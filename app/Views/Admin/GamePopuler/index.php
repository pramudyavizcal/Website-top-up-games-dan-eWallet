				<?php $this->extend('admin'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
						<div class="row">
							<div class="col-lg-10 mx-auto">
							    <?= alert(); ?>
								<div class="card shadow mb-4">
								    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Game Populer</h6>
                                    </div>
									<div class="card-body">
										<a href="<?= base_url(); ?>/admin/gamepopuler/add" class="btn btn-primary">Tambah Game Populer</a>
										
									</div>
									<div class="table-responsive">
										<table class="table-white table table-striped">
											<thead class="bg-primary text-white">
    										    <tr>
    												<th width="10">No</th>
    												<th>Games</th>
    												<th>Action</th>
    											</tr>
    										</thead>
    										<tbody>
    										    <?php $no = 1; foreach ($games as $key => $value): ?>
    											<tr>
    												<td><?= $no++; ?></td>
    												<td>
    													<img src="<?= base_url(); ?>/assets/images/games/<?= $value['image']; ?>" alt="" width="40" class="mr-1 rounded">
    													<?= $value['name']; ?>
    												</td>
    												<td width="10" class="d-flex">
    													<button type="button" onclick="hapus('<?= base_url(); ?>/admin/gamepopuler/delete/<?= $value['id']; ?>');" class="btn btn-danger btn-sm ms-2">
    													    <i class="fas fa-fw fa-trash"></i>
    													</button>
    												</td>
    											</tr>
    											<?php endforeach ?>
    										</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<?php $this->endSection(); ?>