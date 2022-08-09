<body class="" style="background-color: #FAFAD2;">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5 mb-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Pilih Paket Lebaran</h3>
                                    <?= $this->session->flashdata('id_barang[]'); ?>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="<?= base_url('auth/pilih_barang/' . $user->id)  ?>">
                                        <input type="hidden" name="id_user" value="<?= $user->id ?>">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" type="text" placeholder="Username" name="username" value="<?= $user->username ?>" autocomplete="off" readonly>
                                            <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                            <label>Username</label>
                                        </div>
                                        <br>
                                        <label for="">Pilih barang yang ingin diambil pada arisan paket lebaran :</label>
                                        <br>
                                        <?php foreach ($barang as $brg) : ?>
                                            <br>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-check mt-3">
                                                        <input class="form-check-input" type="checkbox" value="<?= $brg->id  ?>" id="id_barang" name="id_barang[]">
                                                        <label class="form-check-label" for="id_barang">
                                                            <img src="<?= base_url('assets/img/barang/') . $brg->gambar ?>" alt="" width="50" height="50">
                                                            <?= $brg->nama_barang ?>
                                                            <br>
                                                            Keterangan : <?= $brg->volume . '  -  Rp.' . number_format($brg->harga)  ?>
                                                        </label>
                                                    </div>

                                                </div>
                                                <div class="col">
                                                    Jumlah
                                                    <div class="form-group mt-3">
                                                        <input type="number" min="1" name="jumlah[]" placeholder="jumlah" class="form-control" value="1">
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <br>
                                        <hr>
                                        Input tabungan yang ingin ditabung perhari :
                                        <div class="form-floating mt-3 mb-3">
                                            <input class="form-control" min="1000" type="number" placeholder="tabungan" name="tabungan" value="<?= set_value('tabungan') ?>" autocomplete="off" />
                                            <?= form_error('tabungan', '<small class="text-danger pl-3">', '</small>'); ?>
                                            <label>Tabungan (Optional)</label>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-success btn-sm btn-user btn-block">
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>