				<?php $this->extend('admin'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>

								<div class="row">
									<div class="col-lg-10 mx-auto">
									    <?= alert(); ?>
        								<div class="card shadow mb-4">
        								    <div class="card-header py-3">
                                                <h6 class="m-0 font-weight-bold text-primary">Edit Bantuan</h6>
                                            </div>
											<div class="card-body">
												
												<form action="" method="POST" enctype="multipart/form-data">
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Gambar</label>
														<div class="col-md-8">
														    <img src="<?= base_url(); ?>/assets/images/sosmed/<?= $sosmeda['image']; ?>" width="120" class="d-block mb-3">
														    <div class="custom-file">
														        <input type="file" class="custom-file-input" id="customFile" name="image">
														        <label class="custom-file-label" for="customFile">Choose file</label>
														    </div>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">Link</label>
														<div class="col-md-8">
															<input type="url" class="form-control" autocomplete="off" name="link" value="<?= $sosmeda['link']; ?>">
														</div>
													</div>
													<a href="<?= base_url(); ?>/admin/sosmed" class="btn btn-warning float-left">Kembali</a>
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
				    $(".custom-file-input").on("change", function() {
				        var fileName = $(this).val().split("\\").pop();
				        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
				    });
				</script>
				<?php $this->endSection(); ?>