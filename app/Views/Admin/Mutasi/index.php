				<?php $this->extend('admin'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
			
				<div class="row">
					<div class="col-lg-12 mx-auto">
						<?= alert(); ?>
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">Mutasi Bank</h6>
							</div>
							<div class="card-body">
								<form method="POST" action="">
									<div class="row">
										<div class="col-md-6 ml-4 mr-4">
											<div class="input-group mb-3">
												<select class="custom-select" id="bank" name="bank">
													<option selected>Pilih Rekening...</option>
													<?php foreach ($method as $key => $value) { ?>
														<option value="<?= $value['code'] ?>" <?= $bank == $value['code'] ? 'selected' : '' ; ?> ><?= $value['method'] ?></option>
													<?php } ?>
												</select>
												<input type="date" class="form-control" name="date_from"  value="<?= $date_from ?>" aria-label="Recipient's username" aria-describedby="button-addon2">
												<input type="date" class="form-control" name="date_to" value="<?= $date_to ?>" aria-label="Recipient's username" aria-describedby="button-addon2">
												<div class="input-group-append">
													<button class="btn btn-outline-secondary" type="submit" name="filter" value="filter" id="button-addon2">Filter</button>
												</div>
											</div>
										</div>
									</div>
								</form>
								<div class="table-responsive">
									<table id="datatable" class="table-white table table-striped">
										<thead>
											<tr class="bg-primary text-white">
												<th width="10">No</th>
												<th>Nama Bank</th>
												<th>Rekening</th>
												<th>Amount</th>
												<th>Deskripsi</th>
												<th>Tanggal</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1; foreach ($mutasi as $key => $value) { ?>
												<tr>
													<td><?= $no++ ?></td>
													<td><?= $value->service_code ?></td>
													<td><?= $value->account_number ?></td>
													<td>Rp. <?= number_format($value->amount, 0 , '.',',') ?></td>
													<td><?= $value->description ?></td>
													<td><?= date('Y-m-d H:i:s', $value->unix_timestamp) ?></td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
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
				                <h5 class="modal-title" id="exampleModalLabel">Detail Topup</h5>
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
					$('#datatable').DataTable();

					function detail(topup_id) {
						$.ajax({
							url: '<?= base_url(); ?>/admin/topup/detail/' + topup_id,
							success: function(result) {
								$("#modal-detail div div .modal-body").html(result);

								$("#modal-detail").modal('show');
							}
						});
					}
				</script>
				<?php $this->endSection(); ?>