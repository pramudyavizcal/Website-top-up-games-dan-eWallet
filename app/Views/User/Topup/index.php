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
			                    <div class="float-right mt-2">
			                    	<a href="<?= base_url(); ?>/user/topup/riwayat">
			                    		<h6><i class="fa fa-history mr-2"></i> Riwayat</h6>
			                    	</a>
			                    </div>
			                    <h5>Top Up</h5>
			                    <span class="strip-primary"></span>
			                </div>
							<?= alert(); ?>
			                <div class="pb-3">
			                    <div class="section">
			                        <div class="card-body">
			                        	<form action="" method="POST">
			                        		<div class="form-group">
			                        			<label class="text-white">Nominal Topup</label>
			                        			<input type="number" class="form-control" autocomplete="off" name="nominal">
			                        		</div>
			                        		<div class="row">
			                        			<?php foreach ($method as $loop): ?>
	                                            <div class="col-sm-6 col-12">
	                                                <input class="radio-nominal" type="radio" name="method" value="<?= $loop['id']; ?>" id="method-<?= $loop['id']; ?>">
	                                                <label for="method-<?= $loop['id']; ?>">
	                                                    <div class="ml-2 mr-2 pb-0">
	                                                        <img src="<?= base_url(); ?>/assets/images/method/<?= $loop['image']; ?>" class="card img-fluid mb-1" style="height: 40px;">
	                                                    </div>
	                                                    <div class="ml-2 mt-2">
	                                                        <p class="m-0" style="font-weight: normal;"><?= $loop['method']; ?></p>
	                                                    </div>
	                                                </label>
	                                            </div>
	                                            <?php endforeach ?>
			                        		</div>
			                        		<div class="text-right">
			                        			<button class="btn text-white" type="reset">Batal</button>
			                        			<button class="btn btn-primary" type="submit" name="tombol" value="submit">Topup Sekarang</button>
			                        		</div>
			                        	</form>
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