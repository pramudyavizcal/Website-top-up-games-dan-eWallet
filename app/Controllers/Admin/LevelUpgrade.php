<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class LevelUpgrade extends BaseController {

    public function index() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        }

        $data = array_merge($this->base_data, [
            'title' => 'Data Upgrade Level',
            'level_upgrade' => $this->MLevelUp->select('level_upgrade.*, users.username')->join('users', 'users.id = level_upgrade.user_id')->findAll(),
        ]);

        return view('Admin/Level-Upgrade/index', $data);
    }

    public function edit($id = null) {
        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        } else if (!is_numeric($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            
            $levelUp = $this->MLevelUp->select('level_upgrade.*, users.username')->join('users', 'users.id = level_upgrade.user_id')->where('level_upgrade.id', $id)->first();

            if (count($levelUp) > 1) {
                if ($this->request->getPost('tombol')) {
                    $data_post = [
                        'id' => $id,
                        'status' => addslashes(trim(htmlentities($this->request->getPost('status')))),
                    ];

                    if (empty($data_post['status'])) {
                        $this->session->setFlashdata('error', 'Status tidak boleh kosong');
                        return redirect()->to(base_url() . '/admin/level-upgrade/edit/' . $id);
                    } else {
                        $level_id = $this->request->getPost('level_id');
                        $user_id = $this->request->getPost('user_id');
                        $status = $this->request->getPost('status');
                        if($status == 'Success'){
                            if($this->MUser->save([
                                'id' => $user_id,
                                'level_id' => $level_id,
                            ])){
                                if($this->MLevelUp->save($data_post)){
                                    $this->session->setFlashdata('success', 'Data berhasil diperbarui');
                                    return redirect()->to(base_url() . '/admin/level-upgrade');
                                }else {
                                    $this->session->setFlashdata('success', 'Data gagal diperbarui');
                                    return redirect()->to(base_url() . '/admin/level-upgrade');
                                }
                            } else {
                                $this->session->setFlashdata('success', 'Data gagal diperbarui');
                                return redirect()->to(base_url() . '/admin/level-upgrade');
                            }
                        } else {
                            if($this->MLevelUp->save($data_post)){
                                $this->session->setFlashdata('success', 'Data berhasil diperbarui');
                                return redirect()->to(base_url() . '/admin/level-upgrade');
                            }else {
                                $this->session->setFlashdata('success', 'Data gagal diperbarui');
                                return redirect()->to(base_url() . '/admin/level-upgrade');
                            }
                        }

                    }
                }

                $data = array_merge($this->base_data, [
                    'level_up' => $levelUp,
                    'title' => 'Edit Data Upgrade Level',
                ]);

                return view('Admin/Level-Upgrade/edit', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }


    public function delete($id = null){
        if($this->MLevelUp->delete($id)){
            $this->session->setFlashdata('success', 'Data upgrade level berhasil dihapus');
            return redirect()->to(base_url() . '/admin/level-upgrade');
        } else {
            $this->session->setFlashdata('error', 'Data upgrade level gagal dihapus');
            return redirect()->to(base_url() . '/admin/level-upgrade');
        }
    }
}