<?php

namespace App\Controllers;

class Pages extends BaseController {


    public function sk() {

    	$data = array_merge($this->base_data, [
    		'title' => 'Syarat & Ketentuan',
            'page_sk' => $this->M_Base->u_get('page_sk'),
    	]);

        return view('Pages/sk', $data);
    }

    public function price() {

        $product = [];
        foreach (array_reverse($this->M_Base->all_data_order('games', 'sort')) as $game) {
            $data_product = $this->M_Base->data_where_array('product', [
                'games_id' => $game['id']
            ], 'price');

            if (count($data_product) !== 0) {
                $product[] = [
                    'games' => $game['games'],
                    'image' => $game['image'],
                    'product' => array_reverse($data_product),
                ];
            }
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Harga',
            'price' => $product,
            'menu_active' => 'Price',
    	]);

        return view('Pages/price', $data);
    }

    public function method() {

    	$data = array_merge($this->base_data, [
    		'title' => 'Metode',
            'method' => $this->M_Base->all_data('method'),
            'menu_active' => 'Method',
    	]);

        return view('Pages/method', $data);
    }

    public function login() {

        if ($this->users !== false) {
            return redirect()->to(base_url());
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
                $users = $this->M_Base->data_where('users', 'username', $data_post['username']);

                if (count($users) === 1) {
                    if ($users[0]['username'] === $data_post['username']) {
                        if ($users[0]['status'] === 'On') {
                            if (password_verify($data_post['password'], $users[0]['password'])) {

                                $this->session->set('level_id', $users[0]['level_id']);
                                $this->session->set('user_id', $users[0]['id']);
                                $this->session->set('username', $users[0]['username']);

                                $this->session->setFlashdata('success', 'Login berhasil');
                                return redirect()->to(base_url() . '/user');
                            } else {
                                $this->session->setFlashdata('error', 'Username atau password salah');
                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                            }
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
            'menu_active' => 'Login',
    	]);

        return view('Pages/login', $data);
    }
    public function register() {

        if ($this->users !== false) {
            return redirect()->to(base_url());
        }

        if ($this->request->getPost('tombol')) {
            
            $data_post = [
                'username' => addslashes(trim(htmlspecialchars($this->request->getPost('username')))),
                'wa' => addslashes(trim(htmlspecialchars($this->request->getPost('wa')))),
                'password' => addslashes(trim(htmlspecialchars($this->request->getPost('password')))),
                'passwordb' => addslashes(trim(htmlspecialchars($this->request->getPost('passwordb')))),
            ];

            if (empty($data_post['username'])) {
                $this->session->setFlashdata('error', 'Username tidak boleh kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (empty($data_post['wa'])) {
                $this->session->setFlashdata('error', 'No. Whatsapp tidak boleh kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (empty($data_post['password'])) {
                $this->session->setFlashdata('error', 'Password tidak boleh kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (empty($data_post['passwordb'])) {
                $this->session->setFlashdata('error', 'Konfirmasi Password tidak boleh kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (strlen($data_post['username']) < 6) {
                $this->session->setFlashdata('error', 'Username minimal 6 karakter');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (strlen($data_post['username']) > 24) {
                $this->session->setFlashdata('error', 'Username maksimal 24 karakter');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (strlen($data_post['password']) < 6) {
                $this->session->setFlashdata('error', 'Password minimal 6 karakter');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (strlen($data_post['password']) > 24) {
                $this->session->setFlashdata('error', 'Password maksimal 24 karakter');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (strlen($data_post['wa']) < 10) {
                $this->session->setFlashdata('error', 'No. Whatsapp tidak sesuai');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (strlen($data_post['wa']) > 14) {
                $this->session->setFlashdata('error', 'No. Whatsapp tidak sesuai');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (!is_numeric($data_post['wa'])) {
                $this->session->setFlashdata('error', 'No. Whatsapp tidak sesuai');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if ($data_post['password'] !== $data_post['passwordb']) {
                $this->session->setFlashdata('error', 'Konfirmasi password tidak sesuai');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else {
                
                $users = $this->M_Base->data_where('users', 'username', $data_post['username']);

                if (count($users) === 0) {
                    
                    $this->M_Base->data_insert('users', [
                        'username' => $data_post['username'],
                        'password' => password_hash($data_post['password'], PASSWORD_DEFAULT),
                        'wa' => $data_post['wa'],
                        'level_id' => 1,
                        'balance' => 0,
                        'status' => 'On',
                        'date_create' => date('Y-m-d G:i:s'),
                    ]);
                    
                    $this->session->setFlashdata('success', 'Pendaftaran akun berhasil');
                    return redirect()->to(base_url() . '/login');
                   
                } else {
                    $this->session->setFlashdata('error', 'Username sudah digunakan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Register',
            'menu_active' => 'Login',
    	]);

        return view('Pages/register', $data);
    }

    public function logout() {
        session_destroy();
        $this->session->remove('username');

        $this->session->setFlashdata('success', 'Logout berhasil');
        return redirect()->to(base_url() . '/login');
    }
}
