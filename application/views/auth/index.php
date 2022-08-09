<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <h3 class="text-center">Selamat Datang di Aplikasi Paket Lebaran SuMas</h3>
                                <h5 class="text-center font-weight-light my-4">Login Sebagai :</h5>
                            </div>
                            <div class="card-body text-center">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <a href="<?= base_url('auth/login_peserta')  ?>" class="btn btn-outline-warning text-dark">Peserta</a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <a href="<?= base_url('auth/login_petugas')  ?>" class="btn btn-outline-warning text-dark">Petugas</a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <a href="<?= base_url('auth')  ?>" class="btn btn-outline-warning text-dark">Penyelenggara</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>