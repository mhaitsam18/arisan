<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="col-lg-8">
                <form action="<?= base_url('laporan/cetak') ?>" method="post" target="_blank">

                    <div class="row mb-3">
                        <label for="tgl_awal" class="col-sm-3 col-form-label">Tanggal Awal</label>
                        <div class="col-sm-9">
                            <input type="date" name="tgl_awal" id="tgl_awal" class="form-control">
                            <?= form_error('tgl_awal', '<span class=text-danger small pl-3>', '</span>') ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tgl_akhir" class="col-sm-3 col-form-label">Tanggal Akhir</label>
                        <div class="col-sm-9">
                            <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control">
                            <?= form_error('tgl_akhir', '<span class=text-danger small pl-3>', '</span>') ?>
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary btn-sm mt-4" style="margin-top: 5px;"><i class="fas fa-print"> | <i class="fas fa-file-pdf"></i></i> Cetak</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->