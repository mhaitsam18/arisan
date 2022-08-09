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
                foreach ($sukses as $row) :
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
                    echo 'halloooo';
                    echo 'halloooo3';
                    echo 'halloooo4';
                    echo 'aku melakukan perubahan';
                endforeach; ?>
            </tbody>
            <h2>Halloo</h2>
            <h2>idham melakukan perbuahan</h2>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card border-info mb-3" style="max-width: 18rem;">
                        <div class="card-body">Jumlah Petugas : <?= $jumlah_petugas ?></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-dark stretched-link" style="text-decoration: none; color:white;" href="<?= base_url('penyelenggara/data_petugas')  ?>">View Details</a>
                            <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card border-danger mb-3" style="max-width: 18rem;">
                        <div class="card-body">Jumlah Peserta : <?= $jumlah_peserta ?></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-dark stretched-link" style="text-decoration: none; color:white;" href="<?= base_url('penyelenggara/data_peserta')  ?>">View Details</a>
                            <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card border-warning mb-3" style="max-width: 18rem;">
                        <div class="card-body">Jumlah Barang : <?= $jumlah_barang ?></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-dark stretched-link" style="text-decoration: none; color:white;" href="<?= base_url('penyelenggara/data_barang')  ?>">View Details</a>
                            <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card border-success mb-3" style="max-width: 18rem;">
                        <div class="card-body">
                            Tanggal Penyelenggaraan
                            <p>
                                Tanggal Mulai: <?= cari_tanggal($user['tanggal_mulai']) ?>
                                <br>
                                Tanggal Selesai: <?= cari_tanggal($user['tanggal_selesai']) ?>
                            </p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-dark stretched-link" style="text-decoration: none; color:white;" href="" data-bs-toggle="modal" data-bs-target="#tanggal">View Details</a>
                            <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card border-warning mb-3" style="max-width: 18rem;">
                        <div class="card-body">Total pemasukan pembayaran petugas : Rp.<?= number_format($jml, 0, ',', '.') ?></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-dark stretched-link" style="text-decoration: none; color:white;" href="<?= base_url('penyelenggara/pembayaran_petugas_sukses')  ?>">View Details</a>
                            <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card border-warning mb-3" style="max-width: 18rem;">
                        <div class="card-body">Total Keseluruhan Dari Petugas : Rp.<?= number_format($jml_seluruh_iuran, 0, ',', '.') ?></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-dark stretched-link" style="text-decoration: none; color:white;" href="<?= base_url('penyelenggara/pembayaran_petugas_sukses')  ?>">View Details</a>
                            <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card border-warning mb-3" style="max-width: 18rem;">
                        <div class="card-body">Sisa yang belum terbayar : Rp.<?= number_format($jml_seluruh_iuran - $jml, 0, ',', '.') ?></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-dark stretched-link" style="text-decoration: none; color:white;" href="<?= base_url('penyelenggara/pembayaran_petugas_sukses')  ?>">View Details</a>
                            <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="tanggal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tanggal Penyelenggaraan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('penyelenggara/edit_tanggal') ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="tanggal_mulai" class="col-sm-4 col-form-label">Tanggal Mulai</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="tanggal_mulai" autocomplete="off" name="tanggal_mulai" value="<?= $user['tanggal_mulai'];  ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tanggal_selesai" class="col-sm-4 col-form-label">Tanggal Selesai</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="tanggal_selesai" autocomplete="off" name="tanggal_selesai" value="<?= $user['tanggal_selesai'];  ?>">
                                <input type="hidden" class="form-control" id="username" autocomplete="off" name="username" value="<?= $user['username'];  ?>">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>