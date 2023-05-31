				<?php $this->extend('admin'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				                <div class="row">
									<div class="col-lg-10 mx-auto">
									    <?= alert(); ?>
        								<div class="card shadow mb-4">
        								    <div class="card-header py-3">
                                                <h6 class="m-0 font-weight-bold text-primary">Tambah Game populer</h6>
                                            </div>
											<div class="card-body">
												
												<form action="<?= base_url('admin/gamepopuler/add') ?>" method="POST" enctype="multipart/form-data">
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Pilih Game</label>
														<div class="col-md-8">
															<select class="form-control" id="game_id" name="game_id">
																<?php foreach($game as $key => $value){ ?>
																	<option value="<?= $value['id'] ?>" ><?= $value['games'] ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													<a href="<?= base_url(); ?>/admin/gamepopuler" class="btn btn-warning float-left">Kembali</a>
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