<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class GamePopuler extends BaseController {

    public function index() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        }

        $data = array_merge($this->base_data, [
            'title' => 'Game Populer',
            'games' => $this->MGamePop->select('games.games AS name, games.image AS image, game_populer.*')->join('games', 'games.id = game_populer.game_id')->findAll(),
        ]);

        return view('Admin/GamePopuler/index', $data);
    }

    public function add() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        }

        if ($this->request->getPost('tombol')) {
            $data_post = [
                'game_id' => addslashes(trim(htmlentities($this->request->getPost('game_id')))),
            ];

            if (empty($data_post['game_id'])) {
                $this->session->setFlashdata('error', 'Game tidak boleh kosong');
                return redirect()->to(base_url() . '/admin/gamepopuler');
            } else {
                if( count($this->MGamePop->findAll()) < 12){
                    $this->M_Base->data_insert('game_populer', $data_post);

                    $this->session->setFlashdata('success', 'Data berhasil ditambahkan');
                    return redirect()->to(base_url() . '/admin/gamepopuler');
                } else {
                    $this->session->setFlashdata('error', 'Hanya bisa maksimal 12 game');
                    return redirect()->to(base_url() . '/admin/gamepopuler');
                }
            }
        }

        $Id = $this->MGamePop->select('game_id')->findAll();

        $rows = [0];
        foreach ($Id as $key => $value){
            $rows [] = $value['game_id'];
        }

        $data = array_merge($this->base_data, [
            'title' => 'Tambah Game Populer',
            'game' => $this->MGame->whereNotIn('id', $rows)->findAll(),
        ]);

        return view('Admin/GamePopuler/add', $data);
    }

    public function delete($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        } else if (!is_numeric($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            $this->M_Base->data_delete('game_populer', $id);

            $this->session->setFlashdata('success', 'Data berhasil dihapus');
            return redirect()->to(base_url() . '/admin/gamepopuler');
        }
    }
}