<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Games extends BaseController {

    public function index() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        }
        
        if (!in_array('Games', explode(',', $this->admin['permission']))) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $games = [];
        foreach ($this->M_Base->all_data('games') as $loop) {
            $games[] = array_merge($loop, [
                'product' => $this->M_Base->data_count('product', [
                    'games_id' => $loop['id']
                ]),
            ]);
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Games',
            'games' => $games,
            'subtitle' => 'Subtitle',
            'subtitle' => $games,
    	]);

        return view('Admin/Games/index', $data);
    }

    public function add() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        }
        
        if (!in_array('Games', explode(',', $this->admin['permission']))) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($this->request->getPost('tombol')) {
            $data_post = [
                'games' => addslashes(trim(htmlspecialchars($this->request->getPost('games')))),
                'category' => addslashes(trim(htmlspecialchars($this->request->getPost('category')))),
                'sort' => addslashes(trim(htmlspecialchars($this->request->getPost('sort')))),
                'konten' => addslashes(trim($this->request->getPost('konten'))),
                'target' => addslashes(trim(htmlspecialchars($this->request->getPost('target')))),
                'check_status' => addslashes(trim(htmlspecialchars($this->request->getPost('check_status')))),
                'check_code' => addslashes(trim(htmlspecialchars($this->request->getPost('check_code')))),
            ];

            if (empty($data_post['games'])) {
                $this->session->setFlashdata('error', 'Nama games tidak boleh kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (empty($data_post['category'])) {
                $this->session->setFlashdata('error', 'Kategori games tidak boleh kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else if (empty($data_post['target'])) {
                $this->session->setFlashdata('error', 'Sistem target tidak boleh kosong');
                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
            } else {

                $data_post['sort'] = empty($data_post['sort']) ? '1' : $data_post['sort'];

                $image = $this->M_Base->upload_file($this->request->getFiles()['image'], 'assets/images/games/');

                if ($image) {
                    $this->M_Base->data_insert('games', array_merge($data_post, [
                        'slug' => url_title($data_post['games'], '-', true),
                        'image' => $image,
                        'status' => 'On',
                    ]));

                    $this->session->setFlashdata('success', 'Games berhasil ditambahkan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                } else {
                    $this->session->setFlashdata('error', 'Gambar tidak sesuai');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }
        }

        $data = array_merge($this->base_data, [
            'title' => 'Tambah Games',
            'subtitle' => 'Tambah Subtitle',
            'category' => $this->M_Base->all_data('category'),
        ]);

        return view('Admin/Games/add', $data);
    }

    public function edit($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        } else if (!is_numeric($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            
            if (!in_array('Games', explode(',', $this->admin['permission']))) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            
            $games = $this->M_Base->data_where('games', 'id', $id);

            if (count($games) === 1) {

                if ($this->request->getPost('tombol')) {
                    $data_post = [
                        'games' => addslashes(trim(htmlspecialchars($this->request->getPost('games')))),
                        'subtitle' => addslashes(trim(htmlspecialchars($this->request->getPost('subtitle')))),
                        'category' => addslashes(trim(htmlspecialchars($this->request->getPost('category')))),
                        'sort' => addslashes(trim(htmlspecialchars($this->request->getPost('sort')))),
                        'konten' => addslashes(trim($this->request->getPost('konten'))),
                        'target' => addslashes(trim(htmlspecialchars($this->request->getPost('target')))),
                        'check_status' => addslashes(trim(htmlspecialchars($this->request->getPost('check_status')))),
                        'check_code' => addslashes(trim(htmlspecialchars($this->request->getPost('check_code')))),
                        'status' => addslashes(trim(htmlspecialchars($this->request->getPost('status')))),
                    ];

                    if (empty($data_post['games'])) {
                        $this->session->setFlashdata('error', 'Nama games tidak boleh kosong');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else if (empty($data_post['category'])) {
                        $this->session->setFlashdata('error', 'Kategori games tidak boleh kosong');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else if (empty($data_post['target'])) {
                        $this->session->setFlashdata('error', 'Sistem target tidak boleh kosong');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    } else {

                        $data_post['sort'] = empty($data_post['sort']) ? '1' : $data_post['sort'];

                        $image = $this->M_Base->upload_file($this->request->getFiles()['image'], 'assets/images/games/');

                        if ($image) {
                            $file = 'assets/images/games/' . $games[0]['image'];

                            if (file_exists($file)) {
                                unlink($file);
                            }
                        } else {
                            $image = $games[0]['image'];
                        }

                        $this->M_Base->data_update('games', array_merge($data_post, [
                            'image' => $image,
                        ]), $id);

                        $this->session->setFlashdata('success', 'Games berhasil disimpan');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                }

                $data = array_merge($this->base_data, [
                    'title' => 'Edit Games',
                    'subtitle' => 'Edit Subtitle',
                    'category' => $this->M_Base->all_data('category'),
                    'games' => $games[0],
                ]);

                return view('Admin/Games/edit', $data);

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
            
            if (!in_array('Games', explode(',', $this->admin['permission']))) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            
            $games = $this->M_Base->data_where('games', 'id', $id);

            if (count($games) === 1) {
                $this->M_Base->data_delete('games', $id);

                $this->session->setFlashdata('success', 'Data berhasil dihapus');
                return redirect()->to(base_url() . '/admin/games');
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }
}