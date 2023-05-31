			<?php $this->extend('template'); ?>
			
			<?php $this->section('css'); ?>
			<style>
				#datatable_wrapper {
					padding: 0;
				}
				#datatable_wrapper .row:nth-child(1), #datatable_wrapper .row:nth-child(3) {
					padding: 20px 15px;
				}
				label {
					color: #fff;
				}
			</style>
			<?php $this->endSection(); ?>
			
			<?php $this->section('content'); ?>
			<div class="clearfix pt-5"></div>
			<div class="pt-5 pb-5">
			    <div class="container">
			        <div class="row justify-content-center pt-4">
			            <div class="col-lg-12">
			                <?php foreach ($price as $games): ?>
			                <div class="row mb-4">
			                	<div class="col-md-3 text-right">
			                		<img src="<?= base_url(); ?>/assets/images/games/<?= $games['image']; ?>" alt="" width="100" class="rounded mb-3">
			                		<h5 class="btn btn-primary"><?= $games['games']; ?></h5>
			                	</div>
			                	<div class="col-md-9">
			                		<div class="card">
			                			<table class="table table-bordered table-striped table-white table-responsive">
			                				<tr>
			                					<th width="10">Kode</th>
			                					<th width="50%">Produk</th>
			                					<th width="10%">Harga</th>
			                					<th width="10" class="text-center">Status</th>
			                				</tr>
			                				<?php foreach ($games['product'] as $product): ?>
			                				<tr>
			                					<td><?= $product['sku']; ?></td>
			                					<td><?= $product['product']; ?></td>
			                					<td>Rp <?= number_format($product['price'],0,',','.'); ?></td>
			                					<td  align="center" ><span class="badge badge-success"><?= $product['status']; ?></span></td>
			                				</tr>
			                				<?php endforeach ?>
			                			</table>
			                		</div>
			                	</div>
			                </div>
			                <?php endforeach ?>
			            </div>
			        </div>
			    </div>
			</div>
			<?php $this->endSection(); ?>
			
			<?php $this->section('js'); ?>
			<script>
				$("#datatable").DataTable({
					ordering: false,
				});
			</script>
			<?php $this->endSection(); ?>