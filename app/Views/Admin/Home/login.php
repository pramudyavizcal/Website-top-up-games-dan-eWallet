			<?php $this->extend('template'); ?>
			
			<?php $this->section('css'); ?>
			<?php $this->endSection(); ?>
			
			<?php $this->section('content'); ?>
			<div class="content" style="min-height: 600px;">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-md-6">
							<div class="card">
								<div class="card-body">
									<h5>Login Administrator</h5>
									<p class="mb-3">Silahkan login dengan akun kamu</p>
									<?= alert(); ?>
									<form action="" method="POST">
										<div class="form-group">
											<label class="text-white">Username</label>
											<input type="text" class="form-control" autocomplete="off" name="username">
										</div>
										<div class="form-group">
											<label class="text-white">Password</label>
											<input type="password" class="form-control" name="password">
										</div>
										<button class="btn btn-primary btn-block" type="submit" name="tombol" value="submit">Login Sekarang</button>
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