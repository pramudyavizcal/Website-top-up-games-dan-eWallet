				<?php $this->extend('admin'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
						<div class="row">
							<div class="col-lg-10 mx-auto">
							    <?= alert(); ?>
								<div class="card shadow mb-4">
								    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Level Member</h6>
                                    </div>
									<div class="card-body">
										<!-- <a href="<?= base_url(); ?>/admin/pengguna/add" class="btn btn-primary">Tambah Level</a> -->
									</div>
									<div class="table-responsive">
										<table class="table-white table table-striped">
											<tr class="bg-primary text-white">
												<th width="10">No</th>
												<th>Level</th>
												<th>Harga</th>
												<th>Action</th>
											</tr>
											<?php $no = 1; foreach ($account as $loop): ?>
											<tr>
												<td><?= $no++; ?></td>
												<td><?= $loop['level_name']; ?></td>
												<td>Rp <?= number_format($loop['price'],0,',','.'); ?></td>
												<td class="d-sm-flex m-2" width="10">
													<a href="<?= base_url(); ?>/admin/level/edit/<?= $loop['id']; ?>" class="btn btn-primary btn-sm mr-2">
													    <i class="fas fa-fw fa-edit"></i>
													</a>
												</td>
											</tr>
											<?php endforeach ?>
											<?php if (count($account) == 0): ?>
											<tr>
												<td colspan="6" align="center">Tidak ada level</td>
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