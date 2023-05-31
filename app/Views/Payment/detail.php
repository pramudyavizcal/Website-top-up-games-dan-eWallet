			<?php $this->extend('template'); ?>

			<?php $this->section('css'); ?>
			<?php $this->endSection(); ?>

			<?php $this->section('content'); ?>
	
			<div class="clearfix pt-5"></div>
			<div class="pt-5 pb-5">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-9">
							<div class="pt-3 pb-4">
								<h5>Detail Pesanan</h5>
								<span class="strip-primary"></span>
							</div>
							<div class="pb-3">
								<div class="section">
									<div class="card-body">
										<h4>Terima Kasih</h4> Pesanan anda berhasil dibuat. Masa berlaku untuk No. Transaksi ini 24 jam, pastikan data game sudah benar dan segera lakukan pembayaran agar pesanan segera diproses. <br>
										<br> Simpan No. Transaksi anda untuk Cek Status Pesanan!
									</div>
								</div>
							</div>
							<div class="pb-3">
								<div class="section">
									<div class="card-header">
										<?php if ($orders['status'] == 'Pending') { ?>
											<div class="border p-2 rounded text-white">Lakukan Pembayaran Sebelum : <b><?= $orders['expired_time']; ?></b></div>
											<input type="hidden" id="tgl" value="<?= $orders['expired_time']; ?>"></input>
											<span class="badge badge-danger"><div id="carasingkat" style="color: white;"></div></span>
										<?php } ?>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-sm-6">
												<div class="pb-4"> Waktu Transaksi
													<h5><?= $orders['date_create']; ?></h5>
												</div>
												<div class="pb-4"> Metode Pembayaran
													<h5><?= $orders['method']; ?></h5>
												</div>
												<?php if ($orders['status'] == 'Pending') : ?>
													<div class="pb-4"> Kode Pembayaran / No. Virtual Account <br>
														<?php if (filter_var($orders['payment_code'], FILTER_VALIDATE_URL)) : ?>
															<img src="<?= $orders['payment_code']; ?>" width="180" class="mt-3">
															<br></br>
															<button class="btn btn-success" onclick="window.location.href='<?= $orders['payment_code']; ?>';">Download QR Code</button>
														<?php else : ?>
															<?php if (strlen($orders['payment_code']) > 250) : ?>
																<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?= $orders['payment_code']; ?>" width="260">
															<?php else : ?>
																<b class="d-block mt-2"><?= $orders['payment_code']; ?></b>
															<?php endif; ?>
														<?php endif ?>
													</div>
													<?php if ($orders['payment_status'] == 'Unpaid') : ?>
														<div class="border p-2 rounded">Status Pembayaran : <b><span class="badge badge-warning"><?= $orders['payment_status']; ?></span></b></div>
														<div class="border p-2 rounded">Status : <b><?= $orders['status']; ?></b></div>
													<?php endif; ?>
												<?php else : ?>
													<?php if ($orders['payment_status'] == 'Unpaid') : ?>
														<div class="border p-2 rounded">Status Pembayaran : <b><span class="badge badge-warning"><?= $orders['payment_status']; ?></span></b></div>
														<div class="border p-2 rounded">Status Transaksi : <b>
																<span class="badge badge-danger"><?= $orders['status']; ?></span>
															</b></div>
													<?php else : ?>
														<div class="border p-2 rounded">Status Pembayaran : <b><span class="badge badge-success"><?= $orders['payment_status']; ?></span></b></div>
														<div class="border p-2 rounded">Status Transaksi : <b>
																<span class="badge badge-success"><?= $orders['status']; ?></span>
															</b></div>

													<?php endif; ?>
												<?php endif ?>
											</div>
											<div class="col-sm-6">
												<div class="pb-4"> No. Transaksi
													<h5>
														<?= $orders['order_id']; ?> <i class="fa fa-clone pl-2 clip" onclick="copy_trx()" data-clipboard-text="<?= $orders['order_id']; ?>"></i>
													</h5>
												</div>
												<div class="pb-4"> Jumlah Pembayaran <h5>Rp. <?= number_format($orders['price'], 0, ',', '.'); ?></h5>
													<h8>(*Sudah termasuk PPN)</h8>
												</div>
												<div class="pb-4"> Rincian Pesanan <h5><?= $orders['games']; ?> - <?= $orders['product']; ?></h5>
													<p>
														<?php
														if ($orders['zone_id'] == 'joki') {
															echo '<i>**Data_Protected**</i>';
														} else {
															echo $orders['user_id'];

															if (!empty($orders['zone_id']) and $orders['zone_id'] !== '1') {
																echo ' (' . $orders['zone_id'] . ') ';
															}

															if (!empty($orders['nickname'])) {
																echo $orders['nickname'];
															}
														}
														?>
													</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php if ($orders['status'] == 'Pending') : ?>
								<div class="pb-3">
									<div class="section">
										<div class="card-body">
											<h4>Informasi Cara Pembayaran</h4>
											<?= htmlspecialchars_decode($orders['instruksi']); ?>
										</div>
									</div>
								</div>
							<?php endif ?>
						</div>
					</div>
				</div>
			</div>
			<?php $this->endSection(); ?>

			<?php $this->section('js'); ?>
			<script>
				function copy_trx() {
					navigator.clipboard.writeText('<?= $orders['order_id']; ?>');

					Swal.fire('Berhasil', 'No Transaksi berhasil di salin', 'success');
				}
			</script>
			<script>
				// Silahkan anda atur tanggal anda
				var tgl = document.getElementById("tgl").value;
				var countDownDate = new Date(tgl).getTime();
				// Hitungan Mundur Waktu Dilakukan Setiap Satu Detik
				var x = setInterval(function() {
					// Mendapatkan Tanggal dan waktu Pada Hari ini
					var now = new Date().getTime();
					//Jarak Waktu Antara Hitungan Mundur
					var distance = countDownDate - now;
					// Perhitungan waktu hari, jam, menit dan detik
					var days = Math.floor(distance / (1000 * 60 * 60 * 24));
					var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
					var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
					var seconds = Math.floor((distance % (1000 * 60)) / 1000);
					// Tampilkan hasilnya di elemen id = "carasingkat"
					document.getElementById("carasingkat").innerHTML = "Pembayaran Berakhir dalam " + hours + "Jam " +
						minutes + " Menit " + seconds + " Detik ";
					// Jika hitungan mundur selesai,
					if (distance < 0) {
						clearInterval(x);
						document.getElementById("carasingkat").innerHTML = "EXPIRED";
					}
				}, 1000);
			</script>
			
			<?php $this->endSection(); ?>