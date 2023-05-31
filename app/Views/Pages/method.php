			<?php $this->extend('template'); ?>
			
			<?php $this->section('css'); ?>
			<?php $this->endSection(); ?>
			
			<?php $this->section('content'); ?>
			<div class="clearfix pt-5"></div>
			<div class="pt-5 pb-5">
			    <div class="container">
			        <div class="row justify-content-center">
			            <div class="col-lg-12">
			            	<div class="pt-3 pb-4">
			                    <h5>Metode Pembayaran</h5>
			                    <span class="strip-primary"></span>
			                </div>
		                    <div class="section">
		                        <div class="card-body">
		                        	<div class="row">
		                        		<?php foreach ($method as $loop): ?>
		                        		<div class="col-4 mb-4">
										    <div class="metode-bayar p-3" style="background: var(--warna_3);box-shadow: none;">
										        <img src="<?= base_url(); ?>/assets/images/method/<?= $loop['image']; ?>" width="100" class="mb-3 rounded">
										        <p class="m-0"><?= $loop['method']; ?></p>
										    </div>
										</div>
		                        		<?php endforeach ?>
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