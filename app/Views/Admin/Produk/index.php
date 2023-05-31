				<?php $this->extend('admin'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
						<div class="row">
							<div class="col-lg-12 mx-auto">

								<div class="card shadow mb-4">
								    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Produk</h6>
                                    </div>
									<div class="card-body">
										<div class="card-tools">
											<a href="<?= base_url(); ?>/admin/produk/import" class="btn btn-primary btn-sm">Import Produk</a>
											<a href="<?= base_url(); ?>/admin/produk/add" class="btn btn-primary btn-sm">Tambah Produk</a>
										</div>
									</div>
									<div class="table-responsive">
										<table class="table-white table table-striped" id="datatable">
    										<thead class="bg-primary text-white">
    										    <tr>
    												<th width="10">No</th>
    												<th>Games</th>
    												<th>Produk</th>
    												<th>Harga Member</th>
    												<th>Harga Reseller</th>
    												<th>Harga VIP</th>
    												<th>Status</th>
    												<th>Action</th>
    											</tr>
    										</thead>
    										<tfoot class="bg-light text-dark">
                                                <tr>
                                                    <th width="10">No</th>
    												<th>Games</th>
    												<th>Produk</th>
    												<th>Harga Member</th>
    												<th>Harga Reseller</th>
    												<th>Harga VIP</th>
    												<th>Status</th>
    												<th>Action</th>
                                                </tr>
                                            </tfoot>
    										<tbody>
    										    <?php $no = 1; foreach ($product as $loop): ?>
    											<tr>
    												<td><?= $no++; ?></td>
    												<td><?= $loop['games']; ?></td>
    												<td><?= $loop['product']; ?></td>
    												<td>Rp <?= number_format($loop['price'],0,',','.'); ?></td>
    												<td>Rp <?= number_format($loop['reseller_price'],0,',','.'); ?></td>
    												<td>Rp <?= number_format($loop['vip_price'],0,',','.'); ?></td>
    												<td><?= $loop['status']; ?></td>
    												<td class="d-sm-flex p-2">
    													<a href="<?= base_url(); ?>/admin/metode/price/<?= $loop['id']; ?>" class="btn btn-success btn-sm mr-2">Kostum Harga</a>
    													<a href="<?= base_url(); ?>/admin/produk/edit/<?= $loop['id']; ?>" class="btn btn-primary btn-sm mr-2">
    													    <i class="fas fa-fw fa-edit"></i>
    													</a>
    													<button type="button" onclick="hapus('<?= base_url(); ?>/admin/produk/delete/<?= $loop['id']; ?>');" class="btn btn-danger btn-sm ms-2">
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
				<script>
				    $("#datatable").DataTable();
				</script>
				<?php $this->endSection(); ?>