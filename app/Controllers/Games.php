<?php

namespace App\Controllers;

class Games extends BaseController {

    public function index($slug = null) {
        if ($slug) {
            $games = $this->M_Base->data_where('games', 'slug', $slug);

            if (count($games) === 1) {
                if ($games[0]['slug'] === $slug) {

                    if ($this->request->getPost('tombol')) {
                        
                        $data_post = [
                            'user_id' => addslashes(trim(htmlspecialchars($this->request->getPost('user_id')))),
                            'zone_id' => addslashes(trim(htmlspecialchars($this->request->getPost('zone_id')))),
                            'username' => addslashes(trim(htmlspecialchars($this->request->getPost('username')))),
                            'method' => addslashes(trim(htmlspecialchars($this->request->getPost('method')))),
                            'product' => addslashes(trim(htmlspecialchars($this->request->getPost('product')))),
                            'wa' => addslashes(trim(htmlspecialchars($this->request->getPost('wa')))),
                        ];
                        
                        if ($data_post['zone_id'] == 'joki') {
                                
                            $data_post['user_id'] = str_replace([
                                '&quot;',
                                '[',
                                ']',
                            ], [
                                '',
                                '',
                                '',
                            ], $data_post['user_id']);
                            
                            if (count(explode(',', $data_post['user_id'])) !== 6) {
                                $this->session->setFlashdata('error', 'Pembelian gagal dilakukan');
                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                            }
                            
                            $no = 0;
                            $pesan = "Pesanan Joki\n";
                            $inden = ['Email', 'Password', 'Hero', 'Nickname', 'Catatan', 'Login Via'];
                            foreach(explode(',', $data_post['user_id']) as $joki) {
                                
                                $pesan .= $inden[$no] . ' : ' . $joki . "\n";
                                
                                $no++;
                            }
                        }

                        if (empty($data_post['user_id']) OR empty($data_post['zone_id'])) {
                            $this->session->setFlashdata('error', 'ID Player harus diisi');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else if (empty($data_post['method'])) {
                            $this->session->setFlashdata('error', 'Metode belum dipilih');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else if (empty($data_post['product'])) {
                            $this->session->setFlashdata('error', 'Produk belum dipilih');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else if (empty($data_post['wa'])) {
                            $this->session->setFlashdata('error', 'Nomor whatsapp tidak sesuai');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else if (strlen($data_post['wa']) < 10 OR strlen($data_post['wa']) > 15) {
                            $this->session->setFlashdata('error', 'Nomor whatsapp tidak sesuai');
                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                        } else {
                            // $product = $this->M_Base->data_where('product', 'id', $data_post['product']);
                            if(session('user_id')){
                                $level = $this->MLevel->select('level_name')->where('id',$this->MUser->select('level_id')->find(session('user_id'))['level_id'])->first()['level_name'];

                                if($level == 'Member'){
                                    $product = $this->MProduct->select('id, games_id, product, price, provider, sku, status, check_status, check_code, logo_url')->where('id', $data_post['product'])->findAll();
                                } else if ($level == 'Reseller') {
                                    $product = $this->MProduct->select('id, games_id, product, reseller_price AS price, provider, sku, status, check_status, check_code, logo_url')->where('id', $data_post['product'])->findAll();
                                } else if ($level == 'VIP') {
                                    $product = $this->MProduct->select('id, games_id, product, vip_price AS price, provider, sku, status, check_status, check_code, logo_url')->where('id', $data_post['product'])->findAll();
                                } else {
                                    $product = $this->MProduct->select('id, games_id, product, price, provider, sku, status, check_status, check_code, logo_url')->where('id', $data_post['product'])->findAll();
                                }
                            } else {
                                $product = $this->MProduct->select('id, games_id, product, price, provider, sku, status, check_status, check_code, logo_url')->where('id', $data_post['product'])->findAll();
                            }

                            
                            if (count($product) > 0) {
                                if ($product[0]['status'] == 'On') {

                                    if ($data_post['method'] === 'balance') {
                                        $method = [
                                            [
                                                'id' => 10001,
                                                'status' => 'On',
                                                'provider' => 'Balance',
                                                'method' => 'Saldo Akun',
                                                'uniq' => 'N',
                                            ]
                                        ];
                                    } else {
                                        $method = $this->M_Base->data_where('method', 'id', $data_post['method']);
                                    }
                                    
                                    if (count($method) > 0) {
                                        if ($method[0]['status'] == 'On') {

                                            if ($this->users == false) {
                                                $username = '';
                                                $username_tripay = 'Default';
                                                $username_ipaymu = 'Default';
                                            } else {
                                                $username = $this->users['username'];
                                                $username_tripay = $this->users['username'];
                                                $username_ipaymu = $this->users['username'];
                                            }

                                            $status = 'Pending';
                                            $payment_status = 'Unpaid';
                                            $expired_time = "";
                                            $ket = 'Menunggu Pembayaran';

                                            $order_id = 'TP' .date('Ymd') . rand(0000,9999);

                                            // $find_price = $this->M_Base->data_where_array('price', [
                                            //     'method_id' => $data_post['method'],
                                            //     'product_id' => $data_post['product'],
                                            // ]);

                                            if(session('user_id')){
                                                $level = $this->MLevel->select('level_name')->where('id',$this->MUser->select('level_id')->find(session('user_id'))['level_id'])->first()['level_name'];
                                                if($level == 'Member'){
                                                    $find_price = $this->MPrice->select('price')->where(['method_id' => $data_post['method'], 'product_id' => $data_post['product']])->findAll();
                                                } else if($level == 'Reseller') {
                                                    $find_price = $this->MPrice->select('reseller_price AS price')->where(['method_id' => $data_post['method'], 'product_id' => $data_post['product']])->findAll();
                                                } else if($level == 'VIP') {
                                                    $find_price = $this->MPrice->select('vip_price AS price')->where(['method_id' => $data_post['method'], 'product_id' => $data_post['product']])->findAll();
                                                }
                                            } else {
                                                $find_price = $this->MPrice->select('price')->where(['method_id' => $data_post['method'], 'product_id' => $data_post['product']])->findAll();
                                            }

                                            $uniq = ($method[0]['uniq'] == 'Y') ? rand(000,999) : 0;

                                            $price = count($find_price) == 1 ? $find_price[0]['price'] : $product[0]['price'];
                                            
                                            $quantity = 1;
                                            if ($this->request->getPost('quantity')) {
                                                
                                                if (is_numeric($this->request->getPost('quantity'))) {
                                                    $quantity = $this->request->getPost('quantity');
                                                }
                                            }
                                            
                                            $price = ($price * $quantity) + $uniq;

                                            if ($method[0]['provider'] == 'Tripay') {

                                                $data = [
                                                    'method'         => $method[0]['code'],
                                                    'merchant_ref'   => $order_id,
                                                    'amount'         => $price,
                                                    'customer_name'  => $username_tripay,
                                                    'customer_email' => 'email@domain.com',
                                                    'customer_phone' => $data_post['wa'],
                                                    'order_items'    => [
                                                        [
                                                            'sku'         => $product[0]['sku'],
                                                            'name'        => $product[0]['product'],
                                                            'price'       => $price,
                                                            'quantity'    => 1,
                                                        ]
                                                    ],
                                                    'return_url'   => base_url(),
                                                    'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
                                                    'signature'    => hash_hmac('sha256', $this->M_Base->u_get('tripay-merchant').$order_id.$price, $this->M_Base->u_get('tripay-private'))
                                                ];

                                                $curl = curl_init();

                                                curl_setopt_array($curl, [
                                                    CURLOPT_FRESH_CONNECT  => true,
                                                    CURLOPT_URL            =>  $this->tripay_base . 'transaction/create',
                                                    CURLOPT_RETURNTRANSFER => true,
                                                    CURLOPT_HEADER         => false,
                                                    CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$this->M_Base->u_get('tripay-key')],
                                                    CURLOPT_FAILONERROR    => false,
                                                    CURLOPT_POST           => true,
                                                    CURLOPT_POSTFIELDS     => http_build_query($data),
                                                    CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
                                                ]);

                                                $result = curl_exec($curl);
                                                $result = json_decode($result, true);
                                                
                                                if ($result) {
                                                    if ($result['success'] == true) {
                                                        if (array_key_exists('qr_url', $result['data'])) {
                                                            $expired_time = date("Y-m-d H:i:s", $result['data']['expired_time']);
                                                            $payment_code = $result['data']['qr_url'];
                                                        } else {
                                                            $payment_code = $result['data']['pay_code'];
                                                        }
                                                    } else {
                                                        $this->session->setFlashdata('error', 'Result : ' . $result['message']);
                                                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                    }
                                                } else {
                                                    $this->session->setFlashdata('error', 'Gagal terkoneksi ke Tripay');
                                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                }

                                            } else if ($method[0]['provider'] == 'iPaymu') {
                                                
                                                $ex_method = explode('.', $method[0]['code']);
                                                
                                                if (count($ex_method) == 2) {
                                                    
                                                    $va = $this->M_Base->u_get('ip_va');
                                                    $secret = $this->M_Base->u_get('ip_secret');
                                                    
                                                    $curl = curl_init();
                                                    
                                                    $body['name']       = $username_ipaymu;
                                                    $body['phone']      = $data_post['wa'];
                                                    $body['email']      = 'email@domain.com';
                                                    $body['amount']     = $price;
                                                    $body['referenceId']= $order_id;
                                                    $body['product']    = array($product[0]['product']);
                                                    $body['qty']        = array('1');
                                                    $body['price']      = array($price);
                                                    $body['returnUrl']  = base_url();
                                                    $body['cancelUrl']  = base_url();
                                                    $body['notifyUrl']  = $this->ipaymu_notify;
                                                    $body['paymentMethod']  = $ex_method[0];
                                                    $body['paymentChannel']  = $ex_method[1];
                                                    
                                                    $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
                                                    $requestBody  = strtolower(hash('sha256', $jsonBody));
                                                    $stringToSign = strtoupper('POST') . ':' . $va . ':' . $requestBody . ':' . $secret;
                                                    $timestamp    = Date('YmdHis');
                                                    
                                                    curl_setopt_array($curl, array(
                                                        CURLOPT_URL => $this->ipaymu_base .'api/v2/payment/direct',
                                                        CURLOPT_RETURNTRANSFER => true,
                                                        CURLOPT_ENCODING => '',
                                                        CURLOPT_MAXREDIRS => 10,
                                                        CURLOPT_TIMEOUT => 0,
                                                        CURLOPT_FOLLOWLOCATION => true,
                                                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                        CURLOPT_CUSTOMREQUEST => 'POST',
                                                        CURLOPT_POSTFIELDS => $jsonBody,
                                                        CURLOPT_HTTPHEADER => array(
                                                            'Content-Type: application/json',
                                                            'signature: ' . hash_hmac('sha256', $stringToSign, $secret),
                                                            'va: ' . $va,
                                                            'timestamp: ' . $timestamp
                                                        ),
                                                    ));
                                                    
                                                    $response = curl_exec($curl);
                                                    $response = json_decode($response, true);
                                                    
                                                    if ($response) {
                                                        if ($response['Status'] == 200) {
                                                            $expired_time = $response['Data']['Expired'];
                                                            $payment_code = $response['Data']['PaymentNo'];
                                                    
                                                        } else {
                                                            $this->session->setFlashdata('error', 'iPaymu : ' . $response['Message']);
                                                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                        }
                                                    } else {
                                                        $this->session->setFlashdata('error', 'Gagal terkoneksi ke iPaymu');
                                                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                    }
                                                } else {
                                                    $this->session->setFlashdata('error', 'Kode metode tidak sesuai');
                                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                }
                                            } else if ($method[0]['provider'] == 'Balance') {

                                                if ($this->users == false) {
                                                    $this->session->setFlashdata('error', 'Silahkan login dahulu');
                                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                } else if ($this->users['balance'] < $price) {
                                                    $this->session->setFlashdata('error', 'Saldo tidak mencukupi silakan periksa sisa saldo anda');
                                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                                } else {

                                                    $payment_code = 'Saldo Akun';
                                                    $status = 'Processing';
                                                    $payment_status = "Paid";

                                                    if (!empty($data_post['zone_id']) AND $data_post['zone_id'] != 1) {
                                                        $customer_no = $data_post['user_id'] . $data_post['zone_id'];
                                                    } else {
                                                        $customer_no = $data_post['user_id'];
                                                    }

                                                    if ($product[0]['provider'] === 'DF') {

                                                        $df_user = $this->M_Base->u_get('digi-user');
                                                        $df_key = $this->M_Base->u_get('digi-key');

                                                        $post_data = json_encode([
                                                            'username' => $df_user,
                                                            'buyer_sku_code' => $product[0]['sku'],
                                                            'customer_no' => $customer_no,
                                                            'ref_id' => $order_id,
                                                            'sign' => md5($df_user.$df_key.$order_id),
                                                        ]);
                                        
                                                        $ch = curl_init();
                                                        curl_setopt($ch, CURLOPT_URL, 'https://api.digiflazz.com/v1/transaction');
                                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                                                        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                                                        curl_setopt($ch, CURLOPT_POST, 1);
                                                        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                                                        $result = curl_exec($ch);
                                                        $result = json_decode($result, true);
                                                        
                                                        if (isset($result['data'])) {
                                                            if ($result['data']['status'] == 'Gagal') {
                                                                $ket = $result['data']['message'];
                                                            } else {
                                                                $ket = $result['data']['sn'] !== '' ? $result['data']['sn'] : $result['data']['message'];
                                                                echo json_encode(['success' => true]);
                                                            }
                                                        } else {
                                                            $ket = 'Failed Order';
                                                        }
                                                    } else if ($product[0]['provider'] == 'Manual') {
                                                              
                                                        $status = 'Processing';
                                                        $ket = 'Pesanan siap diproses';
                                                        
                                                    } else if ($product[0]['provider'] === 'AG') {

                                                        $curl = curl_init();

                                                        curl_setopt_array($curl, array(
                                                            CURLOPT_URL => 'https://v1.apigames.id/transaksi/http-get-v1?merchant='.$this->M_Base->u_get('ag-merchant').'&secret='.$this->M_Base->u_get('ag-secret').'&produk='.$product[0]['sku'].'&tujuan='.$customer_no.'&ref=' . $order_id,
                                                            CURLOPT_RETURNTRANSFER => true,
                                                            CURLOPT_ENCODING => '',
                                                            CURLOPT_MAXREDIRS => 10,
                                                            CURLOPT_TIMEOUT => 0,
                                                            CURLOPT_FOLLOWLOCATION => true,
                                                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                            CURLOPT_CUSTOMREQUEST => 'GET',
                                                            CURLOPT_POSTFIELDS => '',
                                                            CURLOPT_HTTPHEADER => array(
                                                                'Content-Type: application/x-www-form-urlencoded'
                                                            ),
                                                        ));

                                                        $result = curl_exec($curl);
                                                        $result = json_decode($result, true);

                                                        if ($result['status'] == 0) {
                                                            $ket = $result['error_msg'];
                                                        } else {
                                                            
                                                            if ($result['data']['status'] == 'Sukses') {
                                                                $status = 'Success';
                                                            }

                                                            $ket = $result['data']['sn'];
                                                        }

                                                    } else {
                                                        $ket = 'Provider tidak ditemukan';
                                                    }

                                                    $this->M_Base->data_update('users', [
                                                        'balance' => $this->users['balance'] - $price,
                                                    ], $this->users['id']);
                                                }

                                            } else if ($method[0]['provider'] == 'Manual') {
                                                $payment_code = $method[0]['rek'];
                                            } else {
                                                $this->session->setFlashdata('error', 'Metode tidak terdaftar');
                                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                            }


                                            $data = [
                                                'order_id' => $order_id,
                                                'username' => $username,
                                                'wa' => $data_post['wa'],
                                                'product_id' => $product[0]['id'],
                                                'product' => $product[0]['product'],
                                                'price' => $price,
                                                'expired_time' => $expired_time,
                                                'payment_status' => $payment_status,
                                                'quantity' => $quantity,
                                                'user_id' => $data_post['user_id'],
                                                'zone_id' => $data_post['zone_id'],
                                                'nickname' => $data_post['username'],
                                                'method_id' => $method[0]['id'],
                                                'method' => $method[0]['method'],
                                                'games' => $games[0]['games'],
                                                'games_id' => $games[0]['id'],
                                                'status' => $status,
                                                'ket' => $ket,
                                                'payment_code' => $payment_code,
                                                'provider' => $product[0]['provider'],
                                                'date' => date('Y-m-d'),
                                                'date_create' => date('Y-m-d G:i:s'),
                                                'date_process' => date('Y-m-d G:i:s'),
                                            ];

                                            $this->M_Base->data_insert('orders', $data);

                                            $data_wa = [
                                                'order_id' => $order_id,
                                                'username' => $data_post['username'],
                                                'wa' => $data_post['wa'],
                                                'product' => $product[0]['product'],
                                                'total_bayar' => $price * $quantity,
                                                'method' => $method[0]['method'],
                                                'nickname' => $data_post['username'],
                                            ];

                                            $this->MWa->sendWa($data_post['wa'], $data_wa, 'Pending');

                                            $this->session->setFlashdata('success', 'Pesanan berhasil dibuat');
                                            return redirect()->to(base_url() . '/payment/' . $order_id);

                                        } else {
                                            $this->session->setFlashdata('error', 'Metode pembayaran sedang gangguan');
                                            return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                        }
                                    } else {
                                        $this->session->setFlashdata('error', 'Metode pembayaran tidak ditemukan');
                                        return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                    }

                                } else {
                                    $this->session->setFlashdata('error', 'Produk sedang gangguan');
                                    return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                                }
                            } else {
                                $this->session->setFlashdata('error', 'Produk tidak ditemukan');
                                return redirect()->to(str_replace('index.php/', '', site_url(uri_string())));
                            }
                        }
                    }

                    if(session('user_id') != null){
                        $level = $this->MLevel->select('level_name')->where('id',$this->MUser->select('level_id')->find(session('user_id'))['level_id'])->first()['level_name'];

                        if($level == 'Member'){
                            $Product = $this->MProduct->select('id, games_id, product, price, provider, sku, status, check_status, check_code, logo_url')->where('games_id', $games[0]['id'])->findAll();
                        } else if ($level == 'Reseller') {
                            $Product = $this->MProduct->select('id, games_id, product, reseller_price AS price, provider, sku, status, check_status, check_code, logo_url')->where('games_id', $games[0]['id'])->findAll();
                        } else if ($level == 'VIP') {
                            $Product = $this->MProduct->select('id, games_id, product, vip_price AS price, provider, sku, status, check_status, check_code, logo_url')->where('games_id', $games[0]['id'])->findAll();
                        } else {
                            $Product = $this->MProduct->select('id, games_id, product, price, provider, sku, status, check_status, check_code, logo_url')->where('games_id', $games[0]['id'])->findAll();
                        }
                    } else {
                        $Product = $this->MProduct->select('id, games_id, product, price, provider, sku, status, check_status, check_code, logo_url')->where('games_id', $games[0]['id'])->findAll();
                    }

                    $data = array_merge($this->base_data, [
                        'title' => $games[0]['games'],
                        'games' => $games[0],
                        'pay_balance' => $this->M_Base->u_get('pay_balance'),
                        'method' => $this->M_Base->data_where('method', 'status', 'On'),
                        // 'product' => $this->M_Base->data_where('product', 'games_id', $games[0]['id']),
                        'product' => $Product,
                    ]);

                    return view('Games/index', $data);
                    
                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function order($action = null, $id = null) {

        if ($action === 'get-price') {
            if (is_numeric($id)) {
                // $product = $this->M_Base->data_where('product', 'id', $id);
                
                if(session('user_id') !== null) {
                    $level = $this->MLevel->select('level_name')->where('id',$this->MUser->select('level_id')->find(session('user_id'))['level_id'])->first()['level_name'];

                    if($level == 'Member'){
                        $product = $this->MProduct->select('id, games_id, product, price, provider, sku, status, check_status, check_code, logo_url')->where('id', $id)->findAll();
                    } else if ($level == 'Reseller') {
                        $product = $this->MProduct->select('id, games_id, product, reseller_price AS price, provider, sku, status, check_status, check_code, logo_url')->where('id', $id)->findAll();
                    } else if ($level == 'VIP') {
                        $product = $this->MProduct->select('id, games_id, product, vip_price AS price, provider, sku, status, check_status, check_code, logo_url')->where('id', $id)->findAll();
                    } else {
                        $product = $this->MProduct->select('id, games_id, product, price, provider, sku, status, check_status, check_code, logo_url')->where('id', $id)->findAll();
                    }
                } else {
                    $product = $this->MProduct->select('id, games_id, product, price, provider, sku, status, check_status, check_code, logo_url')->where('id', $id)->findAll();
                }

                if (count($product) == 1) {
                    
                    $quantity = 1;
                    if ($this->request->getPost('quantity')) {
                        if (is_numeric($this->request->getPost('quantity'))) {
                            $quantity = $this->request->getPost('quantity');
                        }
                    }

                    // $price = [];
                    // foreach ($this->M_Base->all_data('method') as $loop) {

                    //     $find_price = $this->M_Base->data_where_array('price', [
                    //         'method_id' => $loop['id'],
                    //         'product_id' => $id
                    //     ]);

                    //     $custom_price = count($find_price) == 1 ? $find_price[0]['price'] : $product[0]['price'];

                    //     $price[] = [
                    //         'method' => $loop['id'],
                    //         'price' => number_format($custom_price * $quantity,0,',','.'),
                    //     ];
                    // }
                    
                    if(session('user_id') !== null) {
                        $level = $this->MLevel->select('level_name')->where('id',$this->MUser->select('level_id')->find(session('user_id'))['level_id'])->first()['level_name'];
                    
                        if($level == 'Member'){
                            $price = [];
                            foreach ($this->M_Base->all_data('method') as $loop) {

                                $find_price = $this->MPrice->select('price')->where(['method_id' => $loop['id'],'product_id' => $id ])->findAll();

                                $custom_price = count($find_price) == 1 ? $find_price[0]['price'] : $product[0]['price'];

                                $price[] = [
                                    'method' => $loop['id'],
                                    'price' => number_format($custom_price * $quantity,0,',','.'),
                                ];
                            }
                        } else if ($level == 'Reseller') {
                            $price = [];
                            foreach ($this->M_Base->all_data('method') as $loop) {

                                $find_price = $this->MPrice->select('reseller_price AS price')->where(['method_id' => $loop['id'],'product_id' => $id ])->findAll();

                                $custom_price = count($find_price) == 1 ? $find_price[0]['price'] : $product[0]['price'];

                                $price[] = [
                                    'method' => $loop['id'],
                                    'price' => number_format($custom_price * $quantity,0,',','.'),
                                ];
                            }
                        } else if ($level == 'VIP') {
                            $price = [];
                            foreach ($this->M_Base->all_data('method') as $loop) {

                                $find_price = $this->MPrice->select('vip_price AS price')->where(['method_id' => $loop['id'],'product_id' => $id ])->findAll();

                                $custom_price = count($find_price) == 1 ? $find_price[0]['price'] : $product[0]['price'];

                                $price[] = [
                                    'method' => $loop['id'],
                                    'price' => number_format($custom_price * $quantity,0,',','.'),
                                ];
                            }
                        } else {
                            $price = [];
                            foreach ($this->M_Base->all_data('method') as $loop) {

                                $find_price = $this->MPrice->select('price')->where(['method_id' => $loop['id'],'product_id' => $id ])->findAll();

                                $custom_price = count($find_price) == 1 ? $find_price[0]['price'] : $product[0]['price'];

                                $price[] = [
                                    'method' => $loop['id'],
                                    'price' => number_format($custom_price * $quantity,0,',','.'),
                                ];
                            }
                        }
                    } else {
                        $price = [];
                        foreach ($this->M_Base->all_data('method') as $loop) {

                            $find_price = $this->MPrice->select('price')->where(['method_id' => $loop['id'],'product_id' => $id ])->findAll();

                            $custom_price = count($find_price) == 1 ? $find_price[0]['price'] : $product[0]['price'];

                            $price[] = [
                                'method' => $loop['id'],
                                'price' => number_format($custom_price * $quantity,0,',','.'),
                            ];
                        }
                    }
                    

                    if ($this->M_Base->u_get('pay_balance') == 'Y') {

                        $find_price = $this->M_Base->data_where_array('price', [
                            'method_id' => 10001,
                            'product_id' => $id
                        ]);

                        $custom_price = count($find_price) == 1 ? $find_price[0]['price'] : $product[0]['price'];

                        $price[] = [
                            'method' => 'balance',
                            'price' => number_format($custom_price * $quantity,0,',','.'),
                        ];
                    }

                    echo json_encode($price);
                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            
        } else if ($action == 'get-detail') {

            if ($this->request->getPost('user_id') AND $this->request->getPost('zone_id') AND $this->request->getPost('method') AND $this->request->getPost('wa')) {
                    
                $data_post = [
                    'user_id' => addslashes(trim(htmlspecialchars($this->request->getPost('user_id')))),
                    'zone_id' => addslashes(trim(htmlspecialchars($this->request->getPost('zone_id')))),
                    'method' => addslashes(trim(htmlspecialchars($this->request->getPost('method')))),
                    'product' => $id,
                    'wa' => addslashes(trim(htmlspecialchars($this->request->getPost('wa')))),
                    'quantity' => addslashes(trim(htmlspecialchars($this->request->getPost('quantity')))),
                ];

                $product = $this->M_Base->data_where('product', 'id', $data_post['product']);

                if (count($product) === 1) {
                    
                    if ($data_post['method'] === 'balance') {
                        $method = [
                            [
                                'method' => 'Saldo Akun',
                            ],
                        ];
                    } else {
                        $method = $this->M_Base->data_where('method', 'id', $data_post['method']);
                    }

                    if (count($method) === 1) {

                        $games = $this->M_Base->data_where('games', 'id', $product[0]['games_id']);

                        if (count($games) == 1) {

                            $price = $this->M_Base->data_where_array('price', [
                                'method_id' => $data_post['method'],
                                'product_id' => $data_post['product'],
                            ]);

                            $real_price = count($price) == 1 ? $price[0]['price'] : $product[0]['price'];

                            if ($data_post['zone_id'] != 1) {
                                $target = $data_post['user_id'] . ' (' . $data_post['zone_id'] . ')';
                            } else {
                                $target = $data_post['user_id'];
                            }

                            if ($games[0]['check_status'] == 'Y') {
                                if ($data_post['zone_id'] != 1) {
                                    $gtarget = $data_post['user_id'] . $data_post['zone_id'];
                                } else {
                                    $gtarget = $data_post['user_id'];
                                }

                                // $data = [
                                //     'api_key' => $this->M_Base->u_get('kiosweb-license'),
                                //     'game'    => $games[0]['check_code'],
                                //     'user_id' => $data_post['user_id'],
                                //     'zone_id' => $data_post['zone_id']
                                // ];


                                // https://alfathan.my.id/api/game/aov/?id=xxxxx&key=
                
                                $result = self::fetch('https://alfathan.my.id/api/game', [
                                    'api_key' => $this->M_Base->u_get('kiosweb-license'),
                                    'game'    => $games[0]['check_code'],
                                    'user_id' => $data_post['user_id'],
                                    'zone_id' => $data_post['zone_id']
                                ]);

                                // print_r($result); die();
                                
                                if (isset($result->result)) {
                                    
                                    if ($result->result->status == 200) {   
                                        $gusername = "ID Akun tidak ditemukan!!";
                                        if (isset($result->nickname) && $result->nickname != '') {
                                            $gusername = $result->nickname;
                                        } else {
                                            if ($games[0]['check_code'] == 'apex') {
                                                $gusername = $data_post['user_id'];
                                            }
                                        }
                                        
                                        echo json_encode([
                                            'status' => true,
                                            'msg' => '
                                            <form action="" method="POST">

                                                <input type="hidden" name="user_id" value="'.$data_post['user_id'].'">
                                                <input type="hidden" name="zone_id" value="'.$data_post['zone_id'].'">
                                                <input type="hidden" name="username" value="'.$gusername.'">
                                                <input type="hidden" name="method" value="'.$data_post['method'].'">
                                                <input type="hidden" name="product" value="'.$data_post['product'].'">
                                                <input type="hidden" name="wa" value="'.$data_post['wa'].'">
                                                <input type="hidden" name="quantity" value="'.$data_post['quantity'].'">

                                                <table style="width: 100%;">
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-left pt-2 pb-2">Kategori Layanan:</td>
                                                            <td class="text-left pt-2 pb-2"> '.$games[0]['games'].'</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left pt-2 pb-2">Nominal Layanan:</td>
                                                            <td class="text-left pt-2 pb-2"> '.$product[0]['product'].'</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left pt-2 pb-2">Nickname:</td>
                                                            <td class="text-left pt-2 pb-2 btn btn-primary"> '.$gusername.' </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left pt-2 pb-2">UserID:</td>
                                                            <td class="text-left pt-2 pb-2"> '.$target.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left pt-2 pb-2">Metode Pembayaran:</td>
                                                            <td class="text-left pt-2 pb-2"> '.$method[0]['method'].'</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" class="text-left pt-2 pb-2"> Pastikan data game Anda sudah benar. Kesalahan input data game bukan tanggung jawab kami. </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="text-right">
                                                    <button class="btn text-white" type="button" data-dismiss="modal">Batal</button>
                                                    <button class="btn btn-primary" type="submit" name="tombol" value="submit">Bayar Sekarang</button>
                                                </div>
                                            </form>
                                            
                                            ',
                                        ]);
                                    } else {
                                        echo json_encode([
                                            'status' => false,
                                            'msg' => "Akun gagal dicek!!",
                                        ]);
                                    }
                                } else {
                                    echo json_encode([
                                        'status' => false,
                                        'msg' => 'Akun gagal dicek!!'
                                    ]);
                                }
                            } else {
                                
                                if ($data_post['zone_id'] == 'joki') {
                                    $target = '';
                                } else {
                                    $target = '<tr>
                                                    <td class="text-left pt-2 pb-2">UserID:</td>
                                                    <td class="text-left pt-2 pb-2"> '.$target.'</td>
                                                </tr>';
                                }
                                
                                echo json_encode([
                                    'status' => true,
                                    'msg' => '
                                    <form action="" method="POST">

                                        <input type="hidden" name="user_id" value="'.$data_post['user_id'].'">
                                        <input type="hidden" name="zone_id" value="'.$data_post['zone_id'].'">
                                        <input type="hidden" name="method" value="'.$data_post['method'].'">
                                        <input type="hidden" name="product" value="'.$data_post['product'].'">
                                        <input type="hidden" name="wa" value="'.$data_post['wa'].'">
                                        <input type="hidden" name="quantity" value="'.$data_post['quantity'].'">

                                        <table style="width: 100%;">
                                            <tbody>
                                                <tr>
                                                    <td class="text-left pt-2 pb-2">Kategori Layanan:</td>
                                                    <td class="text-left pt-2 pb-2"> '.$games[0]['games'].'</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left pt-2 pb-2">Nominal Layanan:</td>
                                                    <td class="text-left pt-2 pb-2"> '.$product[0]['product'].'</td>
                                                </tr>
                                                '.$target.'
                                                <tr>
                                                    <td class="text-left pt-2 pb-2">Metode Pembayaran:</td>
                                                    <td class="text-left pt-2 pb-2"> '.$method[0]['method'].'</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="text-left pt-2 pb-2"> Pastikan data Anda sudah benar. Kesalahan input data pembayaran diatas bukan tanggung jawab kami. </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="text-right">
                                            <button class="btn text-white" type="button" data-dismiss="modal">Batal</button>
                                            <button class="btn btn-primary" type="submit" name="tombol" value="submit">Bayar Sekarang</button>
                                        </div>
                                    </form>

                                    ',
                                ]);
                            }
                        } else {
                            echo json_encode([
                                'status' => false,
                                'msg' => 'Games tidak ditemukan',
                            ]);
                        }
                    } else {
                        echo json_encode([
                            'status' => false,
                            'msg' => 'Metode pembayaran tidak ditemukan',
                        ]);
                    }
                } else {
                    echo json_encode([
                        'status' => false,
                        'msg' => 'Produk tidak ditemukan',
                    ]);
                }
            } else {
                echo json_encode([
                    'status' => false,
                    'msg' => 'Pembelian gagal dilakukan',
                ]);
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    
    public static function fetch($url, $data) 
    {
        $game = str_replace(' ', '', strtolower($data['game']));
   		
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, 'https://alfathan.my.id/api/game/'. $game .'/?id=' . str_replace('#', '%23', $data['user_id']) . '&zone='. $data['zone_id'] .'&server=' . $data['zone_id'] . '&key=' . $data['api_key']);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
        
        $response = curl_exec($ch);
        
        curl_close($ch);
        
        $result = json_decode($response);
        
        return $result;	
    }
}