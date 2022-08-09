<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4"><?= $title;  ?></h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"></li>
            </ol>
            <tbody>
                <?php
                $count = 0;
                $jml = 0;
                foreach ($pembayaran_masuk as $row) :
                    $count = $count + 1;
                ?>
                    <tr>

                    </tr>
                <?php $jml += $row->nominal;
                endforeach; ?>
            </tbody>
            <tbody>
                <?php
                $jml_seluruh_iuran = 0;
                $count = 0;
                foreach ($rows as $row) :
                    $count = $count + 1;
                    $this->db->select('SUM(harga) AS harga_total');
                    $this->db->join('barang', 'target_barang.id_barang = barang.id');
                    $barang = $this->db->get_where('target_barang', ['id_user' => $row->id])->row();

                    $tanggal_mulai = date('Y-m-d', strtotime('-1 days', strtotime($penyelenggara->tanggal_mulai)));
                    $mulai = date_create($tanggal_mulai);
                    $selesai = date_create($penyelenggara->tanggal_selesai);
                    $diff = date_diff($mulai, $selesai);
                    $jml_hari = $diff->days;
                    $total_harga_barang = $barang->harga_total * $jml_hari;
                    $total_tabungan = $row->tabungan * $jml_hari;
                    $total_iuran_peserta = $total_harga_barang + $total_tabungan;
                    $sisa = $total_iuran_peserta - $row->total_bayar;
                ?>

                <?php $jml_seluruh_iuran += $total_iuran_peserta;
                endforeach; ?>
            </tbody>
            <tbody>
                <?php
                $count = 0;
                $jml_setoran = 0;
                foreach ($setoran as $row) :
                    $count = $count + 1;
                ?>
                <?php $jml_setoran += $row->nominal;
                endforeach; ?>
            </tbody>

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card border-primary mb-3" style="max-width: 18rem;">
                        <div class="card-body">Jumlah Peserta : <?= $jumlah_peserta ?></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-dark stretched-link" style="text-decoration: none; color:white;" href="<?= base_url('petugas/data_peserta') ?>">View Details</a>
                            <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card border-info mb-3" style="max-width: 18rem;">
                        <div class="card-body">Total Pemasukan Pembayaran Peserta : Rp.<?= number_format($jml, 0, ',', '.') ?></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-dark stretched-link" style="text-decoration: none; color:white;" href="<?= base_url('petugas/pembayaran_peserta_sukses') ?>">View Details</a>
                            <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card border-warning mb-3" style="max-width: 18rem;">
                        <div class="card-body">Total Keseluruhan Dari Peserta : Rp.<?= number_format($jml_seluruh_iuran, 0, ',', '.') ?></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-dark stretched-link" style="text-decoration: none; color:white;" href="<?= base_url('petugas/pembayaran_peserta_sukses') ?>">View Details</a>
                            <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card border-info mb-3" style="max-width: 18rem;">
                        <div class="card-body">Total yang sudah di setorkan : Rp.<?= number_format($jml_setoran, 0, ',', '.') ?></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-dark stretched-link" style="text-decoration: none; color:white;" href="<?= base_url('petugas/pembayaran_peserta_sukses') ?>">View Details</a>
                            <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card border-info mb-3" style="max-width: 18rem;">
                        <div class="card-body">Sisa yang harus di setor : Rp.<?= number_format($jml_seluruh_iuran - $jml_setoran, 0, ',', '.') ?></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-dark stretched-link" style="text-decoration: none; color:white;" href="<?= base_url('petugas/pembayaran_peserta_sukses') ?>">View Details</a>
                            <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>