<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4"><?= $title;  ?></h2>
            <div class="row">

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Barang
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <?= $this->session->flashdata('message'); ?>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fas fa-plus"></i> Tambah Data Barang
                            </button>
                            <thead>
                                <tr class="table-warning">
                                    <th>#</th>
                                    <th>Foto</th>
                                    <th>Nama Barang</th>
                                    <th>Volume</th>
                                    <th>Harga</th>
                                    <!-- <th>Harga Beli</th> -->
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 0;
                                $jml = 0;
                                foreach ($rows as $row) :
                                    $count = $count + 1;
                                ?>
                                    <tr>
                                        <th scope=" row"><?= $count ?></th>
                                        <td><img src="<?= base_url('assets/img/barang/') . $row->gambar ?>" alt="" width="75" height="75"></td>
                                        <td><?= $row->nama_barang ?></td>
                                        <td><?= $row->volume ?></td>
                                        <td><?= number_format($row->harga, 0, ',', '.') ?></td>
                                        <!-- <td><?= number_format($row->harga_beli, 0, ',', '.') ?></td> -->
                                        <td>
                                            <a href="<?= base_url('penyelenggara/edit_barang/') . $row->id ?>" class="btn btn-warning btn-sm" data-placement="top" title="Edit">Edit</a>
                                            <a href="" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus<?= $row->id; ?>">Hapus</a>

                                        </td>
                                    </tr>
                                <?php $jml += $row->harga_beli;
                                endforeach; ?>
                            <tfoot>
                                <tr>

                                </tr>
                                <!-- </tfoot>
                            <tr>
                                <th colspan="5">Total</th>
                                <th colspan="2">Rp.<?= number_format($jml, 0, ',', '.') ?></th>
                            </tr>
                            </tbody> -->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Insert Data Barang-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('penyelenggara/tambah_barang') ?>" method="post" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <label for="" class="col-sm-12 col-form-label">Gambar Barang</label>
                                <input type="file" class="form-control" id="" name="gambar" required oninvalid="this.setCustomValidity('Masukan Gambar Barang')" oninput="setCustomValidity('')">
                                <small class="text-muted">*gif/jpg/png/jpeg</small>
                                <?= form_error('current_password', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <label for="" class="col-sm-12 col-form-label">Nama Barang</label>
                                <input type="text" class="form-control" id="" name="nama_barang" required oninvalid="this.setCustomValidity('Masukan Nama Barang')" oninput="setCustomValidity('')">
                                <?= form_error('nama_barang', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <label for="" class="col-sm-12 col-form-label">Volume</label>
                                <input type="text" class="form-control" id="" name="volume" required oninvalid="this.setCustomValidity('Masukan Volume')" oninput="setCustomValidity('')">
                                <?= form_error('volume', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <label for="" class="col-sm-12 col-form-label">Harga Per Volume</label>
                                <input type="number" class="form-control" id="nominal" name="harga" required oninvalid="this.setCustomValidity('Masukan Harga Per Volume')" oninput="setCustomValidity('')" onkeyup="validasi()">
                                <small class="text-muted">*minimal Rp.200</small>
                                <!-- <input type="text" id="jumlah" value="0">
                                <input type="text" id="total" value="0"> -->
                                <?= form_error('harga', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <!-- <div class="row mb-3">
                            <div class="col-sm-12">
                                <label for="" class="col-sm-12 col-form-label">Harga Beli</label>
                                <input type="number" class="form-control" id="" name="harga_beli">
                                <?= form_error('harga_beli', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div> -->
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success btn-sm" id="btnSimpan" disabled="true">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal hapus barang-->
    <?php
    $count = 0;
    foreach ($rows as $row) :
        $count = $count + 1;
    ?>
        <div class="modal fade" id="hapus<?= $row->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Yakin akan menghapus data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tidak</button>
                        <a href="<?= base_url('penyelenggara/hapus_barang/') . $row->id ?>" class="btn btn-danger btn-sm">Ya</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <script type="text/javascript">
        function validasi() {
            var nominal = document.getElementById('nominal').value;
            var btnSimpan = document.getElementById('btnSimpan');

            if (nominal >= 200) {
                btnSimpan.removeAttribute('disabled');
            } else {
                btnSimpan.disabled = 'true';
            }
        }
    </script>