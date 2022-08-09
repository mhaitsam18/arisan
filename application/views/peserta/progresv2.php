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
                            <?= $this->session->flashdata('message'); ?>
                            <h5>Arisan Periode <?= cari_tanggal($penyelenggara->tanggal_mulai) . '<b> s/d </b>' . cari_tanggal($penyelenggara->tanggal_selesai) ?></h5>
                            <table class="table table-bordered" id="dataTable">
                                <thead>
                                    <tr class="table-warning">
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    $jml = 0;
                                    $tanggal_mulai = date('Y-m-d', strtotime('-1 days', strtotime($penyelenggara->tanggal_mulai)));
                                    $tanggal = $tanggal_mulai;
                                    foreach ($rows as $row) : $count = $count + 1; ?>
                                        <tr>
                                            <th scope="row"><?= $count ?></th>
                                            <td><?= $row->tanggal ?></td>
                                            <td><?= number_format($row->nominal, 0, ',', '.'); ?></td>
                                            <td>
                                                <?php if ($row->status_pembayaran == 'sukses') : ?>
                                                    <button class="btn btn-sm btn-success" disabled><i class="fas fa-check"></i></button>
                                                <?php else : ?>
                                                    Menunggu Konfirmasi
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $jml += $row->nominal;
                                        $tanggal = $row->tanggal;
                                    endforeach;
                                    $sisa_tanggal = date_diff(date_create($tanggal), date_create($penyelenggara->tanggal_selesai));
                                    $jumlah_tanggal = date_diff(date_create($tanggal_mulai), date_create($penyelenggara->tanggal_selesai));

                                    $sisa_tagihan = $harga_barang->total + $harga_barang->tabungan * $jumlah_tanggal->days - $jml;
                                    if ($sisa_tanggal->days > 0) {
                                        $bayar_per_hari = $sisa_tagihan / $sisa_tanggal->days;
                                        $bayar_per_hari = $harga_barang->total;
                                        for ($x = 0; $x < $sisa_tanggal->days; $x++) {
                                            $count = $count + 1;
                                            $tanggal = date('Y-m-d', strtotime('+1 days', strtotime($tanggal)));
                                        ?>
                                            <tr>
                                                <th scope="row"><?= $count ?></th>
                                                <td><?= $tanggal ?></td>
                                                <td><?= number_format($harga_barang->harga_barang, 0, ',', '.'); ?></td>
                                                <td>
                                                    Belum dibayar
                                                </td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">Total Terbayar</td>
                                        <td colspan="2">Rp.<?= number_format($jml, 0, ',', '.') ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Sisa Tagihan</td>
                                        <td colspan="2">Rp.<?= number_format($sisa_tagihan, 0, ',', '.') ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>