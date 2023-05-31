				<?php $this->extend('admin'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
			                    <div class="row">
									<div class="col-lg-10 mx-auto">
									    <?= alert(); ?>
										<div class="card shadow mb-4">
        								    <div class="card-header py-3">
                                                <h6 class="m-0 font-weight-bold text-primary">Edit Produk</h6>
                                            </div>
											<div class="card-body">

												<form action="" method="POST" enctype="multipart/form-data">
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Games</label>
														<div class="col-md-8">
															<select name="games_id" class="form-control">
																<?php foreach ($games as $loop): ?>
																<option value="<?= $loop['id']; ?>" <?= $loop['id'] == $product['games_id'] ? 'selected' : ''; ?>><?= $loop['games']; ?></option>
																<?php endforeach ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Produk</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="product" value="<?= $product['product']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Harga Member</label>
														<div class="col-md-8">
															<input type="number" class="form-control" autocomplete="off" name="price" value="<?= $product['price']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Harga Reseller</label>
														<div class="col-md-8">
															<input type="number" class="form-control" autocomplete="off" name="reseller_price" value="<?= $product['reseller_price']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Harga VIP</label>
														<div class="col-md-8">
															<input type="number" class="form-control" autocomplete="off" name="vip_price" value="<?= $product['vip_price']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Provider</label>
														<div class="col-md-8">
															<select name="provider" class="form-control">
																<option value="DF" <?= $product['provider'] == 'DF' ? 'selected' : ''; ?>>Digiflazz</option>
																<option value="AG" <?= $product['provider'] == 'AG' ? 'selected' : ''; ?>>Api Games</option>
																<option value="Manual" <?= $product['provider'] == 'Manual' ? 'selected' : ''; ?>>Manual</option>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Kode Produk</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="sku" value="<?= $product['sku']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Logo URL</label>
														<div class="col-md-8">
															<input type="url" class="form-control" autocomplete="off" name="logo_url" value="<?= $product['logo_url']; ?>">
														</div>
													</div>
													<a href="<?= base_url(); ?>/admin/produk" class="btn btn-warning float-left">Kembali</a>
													<div class="text-right">
														<button class="btn text-dark" type="reset">Batal</button>
														<button class="btn btn-primary" type="submit" name="tombol" value="submit">Simpan</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<?php $this->endSection(); ?>