<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Level extends BaseController {

    public function index() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        }

        $data = array_merge($this->base_data, [
            'title' => 'Level',
            'account' => $this->MLevel->findAll(),
        ]);

        return view('Admin/Level/index', $data);
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
            
            $level = $this->M_Base->data_where('level', 'id', $id);

            if (count($level) === 1) {

                if ($this->request->getPost('tombol')) {
                    $data_post = [
                        'level_name' => addslashes(trim(htmlentities($this->request->getPost('level_name')))),
                        'price' => addslashes(trim(htmlentities($this->request->getPost('price')))),
                    ];

                    if (empty($data_post['level_name'])) {
                        $this->session->setFlashdata('error', 'Nama level tidak boleh kosong');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else if (empty($data_post['price'])) {
                        $this->session->setFlashdata('error', 'Harga tidak boleh kosong');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else {
                        $this->M_Base->data_update('level', $data_post, $id);

                        $this->session->setFlashdata('success', 'Data level berhasil diedit');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                }

                $data = array_merge($this->base_data, [
                    'level' => $level,
                    'title' => 'Edit level',
                ]);

                return view('Admin/Level/edit', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }
}