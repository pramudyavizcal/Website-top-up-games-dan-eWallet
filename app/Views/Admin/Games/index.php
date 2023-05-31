				<?php $this->extend('admin'); ?>
				
				<?php $this->section('content'); ?>
				<div class="content">
						<div class="row">
							<div class="col-lg-10 mx-auto">
							    <?= alert(); ?>
								<div class="card shadow mb-4">
								    <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary mb-3">Games</h6>
                                    <div class="card-tools">
										<a href="<?= base_url(); ?>/admin/games/add" class="btn btn-primary btn-sm">Tambah Games</a>
									</div>
                                    </div>
									<div class="table-responsive">
										<table class="table-white table table-striped" id="datatable">
    										<thead class="bg-primary text-white">
    										    <tr>
    												<th width="10">No</th>
    												<th>Games</th>
    												<th>Kategori</th>
    												<th>Produk</th>
    												<th>Status</th>
    												<th>Action</th>
    											</tr>
    										</thead>
    										<tbody>
    										    <?php $no = 1; foreach ($games as $loop): ?>
    											<tr>
    												<td><?= $no++; ?></td>
    												<td>
    													<img src="<?= base_url(); ?>/assets/images/games/<?= $loop['image']; ?>" alt="" width="40" class="mr-1 rounded">
    													<?= $loop['games']; ?>
    												</td>
    												<td><?= $loop['category']; ?></td>
    												<td><?= $loop['product']; ?> Produk</td>
    												<td><?= $loop['status']; ?></td>
    												<td width="10" class="d-flex">
    													<a href="<?= base_url(); ?>/admin/games/edit/<?= $loop['id']; ?>" class="btn btn-primary btn-sm mr-2">
    													    <i class="fas fa-fw fa-edit"></i>
    													</a>
    													<button type="button" onclick="hapus('<?= base_url(); ?>/admin/games/delete/<?= $loop['id']; ?>');" class="btn btn-danger btn-sm ms-2">
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
					</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<script>
				    $("#datatable").DataTable();
				</script>
				<?php $this->endSection(); ?>