				<?php $this->extend('admin'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>

				<div class="row">
					<div class="col-lg-10 mx-auto">
						<?= alert(); ?>
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">Edit Template Whatsapp <?= $whatsapp['type'] ?></h6>
							</div>
							<div class="card-body">
								<form action="<?= base_url('/admin/whatsapp/add') ?>" method="POST">
									<div class="form-group">
										<label class="col-form-label text-dark">Variabel</label>
										<div>
											<ul>
												<li>Variabel <b>#username#</b> untuk menampilkan username yang melakukan pembelian</li>
												<li>Variabel <b>#orderid#</b> untuk menampilkan order id pembelian</li>
												<li>Variabel <b>#produk#</b> untuk menampilkan user id game</li>
												<li>Variabel <b>#totalbayar#</b> untuk menampilkan total tagihan pembelian</li>
												<li>Variabel <b>#metodebayar#</b> untuk menampilkan metode pembelian</li>
												<li>Variabel <b>#status#</b> untuk menampilkan status pembelian</li>
											</ul>
										</div>
									</div>
									<div class="form-group">
										<label class="col-form-label text-dark">Pesan</label>
										<textarea rows="10" class="form-control" name="template"><?= $whatsapp['template'] ?></textarea>
									</div>
									<div class="text-right">
										<input type="hidden" name="id" value="<?= $whatsapp['id'] ?>">
										<a href="<?= base_url(); ?>/admin/whatsapp" class="btn btn-warning">Kembali</a>
										<button class="btn btn-primary" type="submit" name="tombol" value="submit">Simpan</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php $this->endSection(); ?>
				