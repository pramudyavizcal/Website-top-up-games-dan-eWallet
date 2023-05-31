<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Admin extends BaseController {

    public function index() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        }
        
        if (!in_array('Admin', explode(',', $this->admin['permission']))) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Admin',
            'account' => $this->M_Base->all_data('admin'),
    	]);

        return view('Admin/Admin/index', $data);
    }

    public function add() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        }
        
        if (!in_array('Admin', explode(',', $this->admin['permission']))) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->request->getPost('tombol')) {
            
            $data_post = [
                'permission' => implode(',', $this->request->getPost('permission')),
                'username' => addslashes(trim(htmlspecialchars($this->request->getPost('username')))),
                'password' => addslashes(trim(htmlspecialchars($this->request->getPost('password')))),
            ];

            if (empty($data_post['username'])) {
                $this->session->setFlashdata('error', 'Username tidak boleh kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (empty($data_post['password'])) {
                $this->session->setFlashdata('error', 'Password tidak boleh kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (strlen($data_post['password']) < 6) {
                $this->session->setFlashdata('error', 'Password minimal 6 karakter');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (strlen($data_post['password']) > 24) {
                $this->session->setFlashdata('error', 'Password maksimal 24 karakter');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else {
                $find_admin = $this->M_Base->data_where('admin', 'username', $data_post['username']);

                if (count($find_admin) === 0) {
                    $this->M_Base->data_insert('admin', [
                        'username' => $data_post['username'],
                        'password' => password_hash($data_post['password'], PASSWORD_DEFAULT),
                        'status' => 'On',
                        'date_create' => date('Y-m-d G:i:s'),
                    ]);

                    $this->session->setFlashdata('success', 'Akun admin berhasil ditambahkan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else {
                    $this->session->setFlashdata('error', 'Username sudah terdaftar');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }
        }

        $data = array_merge($this->base_data, [
            'title' => 'Tambah Admin',
        ]);

        return view('Admin/Admin/add', $data);
    }

    public function edit($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        } else if (!is_numeric($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            
            if (!in_array('Admin', explode(',', $this->admin['permission']))) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            
            $admin = $this->M_Base->data_where('admin', 'id', $id);

            if (count($admin) === 1) {

                if ($this->request->getPost('tombol')) {
                    
                    $data_post = [
                        'permission' => implode(',', $this->request->getPost('permission')),
                        'status' => addslashes(trim(htmlspecialchars($this->request->getPost('status')))),
                    ];

                    if (empty($data_post['status'])) {
                        $this->session->setFlashdata('error', 'Status tidak boleh kosong');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else {
                        $this->M_Base->data_update('admin', $data_post, $id);

                        $this->session->setFlashdata('success', 'Data admin berhasil disimpan');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                }

                $data = array_merge($this->base_data, [
                    'title' => 'Edit Admin',
                    'account' => $admin[0],
                ]);

                return view('Admin/Admin/edit', $data);
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
            
            if (!in_array('Admin', explode(',', $this->admin['permission']))) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            
            $admin = $this->M_Base->data_where('admin', 'id', $id);

            if (count($admin) === 1) {
                $this->M_Base->data_delete('admin', $id);

                $this->session->setFlashdata('success', 'Data admin berhasil dihapus');
                return redirect()->to(base_url() . '/admin/admin');
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }

    public function reset($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        } else {
            
            if (!in_array('Admin', explode(',', $this->admin['permission']))) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            
            $admin = $this->M_Base->data_where('admin', 'id', $id);

            if (count($admin) === 1) {

                $password = $this->M_Base->random_string(6);

                $this->M_Base->data_update('admin', [
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                ], $id);

                $this->session->setFlashdata('success', 'Password berhasil direset : ' . $password);
                return redirect()->to(base_url() . '/admin/admin');

            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }
    public function logout() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        } else {
            if ($this->session->get('admin')) {
                $this->session->remove('admin');

                $this->session->setFlashdata('success', 'Logout berhasil');
                return redirect()->to(base_url() . '/admin/login');
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }
}