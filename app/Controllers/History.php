<?php
namespace App\Controllers;

class History extends BaseController{

    public function riwayat() {
        $product = [];
        foreach (array_reverse($this->M_Base->all_data_riwayat('orders', 'date = DATE(NOW())',10)) as $game) {
                $product[] = [
                    'date_create' => $game['date_create'],
                    'order_id' => $game['order_id'],
                    'product' => $game['product'],
                    'price' => $game['price'],
                    'status' => $game['status'],
                ];
            
        }

    	$data = array_merge($this->base_data, [
    		'title' => 'Riwayat Transaksi Hari Ini',
            'data' => $product,
            'menu_active' => 'Riwayat',
    	]);


        return view('Pages/riwayat', $data);
    }
    


    
}