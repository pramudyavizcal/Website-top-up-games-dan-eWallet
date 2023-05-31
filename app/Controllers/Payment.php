<?php

namespace App\Controllers;

class Payment extends BaseController {

    public function index($order_id = null) {

    	if ($order_id === null) {

            if ($this->request->getPost('order_id')) {
                $orders = $this->M_Base->data_where('orders', 'order_id', $this->request->getPost('order_id'));

                if (count($orders) == 1) {
                    if ($orders[0]['order_id'] === $this->request->getPost('order_id')) {
                        return redirect()->to(base_url() . '/payment/' . $orders[0]['order_id']);
                    } else {
                        $this->session->setFlashdata('error', 'No Transaksi tidak ditemukan');
                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                    }
                } else {
                    $this->session->setFlashdata('error', 'No Transaksi tidak ditemukan');
                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                }
            }

    		$data = array_merge($this->base_data, [
	    		'title' => 'Pembayaran',
                'menu_active' => 'Cek',
	    	]);

	        return view('Payment/index', $data);

    	} else {
    		$orders = $this->M_Base->data_where('orders', 'order_id', $order_id);

    		if (count($orders) === 1) {

                $method = $this->M_Base->data_where('method', 'id', $orders[0]['method_id']);

                $instruksi = count($method) == 1 ? $method[0]['instruksi'] : '-';

    			$data = array_merge($this->base_data, [
		    		'title' => 'Detail Pembayaran',
		    		'orders' => array_merge($orders[0], [
                        'instruksi' => $instruksi,
                    ]),
                    'menu_active' => 'Cek',
		    	]);

		        return view('Payment/detail', $data);
    		} else {
    			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    		}
    	}
    }
}
