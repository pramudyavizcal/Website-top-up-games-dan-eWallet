				<?php $this->extend('admin'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				 <!-- Content Row -->
                    <div class="row">

                        <!-- Total Admin Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Admin</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total['admin']; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Total Pesanan Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Pesanan</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total['orders']; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Total Games Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total Games</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total['games']; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-gamepad fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Total Product Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Total Product</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total['product']; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>


                    <div class="row">

                    <!-- Total Admin Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Transaksi Sukses</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_trx_sukses; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Total Admin Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total Transaksi Pending</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_trx_pending; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Total Pesanan Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Total Transaksi Proses</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_trx_proses; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Total Games Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Total Transaksi Batal</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_trx_batal; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    TopUp Terbanyak
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="datatable" class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Username</th>
                                                    <th>Jumlah TopUp</th>
                                                    <th>Method</th>
                                                    <th>Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; foreach($topup_terbanyak as $key => $value) { ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $value['username'] ?></td>
                                                        <td>Rp. <?= number_format($value['amount'], 0,',',',') ?></td>
                                                        <td><?= $value['method'] ?></td>
                                                        <td><?= $value['date_create'] ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
				<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
				<script>
					new Morris.Line({
						element: 'myfirstchart',
						data: [
							<?php foreach ($chart as $loop): ?>
							{ tanggal: '<?= $loop['tanggal']; ?>', total: <?= $loop['total']; ?> },
							<?php endforeach ?>
						],
						xkey: 'tanggal',
						ykeys: ['total'],
						labels: ['Tanggal'],
						// lineColors: ['#fff'],
                        resize: true,
                        parseTime: false
					});
				</script>
				<script type="text/javascript">
					$(function() {
                        $("#datatable").DataTable();
						$('input[name="daterange"]').daterangepicker();
					});
				</script>
				<?php $this->endSection(); ?>