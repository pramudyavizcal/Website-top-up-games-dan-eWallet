				<?php $this->extend('admin'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="content">
				    <div class="row">
						<div class="col-lg-10 mx-auto">
									    
									    <?= alert(); ?>
									    
										<div class="card shadow mb-4">
										    <div class="card-header py-3">
                                                <h6 class="m-0 font-weight-bold text-primary mb-3">Edit Games</h6>
                                            </div>
											<div class="card-body">

												

												<form action="" method="POST" enctype="multipart/form-data">
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Games</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="games" value="<?= $games['games']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Subtitle</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="subtitle" value="<?= $games['subtitle']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Gambar</label>
														<div class="col-md-8">
															<img src="<?= base_url(); ?>/assets/images/games/<?= $games['image'] ?>" alt="" width="140" class="mb-3 rounded">
															<div class="custom-file">
															    <input type="file" class="custom-file-input" id="games-image" name="image">
															    <label class="custom-file-label" for="games-image">Choose file</label>
															</div>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Kategori</label>
														<div class="col-md-8">
															<select name="category" class="form-control">
																<?php foreach ($category as $loop): ?>
																<option value="<?= $loop['category']; ?>" <?= $loop['category'] == $games['category'] ? 'selected' : ''; ?>><?= $loop['category']; ?></option>
																<?php endforeach ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Urutan</label>
														<div class="col-md-8">
															<input type="number" class="form-control" autocomplete="off" name="sort" value="<?= $games['sort']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Deskripsi</label>
														<div class="col-md-8">
															<textarea name="konten" id="" cols="30" rows="5" class="form-control"><?= $games['konten']; ?></textarea>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Sistem Target</label>
														<div class="col-md-8">
															<select name="target" class="form-control">
																<option value="default" <?= $games['target'] == 'default' ? 'selected' : ''; ?>>Default</option>
																<option value="ml" <?= $games['target'] == 'ml' ? 'selected' : ''; ?>>Mobile Legends</option>
																<option value="gi" <?= $games['target'] == 'gi' ? 'selected' : ''; ?>>Genshin Impact</option>
																<option value="hf" <?= $games['target'] == 'hf' ? 'selected' : ''; ?>>Hyper Front</option>
																<option value="pgr" <?= $games['target'] == 'pgr' ? 'selected' : ''; ?>>Punishing Gray Raven</option>
																<option value="rm" <?= $games['target'] == 'rm' ? 'selected' : ''; ?>>Ragnarok Mobile</option>
																<option value="joki" <?= $games['target'] == 'joki' ? 'selected' : ''; ?>>Joki - Mobile Legends</option>
																<option value="pulsa" <?= $games['target'] == 'pulsa' ? 'selected' : ''; ?>>Pulsa / E Wallet</option>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Validasi Player</label>
														<div class="col-md-8">
															<select name="check_status" class="form-control">
																<option value="Y" <?= $games['check_status'] == 'Y' ? 'selected' : ''; ?>>Ya</option>
																<option value="N" <?= $games['check_status'] == 'N' ? 'selected' : ''; ?>>Tidak</option>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Kode Validasi</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="check_code" value="<?= $games['check_code']; ?>">
															<small>Kosongkan jika tidak menggunakan sistem validasi player</small>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Status</label>
														<div class="col-md-8">
															<select name="status" class="form-control">
																<option value="On" <?= $games['status'] == 'On' ? 'selected' : ''; ?>>On</option>
																<option value="Off" <?= $games['status'] == 'Off' ? 'selected' : ''; ?>>Off</option>
															</select>
														</div>
													</div>
													<a href="<?= base_url(); ?>/admin/games" class="btn btn-warning float-left">Kembali</a>
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
				<script>
					$(".custom-file-input").on("change", function() {
						var fileName = $(this).val().split("\\").pop();
						$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
					});
					CKEDITOR.replace('konten');
				</script>
				<?php $this->endSection(); ?>