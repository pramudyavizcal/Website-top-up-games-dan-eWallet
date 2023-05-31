<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Mutasi extends BaseController
{
    public function index()
    {
        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        }
        
        if($this->request->getPost('filter')){
            $apiKey = $this->M_Base->u_get('cm_key');
            $post_query = [
                'search' => [
                    'date' => [
                        'from' => $this->request->getPost('date_from') . ' 00:00:00',
                        'to'   => $this->request->getPost('date_to') .' 23:59:59',
                    ],
                    'service_code'   => $this->request->getPost('bank'),
                ],
            ];

            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL            => 'https://api.cekmutasi.co.id/v1/bank/search',
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => http_build_query($post_query),
                CURLOPT_HTTPHEADER     => ['Api-Key: ' . $apiKey, 'Accept: application/json'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => false,
                CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4,
            ]);
            
            $result = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($result);
        }


        if(isset($result)){
            $mutasi = $result->response;
        } else {
            $mutasi = [];
        }

        $data = [
                    'title' => 'Mutasi Rekening Bank',
                    'date_from' => $this->request->getPost('date_from') !== null ? $this->request->getPost('date_from') : '',
                    'date_to'   => $this->request->getPost('date_to') !== null ?$this->request->getPost('date_to') : '',
                    'bank'      => $this->request->getPost('bank') !== null ?$this->request->getPost('bank') : '',
                    'mutasi' => $mutasi,
                    'method' => $this->MMethod->where('provider', 'Manual')->findAll(),
                ];
        $data = array_merge($this->base_data, $data);
        return view('Admin/Mutasi/index', $data);
    }
}
