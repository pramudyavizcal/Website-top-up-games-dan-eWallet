				<?php $this->extend('admin'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				        <div class="row">
							<div class="col-lg-10 mx-auto">
							    <?= alert(); ?>
										<div class="card shadow mb-4">
        								    <div class="card-header py-3">
                                                <h6 class="m-0 font-weight-bold text-primary">Edit Pesanan</h6>
                                            </div>
											<div class="card-body">
												
												<form action="" method="POST">
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">No Transaksi</label>
														<div class="col-md-8">
															<input type="text" class="form-control text-dark bg-white" autocomplete="off" value="<?= $orders['order_id']; ?>" readonly>
															<small>No transaksi tidak dapat diedit</small>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Username</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="username" value="<?= $orders['username']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Whatsapp</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="wa" value="<?= $orders['wa']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Produk</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="product" value="<?= $orders['product']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Metode</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="method" value="<?= $orders['method']; ?>">
														</div>
													</div>
													<div class="form-group row <?= $orders['zone_id'] == 'joki' ? 'd-none' : ''; ?>">
														<label class="col-form-label col-md-4 text-white">User ID</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="user_id" value="<?= $orders['user_id']; ?>">
														</div>
													</div>
													<div class="form-group row <?= $orders['zone_id'] == 'joki' ? 'd-none' : ''; ?>">
														<label class="col-form-label col-md-4 text-white">Zone ID</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="zone_id" value="<?= $orders['zone_id']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Nickname</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="nickname" value="<?= $orders['nickname']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Status</label>
														<div class="col-md-8">
															<select name="status" class="form-control">
																<option value="Pending" <?= $orders['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
																<option value="Processing" <?= $orders['status'] == 'Processing' ? 'selected' : ''; ?>>Processing</option>
																<option value="Success" <?= $orders['status'] == 'Success' ? 'selected' : ''; ?>>Success</option>
																<option value="Canceled" <?= $orders['status'] == 'Canceled' ? 'selected' : ''; ?>>Canceled</option>
																<option value="Expired" <?= $orders['status'] == 'Expired' ? 'selected' : ''; ?>>Expired</option>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Keterangan</label>
														<div class="col-md-8">
															<textarea name="ket" cols="30" rows="4" class="form-control"><?= $orders['ket']; ?></textarea>
														</div>
													</div>
													<a href="<?= base_url(); ?>/admin/pesanan" class="btn btn-warning float-left">Kembali</a>
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