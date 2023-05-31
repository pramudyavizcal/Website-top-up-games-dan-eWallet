				<?php $this->extend('admin'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>

								<div class="row">
									<div class="col-lg-10 mx-auto">
									    <?= alert(); ?>
        								<div class="card shadow mb-4">
        								    <div class="card-header py-3">
                                                <h6 class="m-0 font-weight-bold text-primary">Edit Member</h6>
                                            </div>
											<div class="card-body">
												
												<form action="" method="POST" enctype="multipart/form-data">
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Username</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" value="<?= $account['username']; ?>">
															<small>Username tidak dapat diganti</small>
														</div>
													</div>
													<div class="form-group row" id="tipe-manual">
														<label class="col-form-label col-md-4 text-dark">Saldo</label>
														<div class="col-md-8">
															<input type="number" class="form-control" autocomplete="off" name="balance" value="<?= $account['balance']; ?>">
														</div>
													</div>
													<div class="form-group row" id="tipe-manual">
														<label class="col-form-label col-md-4 text-dark">Whatsapp</label>
														<div class="col-md-8">
															<input type="number" class="form-control" autocomplete="off" name="wa" value="<?= $account['wa']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Level Member</label>
														<div class="col-md-8">
															<select class="form-control" id="level_id" name="level_id">
																<?php foreach($level as $key => $value){ ?>
																	<option value="<?= $value['id'] ?>" <?= $value['id'] == $account['level_id'] ? 'selected' : '' ; ?> ><?= $value['level_name'] ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Status</label>
														<div class="col-md-8">
															<select name="status" class="form-control">
																<option value="On" <?= $account['status'] == 'On' ? 'selected' : ''; ?>>On</option>
																<option value="Off" <?= $account['status'] == 'Off' ? 'selected' : ''; ?>>Off</option>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Password</label>
														<div class="col-md-8">
															<button class="btn btn-success" type="button" id="btn-reset">Reset Password</button>
														</div>
													</div>
													<a href="<?= base_url(); ?>/admin/pengguna" class="btn btn-warning float-left">Kembali</a>
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
				<script>
					$("#btn-reset").on('click', function() {
						Swal.fire({
		                    title: 'Reset password?',
		                    text: "Password pengguna akan direset",
		                    icon: 'warning',
		                    showCancelButton: true,
		                    confirmButtonColor: '#3085d6',
		                    cancelButtonColor: '#d33',
		                    cancelButtonText: 'Batal',
		                    confirmButtonText: 'Reset password'
		                }).then((result) => {
		                    if (result.isConfirmed) {
		                        window.location.href = '<?= base_url(); ?>/admin/pengguna/reset/<?= $account['id']; ?>';
		                    }
		                });
					});
				</script>
				<?php $this->endSection(); ?>