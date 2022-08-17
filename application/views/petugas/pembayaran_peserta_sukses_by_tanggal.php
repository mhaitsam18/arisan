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
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        <?php $tgl_a = Tgl_indo($tgl_awal);
                        $tgl_b = Tgl_indo($tgl_akhir); ?>
                        Data Pembayaran Peserta Periode <?= $tgl_a; ?> sampai <?= $tgl_b ?>
                    </div>
                    <div class="card-body">
                        <?= $this->session->flashdata('message'); ?>
                        <form action="<?= base_url('petugas/pembayaran_peserta_sukses_by_tanggal') ?>" method="POST" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="" class="form-label">Tanggal Awal</label>
                                    <input type="date" name="tgl_awal" id="" class="form-control" min="<?= $penyelenggara->tanggal_mulai; ?>" max="<?= $penyelenggara->tanggal_selesai; ?>" value="<?= set_value('tgl_awal') ?>" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="form-label">Tanggal Akhir</label>
                                    <input type="date" name="tgl_akhir" id="" class="form-control" min="<?= $penyelenggara->tanggal_mulai; ?>" max="<?= $penyelenggara->tanggal_selesai; ?>" value="<?= set_value('tgl_akhir') ?>" required>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-success btn-sm" style="margin-top: 32px;">Sort</button>
                                    <a href="<?= base_url('petugas/pembayaran_peserta_sukses') ?>" class="btn btn-secondary btn-sm" style="margin-top: 32px;">Reset</a>
                                    <?php if (!empty($rows)) : ?>
                                        <a href="" class="btn btn-success btn-sm" style="margin-top: 32px;" data-bs-toggle="modal" data-bs-target="#bayar">Bayar</a>
                                    <?php else : ?>
                                        <button class="btn btn-success btn-sm" style="margin-top: 32px;" data-bs-toggle="modal" data-bs-target="#bayar" disabled="true">Bayar</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </form>
                        <table id=" datatablesSimple">
                            <thead>
                                <tr class="table-warning">
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Nominal</th>
                                    <th>Bukti</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $id_petugas = $user['id'];
                                // $tgl = $this->db->query("SELECT MAX(tanggal_akhir_periode) as tgl_max FROM pembayaran_bulanan WHERE id_petugas = $id_petugas")->row();
                                $tgl = $tgl_max->tgl_max;
                                $data = $this->db->query(
                                    "SELECT tanggal, pembayaran.nama_lengkap AS nama_peserta, pembayaran.nominal AS nominal_peserta, pembayaran.bukti AS bukti_peserta, pembayaran.status AS status_peserta, pembayaran.id AS id_pembayaran FROM pembayaran 
                                JOIN user ON user.id = pembayaran.id_user 
                                JOIN pembayaran_bulanan ON user.id_petugas = pembayaran_bulanan.id_petugas 
                                AND pembayaran.status = 'sukses' 
                                WHERE user.id_petugas = $id_petugas 
                                AND pembayaran.tanggal >= '$tgl_awal'
                                AND pembayaran.tanggal <= '$tgl_akhir'
                                AND pembayaran.tanggal > '$tgl'
                                -- AND pembayaran_bulanan.status = 'sukses'
                                -- AND pembayaran.tanggal > '2022-06-15'
                                -- AND pembayaran.tanggal BETWEEN $tgl_max->tgl_max AND $penyelenggara->tanggal_selesai
                                ORDER BY tanggal ASC"
                                )->result();
                                ?>
                                <?php if (empty($data)) : ?>
                                    <tr>
                                        <td colspan="6"><i>data tidak ditemukan</i></td>
                                    </tr>
                                <?php else : ?>
                                    <?php
                                    $count = 0;
                                    $jml = 0;
                                    foreach ($data as $row) :
                                        $count = $count + 1;
                                    ?>
                                        <tr>
                                            <th scope=" row"><?= $count ?></th>
                                            <td><?= $row->nama_peserta ?></td>
                                            <?php $tgl = tgl_indo($row->tanggal) ?>
                                            <td><?= $tgl ?></td>
                                            <td>Rp.<?= number_format($row->nominal_peserta, 0, ',', '.') ?></td>
                                            <td>
                                                <?php if ($row->bukti_peserta == 'dilakukan secara offline') : ?>
                                                    <i>dilakukan secara offline</i>
                                                <?php else : ?>
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $row->id_pembayaran; ?>"><?= $row->bukti_peserta ?></a>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($row->status_peserta == 'proses') : ?>
                                                    <a href="" class="badge rounded-pill bg-warning">proses</a>
                                                <?php else : ?>
                                                    <button href="" class="badge rounded-pill bg-success" disabled>Sukses <i class="fas fa-check"></i> </button>
                                                <?php endif; ?>
                                            </td>

                                        </tr>
                                    <?php $jml += $row->nominal_peserta;
                                    endforeach; ?>
                                    <tr>
                                        <th colspan="3">Total</th>
                                        <th colspan="2">Rp.<?= number_format($jml, 0, ',', '.') ?></th>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Bayar -->
    <div class="modal fade" id="bayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('petugas/proses_pembayaran_bulanan') ?>" method="post" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <label for="nama_lengkap" class="form-label">Nama</label>
                                <input type="hidden" name="id_petugas" id="" value="<?= $user['id'] ?>">
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" readonly value="<?= $user['nama_lengkap']  ?>">
                                <input type="hidden" class="form-control" id="" autocomplete="off" name="tanggal_awal_periode" required value="<?= set_value('tgl_awal') ?>">
                                <input type="hidden" class="form-control" id="" autocomplete="off" name="tanggal_akhir_periode" required value="<?= set_value('tgl_akhir') ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <label for="tanggal" class="form-label">Tanggal Pembayaran</label>
                                <input type="date" class="form-control" id="tanggal" autocomplete="off" name="tanggal_bayar" min="<?= $tgl_akhir; ?>" max="<?= $penyelenggara->tanggal_selesai; ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <label for="nominal" class="form-label">Nominal Pembayaran</label>
                                <input type="text" class="form-control" id="nominal" autocomplete="off" name="nominal" value="Rp.<?= number_format($jml, 0, ',', '.'); ?>" readonly>
                            </div>
                        </div>
                        <div class=" row mb-3">
                            <div class="col-sm-12">
                                <label for="bukti" class="form-label">Bukti Pembayaran</label>
                                <input type="file" class="form-control" id="bukti" autocomplete="off" name="bukti" required>
                                <small class="text-muted">*jpg/jpeg/png</small>
                            </div>
                        </div>
                        <div class="form-group row justify-content-start">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-success btn-sm">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <?php
    $count = 0;
    foreach ($data as $row) :
        $count = $count + 1;
    ?>
        <div class="modal fade" id="exampleModal<?= $row->id_pembayaran; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Bukti Bayar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="<?= base_url('assets/img/bukti_bayar/') . $row->bukti_peserta; ?>" class="img-fluid " style="width: 500px; height: 500px; display:block; margin:auto;">
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>