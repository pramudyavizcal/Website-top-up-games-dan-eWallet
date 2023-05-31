				<?php $this->extend('admin'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
						<div class="row">
							<div class="col-lg-12 mx-auto">

								<div class="card shadow mb-4">
								    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Kategori</h6>
                                    </div>
									<div class="card-body">
										<div class="card-tools">
											<button class="btn btn-primary btn-sm text-right" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" type="button">Tambah Kategori</button>
										</div>
										<div class="mt-4">
											<div class="collapse" id="collapseExample">
												<form action="" method="POST">
													<div class="form-group row">
														<label class="col-form-label text-dark col-md-4">Icon</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="icon">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label text-dark col-md-4">Kategori Baru</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="category">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label text-dark col-md-4">Urutan</label>
														<div class="col-md-8">
															<input type="number" class="form-control" autocomplete="off" name="sort">
														</div>
													</div>
													<div class="text-right">
														<button class="btn text-dark" type="reset">Batal</button>
														<button class="btn btn-primary" type="submit" name="tombol" value="submit">Simpan</button>
													</div>
												</form>
											</div>
										</div>
										<?= alert(); ?>
									</div>
									<div class="table-responsive">
										<table class="table-white table table-striped">
											<tr class="bg-primary text-white">
												<th>No</th>
												<th>Icon</th>
												<th>Kategori</th>
												<th>Urutan</th>
												<th>Action</th>
											</tr>
											<?php $no = 1; foreach ($kategori as $loop): ?>
											<tr>
												<td width="10"><?= $no++; ?></td>
												<td>
													<div class="input-group">
														<div class="mr-2 pt-2">
															<i class="<?= $loop['icon']; ?>"></i>
														</div>
														<input type="text" class="form-control" value="<?= $loop['icon']; ?>" style="width: 10px;" id="icon-<?= $loop['id']; ?>">
													</div>
												</td>
												<td><?= $loop['category']; ?></td>
												<td>
													<div class="input-group">
														<input type="number" class="form-control" value="<?= $loop['sort']; ?>" style="width: 10px;" id="sort-<?= $loop['id']; ?>">
														<button class="btn btn-primary" type="button" onclick="save_sort('<?= $loop['id']; ?>');">Simpan</button>
													</div>
												</td>
												<td width="10">
													<button type="button" onclick="hapus('<?= base_url(); ?>/admin/kategori/delete/<?= $loop['id']; ?>');" class="btn btn-danger btn-sm">
													    <i class="fas fa-fw fa-trash"></i>
													</button>
												</td>
											</tr>
											<?php endforeach ?>
										</table>
									</div>
								</div>
							</div>
						</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<script>
					function save_sort(id) {
						var icon = $("#icon-" + id).val();
						var sort = $("#sort-" + id).val();

						$.ajax({
							url: '<?= base_url(); ?>/admin/kategori/edit/' + id,
							type: 'POST',
							data: {icon : icon, sort : sort},
							success: function(result) {
								Swal.fire('Berhasil', 'Urutan kategori berhasil disimpan', 'success');
							}
						});
					}
				</script>
				<?php $this->endSection(); ?>