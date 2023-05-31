				<?php $this->extend('admin'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				
						<div class="row">
							<div class="col-lg-10 mx-auto">

								<div class="card shadow mb-4">
								    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Metode Pembayaran</h6>
                                    </div>
									<div class="card-body">
										<div class="card-tools">
											<a href="<?= base_url(); ?>/admin/metode/add" class="btn btn-primary">Tambah Metode</a>
										</div>
										<form action="" method="POST">
											<div class="row mt-3">
												<div class="col-md-6">
													<div class="form-group">
														<label class="text-dark">Pembayaran Saldo</label>
														<div class="input-group">
															<select name="pay_balance" class="form-control">
																<option value="Y" <?= $pay_balance == 'Y' ? 'selected' : ''; ?>>Ya</option>
																<option value="N" <?= $pay_balance == 'N' ? 'selected' : ''; ?>>Tidak</option>
															</select>
															<button class="btn btn-primary" type="submit">Simpan</button>
														</div>
													</div>
												</div>
											</div>
										</form>
										<?= alert(); ?>
									</div>
									<div class="table-responsive">
										<table id="datatable" class="table-white table table-striped">
											<tr class="bg-primary text-white">
												<th width="10">No</th>
												<th>Metode</th>
												<th>Provider</th>
												<th>Kategori</th>
												<th>Kode Unik</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
											<?php $no = 1; foreach ($method as $loop): ?>
											<tr>
												<td><?= $no++; ?></td>
												<td>
													<img src="<?= base_url(); ?>/assets/images/method/<?= $loop['image']; ?>" alt="" width="70" class="mr-2 rounded">
													<?= $loop['method']; ?>
												</td>
												<td>
													<?= $loop['provider']; ?>
													<p class="m-0"><?= $loop['code']; ?></p>
												</td>
												<td>
													<?= $loop['category']; ?>
												</td>
												<td>
													<?php
													if ($loop['uniq'] == 'Y') {
														echo "Ya";
													} else {
														echo "Tidak";
													}
													?>
												</td>
												<td><?= $loop['status']; ?></td>
												<td width="10" class="d-sm-flex p-2">
													<a href="<?= base_url(); ?>/admin/metode/edit/<?= $loop['id']; ?>" class="btn btn-primary btn-sm mr-2">
													    <i class="fas fa-fw fa-edit"></i>
													</a>
													<button type="button" onclick="hapus('<?= base_url(); ?>/admin/metode/delete/<?= $loop['id']; ?>');" class="btn btn-danger btn-sm ms-2">
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