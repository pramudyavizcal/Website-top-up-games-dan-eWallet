			<?php $this->extend('template'); ?>
			
			<?php $this->section('css'); ?>
			<?php $this->endSection(); ?>
			
			<?php $this->section('content'); ?>
		
			<div class="clearfix pt-5"></div>
			<div class="pt-5 pb-5" style="min-height: 500px;">
			    <div class="container">
				
			    	<div class="row justify-content-center">
					    <div class="col-lg-9">
					    	<div class="pt-3 pb-4">
					            <h5 class="btn btn-primary">Cek Status Pesanan</h5>
					            <!--<span class="strip-primary"></span>-->
					        </div>
				            <div class="section">
				                <div class="card-body">
				                    <form role="form" class="mb-3" action="" method="POST">
				                        <p class="text-white">No. Transaksi</p>
				                        <?= alert(); ?>
				                        <div class="form-group mb-3">
				                            <input type="text" name="order_id" class="form-control" required autocomplete="off">
				                        </div>
				                        <div class="text-right">
				                        	<button type="submit" name="submit" value="submit" class="btn btn-primary">Cek Pesanan</button>
				                        </div>
				                    </form>
				                </div>
				            </div>
					    </div>
					</div>
			    </div>
			</div>
			<?php $this->endSection(); ?>
		
			
			<?php $this->section('js'); ?>
			<?php $this->endSection(); ?>
			
			