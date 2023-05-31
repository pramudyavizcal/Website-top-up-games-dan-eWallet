				<?php $this->extend('admin'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
						<div class="row">
							<div class="col-lg-10 mx-auto">

								<div class="card shadow mb-4">
								    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Bantuan</h6>
                                    </div>
									<div class="card-body">
										
										<a href="<?= base_url(); ?>/admin/sosmed/add" class="btn btn-primary btn-sm">Tambah</a>
										
										<?= alert(); ?>
										
									</div>
									<div class="table-responsive">
										<table class="table-white table table-striped">
											<tr class="bg-primary text-white">
												<th width="10">No</th>
												<th>Gambar</th>
												<th>Link</th>
												<th>Action</th>
											</tr>
											<?php $no = 1; foreach ($sosmed as $loop): ?>
											<tr>
												<td><?= $no++; ?></td>
												<td>
												    <img src="<?= base_url(); ?>/assets/images/sosmed/<?= $loop['image']; ?>" width="40">
												</td>
												<td><?= $loop['link']; ?></td>
												<td class="d-sm-flex" width="10">
													<a href="<?= base_url(); ?>/admin/sosmed/edit/<?= $loop['id']; ?>" class="btn btn-primary btn-sm mr-2">
													    <i class="fas fa-fw fa-edit"></i>
													</a>
													<button type="button" onclick="hapus('<?= base_url(); ?>/admin/sosmed/delete/<?= $loop['id']; ?>');" class="btn btn-danger btn-sm ms-2">
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
				<?php $this->endSection(); ?>