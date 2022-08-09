<?php
function tgl_indo($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = getBulan(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    return $tanggal . '-' . $bulan . '-' . $tahun;
}
function getBulan($bln)
{
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}
?>

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
                                            <?php $tgl = tgl_indo($row->tanggal) ?>
                                            <td><?= $tgl ?></td>
                                            <td>Rp.<?= number_format($row->nominal, 0, ',', '.'); ?></td>

                                            <td>

                                                <?php if ($row->status_pembayaran == 'sukses') : ?>
                                                    Pembayaran sukses <button class="btn btn-sm btn-success" disabled><i class="fas fa-check"></i></button>
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

                                    // $sisa_tagihan = $harga_barang->total + $harga_barang->tabungan * $jumlah_tanggal->days - $jml;
                                    $sisa_tagihan = ($harga_barang->harga_barang + $harga_barang->tabungan) * $sisa_tanggal->days;
                                    if ($sisa_tanggal->days > 0) {
                                        $bayar_per_hari = $sisa_tagihan / $sisa_tanggal->days;
                                        $bayar_per_hari = $harga_barang->total;
                                        for ($x = 0; $x < $sisa_tanggal->days; $x++) {
                                            $count = $count + 1;
                                            $tanggal = date('Y-m-d', strtotime('+1 days', strtotime($tanggal)));
                                        ?>
                                            <tr>
                                                <th scope="row"><?= $count ?></th>
                                                <?php $tgl2 = tgl_indo($tanggal) ?>
                                                <td><?= $tgl2 ?></td>
                                                <td>Rp.<?= number_format($harga_barang->harga_barang + $harga_barang->tabungan, 0, ',', '.'); ?></td>
                                                <td>
                                                    Belum dibayar
                                                </td>
                                            </tr>
                                    <?php }
                                    } ?>

                                    <!-- <tr>
                                        <td colspan="2">Total</td>
                                        <td colspan="2">Rp.<?= number_format($jml, 0, ',', '.') ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Sisa Tagihan</td>
                                        <td colspan="2">Rp.<?= number_format($harga_barang->total - $jml, 0, ',', '.') ?></td>
                                    </tr> -->

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