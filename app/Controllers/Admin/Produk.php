<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Produk extends BaseController {

    public function index() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        }
        
        if (!in_array('Produk', explode(',', $this->admin['permission']))) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $product = [];
        foreach ($this->M_Base->all_data('product') as $loop) {
            $games = $this->M_Base->data_where('games', 'id', $loop['games_id']);

            $nama_games = count($games) == 1 ? $games[0]['games'] : '-';

            $product[] = array_merge($loop, [
                'games' => $nama_games,
            ]);
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Produk',
            'product' => $product,
    	]);

        return view('Admin/Produk/index', $data);
    }
    
    public function import() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        }
        
        if (!in_array('Produk', explode(',', $this->admin['permission']))) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        if ($this->request->getPost('tombol')) {
            
            $file_excel = $this->request->getFile('file');
            
            if ($file_excel->getError() == 4) {
                $this->session->setFlashdata('error', 'Silahkan pilih file dahulu');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else {
                
                $ext = $file_excel->getClientExtension();
                
                if (in_array($ext, ['xls', 'xlsx'])) {
                    
                    if ($ext == 'xls') {
        				$render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        			} else {
        				$render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        			}
        			
        			$spreadsheet = $render->load($file_excel);
        	
        			$data = $spreadsheet->getActiveSheet()->toArray();
        			
        			$insert = 0;
        			
        			foreach($data as $x => $row) {
        			    
        				if ($x !== 0) {
        				    
        				    $this->M_Base->data_insert('product', [
        				        'games_id' => $row[0],
        				        'product' => $row[1],
        				        'price' => $row[2],
                                'reseller_price' => $row[3],
                                'vip_price' => $row[4],
        				        'provider' => $row[5],
        				        'sku' => $row[6],
        				        'status' => 'On',
        				        'check_status' => 'Y',
        				        'check_code' => '',
        				        'logo_url' => $row[7],
        				    ]);
        				    
        				    $insert++;
        				    
        				}
        			}
        			
        			$this->session->setFlashdata('success', $insert . ' produk berhasil di tambahkan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else {
                    $this->session->setFlashdata('error', 'Format file harus .xlsx');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Import',
            'games' => $this->M_Base->all_data('games'),
    	]);

        return view('Admin/Produk/import', $data);
    }

    public function add() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        }
        
        if (!in_array('Produk', explode(',', $this->admin['permission']))) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->request->getPost('tombol')) {
            $data_post = [
                'games_id' => addslashes(trim(htmlspecialchars($this->request->getPost('games_id')))),
                'product' => addslashes(trim(htmlspecialchars($this->request->getPost('product')))),
                'price' => addslashes(trim(htmlspecialchars($this->request->getPost('price')))),
                'reseller_price' => addslashes(trim(htmlspecialchars($this->request->getPost('reseller_price')))),
                'vip_price' => addslashes(trim(htmlspecialchars($this->request->getPost('vip_price')))),
                'provider' => addslashes(trim(htmlspecialchars($this->request->getPost('provider')))),
                'sku' => addslashes(trim(htmlspecialchars($this->request->getPost('sku')))),
                'logo_url' => trim(htmlspecialchars($this->request->getPost('logo_url')))
            ];

            if (empty($data_post['games_id']) OR empty($data_post['product']) OR empty($data_post['price']) OR empty($data_post['provider']) OR empty($data_post['sku'])) {
                $this->session->setFlashdata('error', 'Masih ada data yang kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else {
                $games = $this->M_Base->data_where('games', 'id', $data_post['games_id']);

                if (count($games) === 1) {
                    $this->M_Base->data_insert('product', $data_post);

                    $this->session->setFlashdata('success', 'Produk berhasil ditambahkan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else {
                    $this->session->setFlashdata('error', 'Games tidak ditemukan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }
        }

        $data = array_merge($this->base_data, [
            'title' => 'Tambah Produk',
            'games' => $this->M_Base->all_data('games'),
        ]);

        return view('Admin/Produk/add', $data);
    }

    public function edit($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        } else if (is_numeric($id)) {
            
            if (!in_array('Produk', explode(',', $this->admin['permission']))) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            
            $product = $this->M_Base->data_where('product', 'id', $id);

            if (count($product) === 1) {

                if ($this->request->getPost('tombol')) {
                    $data_post = [
                        'games_id' => addslashes(trim(htmlspecialchars($this->request->getPost('games_id')))),
                        'product' => addslashes(trim(htmlspecialchars($this->request->getPost('product')))),
                        'price' => addslashes(trim(htmlspecialchars($this->request->getPost('price')))),
                        'reseller_price' => addslashes(trim(htmlspecialchars($this->request->getPost('reseller_price')))),
                        'vip_price' => addslashes(trim(htmlspecialchars($this->request->getPost('vip_price')))),
                        'provider' => addslashes(trim(htmlspecialchars($this->request->getPost('provider')))),
                        'sku' => addslashes(trim(htmlspecialchars($this->request->getPost('sku')))),
                        'logo_url' => trim(htmlspecialchars($this->request->getPost('logo_url')))
                    ];

                    if (empty($data_post['games_id']) OR empty($data_post['product']) OR empty($data_post['price']) OR empty($data_post['provider']) OR empty($data_post['sku'])) {
                        $this->session->setFlashdata('error', 'Masih ada data yang kosong');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else {
                        $games = $this->M_Base->data_where('games', 'id', $data_post['games_id']);

                        if (count($games) === 1) {
                            $this->M_Base->data_update('product', $data_post, $id);

                            $this->session->setFlashdata('success', 'Produk berhasil disimpan');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else {
                            $this->session->setFlashdata('error', 'Games tidak ditemukan');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        }
                    }
                }

                $data = array_merge($this->base_data, [
                    'title' => 'Edit Produk',
                    'product' => $product[0],
                    'games' => $this->M_Base->all_data('games'),
                ]);

                return view('Admin/Produk/edit', $data);

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
            
            if (!in_array('Produk', explode(',', $this->admin['permission']))) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            
            $product = $this->M_Base->data_where('product', 'id', $id);

            if (count($product) === 1) {

                $this->M_Base->data_delete('product', $id);
                
                $this->session->setFlashdata('success', 'Produk berhasil dihapus');
                return redirect()->to(base_url() . '/admin/produk');

            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}

