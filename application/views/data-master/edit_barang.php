<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4"><?= $title;  ?></h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"></li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="col-lg-8">
                                        <?= $this->session->flashdata('message'); ?>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="row mb-3">
                                                <a href="<?= base_url('penyelenggara/data_barang')  ?>" class="btn btn-secondary btn-sm col-sm-2 col-form-label"><i class="fas fa-angle-left"></i> Kembali</a>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="nama_barang" class="col-sm-3 col-form-label">Nama Barang</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="nama_barang" autocomplete="off" name="nama_barang" value="<?= $data_barang->nama_barang  ?>">
                                                    <?= form_error('nama_barang', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="volume" class="col-sm-3 col-form-label">Volume</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="volume" autocomplete="off" name="volume" value="<?= $data_barang->volume ?>">
                                                    <?= form_error('volume', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="harga" class="col-sm-3 col-form-label">Harga</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="harga" autocomplete="off" name="harga" value="<?= $data_barang->harga  ?>">
                                                    <?= form_error('harga', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">Foto</div>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <img src="<?= base_url('assets/img/barang/') . $data_barang->gambar  ?>" class="img-thumbnail" width="70" height="70">
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row justify-content-end">
                                                <input type="hidden" class="form-control" id="id" autocomplete="off" name="id" value="<?= $data_barang->id  ?>">
                                                <div class="col-sm-9">
                                                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>