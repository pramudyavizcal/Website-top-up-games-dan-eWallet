				<?php $this->extend('admin'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				                <div class="row">
									<div class="col-lg-10 mx-auto">
									    	<?= alert(); ?>
										<div class="card shadow mb-4">
        								    <div class="card-header py-3">
                                                <h6 class="m-0 font-weight-bold text-primary">Import Produk</h6>
                                            </div>
											<div class="card-body">

												<form action="" method="POST" enctype="multipart/form-data">
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-dark">File .xlsx</label>
														<div class="col-md-8">
														    <div class="custom-file">
														        <input type="file" class="custom-file-input" id="customFile" name="file">
														        <label class="custom-file-label" for="customFile">Choose file</label>
														    </div>
															<small>Silahkan upload file .xlsx, download format <a href="/format-import-produk.xlsx">disini</a></small>
														</div>
													</div>
													<a href="<?= base_url(); ?>/admin/produk" class="btn btn-warning float-left">Kembali</a>
													<div class="text-right mb-3">
														<button class="btn text-dark" type="reset">Batal</button>
														<button class="btn btn-primary" type="submit" name="tombol" value="submit">Import</button>
													</div>
												</form>
												<table class="table table-white table-striped">
												    <tr class="bg-primary text-white">
												        <th>ID Games</th>
												        <th>Nama Games</th>
												    </tr>
												    <?php foreach($games as $loop): ?>
												    <tr>
												        <td><?= $loop['id']; ?></td>
												        <td><?= $loop['games']; ?></td>
												    </tr>
												    <?php endforeach; ?>
												</table>
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