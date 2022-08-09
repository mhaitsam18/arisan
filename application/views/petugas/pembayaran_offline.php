<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4"><?= $title;  ?></h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Input pembayaran peserta disini:</li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="col-lg-8">
                                        <?= $this->session->flashdata('message'); ?>
                                        <form action="<?= base_url('petugas/pembayaran_offline') ?>" method="post" enctype="multipart/form-data">
                                            <div class=" row mb-3">
                                                <label for="id_peserta" class="col-sm-3 col-form-label">Nama Peserta</label>
                                                <div class="col-sm-9">
                                                    <select name="id_peserta" id="id_peserta" class="form-control">
                                                        <option value="">--pilih--</option>
                                                        <?php foreach ($peserta as $p) : ?>
                                                            <option value="<?= $p->id ?>"><?= strtolower($p->nama_lengkap) ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <?= form_error('id_peserta', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class=" row mb-3">
                                                <label for="tanggal" class="col-sm-3 col-form-label">Tanggal Pembayaran</label>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" id="tanggal" autocomplete="off" name="tanggal" min="<?= $tanggal_minimal ?>" max="<?= $tanggal_maksimal ?>">
                                                    <?= form_error('tanggal', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class=" row mb-3">
                                                <label for="nominal" class="col-sm-3 col-form-label">Nominal Pembayaran</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="nominal" autocomplete="off" name="nominal" readonly>
                                                    <?= form_error('nominal', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group row justify-content-end">

                                                <div class="col-sm-9">
                                                    <button type="submit" class="btn btn-success btn-sm btn-user btn-block"">Submit</button>
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
    <script src=" https://code.jquery.com/jquery-3.6.0.min.js" type=""></script>
                                                        <script type="text/javascript">
                                                            const id_peserta = document.querySelector('#id_peserta');
                                                            const nominal = document.querySelector('#nominal');
                                                            const tanggal = document.querySelector('#tanggal');
                                                            id_peserta.addEventListener('change', function() {
                                                                fetch('<?= base_url('Petugas/checkNominal?id_peserta=') ?>' + id_peserta.value)
                                                                    .then(response => response.json())
                                                                    .then(data => [
                                                                        nominal.value = data.nominal,
                                                                        tanggal.min = data.tanggal_minimal,
                                                                        tanggal.value = data.tanggal_minimal
                                                                    ]);
                                                                // .then(data => tanggal.min = data.tanggal);
                                                            });

                                                            tanggal.addEventListener('change', function() {
                                                                fetch('<?= base_url('Petugas/checkNominal?tanggal=') ?>' + tanggal.value + '&id_peserta=' + id_peserta.value)
                                                                    .then(response => response.json())
                                                                    .then(data => nominal.value = data.nominal);
                                                            });
                                                        </script>