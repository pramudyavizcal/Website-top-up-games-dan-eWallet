<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Kategori extends BaseController {

    public function index() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        }
        
        if (!in_array('Kategori', explode(',', $this->admin['permission']))) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->request->getPost('tombol')) {
            $data_post = [
                'icon' => $this->request->getPost('icon'),
                'category' => addslashes(trim(htmlspecialchars($this->request->getPost('category')))),
                'sort' => addslashes(trim(htmlspecialchars($this->request->getPost('sort')))),
            ];

            if (empty($data_post['category'])) {
                $this->session->setFlashdata('error', 'Nama kategori baru tidak boleh kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else {
                $data_post['sort'] = empty($data_post['sort']) ? '1' : $data_post['sort'];

                $this->M_Base->data_insert('category', $data_post);

                $this->session->setFlashdata('success', 'Kategori baru berhasil ditambahkan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            }
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Kategori',
            'kategori' => $this->M_Base->all_data('category'),
    	]);

        return view('Admin/Kategori/index', $data);
    }

    public function edit($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        } else if (is_numeric($id)) {
            
            if (!in_array('Kategori', explode(',', $this->admin['permission']))) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            
            $kategori = $this->M_Base->data_where('category', 'id', $id);

            if (count($kategori) === 1) {
                if ($this->request->getPost('sort')) {
                    if (is_numeric($this->request->getPost('sort'))) {
                        $this->M_Base->data_update('category', [
                            'icon' => $this->request->getPost('icon'),
                            'sort' => $this->request->getPost('sort'),
                        ], $id);
                    } else {
                        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                    }
                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function delete($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        } else if (is_numeric($id)) {
            
            if (!in_array('Kategori', explode(',', $this->admin['permission']))) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            
            $kategori = $this->M_Base->data_where('category', 'id', $id);

            if (count($kategori) === 1) {
                $this->M_Base->data_delete('category', $id);

                $this->session->setFlashdata('success', 'Data berhasil dihapus');
                return redirect()->to(base_url() . '/admin/kategori');
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}