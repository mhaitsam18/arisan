<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4"><?= $title;  ?></h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Paket Barang</li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-user me-1"></i>
                            Nama Peserta : <?= $rows->nama_lengkap  ?>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <?= $this->session->flashdata('message'); ?>
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Volume</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $jml = 0;
                                    foreach ($data_barang as $brg) : ?>
                                        <tr>
                                            <td><img src="<?= base_url('assets/img/barang/') . $brg->gambar ?>" alt="" width="50" height="50"></td>
                                            <td><?= $brg->volume ?></td>
                                            <td>Rp.<?= $brg->harga ?></td>
                                        </tr>
                                    <?php
                                        $jml += $rows->harga;
                                    endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Total Harga</th>
                                        <th></th>
                                        <th colspan="2">Rp.<?= $jml  ?></th>
                                    </tr>
                                    <tr>
                                        <th>Tabungan</th>
                                        <th></th>
                                        <th>Rp.<?= $rows->tabungan ?></th>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Bayar</th>
                                        <th></th>
                                        <?php $jml_bayar = 0;
                                        $jml_bayar = $jml + $rows->tabungan; ?>
                                        <th>Rp.<?= $jml_bayar ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>