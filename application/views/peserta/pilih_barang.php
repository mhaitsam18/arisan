<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Create Account</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="<?= base_url('auth/registrasi_peserta')  ?>">
                                        <label for="">Pilih Barang</label>
                                        <?php foreach ($barang as $brg) : ?>
                                            <div class="form-check mt-3">
                                                <input class="form-check-input" type="checkbox" value="<?= $brg->id ?>" id="flexCheckDefault" name="barang">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    <?= $brg->nama_barang . ' - ' . $brg->harga  ?>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                        <div class="form-floating mt-3">
                                            <input class="form-control" type="number" placeholder="Username" name="tabungan" value="<?= set_value('username') ?>" autocomplete="off" />
                                            <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                            <label>Tabungan</label>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid">
                                                <a href="<?= base_url('peserta/pilih_barang') ?>" class="btn btn-primary btn-user btn-block">Selanjutnya</a>
                                                <!-- <button type="submit" class="btn btn-primary btn-user btn-block">
                                                    Registrasi Akun
                                                </button> -->
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