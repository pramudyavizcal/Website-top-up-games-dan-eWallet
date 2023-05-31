								<nav class="navbar navbar-expand-lg navbar-dark mb-3" style="background: var(--warna_2);border-radius: 10px;">
								    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-admin" aria-controls="navbar-admin" aria-expanded="false" aria-label="Toggle navigation">
								        <span class="navbar-toggler-icon"></span>
								    </button>
								    <div class="collapse navbar-collapse" id="navbar-admin" style="background: transparent;">
								        <div class="navbar-nav">
								            <a class="nav-item nav-link" href="<?= base_url(); ?>/admin/">Home</a>
								            <?php $per_activea = explode(',', $admin['permission']); foreach(['Konfigurasi', 'Admin', 'Games', 'Kategori', 'Produk', 'Pesanan', 'Topup', 'Metode', 'Pengguna', 'Sosmed'] as $per): ?>
								            <?php if (in_array($per, $per_activea)): ?>
								            <a class="nav-item nav-link" href="<?= base_url(); ?>/admin/<?= strtolower($per); ?>"><?= $per; ?></a>
								            <?php endif; ?>
								            <?php endforeach; ?>
								        </div>
								    </div>
								    <div class="dropdown">
									    <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
									    	<img src="<?= base_url(); ?>/assets/images/profile.png" alt="" width="36">
									    </span>
									    <div class="dropdown-menu mt-2" aria-labelledby="dropdownMenuButton" style="left: auto;right: 0;box-shadow: none !important;background: #1f2a36;">
									        <a class="dropdown-item text-white" href="<?= base_url(); ?>/admin/password">Ganti Password</a>
									        <a class="dropdown-item text-white" href="<?= base_url(); ?>/admin/logout">Logout</a>
									    </div>
									</div>
								</nav>