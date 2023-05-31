				<?php $this->extend('admin'); ?>
				
				<?php $this->section('content'); ?>
				<div class="content">
				    
				    <div class="row">
                                 <div class="col-lg-10 mx-auto">
                                     <?= alert(); ?>
                                 <!-- Admin -->
                                 <div class="card shadow mb-4">
								    <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary mb-3">Admin</h6>
                                    <div class="card-tools">
										<a href="<?= base_url(); ?>/admin/admin/add" class="btn btn-primary btn-sm">Tambah Akun</a>
									</div>
                                    </div>
									<div class="table-responsive">
										<table class="table-white table table-striped">
											<tr>
												<th width="10">No</th>
												<th>Username</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
											<?php $no = 1; foreach ($account as $loop): ?>
											<tr>
												<td><?= $no++; ?></td>
												<td><?= $loop['username']; ?></td>
												<td><?= $loop['status']; ?></td>
												<td width="10" class="d-flex">
													<a href="<?= base_url(); ?>/admin/admin/edit/<?= $loop['id']; ?>" class="btn btn-primary btn-sm mr-2">
													    <i class="fas fa-fw fa-edit"></i>
													</a>
													<button type="button" onclick="hapus('<?= base_url(); ?>/admin/admin/delete/<?= $loop['id']; ?>');" class="btn btn-danger btn-sm ms-2">
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
					    	</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<?php $this->endSection(); ?>