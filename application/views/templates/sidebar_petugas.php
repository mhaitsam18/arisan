<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color: #ffea66;">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3 text-dark" href="<?= base_url('petugas') ?>"><img src="<?= base_url('assets/img/logo/logo.png') ?>" alt="" width="55" height="30"> Paket Lebaran</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 text-dark" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <label for="" class="text-dark"><?= $user['nama_lengkap']; ?> (Petugas)</label>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-dark" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="<?= base_url('assets/img/profile/') . $user['image'];  ?>" alt="" class="img-fluid rounded-circle" style="width: 30px; height: 30px;"></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?= base_url('petugas/profile')  ?>">Profil</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('petugas/settings')  ?>">Pengaturan</a></li>

                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#logout">Keluar</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link text-dark" href="<?= base_url('petugas')  ?>">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link text-dark" href="<?= base_url('petugas/data_peserta')  ?>">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-users"></i></div>
                            Data Peserta
                        </a>
                        <a class="nav-link text-dark" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-money-bill-wave"></i></div>
                            Pembayaran Peserta
                            <div class="sb-sidenav-collapse-arrow text-dark"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link text-dark" href="<?= base_url('petugas/pembayaran_peserta')  ?>">Proses</a>
                                <a class="nav-link text-dark" href="<?= base_url('petugas/pembayaran_peserta_sukses')  ?>">Sukses</a>
                                <a class="nav-link text-dark" href="<?= base_url('petugas/pembayaran_peserta_batal')  ?>">Batal</a>
                            </nav>
                        </div>
                        <a class="nav-link text-dark" href="<?= base_url('petugas/pembayaran_offline')  ?>">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-pen"></i></div>
                            Input Pembayaran Peserta
                        </a>
                        <!-- <a class="nav-link text-dark" href="<?= base_url('petugas/pembayaran_bulanan')  ?>">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-solid fa-upload"></i></div>
                            Upload Setoran
                        </a> -->
                        <!-- <a class="nav-link text-dark" href="">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-book-open"></i></div>
                            Laporan Setoran
                        </a> -->
                        <a class="nav-link text-dark" href="#" data-bs-toggle="collapse" data-bs-target="#laporan" aria-expanded="false" aria-controls="laporan">
                            <div class="sb-nav-link-icon text-dark"><i class="fas fa-book-open"></i></div>
                            Laporan Setoran
                            <div class="sb-sidenav-collapse-arrow text-dark"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="laporan" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link text-dark" href="<?= base_url('petugas/laporan_setoran') ?>">Setoran</a>
                                <a class="nav-link text-dark" href="<?= base_url('petugas/laporan_setoran_batal') ?>">Ditolak</a>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?= $user['nama_lengkap'];  ?>
                </div>
            </nav>
        </div>

        <!-- modal logout  -->
        <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Keluar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Yakin akan keluar?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tidak</button>
                        <a href="<?= base_url('auth/utama') ?>" class="btn btn-danger btn-sm">Ya</a>
                    </div>
                </div>
            </div>
        </div>