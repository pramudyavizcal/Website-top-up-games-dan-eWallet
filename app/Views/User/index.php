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
			                    <h5>Info Profile</h5>
			                    <span class="strip-primary"></span>
			                </div>

			                <?= alert(); ?>

			                <div class="pb-3">
		                    	<div class="row">
									<div class="col-md-6">
										<div class="card">
											<div class="card-body">
												<p>Username</p>
												<h4 class="m-0"><?= $users['username']; ?></h4>
											</div>
										</div>
									</div>
	                        		<div class="col-md-6">
										<div class="card">
											<div class="card-body">
												<p>Saldo Saya</p>
												<h4 class="m-0">Rp <?= number_format($users['balance'],0,',','.'); ?></h4>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="card">
											<div class="card-body">
												<p>Pesanan Saya</p>
												<h4 class="m-0"><?= number_format($orders,0,',','.'); ?></h4>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="card">
											<div class="card-body">
												<p>Whatsapp Saya</p>
												<h4 class="m-0"><?= $users['wa']; ?></h4>
											</div>
										</div>
									</div>
	                        	</div>
			                    <div class="section mb-4">
			                        <div class="card-body">
			                        	<form action="" method="POST">
			                        		<div class="form-group">
			                        			<label class="text-white">Username</label>
			                        			<input type="text" class="form-control bg-white" readonly="" value="<?= $users['username']; ?>">
			                        			<small>Username tidak dapat diganti</small>
			                        		</div>
			                        		<div class="form-group">
			                        			<label class="text-white">Whatsapp</label>
			                        			<input type="number" class="form-control" value="<?= $users['wa']; ?>" name="wa">
			                        		</div>
			                        		<div class="text-right">
			                        			<button class="btn text-white" type="reset">Batal</button>
			                        			<button class="btn btn-primary" type="submit" name="tombol" value="submit">Simpan</button>
			                        		</div>
			                        	</form>
			                        </div>
			                    </div>
			                    <div class="section">
			                        <div class="card-body">
			                        	<h5>Ganti Password</h5>
			                        	<form action="" method="POST">
			                        		<div class="form-group">
			                        			<label class="text-white">Password Lama</label>
			                        			<input type="password" class="form-control bg-white" name="passwordl">
			                        		</div>
			                        		<div class="form-group">
			                        			<label class="text-white">Password Baru</label>
			                        			<input type="password" class="form-control bg-white" name="passwordb">
			                        		</div>
			                        		<div class="form-group">
			                        			<label class="text-white">Ulangi Password Baru</label>
			                        			<input type="password" class="form-control bg-white" name="passwordbb">
			                        		</div>
			                        		<div class="text-right">
			                        			<button class="btn text-white" type="reset">Batal</button>
			                        			<button class="btn btn-primary" type="submit" name="btn_password" value="password">Simpan</button>
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