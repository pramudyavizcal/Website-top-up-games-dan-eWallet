<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\M_Base;

class WhatsappModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'whatsapp';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['template', 'type', 'created_at', 'updated_at', 'deleted_at'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
    
    public function sendWa($target = null, $data_wa = null, $type = null) 
    {
        $M_Base = new M_Base;

        $username = $data_wa['username'];
        $order_id = $data_wa['order_id'];
        $product = $data_wa['product'];
        $method = $data_wa['method'];
        $total_bayar = $data_wa['total_bayar'];
        $status = $type;

        $template = $this->where('type', "Order " . $type)->first();

        $message = str_replace("#status#", $status, str_replace("#totalbayar#", $total_bayar, str_replace('#metodebayar#', $method, str_replace('#produk#', $product, str_replace("#orderid#", $order_id, str_replace("#username#", $username, $template['template']))))));
        // $message = $order_id . '|' . $product . '|' . $method . '|' .$total_bayar;
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $target,
                // 'message' => "Halo kak, \r\n\r\nBerikut adalah rincian pesanan Anda:\r\n\r\n- Produk : " . $data_wa['product'] . " \r\n- No.Invoice : " . $data_wa['order_id'] . " \r\n- Total Tagihan : " . $data_wa['total_bayar'] . " \r\n- Metode Pembayaran : " . $data_wa['method'] ."\r\n\r\nCek pesanan anda di sini ". base(_url() . "/payment/" . $data_wa['order_id']  ."\r\n\r\nTerima kasih.",
                'message' => $message,
                'countryCode' => '62', //optional
            ),
            CURLOPT_HTTPHEADER => [
                'Authorization:  ' . $M_Base->u_get('fonnte-token') . '' //change TOKEN to your actual token
            ],
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}
