<body class="" style="background-color: #FAFAD2;">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5 mb-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Create Account</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="<?= base_url('auth/registrasi_peserta')  ?>">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" type="text" placeholder="Nama Lengkap" name="nama_lengkap" value="<?= set_value('nama_lengkap') ?>" autocomplete="off" />
                                            <?= form_error('nama_lengkap', '<small class="text-danger pl-3">', '</small>'); ?>
                                            <label>Nama Lengkap</label>
                                        </div>
                                        <label for="">Pilih Barang</label>
                                        <?php foreach ($barang as $brg) : ?>
                                            <div class="form-check mt-3">
                                                <input class="form-check-input" type="checkbox" value="<?= $brg->id  ?>" id="flexCheckDefault" name="id_barang[]">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    <?= $brg->nama_barang . ' -  Rp.' . number_format($brg->harga)  ?>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                        <div class="form-floating mt-3 mb-3">
                                            <input class="form-control" type="number" placeholder="tabungan" name="tabungan" value="<?= set_value('tabungan') ?>" autocomplete="off" />
                                            <?= form_error('tabungan', '<small class="text-danger pl-3">', '</small>'); ?>
                                            <label>Tabungan</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" type="text" placeholder="Username" name="username" value="<?= set_value('username') ?>" autocomplete="off" />
                                            <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                            <label>Username</label>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" type="password" placeholder="Password" name="password1" />
                                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    <label>Password</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" type="password" placeholder="Confirm Password" name="password2" />
                                                    <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    <label>Confirm Password</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid">
                                                <!-- <a href="<?= base_url('peserta/pilih_barang') ?>" class="btn btn-primary btn-user btn-block">Selanjutnya</a> -->
                                                <button type="submit" class="btn btn-outline-warning text-dark">
                                                    Registrasi Akun
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="<?= base_url('auth/login_peserta')  ?>">Have an account? Go to login</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>