				<?php $this->extend('admin'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
						<div class="row">
							<div class="col-lg-12 mx-auto">
							    <?= alert(); ?>
								<div class="card shadow mb-4">
								    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Template Pesan Whatsapp</h6>
                                    </div>
									<div class="card-body">
										<!-- <a href="<?= base_url(); ?>/admin/pengguna/add" class="btn btn-primary">Tambah Level</a> -->
										<div class="table-responsive">
											<table class="table-white table table-striped">
												<tehad>
													<tr class="bg-primary text-white">
														<th width="10">No</th>
														<th>Jenis Template</th>
														<th>Action</th>
													</tr>
												</tehad>
												<tbody>
													<?php $no = 1; foreach ($whatsapp as $key => $value): ?>
													<tr>
														<td><?= $no++; ?></td>
														<td><?= $value['type']; ?></td>
														<td class="d-sm-flex m-2" width="10">
															<a href="<?= base_url(); ?>/admin/whatsapp/edit/<?= $value['id']; ?>" class="btn btn-primary btn-sm mr-2">
																<i class="fas fa-fw fa-edit"></i>
															</a>
														</td>
													</tr>
													<?php endforeach ?>
													<?php if (count($whatsapp) == 0): ?>
													<tr>
														<td colspan="3" align="center">Tidak ada level</td>
													</tr>
													<?php endif ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<?php $this->endSection(); ?>