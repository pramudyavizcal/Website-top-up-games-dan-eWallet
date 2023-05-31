				<?php $this->extend('admin'); ?>
				
				<?php $this->section('content'); ?>
				<div class="content">
								<div class="row">
									<div class="col-lg-10 mx-auto">
									    <?= alert(); ?>
										<div class="card shadow mb-4">
    								    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary mb-3">Ubah Password</h6>
                                        </div>
                                        
											<div class="card-body">
												
												<form action="" method="POST">
													<div class="form-group row">
														<label class="col-form-label text-dark col-md-4">Password Lama</label>
														<div class="col-md-8">
															<input type="password" class="form-control" autocomplete="off" name="passwordl">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label text-dark col-md-4">Password Baru</label>
														<div class="col-md-8">
															<input type="password" class="form-control" autocomplete="off" name="passwordb">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label text-dark col-md-4">Ulangi Password Baru</label>
														<div class="col-md-8">
															<input type="password" class="form-control" autocomplete="off" name="passwordbb">
														</div>
													</div>
													<div class="text-right">
														<button class="btn text-dark" type="reset">Batal</button>
														<button class="btn btn-primary" type="submit" name="tombol" value="submit">Simpan</button>
													</div>
												</form>
												
											</div>
										</div>
									</div>
								</div>
							</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<?php $this->endSection(); ?>