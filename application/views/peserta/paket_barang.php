<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4"><?= $title;  ?></h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"></li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <table class="table">
                                <?= $this->session->flashdata('message'); ?>
                                <thead>
                                    <tr class="table-warning">
                                        <th>Foto</th>
                                        <th>Nama Barang</th>
                                        <th>Volume</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $tabungan = 0;
                                    $total = 0;
                                    $jml_bayar = 0;
                                    foreach ($rows as $row) :
                                    ?>
                                        <tr>
                                            <td><img src="<?= base_url('assets/img/barang/') . $row->gambar ?>" alt="" width="75" height="75"></td>
                                            <td><?= $row->nama_barang ?></td>
                                            <td><?= $row->volume ?></td>
                                            <td>Rp.<?= number_format($row->harga, 0, ',', '.'); ?></td>
                                            <td><?= $row->jumlah ?></td>
                                            <td>Rp.<?= number_format($row->sub_total, 0, ',', '.'); ?></td>
                                        </tr>
                                    <?php
                                        $tabungan = $row->tabungan;
                                        $total += $row->sub_total;
                                        $jml_bayar = $tabungan + $total;
                                    endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Total Paket Barang</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th colspan="2">Rp.<?= number_format($total, 0, ',', '.'); ?></th>
                                    </tr>
                                    <tr>
                                        <th>Tabungan Per Hari</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>Rp.<?= number_format($tabungan, 0, ',', '.'); ?></th>
                                    </tr>
                                    <tr>
                                        <?php
                                        $tanggal_mulai = date('Y-m-d', strtotime('-1 days', strtotime($penyelenggara->tanggal_mulai)));
                                        $mulai = date_create($tanggal_mulai);
                                        $selesai = date_create($penyelenggara->tanggal_selesai);
                                        $diff = date_diff($mulai, $selesai);
                                        $jml_hari = $diff->days;
                                        ?>
                                        <th>Tabungan yang di dapat</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>Rp.<?= number_format($tabungan * $jml_hari, 0, ',', '.'); ?></th>
                                    </tr>
                                    <tr>
                                        <th>Total Iuran Per Hari</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>Rp.<?= number_format($jml_bayar, 0, ',', '.'); ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>