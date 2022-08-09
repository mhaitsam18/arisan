<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4"><?= $title;  ?></h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Upload bukti pembayaran setoran:</li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="col-lg-8">
                                        <?= $this->session->flashdata('message'); ?>
                                        <form action="<?= base_url('petugas/pembayaran_bulanan') ?>" method="post" enctype="multipart/form-data">
                                            <div class="row mb-3">
                                                <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama</label>
                                                <div class="col-sm-9">
                                                    <input type="hidden" name="id_petugas" id="" value="<?= $user['id'] ?>">
                                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" readonly value="<?= $user['nama_lengkap']  ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="tanggal" class="col-sm-3 col-form-label">Tanggal Pembayaran</label>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" id="tanggal" autocomplete="off" name="tanggal">
                                                    <?= form_error('tanggal', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="nominal" class="col-sm-3 col-form-label">Nominal Pembayaran</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="nominal" autocomplete="off" name="nominal">
                                                    <?= form_error('nominal', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class=" row mb-3">
                                                <label for="bukti" class="col-sm-3 col-form-label">Bukti Pembayaran</label>
                                                <div class="col-sm-9">
                                                    <input type="file" class="form-control" id="bukti" autocomplete="off" name="bukti">
                                                    <?= form_error('bukti', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group row justify-content-end">

                                                <div class="col-sm-9">
                                                    <button type="submit" class="btn btn-success btn-sm">Submit</button>
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