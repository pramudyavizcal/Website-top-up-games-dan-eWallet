<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Sosmed extends BaseController {

    public function index() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        }
        
        if (!in_array('Sosmed', explode(',', $this->admin['permission']))) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Sosmed',
    	]);

        return view('Admin/Sosmed/index', $data);
    }
    
    public function add() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        }
        
        if (!in_array('Sosmed', explode(',', $this->admin['permission']))) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        if ($this->request->getPost('tombol')) {
            
            $data_post = [
                'link' => $this->request->getPost('link'),
            ];
            
            $image = $this->M_Base->upload_file($this->request->getFile('image'), 'assets/images/sosmed/');
            
            if ($image) {
                
                $this->M_Base->data_insert('sosmed', array_merge($data_post, [
                    'image' => $image,
                ]));
                
                $this->session->setFlashdata('success', 'Sosmed berhasil ditambahkan');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                
            } else {
                $this->session->setFlashdata('error', 'Gambar tidak sesuai');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            }
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Tambah Sosmed',
    	]);

        return view('Admin/Sosmed/add', $data);
    }
    
    public function edit($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        } else if (!is_numeric($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            
            if (!in_array('Sosmed', explode(',', $this->admin['permission']))) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            
            $sosmed = $this->M_Base->data_where('sosmed', 'id', $id);

            if (count($sosmed) === 1) {
                
                if ($this->request->getPost('tombol')) {
            
                    $data_post = [
                        'link' => $this->request->getPost('link'),
                    ];
                    
                    $image = $this->M_Base->upload_file($this->request->getFile('image'), 'assets/images/sosmed/');
                    
                    if ($image) {
                        
                        $file = $sosmed[0]['image'];
                        
                        if (!empty($file)) {
                            
                            $path = 'assets/images/sosmed/' . $file;
                            
                            if (file_exists($path)) {
                                unlink($path);
                            }
                        }
                        
                    } else {
                        $image = $sosmed[0]['image'];
                    }
                    
                    $this->M_Base->data_update('sosmed', array_merge($data_post, [
                        'image' => $image,
                    ]), $id);
                    
                    $this->session->setFlashdata('success', 'Sosmed berhasil disimpan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
                
                $data = array_merge($this->base_data, [
            		'title' => 'Edit Sosmed',
                    'sosmeda' => $sosmed[0],
            	]);
        
                return view('Admin/Sosmed/edit', $data);
                
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
            
            if (!in_array('Sosmed', explode(',', $this->admin['permission']))) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            
            $sosmed = $this->M_Base->data_where('sosmed', 'id', $id);

            if (count($sosmed) === 1) {
                
                $file = $sosmed[0]['image'];
                        
                if (!empty($file)) {
                    
                    $path = 'assets/images/sosmed/' . $file;
                    
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
                
                $this->M_Base->data_delete('sosmed', $id);

                $this->session->setFlashdata('success', 'Data sosmed berhasil dihapus');
                return redirect()->to(base_url() . '/admin/sosmed');
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }
}