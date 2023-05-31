<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Whatsapp extends BaseController
{
    public function index()
    {
        $data = [
                    'title' => 'Whatsapp Template',
                    'whatsapp' => $this->MWa->findAll()
                ];
        $data = array_merge($this->base_data, $data);
        return view('Admin/Whatsapp/index', $data);
    }

    public function edit($id = null)
    {
        $data = [
                    'title' => 'Whatsapp Template',
                    'whatsapp' => $this->MWa->where('id', $id)->first()
                ];
        $data = array_merge($this->base_data, $data);
        return view('Admin/Whatsapp/edit', $data);
    }

    public function add()
    {
        $id = $this->request->getPost('id');
        $template = $this->request->getPost('template');

        if($this->MWa->save([
                    'id' => $id,
                    'template' => $template
            ])){
            session()->setFlashData('success', 'Data berhasil disimpan');
            return redirect()->to(base_url('/admin/whatsapp'));
        } else {
            session()->setFlashData('error', 'Data gagal disimpan');
            return redirect()->to(base_url('/admin/whatsapp'));
        }
    }
}
