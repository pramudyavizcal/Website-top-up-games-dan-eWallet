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
			                    <h5>Upgrade Level</h5>
			                    <span class="strip-primary"></span>
			                </div>

			                <?= alert(); ?>

			                <div class="pb-3">
		                    	<div class="row">
	                        		<div class="col-md-12">
										<div class="card">
											<div class="card-body">
												<h6>Level Sekarang</h6>
												<h4 class="m-0"><?= $current_level ?></h4>
											</div>
										</div>
									</div>
	                        	</div>
			                    <div class="section mb-4">
			                        <div class="card-body">
										<form method="post" action="<?= base_url('user/level/upgrade') ?>">
											<h6>Pilih Jenis Member :</h6>
											<div class="row">
											<?php $no = 1; 
												foreach ($level_list as $key => $value) { ?>
												<div class="col-md-6">
													<div class="card">
														<div class="card-body shadow" style="background-color : #ff9800; border-radius : 5px;">
															<div class="row">
																<div class="col-10">
																	<p>Upgrade Ke <?= $value['level_name'] ?></p>
																	<h4 class="m-0">Rp. <?= number_format($value['price'],0,',','.') ?></h4>
																</div>
																<div class="col-2">
																	<input type="radio" name="level_id" value="<?= $value['id'] ?>" class="form-check-input form-control mt-2" require>
																</div>
															</div>
														</div>
													</div>
												</div>
											<?php } ?>
											</div>
											
											<h6>Pilih Metode Pembayaran :</h6>
											<!-- <div class="row">
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
			                        		</div> -->

											<div id="main">
												<div class="container">
													<div class="accordion" id="faq">
														
														<!-- <div class="card">
															<div class="card-header" id="faqhead1">
																<a href="#" class="btn btn-header-link pt-4" data-toggle="collapse" data-target="#faq1" aria-expanded="true" aria-controls="faq1">
																	Saldo
																</a>
															</div>
															<div id="faq1" class="collapse show" aria-labelledby="faqhead1" data-parent="#faq">
																<div class="card-body">
																	<div class="row pt-4 pr-2 mb-2">

																		<?php // if ($pay_balance === 'Y'): ?>
																		<div class="col-sm-12 col-12">
																			<input class="radio-nominal p-2 border rounded mb-3 method-list" type="radio" name="method" value="balance" id="method-balance">
																			<label for="method-balance">
																				<div class="row">
																					<div class="col-6">
																						<div class="ml-2 mr-2 pb-0">
																							<img src="<?= base_url(); ?>/assets/images/method/balance.png" class="rounded img-fluid mb-1" style="height: 40px;">
																							<p class="m-0" style="font-weight: normal;">Saldo Akun</p>
																						</div>
																					</div>
																					<div class="col-6">
																						<div class="ml-2 mt-2 text-right">
																							<p class="mb-0" style="font-weight: bold; font-size: 13px;" id="price-method-balance"></p>
																						</div>
																					</div>
																				</div>
																			</label>
																		</div>
																		<?php // endif ?>
																	</div>
																</div>
															</div>
														</div> -->

														<div class="card">
															<div class="card-header" id="faqhead2">
																<a href="#" class="btn btn-header-link pt-4 collapsed" data-toggle="collapse" data-target="#faq2"
																	aria-expanded="true" aria-controls="faq2">E-Wallet</a>
															</div>
															<div id="faq2" class="collapse" aria-labelledby="faqhead2" data-parent="#faq">
																<div class="card-body">
																	<div class="row pt-4 pr-2 mb-2">
																		<?php foreach ($method as $loop): ?>
																		<?php if($loop['category'] == 'E-Wallet') { ?>
																		<div class="col-sm-12 col-12">
																			<input class="radio-nominal" type="radio" name="method" value="<?= $loop['id']; ?>" id="method-<?= $loop['id']; ?>">
																			<label for="method-<?= $loop['id']; ?>">
																				<div class="row">
																					<div class="col-6">
																						<div class="ml-2 mr-2 pb-0">
																							<img src="<?= base_url(); ?>/assets/images/method/<?= $loop['image']; ?>" class="rounded img-fluid mb-1" style="height: 40px;">
																							<p class="m-0" style="font-weight: normal;"><?= $loop['method']; ?></p>
																						</div>
																					</div>
																					<div class="col-6">
																						<div class="ml-2 mt-2 text-right">
																							<p class="mb-0" style="font-weight: bold; font-size: 13px;" id="price-method-<?= $loop['id']; ?>"></p>
																						</div>
																					</div>
																				</div>
																			</label>
																		</div>
																		<?php } ?>
																		<?php endforeach ?>
																	</div>
																</div>
															</div>
														</div>

														<!--<div class="card">-->
														<!--	<div class="card-header" id="faqhead3">-->
														<!--		<a href="#" class="btn btn-header-link pt-4 collapsed" data-toggle="collapse" data-target="#faq3"-->
														<!--			aria-expanded="true" aria-controls="faq3">Bank Transfer</a>-->
														<!--	</div>-->
														<!--	<div id="faq3" class="collapse" aria-labelledby="faqhead3" data-parent="#faq">-->
														<!--		<div class="card-body">-->
														<!--		<?php foreach ($method as $loop): ?>-->
														<!--			<?php if($loop['category'] == 'Bank Transfer') { ?>-->
														<!--			<div class="col-sm-12 col-12">-->
														<!--				<input class="radio-nominal" type="radio" name="method" value="<?= $loop['id']; ?>" id="method-<?= $loop['id']; ?>">-->
														<!--				<label for="method-<?= $loop['id']; ?>">-->
														<!--					<div class="row">-->
														<!--						<div class="col-6">-->
														<!--							<div class="ml-2 mr-2 pb-0">-->
														<!--								<img src="<?= base_url(); ?>/assets/images/method/<?= $loop['image']; ?>" class="rounded img-fluid mb-1" style="height: 40px;">-->
														<!--								<p class="m-0" style="font-weight: normal;"><?= $loop['method']; ?></p>-->
														<!--							</div>-->
														<!--						</div>-->
														<!--						<div class="col-6">-->
														<!--							<div class="ml-2 mt-2 text-right">-->
														<!--								<p class="mb-0" style="font-weight: bold; font-size: 13px;" id="price-method-<?= $loop['id']; ?>"></p>-->
														<!--							</div>-->
														<!--						</div>-->
														<!--					</div>-->
														<!--				</label>-->
														<!--			</div>-->
														<!--			<?php } ?>-->
														<!--			<?php endforeach ?>-->
														<!--		</div>-->
														<!--	</div>-->
														<!--</div>-->
														
														<!--<div class="card">-->
														<!--	<div class="card-header" id="faqhead4">-->
														<!--		<a href="#" class="btn btn-header-link pt-4 collapsed" data-toggle="collapse" data-target="#faq4"-->
														<!--			aria-expanded="true" aria-controls="faq4">Virtual Account</a>-->
														<!--	</div>-->
														<!--	<div id="faq4" class="collapse" aria-labelledby="faqhead4" data-parent="#faq">-->
														<!--		<div class="card-body">-->
														<!--		<?php foreach ($method as $loop): ?>-->
														<!--			<?php if($loop['category'] == 'Virtual Account') { ?>-->
														<!--			<div class="col-sm-12 col-12">-->
														<!--				<input class="radio-nominal" type="radio" name="method" value="<?= $loop['id']; ?>" id="method-<?= $loop['id']; ?>">-->
														<!--				<label for="method-<?= $loop['id']; ?>">-->
														<!--					<div class="row">-->
														<!--						<div class="col-6">-->
														<!--							<div class="ml-2 mr-2 pb-0">-->
														<!--								<img src="<?= base_url(); ?>/assets/images/method/<?= $loop['image']; ?>" class="rounded img-fluid mb-1" style="height: 40px;">-->
														<!--								<p class="m-0" style="font-weight: normal;"><?= $loop['method']; ?></p>-->
														<!--							</div>-->
														<!--						</div>-->
														<!--						<div class="col-6">-->
														<!--							<div class="ml-2 mt-2 text-right">-->
														<!--								<p class="mb-0" style="font-weight: bold; font-size: 13px;" id="price-method-<?= $loop['id']; ?>"></p>-->
														<!--							</div>-->
														<!--						</div>-->
														<!--					</div>-->
														<!--				</label>-->
														<!--			</div>-->
														<!--			<?php } ?>-->
														<!--			<?php endforeach ?>-->
														<!--		</div>-->
														<!--	</div>-->
														<!--</div>-->

														<div class="card">
															<div class="card-header" id="faqhead5">
																<a href="#" class="btn btn-header-link pt-4 collapsed" data-toggle="collapse" data-target="#faq5"
																	aria-expanded="true" aria-controls="faq5">Convenience Store</a>
															</div>
															<div id="faq5" class="collapse" aria-labelledby="faqhead5" data-parent="#faq">
																<div class="card-body">
																<?php foreach ($method as $loop): ?>
																	<?php if($loop['category'] == 'Convenience Store') { ?>
																	<div class="col-sm-12 col-12">
																		<input class="radio-nominal" type="radio" name="method" value="<?= $loop['id']; ?>" id="method-<?= $loop['id']; ?>">
																		<label for="method-<?= $loop['id']; ?>">
																			<div class="row">
																				<div class="col-6">
																					<div class="ml-2 mr-2 pb-0">
																						<img src="<?= base_url(); ?>/assets/images/method/<?= $loop['image']; ?>" class="rounded img-fluid mb-1" style="height: 40px;">
																						<p class="m-0" style="font-weight: normal;"><?= $loop['method']; ?></p>
																					</div>
																				</div>
																				<div class="col-6">
																					<div class="ml-2 mt-2 text-right">
																						<p class="mb-0" style="font-weight: bold; font-size: 13px;" id="price-method-<?= $loop['id']; ?>"></p>
																					</div>
																				</div>
																			</div>
																		</label>
																	</div>
																	<?php } ?>
																	<?php endforeach ?>
																</div>
															</div>
														</div>
														
													</div>
												</div>
											</div>

											<div class="input-group mt-2">
												<button class="btn btn-block text-white" style="background-color : #ff9800; border-radius : 5px;">Upgrade</button>
											</div>
										</form>
			                        </div>
			                    </div>

								<div class="section">
			                        <div class="card-body">
										<div class="row">
											<h5>Riwayat Upgrade Level</h5>
											<table class="table text-white">
												<thead>
													<tr>
														<th>No</th>
														<th>Nama Level</th>
														<th>Harga</th>
														<th>Status</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php $no = 1; 
														foreach ($histori_list as $key => $value) { ?>
															<tr>
																<td><?= $no++ ?></td>
																<td><?= $value['level_name'] ?></td>
																<td>Rp. <?= number_format($value['price'] ,0,',','.')  ?></td>
																<td><?= $value['status'] ?></td>
																<td>
																	<a href="<?= base_url('user/level/upgrade-detail/' . $value['id']) ?>">Detail</a>
																</td>
															</tr>
														<?php }
													?>
												</tbody>
											</table>
										</div>
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