<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Pengguna extends BaseController {

    public function index() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        }
        
        if (!in_array('Pengguna', explode(',', $this->admin['permission']))) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = array_merge($this->base_data, [
            'title' => 'Pengguna',
            'account' => $this->M_Base->all_data('users'),
        ]);

        return view('Admin/Pengguna/index', $data);
    }

    public function add() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        }
        
        if (!in_array('Pengguna', explode(',', $this->admin['permission']))) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->request->getPost('tombol')) {
            $data_post = [
                'username' => addslashes(trim(htmlentities($this->request->getPost('username')))),
                'password' => addslashes(trim(htmlentities($this->request->getPost('password')))),
                'level_id' => 1,
                'balance' => addslashes(trim(htmlentities($this->request->getPost('balance')))),
                'wa' => addslashes(trim(htmlentities($this->request->getPost('wa')))),
            ];

            if (empty($data_post['username'])) {
                $this->session->setFlashdata('error', 'Username tidak boleh kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (empty($data_post['password'])) {
                $this->session->setFlashdata('error', 'Password tidak boleh kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (empty($data_post['wa'])) {
                $this->session->setFlashdata('error', 'Whatsapp tidak boleh kosong');
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
            } else {

                $find_user = $this->M_Base->data_where('users', 'username', $data_post['username']);

                if (count($find_user) === 0) {
                    $this->M_Base->data_insert('users', array_merge($data_post, [
                        'password' => password_hash($data_post['password'], PASSWORD_DEFAULT),
                        'status' => 'On',
                        'date_create' => date('Y-m-d G:i:s'),
                    ]));

                    $this->session->setFlashdata('success', 'Pengguna berhasil ditambahkan <br> Username : ' . $data_post['username'] . '<br>Password : ' . $data_post['password'] . '<br>Saldo : ' . number_format($data_post['balance'],0,',','.'));
                    return redirect()->to(base_url() . '/admin/pengguna');
                } else {
                    $this->session->setFlashdata('error', 'Username sudah digunakan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }
        }

        $data = array_merge($this->base_data, [
            'title' => 'Tambah Pengguna',
            'level' => $this->MLevel->findAll(),
        ]);

        return view('Admin/Pengguna/add', $data);
    }

    public function edit($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        } else if (!is_numeric($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            
            if (!in_array('Pengguna', explode(',', $this->admin['permission']))) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            
            $account = $this->M_Base->data_where('users', 'id', $id);

            if (count($account) === 1) {

                if ($this->request->getPost('tombol')) {
                    $data_post = [
                        'balance' => addslashes(trim(htmlspecialchars($this->request->getPost('balance')))),
                        'status' => addslashes(trim(htmlspecialchars($this->request->getPost('status')))),
                        'wa' => addslashes(trim(htmlspecialchars($this->request->getPost('wa')))),
                        'level_id' => addslashes(trim(htmlentities($this->request->getPost('level_id')))),
                    ];

                    if (empty($data_post['status']) OR empty($data_post['wa'])) {
                        $this->session->setFlashdata('error', 'Nomor wa tidak boleh kosong');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else if (strlen($data_post['wa']) < 10 OR strlen($data_post['wa']) > 14) {
                        $this->session->setFlashdata('error', 'Nomor wa tidak sesuai');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else {
                        $this->M_Base->data_update('users', $data_post, $id);

                        $this->session->setFlashdata('success', 'Data pengguna berhasil disimpan');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                }

                $data = array_merge($this->base_data, [
                    'title' => 'Edit Pengguna',
                    'account' => $account[0],
                    'level' => $this->MLevel->findAll(),
                ]);

                return view('Admin/Pengguna/edit', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }

    public function delete($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        } else if (!is_numeric($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            
            if (!in_array('Pengguna', explode(',', $this->admin['permission']))) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            
            $account = $this->M_Base->data_where('users', 'id', $id);

            if (count($account) === 1) {
                $this->M_Base->data_delete('users', $id);

                $this->session->setFlashdata('success', 'Data pengguna berhasil dihapus');
                return redirect()->to(base_url() . '/admin/pengguna');
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }

    public function reset($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        } else if (!is_numeric($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            
            if (!in_array('Pengguna', explode(',', $this->admin['permission']))) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            
            $account = $this->M_Base->data_where('users', 'id', $id);

            if (count($account) === 1) {

                $password = $this->M_Base->random_string(6);

                $this->M_Base->data_update('users', [
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                ], $id);

                $this->session->setFlashdata('success', 'Password pengguna berhasil direset : ' . $password);
                return redirect()->to(base_url() . '/admin/pengguna/edit/' . $id);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }
}