				<?php $this->extend('admin'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				
						<div class="row">
							<div class="col-lg-10 mx-auto">

								<div class="card shadow mb-4">
								    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Pesanan</h6>
                                    </div>
									<div class="card-body">
										<b class="d-block mb-1">Keterangan Status</b>
										<ul class="mb-0 pl-4">
											<li><b>Pending</b> : Pesanan belum dibayar / menunggu pembayaran</li>
											<li><b>Processing</b> : Pesanan dalam proses oleh provider / manual</li>
											<li><b>Success</b> : Pesanan telah berhasil diproses</li>
											<li><b>Canceled</b> : Pesanan gagal diproses</li>
											<li><b>Expired</b> : Pesanan gagal / expired</li>
										</ul>
										
										<?= alert(); ?>
										
										<hr>
										<button class="btn btn-primary" type="button" onclick="filter_pesanan('Otomatis');">Semua</button>
										<button class="btn btn-primary" type="button" onclick="filter_pesanan('Otomatis');">Otomatis</button>
										<button class="btn btn-primary" type="button" onclick="filter_pesanan('Manual');">Manual</button>
									</div>
									<div class="table-responsive">
										<table class="table-white table table-striped" id="datatable">
    										<thead>
    										    <tr class="bg-primary text-white">
    												<th>No</th>
    												<th>No Transaksi</th>
    												<th>Produk</th>
    												<th>Metode</th>
    												<th>Provider</th>
    												<th>Status</th>
    												<th>Action</th>
    											</tr>
    										</thead>
    										<tbody>
    										    <?php $no = 1; foreach ($orders as $loop): ?>
    											<tr class="<?= $loop['status']; ?> <?= $loop['provider']; ?> all-orders">
    												<td><?= $no++; ?></td>
    												<td><b class="cursor-pointer" onclick="detail('<?= $loop['order_id']; ?>');"><?= $loop['order_id']; ?></b></td>
    												<td>
    													<p class="mb-1"><?= $loop['product']; ?></p>
    													<?php 
    													if ($loop['zone_id'] !== 'joki') {
        												    if (!empty($loop['zone_id']) AND $loop['zone_id'] != 1) {
        														echo $loop['user_id'] . ' ('.$loop['zone_id'].')';
        													} else {
        														echo $loop['user_id'];
        													}
        												}
    													?>
    												</td>
    												<td><?= $loop['method']; ?></td>
    												<td><?= $loop['provider']; ?></td>
    												<td><?= $loop['status']; ?></td>
    												<td>
    													<a href="<?= base_url(); ?>/admin/pesanan/edit/<?= $loop['id']; ?>" class="btn btn-primary btn-sm">
    													    <i class="fas fa-fw fa-edit"></i>
    													</a>
    													<button type="button" onclick="hapus('<?= base_url(); ?>/admin/pesanan/delete/<?= $loop['id']; ?>');" class="btn btn-danger btn-sm">
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
				<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				    <div class="modal-dialog" role="document">
				        <div class="modal-content" style="">
				            <div class="modal-header">
				                <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				                    <span aria-hidden="true">&times;</span>
				                </button>
				            </div>
				            <div class="modal-body p-0">
				            	
				            </div>
				        </div>
				    </div>
				</div>
				<script>
					function detail(order_id) {
						$.ajax({
							url: '<?= base_url(); ?>/admin/pesanan/detail/' + order_id,
							success: function(result) {
								$("#modal-detail div div .modal-body").html(result);

								$("#modal-detail").modal('show');
							}
						});
					}
					
					function filter_pesanan(ket) {
					    
					    if (ket == 'Semua') {
					        $(".all-orders").removeClass('d-none');
					    } else if (ket == 'Manual') {
					        
					        $(".all-orders").removeClass('d-none');
					        
					        <?php foreach($provider as $a): ?>
					        $(".<?= $a['provider']; ?>").addClass('d-none');
					        <?php endforeach; ?>
					        
					    } else if (ket == 'Otomatis') {
					        $(".all-orders").removeClass('d-none');
					        $(".Manual").addClass('d-none');
					    } else if (ket == 'Success') {
					        $(".all-orders").addClass('d-none');
					        $(".Success").removeClass('d-none');
					    } else if (ket == 'Canceled') {
					        $(".all-orders").addClass('d-none');
					        $(".Canceled").removeClass('d-none');
					    } else if (ket == 'Pending') {
					        $(".all-orders").addClass('d-none');
					        $(".Pending").removeClass('d-none');
					    } else if (ket == 'Processing') {
					        $(".all-orders").addClass('d-none');
					        $(".Processing").removeClass('d-none');
					    }
					}
					
					$("#datatable").DataTable();
				</script>
				<?php $this->endSection(); ?>