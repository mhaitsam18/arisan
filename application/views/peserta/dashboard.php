<?php date_default_timezone_set('Asia/Jakarta'); ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4">Selamat Datang <?= $user['nama_lengkap'] ?></h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Berhasil login pada tanggal <b> <?= date("d M Y") ?> </b> jam <b> <?= date("H:i:s") ?> </b></li>
            </ol>
            <tbody>
                <?php
                $tabungan = 0;
                $total = 0;
                $jml_bayar = 0;
                foreach ($rows as $row) :
                ?>
                <?php
                    $tabungan = $row->tabungan;
                    $total += $row->sub_total;
                    $jml_bayar = $tabungan + $total;
                endforeach; ?>
            </tbody>
            <tbody>
                <?php
                $count = 0;
                $jml = 0;
                $tanggal_mulai = date('Y-m-d', strtotime('-1 days', strtotime($penyelenggara->tanggal_mulai)));
                $tanggal = $tanggal_mulai;
                foreach ($pembayaran as $row) : $count = $count + 1; ?>

                    <?php
                    $jml += $row->nominal;
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
                <?php }
                } ?>
            </tbody>

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card border-success mb-3" style="max-width: 18rem;">
                        <?php
                        $tanggal_mulai = date('Y-m-d', strtotime('-1 days', strtotime($penyelenggara->tanggal_mulai)));
                        $mulai = date_create($tanggal_mulai);
                        $selesai = date_create($penyelenggara->tanggal_selesai);
                        $diff = date_diff($mulai, $selesai);
                        $jml_hari = $diff->days;
                        ?>
                        <div class="card-body">Total Iuran : <br> Rp.<?= number_format($jml_bayar * $jml_hari, 0, ',', '.') ?></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-dark stretched-link" style="text-decoration: none; color:white;" href="<?= base_url('peserta/paket_barang')  ?>">Lihat Detail</a>
                            <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card border-info mb-3" style="max-width: 18rem;">
                        <div class="card-body">Iuran Perhari : <br> Rp.<?= number_format($jml_bayar, 0, ',', '.'); ?></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-dark stretched-link" style="text-decoration: none; color:white;" href="<?= base_url('peserta/paket_barang')  ?>">Lihat Detail</a>
                            <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card border-info mb-3" style="max-width: 18rem;">
                        <div class="card-body">Tabungan : <br> Rp.<?= number_format($tabungan, 0, ',', '.'); ?></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-dark stretched-link" style="text-decoration: none; color:white;" href="<?= base_url('peserta/paket_barang')  ?>">Lihat Detail</a>
                            <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card border-warning mb-3" style="max-width: 18rem;">
                        <div class="card-body">Total yang sudah terbayar : <br> Rp.<?= number_format($jml, 0, ',', '.') ?></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-dark stretched-link" style="text-decoration: none; color:white;" href="<?= base_url('peserta/progres')  ?>">Lihat Detail</a>
                            <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card border-danger mb-3" style="max-width: 18rem;">
                        <?php
                        $jumlah_iuran =  $jml_bayar * $jml_hari;
                        $jumlah_terbayar = $jml;
                        $sisa = $jumlah_iuran - $jumlah_terbayar;
                        ?>
                        <div class="card-body">Sisa Iuran yang harus dibayar : <br> Rp.<?= number_format($sisa, 0, ',', '.') ?></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-dark stretched-link" style="text-decoration: none; color:white;" href="<?= base_url('peserta/progres')  ?>">Lihat Detail</a>
                            <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card border-info mb-3" style="max-width: 18rem;">
                        <?php
                        $tanggal_mulai = date('Y-m-d', strtotime('-1 days', strtotime($penyelenggara->tanggal_mulai)));
                        $mulai = date_create($tanggal_mulai);
                        $selesai = date_create($penyelenggara->tanggal_selesai);
                        $diff = date_diff($mulai, $selesai);
                        $jml_hari = $diff->days;
                        ?>
                        <div class="card-body">Total tabungan yang didapat : <br> Rp.<?= number_format($tabungan * $jml_hari, 0, ',', '.') ?></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-dark stretched-link" style="text-decoration: none; color:white;" href="<?= base_url('peserta/progres')  ?>">Lihat Detail</a>
                            <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            Paket barang yang diambil :
                            <table class="table">
                                <tbody>
                                    <?php
                                    $tabungan = 0;
                                    $total = 0;
                                    $jml_bayar = 0;
                                    foreach ($rows as $row) :
                                    ?>
                                        <tr>
                                            <td><img src="<?= base_url('assets/img/barang/') . $row->gambar ?>" alt="" class="rounded mx-auto d-block" width="500" height="300"></td>


                                        </tr>
                                    <?php
                                        $tabungan = $row->tabungan;
                                        $total += $row->sub_total;
                                        $jml_bayar = $tabungan + $total;
                                    endforeach; ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </main>