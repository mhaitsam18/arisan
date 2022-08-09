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
                                        <form action="<?= base_url('penyelenggara/pembayaran_offline') ?>" method="post" enctype="multipart/form-data">
                                            <div class=" row mb-3">
                                                <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Petugas</label>
                                                <div class="col-sm-9">
                                                    <select name="nama_lengkap" id="nama_lengkap" class="form-control">
                                                        <option value="">--pilih--</option>
                                                        <?php foreach ($petugas as $p) : ?>
                                                            <option value="<?= $p->nama_lengkap ?>"><?= strtolower($p->nama_lengkap) ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <?= form_error('nama_lengkap', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class=" row mb-3">
                                                <label for="tanggal" class="col-sm-3 col-form-label">Tanggal Pembayaran</label>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control" id="tanggal" autocomplete="off" name="tanggal">
                                                    <?= form_error('tanggal', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class=" row mb-3">
                                                <label for="nominal" class="col-sm-3 col-form-label">Nominal Pembayaran</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="nominal" autocomplete="off" name="nominal" minlength="6" onkeyup="validasi()">
                                                    <?= form_error('nominal', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group row justify-content-end">

                                                <div class="col-sm-9">
                                                    <button type="submit" class="btn btn-success btn-sm" id="btnSimpan" disabled="true">Submit</button>
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

    <script>
        function validasi() {
            var nominal = document.getElementById('nominal').value;
            var btnSimpan = document.getElementById('btnSimpan');

            if (nominal >= 100000) {
                btnSimpan.removeAttribute('disabled');
            } else {
                btnSimpan.disabled = 'true';
            }
        }

        function restrictAlphabets(e) {
            var x = e.which || e.keycode;
            if ((x >= 48 && x <= 57))
                return true;
            else
                return false;
        }
    </script>