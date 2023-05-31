				<?php $this->extend('admin'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
					<div class="row">
						<div class="col-lg-10 mx-auto">
							<?= alert(); ?>
							<div class="card shadow mb-4">
								<div class="card-header py-3">
									<h6 class="m-0 font-weight-bold text-primary">Upgrade Level Member</h6>
								</div>
								<div class="card-body">
									<!-- <a href="<?= base_url(); ?>/admin/pengguna/add" class="btn btn-primary">Tambah Level</a> -->
								</div>
								<div class="table-responsive">
									<table class="table-white table table-striped">
										<tr class="bg-primary text-white">
											<th width="10">No</th>
											<th>Nama User</th>
											<th>Nama Level</th>
											<th>Harga</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
										<?php $no = 1; foreach ($level_upgrade as $key => $value): ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= $value['username']; ?></td>
											<td><?= $value['level_name']; ?></td>
											<td>Rp. <?= number_format($value['price'], 0,'.',',') ; ?></td>
											<td><?= $value['status']; ?></td>
											<td>
												<a href="<?= base_url(); ?>/admin/level-upgrade/edit/<?= $value['id']; ?>" class="btn btn-primary btn-sm">
													<i class="fas fa-fw fa-edit"></i>
												</a>
												<a href="<?= base_url(); ?>/admin/level-upgrade/delete/<?= $value['id']; ?>" class="btn btn-primary btn-sm">
													Hapus
												</a>
											</td>
										</tr>
										<?php endforeach ?>
										<?php if (count($level_upgrade) == 0): ?>
										<tr>
											<td colspan="6" align="center">Tidak ada data upgrade level</td>
										</tr>
										<?php endif ?>
									</table>
								</div>
							</div>
						</div>
					</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<?php $this->endSection(); ?>