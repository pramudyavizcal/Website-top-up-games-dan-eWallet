				<?php $this->extend('admin'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
			                    <div class="row">
									<div class="col-lg-10 mx-auto">
									    <?= alert(); ?>
										<div class="card shadow mb-4">
        								    <div class="card-header py-3">
                                                <h6 class="m-0 font-weight-bold text-primary">Edit Deposit</h6>
                                            </div>
											<div class="card-body">
												
												<form action="" method="POST">
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Topup ID</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" value="<?= $topup['topup_id']; ?>">
															<small>Topup ID tidak dapat diganti</small>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Username</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="username" value="<?= $topup['username']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Metode</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="method" value="<?= $topup['method']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Jumlah</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="amount" value="<?= $topup['amount']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Status</label>
														<div class="col-md-8">
															<select name="status" class="form-control">
																<option value="Pending" <?= $topup['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
																<option value="Success" <?= $topup['status'] == 'Success' ? 'selected' : ''; ?>>Success</option>
																<option value="Canceled" <?= $topup['status'] == 'Canceled' ? 'selected' : ''; ?>>Canceled</option>
															</select>
														</div>
													</div>
													<a href="<?= base_url(); ?>/admin/topup" class="btn btn-warning float-left">Kembali</a>
													<div class="text-right">
														<button class="btn text-dark" type="reset">Batal</button>
														<button class="btn btn-success" type="button" onclick="terima();">Terima</button>
														<button class="btn btn-primary" type="submit" name="tombol" value="submit">Simpan</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<script>
					function terima() {
						Swal.fire({
		                    title: 'Terima topup?',
		                    text: "Saldo akan dikirim ke pengguna",
		                    icon: 'warning',
		                    showCancelButton: true,
		                    confirmButtonColor: '#3085d6',
		                    cancelButtonColor: '#d33',
		                    cancelButtonText: 'Batal',
		                    confirmButtonText: 'Terima'
		                }).then((result) => {
		                    if (result.isConfirmed) {
		                        window.location.href = '<?= base_url(); ?>/admin/topup/accept/<?= $topup['id']; ?>';
		                    }
		                });
					}
				</script>
				<?php $this->endSection(); ?>