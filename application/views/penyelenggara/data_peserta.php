<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4"><?= $title;  ?></h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"></li>
            </ol>
            <div class="row">

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Peserta
                    </div>
                    <div class="card-body">
                        <?= $this->session->flashdata('message'); ?>
                        <table id="datatablesSimple">
                            <thead>
                                <tr class="table-warning">
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No HP</th>
                                    <th>Nama Petugas</th>
                                    <th>Status Akun</th>
                                    <th>Status Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 0;
                                foreach ($rows as $row) :
                                    $count = $count + 1;

                                    $this->db->select('SUM(harga) AS harga_total');
                                    $this->db->join('barang', 'target_barang.id_barang = barang.id');
                                    $barang = $this->db->get_where('target_barang', ['id_user' => $row->id])->row();
                                    $jml_barang = $this->db->get_where('target_barang', ['id_user' => $row->id])->num_rows();

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

                                    <tr class="table-light">
                                        <th scope=" row"><?= $count ?></th>
                                        <td><?= $row->nama_lengkap ?></td>
                                        <td><?= $row->alamat ?></td>
                                        <td><?= $row->no_hp ?></td>
                                        <td><?= $row->nama_petugas ?></td>
                                        <td><?= $row->status  ?></td>
                                        <td>
                                            <?php if ($jml_barang > 0) : ?>
                                                <?php if ($sisa <= 0) : ?>
                                                    Sudah Lunas (
                                                <?php else : ?>
                                                    Belum Lunas (Rp.
                                                <?php endif ?>
                                                <?= number_format($sisa, 0, ',', '.') ?>
                                                )
                                            <?php else : ?>
                                                Belum memilih barang
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('penyelenggara/data_barang_peserta/' . $row->id) ?>" class="btn btn-info btn-sm">Lihat Barang</a>
                                            <a href="<?= base_url('penyelenggara/progres_peserta/' . $row->id) ?>" class="btn btn-success btn-sm">Lihat Progres</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>