			<?php $this->extend('template'); ?>
			
			<?php $this->section('css'); ?>
			<?php $this->endSection(); ?>
			
			<?php $this->section('content'); ?>
			<div class="content" style="min-height: 580px;">
			    <div class="container">
			        <div class="row">
			            
			            <?= $this->include('header-user'); ?>

			            <div class="col-lg-9">
			            	<div class="pb-4">
			                    <h5>Riwayat</h5>
			                    <span class="strip-primary"></span>
			                </div>
			                <div class="pb-3">
			                    <div class="section">
			                        <div class="card-body">
			                        	<div class="row">
			                        		<div class="col-md-6">
			                        			<form action="" method="POST">
					                        		<div class="input-group">
					                        			<input type="text" class="form-control" autocomplete="off" placeholder="Pencarian">
					                        			<button class="btn btn-primary">Cari</button>
					                        		</div>
					                        	</form>
			                        		</div>
			                        	</div>
			                        </div>
			                        <div class="table-responsive">
			                        	<table class="table table-white table-striped mb-0">
			                        		<tr>
			                        			<th>No Transaksi</th>
			                        			<th>Produk</th>
			                        			<th>ID Player</th>
			                        			<th>Harga</th>
			                        			<th>Status</th>
			                        		</tr>
			                        		<?php foreach ($riwayat as $loop): ?>
			                        		<tr>
			                        			<td><?= $loop['order_id']; ?></td>
			                        			<td><?= $loop['product']; ?></td>
			                        			<td><?= $loop['user_id']; ?></td>
			                        			<td>Rp <?= number_format($loop['price'],0,',','.'); ?></td>
			                        			<td><?= $loop['status']; ?></td>
			                        		</tr>
			                        		<?php endforeach ?>
			                        		<?php if (count($riwayat) == 0): ?>
			                        		<tr>
			                        			<td align="center" colspan="5">Tidak ada riwayat</td>
			                        		</tr>
			                        		<?php endif ?>
			                        	</table>
			                        </div>
			                    </div>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>
			<?php $this->endSection(); ?>
			
			<?php $this->section('js'); ?>
			<?php $this->endSection(); ?>