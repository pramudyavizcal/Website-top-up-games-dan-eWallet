			<?php $this->extend('template'); ?>
			
			<?php $this->section('css'); ?>
			<?php $this->endSection(); ?>
			
			<?php $this->section('content'); ?>
			<div class="content" style="min-height: 580px;">
			    <div class="container">
			    	<div class="row justify-content-center">
					    <div class="col-lg-9">
					    	<div class="pt-3 pb-4">
					            <h5>Login Reseller</h5>
					            <span class="strip-primary"></span>
					        </div>
					        <div class="pb-3">
					            <div class="section">
					                <div class="card-body">

					                	<?= alert(); ?>

					                    <form role="form" action="" method="POST">
					                        <div class="form-group mb-2">
					                            <p class="text-white">Username</p>
					                            <input type="text" name="username" class="form-control" required autocomplete="off">
					                        </div>
					                        <div class="form-group mb-3">
					                            <p class="text-white">Password</p>
					                            <input type="password" name="password" class="form-control" required>
					                        </div>
					                        <button type="submit" name="tombol" value="submit" class="btn btn-primary">Masuk Akun</button>
					                    </form>
					                    <hr style="background-color: #b8b8b8; opacity: .3;">
				                        <!--<p>Belum memiliki akun? <a href="<?= base_url(); ?>/register">Register</a></p>-->
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