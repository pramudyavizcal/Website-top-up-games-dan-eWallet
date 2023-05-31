<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Home extends BaseController {

    public function index() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        }

        if ($this->request->getPost('daterange')) {
            $daterange = explode(' - ', $this->request->getPost('daterange'));

            $end_date = fix_date($daterange[0]);
            $start_date = fix_date($daterange[1]);

        } else {
            $end_date = date('Y-m-d', time()-60*60*24*7);
            $start_date = date('Y-m-d');
        }

        $chart = [];
        foreach ($this->M_Base->data_avg('orders', 'date', [$end_date, $start_date], true) as $date) {
            $chart[] = [
                'tanggal' => $date['date'],
                'total' => $this->M_Base->data_count('orders', ['date' => $date['date']]),
            ];
        }
        
        $total_orders = 0;
        foreach($this->M_Base->all_data('orders') as $loop) {
            $total_orders += $loop['price'];
        }

        $TopUpData = $this->MTopUp->select('DISTINCT(username)')
                                ->select('SUM(amount) AS amount')
                                ->groupBy('username')
                                ->orderBy('amount ASC')
                                ->findAll();

        // dd($TopUpData);
        $rows = [];
        foreach ($TopUpData as $key => $value) {
            $TopUp = $this->MTopUp->select('username, method, amount, date_create')
                                ->where('username', $value['username'])
                                ->first();

            $row['username']  = $TopUp['username'];
            $row['method']    = $TopUp['method'];
            $row['amount']    = $TopUp['amount'];
            $row['date_create'] = $TopUp['date_create'];

            $rows[] = $row;
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Administrator',
    		'total_trx_pending' => (int) count( $this->MOrder->where('status', 'Pending')->findAll()),
    		'total_trx_proses'  => (int) count( $this->MOrder->where('status', 'Processing')->findAll()),
            'total_trx_sukses'  => (int) count( $this->MOrder->where('status', 'Success')->findAll()),
    		'total_trx_batal'   => (int) count( $this->MOrder->where('status', 'Canceled')->findAll()),
    		'topup_terbanyak'   => $rows,
            'total' => [
                'admin' => $this->M_Base->data_count('admin'),
                'games' => $this->M_Base->data_count('games'),
                'product' => $this->M_Base->data_count('product'),
                'orders' => '(' . $this->M_Base->data_count('orders') . ') Rp ' . number_format($total_orders,0,',','.'),
            ],
            'chart' => $chart,
            'date_range' => reverse_date($end_date, $start_date),
    	]);

        return view('Admin/Home/index', $data);
    }

    public function password() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        }

        if ($this->request->getPost('tombol')) {
            $data_post = [
                'passwordl' => addslashes(trim(htmlspecialchars($this->request->getPost('passwordl')))),
                'passwordb' => addslashes(trim(htmlspecialchars($this->request->getPost('passwordb')))),
                'passwordbb' => addslashes(trim(htmlspecialchars($this->request->getPost('passwordbb')))),
            ];

            if (empty($data_post['passwordl'])) {
                $this->session->setFlashdata('error', 'Password lama tidak boleh kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (empty($data_post['passwordb'])) {
                $this->session->setFlashdata('error', 'Password baru tidak boleh kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (empty($data_post['passwordbb'])) {
                $this->session->setFlashdata('error', 'Konfirmasi password tidak boleh kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (!password_verify($data_post['passwordl'], $this->admin['password'])) {
                $this->session->setFlashdata('error', 'Password lama tidak sesuai');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (strlen($data_post['passwordb']) < 6) {
                $this->session->setFlashdata('error', 'Password baru minimal 6 karakter');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (strlen($data_post['passwordb']) > 24) {
                $this->session->setFlashdata('error', 'Password baru maksimal 24 karakter');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if ($data_post['passwordb'] !== $data_post['passwordbb']) {
                $this->session->setFlashdata('error', 'Konfirmasi password tidak sesuai');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else {
                $this->M_Base->data_update('admin', [
                    'password' => password_hash($data_post['passwordb'], PASSWORD_DEFAULT),
                ], $this->admin['id']);

                $this->session->setFlashdata('success', 'Password berhasil disimpan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            }
        }

        $data = array_merge($this->base_data, [
            'title' => 'Ganti Password',
        ]);

        return view('Admin/Home/password', $data);
    }

    public function login() {

        if ($this->admin !== false) {
            return redirect()->to(base_url() . '/admin');
        }

        if ($this->request->getPost('tombol')) {
            $data_post = [
                'username' => addslashes(trim(htmlspecialchars($this->request->getPost('username')))),
                'password' => addslashes(trim(htmlspecialchars($this->request->getPost('password')))),
            ];

            if (empty($data_post['username'])) {
                $this->session->setFlashdata('error', 'Username tidak boleh kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (empty($data_post['password'])) {
                $this->session->setFlashdata('error', 'Password tidak boleh kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else {
                $admin = $this->M_Base->data_where('admin', 'username', $data_post['username']);

                if (count($admin) === 1) {
                    if (password_verify($data_post['password'], $admin[0]['password'])) {
                        if ($admin[0]['status'] === 'On') {
                            $this->session->set('admin', $admin[0]['username']);

                            $this->session->setFlashdata('success', 'Login berhasil');
                            return redirect()->to(base_url() . '/admin');
                        } else {
                            $this->session->setFlashdata('error', 'Akun kamu telah dinonaktifkan');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        }
                    } else {
                        $this->session->setFlashdata('error', 'Username atau password salah');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                } else {
                    $this->session->setFlashdata('error', 'Username atau password salah');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Login',
    	]);

        return view('Admin/Home/login', $data);
    }
}
