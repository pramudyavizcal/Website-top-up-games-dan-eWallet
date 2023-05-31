<?php

namespace App\Controllers;

class Sistem extends BaseController {

	public function apigame_status() {
		$merchant = $this->M_Base->u_get('ag-merchant');
		$secret = $this->M_Base->u_get('ag-secret');
		

		$rows = [];
        foreach($this->M_Base->data_where('orders', 'status', 'Processing') as $order) {
			$product = $this->MProduct->where('id', $order['product_id'])->first();

			if(isset($product)){
				$signature = md5($merchant.":".$secret.":".$order['order_id']);
	
				$curl = curl_init();

				curl_setopt_array($curl, array(
					CURLOPT_URL => "https://v1.apigames.id/v2/transaksi/status?merchant_id=". $merchant ."&ref_id=". $order['order_id'] ."&signature=" . $signature,
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
				
				$rows[] = [
							'product' => $product,
							'result' => $result
						]; 
	
				if (isset($result['data'])) {
					
					if ($result['data']['status'] == 'Sukses') {
						$ket = $result['data']['sn'] !== '' ? $result['data']['sn'] : $result['data']['message'];
	
						$status = 'Success';
						$ket = $result['data']['message'];
	
						$this->M_Base->data_update('orders', [
							'ket' => $ket,
							'status' => 'Success',
						], $order['id']);


						$data_wa = [
							'order_id' => $order['id'],
							'username' => $order['username'],
							'wa' => $order['wa'],
							'product' => $order['product'],
							'total_bayar' => $order['price'] * $order['quantity'],
							'method' => $order['method'],
							'nickname' => $order['nickname'],
						];

						$this->MWa->sendWa($orders[0]['wa'], $data_wa, 'Success');
	
					} else {
						$ket = 'Tidak ada data';
						$status = 'False';
					}
					// else if ($result['data']['status'] == 'Gagal') {
					// 	$ket = $result['data']['message'];
					// 	$status = 'Canceled';
	
					// 	$this->M_Base->data_update('orders',[
					// 		'ket' => $result['data']['message'],
					// 		'status' => 'Canceled',
					// 	], $order['id']);
						
					// 	$users = $this->M_Base->data_where('users', 'username', $order['username']);
						
					// 	if (count($users) == 1) {
					// 	   $this->M_Base->data_update('users', [
					// 	       'balance' => $users[0]['balance'] + $order['price']
					// 	   ], $users[0]['id']);
					// 	}
	
					// }
				}
				$rows = array_merge($rows, ['status' => $status, 'message' => $ket]);
			}
        }

		echo json_encode($rows);
    }
	
	public function digi_status() {
		$df_user = $this->M_Base->u_get('digi-user');
		$df_key = $this->M_Base->u_get('digi-key');

		$rows = [];
        foreach($this->M_Base->data_where('orders', 'status', 'Processing') as $order) {
			$product = $this->MProduct->where('id', $order['product_id'])->first();

			if(isset($product)){
				if (!empty($order['zone_id']) AND $order['zone_id'] != 1) {
					$customer_no = $order['user_id'] . $order['zone_id'];
				} else {
					$customer_no = $order['user_id'];
				}
	
				$post_data = json_encode([
									"commands" => "status-praba",
									'username' => $df_user,
									'buyer_sku_code' => $product['sku'],
									'customer_no' => $customer_no,
									'ref_id' => $order['order_id'],
									'sign' => md5($df_user.$df_key.$order['order_id']),
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
				
				$rows[] = [
							'product' => $product,
							'result' => $result
						]; 
	
				if (isset($result['data'])) {
					
					if ($result['data']['status'] == 'Sukses') {
						$ket = $result['data']['sn'] !== '' ? $result['data']['sn'] : $result['data']['message'];
	
						$ket = "Transaksi Success";
						$status = 'Success';
	
						$this->M_Base->data_update('orders', [
							'ket' => $ket,
							'status' => 'Success',
						], $order['id']);
						
						$data_wa = [
							'order_id' => $order['id'],
							'username' => $order['username'],
							'wa' => $order['wa'],
							'product' => $order['product'],
							'total_bayar' => $order['price'] * $order['quantity'],
							'method' => $order['method'],
							'nickname' => $order['nickname'],
						];

						$this->MWa->sendWa($orders[0]['wa'], $data_wa, 'Success');

					} else {
						$ket = 'Tidak ada data';
						$status = 'False';
					}
					// else if ($result['data']['status'] == 'Gagal') {
					// 	$ket = $result['data']['message'];
					// 	$status = 'Canceled';
	
					// 	$this->M_Base->data_update('orders',[
					// 		'ket' => $result['data']['message'],
					// 		'status' => 'Canceled',
					// 	], $order['id']);
						
					// 	$users = $this->M_Base->data_where('users', 'username', $order['username']);
						
					// 	if (count($users) == 1) {
					// 	   $this->M_Base->data_update('users', [
					// 	       'balance' => $users[0]['balance'] + $order['price']
					// 	   ], $users[0]['id']);
					// 	}
	
					// }
				}
				$rows = array_merge($rows, ['status' => $status, 'message' => $ket]);
			}
        }

		echo json_encode($rows);
    }

    public function callback($action = null) {
        
    	if ($action === 'tripay') {

			$json = file_get_contents('php://input');

			$callbackSignature = isset($_SERVER['HTTP_X_CALLBACK_SIGNATURE']) ? $_SERVER['HTTP_X_CALLBACK_SIGNATURE'] : '';

			if ($callbackSignature !== hash_hmac('sha256', $json, $this->M_Base->u_get('tripay-private'))) {
				echo json_encode( [
					'signature' => $callbackSignature,
					'data' => hash_hmac('sha256', $json, $this->M_Base->u_get('tripay-private')),
					'status' => 'Signature Failed'
				]);
			} else {
				if($_SERVER['HTTP_X_CALLBACK_EVENT'] !== 'payment_status'){
					echo json_encode( [
							'signature' => $callbackSignature,
							'data' => hash_hmac('sha256', $json, $this->M_Base->u_get('tripay-private')),
							'status' => 'Callback Event Failed'
					]);
				} else {
					$data = json_decode($json, true);

					if ($data) {
						if (is_array($data)) {
							$id = $data['merchant_ref'];

							if ($data['status'] === 'PAID') {
								$orders = $this->M_Base->data_where_array('orders', [
									'order_id' => $id,
									'status' => 'Pending'
								]);
	
								if (count($orders) > 0) {
	
									$status = 'Processing';
									$payment_status = 'Paid';

									$data_wa = [
										'order_id' => $id,
										'username' => $orders[0]['username'],
										'wa' => $orders[0]['wa'],
										'product' => $orders[0]['product'],
										'total_bayar' => $orders[0]['price'] * $orders[0]['quantity'],
										'method' => $orders[0]['method'],
										'nickname' => $orders[0]['nickname'],
									];

									$this->MWa->sendWa($orders[0]['wa'], $data_wa, 'Processing');
	
									$product = $this->M_Base->data_where('product', 'id', $orders[0]['product_id']);
	
									if (count($product) === 1) {
										
										if (!empty($orders[0]['zone_id']) AND $orders[0]['zone_id'] != 1) {
											$customer_no = $orders[0]['user_id'] . $orders[0]['zone_id'];
										} else {
											$customer_no = $orders[0]['user_id'];
										}
	
										if ($orders[0]['provider'] == 'DF') {
	
											$df_user = $this->M_Base->u_get('digi-user');
											$df_key = $this->M_Base->u_get('digi-key');
	
											$post_data = json_encode([
												'username' => $df_user,
												'buyer_sku_code' => $product[0]['sku'],
												'customer_no' => $customer_no,
												'ref_id' => $orders[0]['order_id'],
												'sign' => md5($df_user.$df_key.$orders[0]['order_id']),
											]);
							
											$ch = curl_init();
											curl_setopt($ch, CURLOPT_URL, 'https://api.digiflazz.com/v1/transaction');
											curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
											curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
											curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
											curl_setopt($ch, CURLOPT_POST, 1);
											curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
											$json = curl_exec($ch);
											$result = json_decode($json, true);

											// $this->M_Base->data_insert('callback', [
											// 	'signature' => $callbackSignature,
											// 	'data' => $json,
											// 	'signature' => 'Signature Success'
											// ]);
											
											if (isset($result['data'])) {
												if ($result['data']['status'] == 'Gagal') {
													$ket = $result['data']['message'];

													$data_wa = [
														'order_id' => $id,
														'username' => $orders[0]['username'],
														'wa' => $orders[0]['wa'],
														'product' => $orders[0]['product'],
														'total_bayar' => $orders[0]['price'] * $orders[0]['quantity'],
														'method' => $orders[0]['method'],
														'nickname' => $orders[0]['nickname'],
													];
				
													$this->MWa->sendWa($orders[0]['wa'], $data_wa, 'Canceled');
												} else {
													$status = 'Success';
													$ket = $result['data']['sn'] !== '' ? $result['data']['sn'] : ($result['data']['message'] == '' ? 'Menunggu diproses provider' : $result['data']['message']);
													
													$data_wa = [
														'order_id' => $id,
														'username' => $orders[0]['username'],
														'wa' => $orders[0]['wa'],
														'product' => $orders[0]['product'],
														'total_bayar' => $orders[0]['price'] * $orders[0]['quantity'],
														'method' => $orders[0]['method'],
														'nickname' => $orders[0]['nickname'],
													];
				
													$this->MWa->sendWa($orders[0]['wa'], $data_wa, 'Success');

													echo json_encode(['success' => true]);
												}
											} else {
												$ket = 'Failed Order';
											}
										} else if ($orders[0]['provider'] == 'Manual') {
															
											$status = 'Processing';
											$ket = 'Pesanan siap diproses';
											
										} else if ($orders[0]['provider'] == 'AG') {
											$merchant =$this->M_Base->u_get('ag-merchant');
											$secret = $this->M_Base->u_get('ag-secret');

											$post_data = json_encode([
												"ref_id" => $orders[0]['order_id'],
												"merchant_id" => $merchant,
												"produk" => $product[0]['sku'],
												"tujuan" => $customer_no,
												"server_id" => "",
												"signature" => md5($merchant. ':' .$secret. ':' .$orders[0]['order_id']),
											]);
							
											$ch = curl_init();
											curl_setopt($ch, CURLOPT_URL, 'https://v1.apigames.id/v2/transaksi');
											curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
											curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
											curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
											curl_setopt($ch, CURLOPT_POST, 1);
											curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
											$json = curl_exec($ch);
											$result = json_decode($json, true);
	
											if ($result['status'] == 0) {
												$ket = $result['error_msg'];

												$data_wa = [
													'order_id' => $id,
													'username' => $orders[0]['username'],
													'wa' => $orders[0]['wa'],
													'product' => $orders[0]['product'],
													'total_bayar' => $orders[0]['price'] * $orders[0]['quantity'],
													'method' => $orders[0]['method'],
													'nickname' => $orders[0]['nickname'],
												];
			
												$this->MWa->sendWa($orders[0]['wa'], $data_wa, 'Canceled');
											} else {
												
												if ($result['data']['status'] == 'Sukses') {
													$status = 'Success';

													$data_wa = [
														'order_id' => $id,
														'username' => $orders[0]['username'],
														'wa' => $orders[0]['wa'],
														'product' => $orders[0]['product'],
														'total_bayar' => $orders[0]['price'] * $orders[0]['quantity'],
														'method' => $orders[0]['method'],
														'nickname' => $orders[0]['nickname'],
													];
				
													$this->MWa->sendWa($orders[0]['wa'], $data_wa, 'Success');
												}
	
												$ket = $result['data']['sn'];
											}
	
										} else {
											$ket = 'Provider tidak ditemukan';
										}
									} else {
										$ket = 'Produk tidak ditemukan';
									}
	
									$this->M_Base->data_update('orders', [
										'status' => $status,
										'ket' => $ket,
										'payment_status' => $payment_status
									], $orders[0]['id']);
	
								} else {
									$topup = $this->M_Base->data_where_array('topup', [
										'topup_id' => $id,
										'status' => 'Pending',
									]);
	
									if (count($topup) === 1) {
										$users = $this->M_Base->data_where('users', 'username', $topup[0]['username']);
	
										if (count($users) === 1) {
											$this->M_Base->data_update('users', [
												'balance' => $users[0]['balance'] + $topup[0]['amount'],
											], $users[0]['id']);
	
											$this->M_Base->data_update('topup', [
												'status' => 'Success',
											], $topup[0]['id']);
	
											echo json_encode(['msg' => 'Berhasil upgrade level member']);
										} else {
											echo json_encode(['msg' => 'Pengguna tidak ditemukan']);
										}
									} else {
										$upgrade = $this->M_Base->data_where_array('level_upgrade', [
											'code' => $id,
											'status' => 'Pending',
										]);

										
										if (count($upgrade) === 1) {
											$users = $this->M_Base->data_where('users', 'id', $upgrade[0]['user_id']);	
											
											if (count($users) === 1) {
												$level_up = $this->MLevelUp->select('id, level_id')->where('code', $id)->first();

												$this->M_Base->data_update('users', [
													'level_id' => $level_up['level_id'],
												], $users[0]['id']);
		
												$this->MLevelUp->save([
													'id'     => $level_up['id'],
													'status' => 'Success',
												]);
		
												echo json_encode(['msg' => 'Berhasil {TOPUP}']);
											} else {
												echo json_encode(['msg' => 'Pengguna tidak ditemukan']);
											}
										} else {
											echo json_encode(['msg' => 'Transaksi tidak ditemukan']);
										}
									}
								}
							} elseif ($data['status'] === 'EXPIRED' || $data['status'] === 'FAILED' || $data['status'] === 'REFUND') {
								$id = $data['merchant_ref'];

								$payment_status = 'Unpaid';

								$orders = $this->M_Base->data_where_array('orders', [
									'order_id' => $id,
									'status' => 'Pending',
								]);

								
								if (count($orders) === 1) {
									
									$data_wa = [
										'order_id' => $id,
										'username' => $orders[0]['username'],
										'wa' => $orders[0]['wa'],
										'product' => $orders[0]['product'],
										'total_bayar' => $orders[0]['price'] * $orders[0]['quantity'],
										'method' => $orders[0]['method'],
										'nickname' => $orders[0]['nickname'],
									];
	
									$this->MWa->sendWa($orders[0]['wa'], $data_wa, 'Canceled');
									
									$status = 'Expired';
		
									$this->M_Base->data_update('orders', [
										'status' => $status,
										'ket' => 'User tidak melakukan pembayaran',
										'payment_status' => $payment_status
									], $orders[0]['id']);
		
								} else {
									$topup = $this->M_Base->data_where_array('topup', [
										'topup_id' => $id,
										'status' => 'Pending',
									]);
		
									if (count($topup) === 1) {
										$users = $this->M_Base->data_where('users', 'username', $topup[0]['username']);
		
										if (count($users) === 1) {
		
											$this->M_Base->data_update('topup', [
												'status' => 'Canceled',
											], $topup[0]['id']);
		
											echo json_encode(['msg' => 'Berhasil {TOPUP}']);
										} else {
											echo json_encode(['msg' => 'Pengguna tidak ditemukan']);
										}
									} else {
										$upgrade = $this->M_Base->data_where_array('level_upgrade', [
											'code' => $id,
											'status' => 'Pending',
										]);
										
										if (count($upgrade) === 1) {
											$users = $this->M_Base->data_where('users', 'id', $upgrade[0]['user_id']);	
											
											if (count($users) === 1) {
												$level_up = $this->MLevelUp->select('id, level_id')->where('code', $id)->first();
		
												$this->MLevelUp->save([
													'id'     => $level_up['id'],
													'status' => 'Canceled',
												]);
		
												echo json_encode(['msg' => 'Berhasil upgrade level member']);
											} else {
												echo json_encode(['msg' => 'Pengguna tidak ditemukan']);
											}
										} else {
											echo json_encode(['msg' => 'Transaksi tidak ditemukan']);
										}
									}
								}
							} else {
								echo json_encode(['msg' => 'Transaksi tidak ditemukan']);
							}

						} else {
							throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
						}
					} else {
						throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
					}
				}
				
			}
    	} else if ($action === 'ipaymu') {
			if ($this->request->getPost('reference_id')) {
				if ($this->request->getPost('status_code')) {
					if ($this->request->getPost('status_code') == 1) {
						
						$order_id = $this->request->getPost('reference_id');
						$orders = $this->M_Base->data_where_array('orders', [
							'order_id' => $this->request->getPost('reference_id'),
							'status' => 'Pending'
						]);
						
						if (count($orders) === 1) {

							$status = 'Processing';
							$payment_status = 'Paid';
							
							$data_wa = [
								'order_id' => $order_id,
								'username' => $orders[0]['username'],
								'wa' => $orders[0]['wa'],
								'product' => $orders[0]['product'],
								'total_bayar' => $orders[0]['price'] * $orders[0]['quantity'],
								'method' => $orders[0]['method'],
								'nickname' => $orders[0]['nickname'],
							];

							$this->MWa->sendWa($orders[0]['wa'], $data_wa, 'Processing');
							
							$product = $this->M_Base->data_where('product', 'id', $orders[0]['product_id']);
							
							if (count($product) === 1) {
								
								if (!empty($orders[0]['zone_id']) AND $orders[0]['zone_id'] != 1) {
									$customer_no = $orders[0]['user_id'] . $orders[0]['zone_id'];
								} else {
									$customer_no = $orders[0]['user_id'];
								}

								if ($orders[0]['provider'] == 'DF') {

									$df_user = $this->M_Base->u_get('digi-user');
									$df_key = $this->M_Base->u_get('digi-key');

									$post_data = json_encode([
			                            'username' => $df_user,
			                            'buyer_sku_code' => $product[0]['sku'],
			                            'customer_no' => $customer_no,
			                            'ref_id' => $orders[0]['order_id'],
			                            'sign' => md5($df_user.$df_key.$orders[0]['order_id']),
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

											$data_wa = [
												'order_id' => $order_id,
												'username' => $orders[0]['username'],
												'wa' => $orders[0]['wa'],
												'product' => $orders[0]['product'],
												'total_bayar' => $orders[0]['price'] * $orders[0]['quantity'],
												'method' => $orders[0]['method'],
												'nickname' => $orders[0]['nickname'],
											];
				
											$this->MWa->sendWa($orders[0]['wa'], $data_wa, 'Canceled');
			                            } else {
											$status = 'Success';
			                                $ket = $result['data']['sn'] !== '' ? $result['data']['sn'] : $result['data']['message'];

											$data_wa = [
												'order_id' => $order_id,
												'username' => $orders[0]['username'],
												'wa' => $orders[0]['wa'],
												'product' => $orders[0]['product'],
												'total_bayar' => $orders[0]['price'] * $orders[0]['quantity'],
												'method' => $orders[0]['method'],
												'nickname' => $orders[0]['nickname'],
											];
				
											$this->MWa->sendWa($orders[0]['wa'], $data_wa, 'Success');
											echo json_encode(['success' => true]);
			                            }
			                        } else {
			                        	$ket = 'Failed Order';
			                        }
			                    } else if ($orders[0]['provider'] == 'Manual') {
                                                    
                                    $status = 'Processing';
                                    $ket = 'Pesanan siap diproses';
                                    
								} else if ($orders[0]['provider'] == 'AG') {

									$curl = curl_init();

									curl_setopt_array($curl, array(
										CURLOPT_URL => 'https://v1.apigames.id/transaksi/http-get-v1?merchant='.$this->M_Base->u_get('ag-merchant').'&secret='.$this->M_Base->u_get('ag-secret').'&produk='.$product[0]['sku'].'&tujuan='.$customer_no.'&ref=' . $orders[0]['order_id'],
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

										$data_wa = [
											'order_id' => $order_id,
											'username' => $orders[0]['username'],
											'wa' => $orders[0]['wa'],
											'product' => $orders[0]['product'],
											'total_bayar' => $orders[0]['price'] * $orders[0]['quantity'],
											'method' => $orders[0]['method'],
											'nickname' => $orders[0]['nickname'],
										];
			
										$this->MWa->sendWa($orders[0]['wa'], $data_wa, 'Canceled');
			                        } else {
			                        	
			                            if ($result['data']['status'] == 'Sukses') {
			                                $status = 'Success';

											$data_wa = [
												'order_id' => $order_id,
												'username' => $orders[0]['username'],
												'wa' => $orders[0]['wa'],
												'product' => $orders[0]['product'],
												'total_bayar' => $orders[0]['price'] * $orders[0]['quantity'],
												'method' => $orders[0]['method'],
												'nickname' => $orders[0]['nickname'],
											];
				
											$this->MWa->sendWa($orders[0]['wa'], $data_wa, 'Success');
			                            }

			                            $ket = $result['data']['sn'];
			                        }

								} else {
									$ket = 'Provider tidak ditemukan';
								}
							} else {
								$ket = 'Produk tidak ditemukan';
							}

							$this->M_Base->data_update('orders', [
								'status' => $status,
								'ket' => $ket,
								'payment_status' => $payment_status,
							], $orders[0]['id']);

						} else {
							$topup = $this->M_Base->data_where_array('topup', [
								'topup_id' => $this->request->getPost('reference_id'),
								'status' => 'Pending',
							]);

							if (count($topup) === 1) {
								$users = $this->M_Base->data_where('users', 'username', $topup[0]['username']);

								if (count($users) === 1) {
									$this->M_Base->data_update('users', [
										'balance' => $users[0]['balance'] + $topup[0]['amount'],
									], $users[0]['id']);

									$this->M_Base->data_update('topup', [
										'status' => 'Success',
									], $topup[0]['id']);

									echo json_encode(['msg' => 'Berhasil {TOPUP}']);
								} else {
									echo json_encode(['msg' => 'Pengguna tidak ditemukan']);
								}
							} else {
								$upgrade = $this->M_Base->data_where_array('level_upgrade', [
									'code' => $this->request->getPost('reference_id'),
									'status' => 'Pending',
								]);

								
								if (count($upgrade) === 1) {
									$users = $this->M_Base->data_where('users', 'id', $upgrade[0]['user_id']);	
									
									if (count($users) === 1) {
										$level_up = $this->MLevelUp->select('id, level_id')->where('code', $this->request->getPost('reference_id'))->first();

										$this->M_Base->data_update('users', [
											'level_id' => $level_up['level_id'],
										], $users[0]['id']);

										$this->MLevelUp->save([
											'id'     => $level_up['id'],
											'status' => 'Success',
										]);

										echo json_encode(['msg' => 'Berhasil upgrade level member']);
									} else {
										echo json_encode(['msg' => 'Pengguna tidak ditemukan']);
									}
								} else {
									echo json_encode(['msg' => 'Transaksi tidak ditemukan']);
								}
							}
						}

                    } elseif ($this->request->getPost('status_code') == -2) {
						$orders = $this->M_Base->data_where_array('orders', [
							'order_id' => $this->request->getPost('reference_id'),
							'status' => 'Pending'
						]);
						
						if (count($orders) === 1) {

							$data_wa = [
								'order_id' => $order_id,
								'username' => $orders[0]['username'],
								'wa' => $orders[0]['wa'],
								'product' => $orders[0]['product'],
								'total_bayar' => $orders[0]['price'] * $orders[0]['quantity'],
								'method' => $orders[0]['method'],
								'nickname' => $orders[0]['nickname'],
							];

							$this->MWa->sendWa($orders[0]['wa'], $data_wa, 'Canceled');

							$status = 'Canceled';
							$payment_status = 'Unpaid';

							$this->M_Base->data_update('orders', [
								'status' => $status,
								'payment_status' => $payment_status,
								'ket' => 'User tidak melakukan pembayaran',
							], $orders[0]['id']);

						} else {
							$topup = $this->M_Base->data_where_array('topup', [
								'topup_id' => $this->request->getPost('reference_id'),
								'status' => 'Pending',
							]);

							if (count($topup) === 1) {
								$users = $this->M_Base->data_where('users', 'username', $topup[0]['username']);

								if (count($users) === 1) {

									$this->M_Base->data_update('topup', [
										'status' => 'Canceled',
									], $topup[0]['id']);

									echo json_encode(['msg' => 'Berhasil {TOPUP}']);
								} else {
									echo json_encode(['msg' => 'Pengguna tidak ditemukan']);
								}
							} else {
								$upgrade = $this->M_Base->data_where_array('level_upgrade', [
									'code' => $this->request->getPost('reference_id'),
									'status' => 'Pending',
								]);
								
								if (count($upgrade) === 1) {
									$users = $this->M_Base->data_where('users', 'id', $upgrade[0]['user_id']);	
									
									if (count($users) === 1) {
										$level_up = $this->MLevelUp->select('id, level_id')->where('code', $this->request->getPost('reference_id'))->first();

										$this->MLevelUp->save([
											'id'     => $level_up['id'],
											'status' => 'Canceled',
										]);

										echo json_encode(['msg' => 'Berhasil upgrade level member']);
									} else {
										echo json_encode(['msg' => 'Pengguna tidak ditemukan']);
									}
								} else {
									echo json_encode(['msg' => 'Transaksi tidak ditemukan']);
								}
							}
						}
					} else {
                        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                    }
                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
    	    
    	} else if ($action === 'cekmutasi') {

			$json = file_get_contents('php://input');
			$data = json_decode($json, true);

			
			if ($data) {
				
				if (is_array($data)) {

			        foreach($data['content']['data'] as $mutasi) {
			            
			            if ($mutasi['type'] == 'credit') {
			                
			                $amount = explode('.', $mutasi['amount'])[0];
			                
			                $orders = $this->M_Base->data_where_array('orders', [
								'price' => $amount,
								'status' => 'Pending'
							]);

							$order_id = $orders[0]['order_id'];

							if (count($orders) === 1) {

								$data_wa = [
									'order_id' => $order_id,
									'username' => $orders[0]['username'],
									'wa' => $orders[0]['wa'],
									'product' => $orders[0]['product'],
									'total_bayar' => $orders[0]['price'] * $orders[0]['quantity'],
									'method' => $orders[0]['method'],
									'nickname' => $orders[0]['nickname'],
								];
	
								$this->MWa->sendWa($orders[0]['wa'], $data_wa, 'Processing');

								$status = 'Processing';
								$payment_status = 'Paid';

								$product = $this->M_Base->data_where('product', 'id', $orders[0]['product_id']);

								if (count($product) === 1) {
									
									if (!empty($orders[0]['zone_id']) AND $orders[0]['zone_id'] != 1) {
										$customer_no = $orders[0]['user_id'] . $orders[0]['zone_id'];
									} else {
										$customer_no = $orders[0]['user_id'];
									}

									if ($orders[0]['provider'] == 'DF') {

										$df_user = $this->M_Base->u_get('digi-user');
										$df_key = $this->M_Base->u_get('digi-key');

										$post_data = json_encode([
				                            'username' => $df_user,
				                            'buyer_sku_code' => $product[0]['sku'],
				                            'customer_no' => $customer_no,
				                            'ref_id' => $orders[0]['order_id'],
				                            'sign' => md5($df_user.$df_key.$orders[0]['order_id']),
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

												$data_wa = [
													'order_id' => $order_id,
													'username' => $orders[0]['username'],
													'wa' => $orders[0]['wa'],
													'product' => $orders[0]['product'],
													'total_bayar' => $orders[0]['price'] * $orders[0]['quantity'],
													'method' => $orders[0]['method'],
													'nickname' => $orders[0]['nickname'],
												];
					
												$this->MWa->sendWa($orders[0]['wa'], $data_wa, 'Success');
				                            } else {
												$status = 'Success';
				                                $ket = $result['data']['sn'] !== '' ? $result['data']['sn'] : $result['data']['message'];

												echo json_encode(['success' => true]);
				                            }
				                        } else {
				                        	$ket = 'Failed Order';
				                        }
				                    } else if ($orders[0]['provider'] == 'Manual') {
                                                        
                                        $status = 'Processing';
                                        $ket = 'Pesanan siap diproses';
                                        
									} else if ($orders[0]['provider'] == 'AG') {

										$curl = curl_init();

										curl_setopt_array($curl, array(
											CURLOPT_URL => 'https://v1.apigames.id/transaksi/http-get-v1?merchant='.$this->M_Base->u_get('ag-merchant').'&secret='.$this->M_Base->u_get('ag-secret').'&produk='.$product[0]['sku'].'&tujuan='.$customer_no.'&ref=' . $orders[0]['order_id'],
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
											$data_wa = [
												'order_id' => $order_id,
												'username' => $orders[0]['username'],
												'wa' => $orders[0]['wa'],
												'product' => $orders[0]['product'],
												'total_bayar' => $orders[0]['price'] * $orders[0]['quantity'],
												'method' => $orders[0]['method'],
												'nickname' => $orders[0]['nickname'],
											];
				
											$this->MWa->sendWa($orders[0]['wa'], $data_wa, 'Canceled');
				                        } else {
				                        	
				                            if ($result['data']['status'] == 'Sukses') {
				                                $status = 'Success';
												$data_wa = [
													'order_id' => $order_id,
													'username' => $orders[0]['username'],
													'wa' => $orders[0]['wa'],
													'product' => $orders[0]['product'],
													'total_bayar' => $orders[0]['price'] * $orders[0]['quantity'],
													'method' => $orders[0]['method'],
													'nickname' => $orders[0]['nickname'],
												];
					
												$this->MWa->sendWa($orders[0]['wa'], $data_wa, 'Success');
				                            }

				                            $ket = $result['data']['sn'];
				                        }

									} else {
										$ket = 'Provider tidak ditemukan';
									}
								} else {
									$ket = 'Produk tidak ditemukan';
								}

								$this->M_Base->data_update('orders', [
									'status' => $status,
									'payment_status' => $payment_status,
									'ket' => $ket,
								], $orders[0]['id']);

							} else {
								$topup = $this->M_Base->data_where_array('topup', [
									'amount' => $amount,
									'status' => 'Pending',
								]);

								if (count($topup) === 1) {
									$users = $this->M_Base->data_where('users', 'username', $topup[0]['username']);

									if (count($users) === 1) {
									    
										$this->M_Base->data_update('users', [
											'balance' => $users[0]['balance'] + $topup[0]['amount'],
										], $users[0]['id']);

										$this->M_Base->data_update('topup', [
											'status' => 'Success',
										], $topup[0]['id']);

										echo json_encode(['msg' => 'Berhasil topup']);
									} else {
										echo json_encode(['msg' => 'Pengguna tidak ditemukan']);
									}
								} else {
									$upgrade = $this->M_Base->data_where_array('level_upgrade', [
										'price' => $amount,
										'status' => 'Pending',
									]);
	
									
									if (count($upgrade) === 1) {
										$users = $this->M_Base->data_where('users', 'id', $upgrade[0]['user_id']);	
										
										if (count($users) === 1) {
											$level_up = $this->MLevelUp->select('id, level_id')->where('code', $upgrade[0]['code'])->first();
	
											$this->M_Base->data_update('users', [
												'level_id' => $level_up['level_id'],
											], $users[0]['id']);
	
											$this->MLevelUp->save([
												'id'     => $level_up['id'],
												'status' => 'Success',
											]);
	
											echo json_encode(['msg' => 'Berhasil upgrade level member']);
										} else {
											echo json_encode(['msg' => 'Pengguna tidak ditemukan']);
										}
									} else {
										echo json_encode(['msg' => 'Transaksi tidak ditemukan']);
									}
								}
							}
			            }
			        }
			        
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
}