				<?php $this->extend('admin'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="content">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
							   
								<div class="row justify-content-center">
									<div class="col-md-10">
									     <?= alert(); ?>
										<div class="card">
											<div class="card-body">
												<h5 class="mb-3">Tambah Games</h5>

												

												<form action="" method="POST" enctype="multipart/form-data">
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Games</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="games">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Gambar</label>
														<div class="col-md-8">
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
																<option value="<?= $loop['category']; ?>"><?= $loop['category']; ?></option>
																<?php endforeach ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Urutan</label>
														<div class="col-md-8">
															<input type="number" class="form-control" autocomplete="off" name="sort">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Deskripsi</label>
														<div class="col-md-8">
															<textarea name="konten" id="" cols="30" rows="5" class="form-control"></textarea>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Sistem Target</label>
														<div class="col-md-8">
															<select name="target" class="form-control">
																<option value="default">Default</option>
																<option value="ml">Mobile Legends</option>
																<option value="gi">Genshin Impact</option>
																<option value="hf">Hyper Front</option>
																<option value="pgr">Punishing Gray Raven</option>
																<option value="rm">Ragnarok Mobile</option>
																<option value="joki">Joki - Mobile Legends</option>
																<option value="pulsa">Pulsa / E Wallet</option>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Validasi Player</label>
														<div class="col-md-8">
															<select name="check_status" class="form-control">
																<option value="Y">Ya</option>
																<option value="N">Tidak</option>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Kode Validasi</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="check_code">
															<small>Kosongkan jika tidak menggunakan sistem validasi player</small>
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