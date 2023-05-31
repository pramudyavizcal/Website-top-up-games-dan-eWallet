<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?> - <?= $web['title']; ?></title>
    
    <link rel="shortcut icon" href="<?= base_url(); ?>/assets/images/<?= $web['logo']; ?>">

    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>/public/template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>/public/template/css/sb-admin-2.min.css" rel="stylesheet">
    
    <?php $this->renderSection('css'); ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url(); ?>">
               <div class="sidebar-brand-icon mr-2">
                    <img src="<?= base_url(); ?>/assets/images/<?= $web['logo']; ?>" width="35">
                </div>
                <div class="sidebar-brand-text">Topupinaja</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/admin/home">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            
            <!-- Nav Item - Konfigurasi -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/admin/konfigurasi">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Konfigurasi</span></a>
            </li>

            <!-- Nav Item - Konfigurasi -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/admin/whatsapp">
                    <i class="fas fa-fw fa-comment-dots"></i>
                    <span>Template WhatsApp</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            
            <!-- Heading -->
            <div class="sidebar-heading">
                Management
            </div>

            <!-- Nav Item - Admin -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/admin/mutasi">
                <i class="fas fa-fw fa-money-check-alt"></i>
                    <span>Kelola Mutasi Bank</span></a>
            </li> -->
            
            <!-- Nav Item - Admin -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/admin/admin">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Kelola Admin</span></a>
            </li>
            

            <!-- Nav Item - Member -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/admin/level">
                    <i class="fas fa-duotone fa-layer-group"></i>
                    <span>Kelola Level Member</span></a>
            </li>
            
            <!-- Nav Item - Member -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/admin/pengguna">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Kelola Member</span></a>
            </li>
            
            <!-- Nav Item - Games -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/admin/games">
                    <i class="fas fa-fw fa-gamepad"></i>
                    <span>Kelola Games</span></a>
            </li>

             <!-- Nav Item - Games -->
             <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/admin/gamepopuler">
                    <i class="fas fa-fw fa-fire"></i>
                    <span>Kelola Games Populer</span></a>
            </li>
            
            <!-- Nav Item - Kategori -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/admin/kategori">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Kelola Kategori</span></a>
            </li>
            
            <!-- Nav Item - Produk -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/admin/produk">
                    <i class="fas fa-fw fa-cart-plus"></i>
                    <span>Kelola Produk</span></a>
            </li>

            <!-- Nav Item -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/admin/level-upgrade">
                    <i class="fas fa-fw fa-upload"></i>
                    <span>Kelola Upgrade Level</span></a>
            </li>
            
            <!-- Nav Item - Pesanan -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/admin/pesanan">
                    <i class="fas fa-fw fa-download"></i>
                    <span>Kelola Pesanan</span></a>
            </li>
            
            <!-- Nav Item - Deposit -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/admin/topup">
                    <i class="fas fa-fw fa-university"></i>
                    <span>Kelola Deposit</span></a>
            </li>
            
            <!-- Nav Item - Metode -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/admin/metode">
                    <i class="fas fa-fw fa-money-check"></i>
                    <span>Kelola Metode</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Konten
            </div>

            <!-- Nav Item - Bantuan -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>/admin/sosmed">
                    <i class="fas fa-fw fa-headphones"></i>
                    <span>Bantuan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><b>Hallo, </b>Admin</span>
                                <img class="img-profile rounded-circle"
                                    src="/public/template/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url(); ?>/admin/password">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Ubah Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url(); ?>/admin/logout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Keluar
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <?php $this->renderSection('content'); ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>&copy; <a href="https://topupinaja.com">Topupinaja</a></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(); ?>/public/template/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/public/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>/public/template/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>/public/template/js/sb-admin-2.min.js"></script>
    
    <!-- Custom scripts -->
        <!--<script src="<?= base_url(); ?>/assets/js/app-script.js"></script>-->
        <script src="<?= base_url(); ?>/assets/plugins/summernote/dist/summernote-bs4.min.js"></script>
        <!--Select Plugins Js-->
        <script src="<?= base_url(); ?>/assets/plugins/select2/js/select2.min.js"></script>
        <!--Data Tables js-->
        <script src="<?= base_url(); ?>/assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url(); ?>/assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
        
        <script>
      $('#summernote').summernote({
        placeholder: 'Hello Bootstrap 5',
        tabsize: 2,
        height: 100
      });
    </script>
        <script>
            $('#datatable').DataTable();
            // $(document).ready(function() {
            //     $('#default-datatable').DataTable();
            // });

            function openNav() {
                document.getElementById("mySidenav").style.width = "300px";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
            }
        </script>
        <script>
            <?php if ($admin !== false): ?>
            function hapus(link) {
                Swal.fire({
                    title: 'Anda yakin?',
                    text: "Data akan dihapus permanen",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tetap hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link;
                    }
                });
            }
            <?php endif; ?>

        </script>
        <script>
            $("#customFile").on("change", function() {
						var fileName = $(this).val().split("\\").pop();
						$(this).siblings("label[for=customFile]").addClass("selected").html(fileName);
					});

					$("#customFile-banner").on("change", function() {
						var fileName = $(this).val().split("\\").pop();
						$(this).siblings("label[for=customFile-banner]").addClass("selected").html(fileName);
					});
        </script>
        
        <?php $this->renderSection('js'); ?>

</body>

</html>