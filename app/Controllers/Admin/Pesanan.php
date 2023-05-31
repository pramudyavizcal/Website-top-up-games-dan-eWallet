<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Pesanan extends BaseController {

    public function index() {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        }
        
        if (!in_array('Pesanan', explode(',', $this->admin['permission']))) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Pesanan',
            'orders' => $this->M_Base->all_data('orders'),
            'provider' => $this->M_Base->select_distinct('orders', 'provider'),
    	]);

        return view('Admin/Pesanan/index', $data);
    }

    public function edit($id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        } else if (!is_numeric($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            
            if (!in_array('Pesanan', explode(',', $this->admin['permission']))) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            
            $orders = $this->M_Base->data_where('orders', 'id', $id);

            if (count($orders) === 1) {

                if ($this->request->getPost('tombol')) {
                    $this->M_Base->data_update('orders', [
                        'username' => $this->request->getPost('username'),
                        'wa' => $this->request->getPost('wa'),
                        'product' => $this->request->getPost('product'),
                        'method' => $this->request->getPost('method'),
                        'user_id' => $this->request->getPost('user_id'),
                        'zone_id' => $this->request->getPost('zone_id'),
                        'nickname' => $this->request->getPost('nickname'),
                        'status' => $this->request->getPost('status'),
                        'ket' => $this->request->getPost('ket'),
                    ], $id);

                    $this->session->setFlashdata('success', 'Data pesanan berhasil disimpan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }

                $data = array_merge($this->base_data, [
                    'title' => 'Edit Pesanan',
                    'orders' => $orders[0],
                ]);

                return view('Admin/Pesanan/edit', $data);
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
            
            if (!in_array('Pesanan', explode(',', $this->admin['permission']))) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            
            $orders = $this->M_Base->data_where('orders', 'id', $id);

            if (count($orders) === 1) {
                $this->M_Base->data_delete('orders', $id);

                $this->session->setFlashdata('success', 'Data pesanan berhasil dihapus');
                return redirect()->to(base_url() . '/admin/pesanan');
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }

    public function detail($order_id = null) {

        if ($this->admin == false) {
            $this->session->setFlashdata('error', 'Silahkan login dahulu');
            return redirect()->to(base_url() . '/admin/login');
        } else {
            
            if (!in_array('Pesanan', explode(',', $this->admin['permission']))) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            
            $orders = $this->M_Base->data_where('orders', 'order_id', $order_id);

            if (count($orders) === 1) {

                if ($orders[0]['zone_id'] == 'joki') {
                    
                    $target = '<ul class="mb-0">';
                    $inden = ['No. Hp / Email', 'Password', 'Hero', 'Nickname', 'Catatan', 'Login Via'];
                    $no = 0;
                    foreach(explode(',', $orders[0]['user_id']) as $joki) {
                        
                        $target .= '<li><b>'.$inden[$no].'</b> : '.$joki.'</li>';
                        
                        $no++;
                    }
                    $target .= '</ul>';
                    
                } else {
                    
                    if (!empty($orders[0]['zone_id']) AND $orders[0]['zone_id'] != 1) {
                        $target = $orders[0]['user_id'] . ' (' . $orders[0]['zone_id'] . ')';
                    } else {
                        $target = $orders[0]['user_id'];
                    }
                }

                echo '
                <table class="table table-white table-striped">
                    <tr>
                        <th>No Transaksi</th>
                        <td>'.$orders[0]['order_id'].'</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>'.$orders[0]['username'].'</td>
                    </tr>
                    <tr>
                        <th>Whatsapp</th>
                        <td>'.$orders[0]['wa'].'</td>
                    </tr>
                    <tr>
                        <th>Produk</th>
                        <td>'.$orders[0]['games'].' - '.$orders[0]['product'].'</td>
                    </tr>
                    <tr>
                        <th>ID Player</th>
                        <td>'.$target.'</td>
                    </tr>
                    <tr>
                        <th>Nickname</th>
                        <td>'.$orders[0]['nickname'].'</td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>Rp '.number_format($orders[0]['price'],0,',','.').'</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>'.$orders[0]['status'].'</td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>'.$orders[0]['ket'].'</td>
                    </tr>
                    <tr>
                        <th>Metode</th>
                        <td>'.$orders[0]['method'].'</td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>'.$orders[0]['date_create'].'</td>
                    </tr>
                </table>
                ';
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }
}