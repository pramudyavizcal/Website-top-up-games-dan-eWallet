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
			                    <h5>Riwayat Topup</h5>
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
			                        			<th>No Topup</th>
			                        			<th>Metode</th>
			                        			<th>Nominal</th>
			                        			<th>Status</th>
			                        			<th>Tanggal</th>
			                        		</tr>
			                        		<?php foreach ($topup as $loop): ?>
			                        		<tr>
			                        			<td>
			                        				<a href="<?= base_url(); ?>/user/topup/<?= $loop['topup_id']; ?>"><b><?= $loop['topup_id']; ?></b></a>
			                        			</td>
			                        			<td><?= $loop['method']; ?></td>
			                        			<td>Rp <?= number_format($loop['amount'],0,',','.'); ?></td>
			                        			<td><?= $loop['status']; ?></td>
			                        			<td><?= $loop['date_create']; ?></td>
			                        		</tr>
			                        		<?php endforeach ?>
			                        		<?php if (count($topup) == 0): ?>
			                        		<tr>
			                        			<td align="center" colspan="5">Tidak ada topup</td>
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