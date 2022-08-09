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
                                <?php if (empty($rows)) : ?>
                                    <tr>
                                        <td colspan="6"><i>data tidak ditemukan</i></td>
                                    </tr>
                                <?php else : ?>
                                    <?php
                                    $count = 0;
                                    $jml = 0;
                                    foreach ($rows as $row) :
                                        $count = $count + 1;
                                    ?>
                                        <tr>
                                            <th scope=" row"><?= $count ?></th>
                                            <td><?= $row->nama_lengkap ?></td>
                                            <?php $tgl = tgl_indo($row->tanggal) ?>
                                            <td><?= $tgl ?></td>
                                            <td>Rp.<?= number_format($row->nominal, 0, ',', '.') ?></td>
                                            <td>
                                                <?php if ($row->bukti == 'dilakukan secara offline') : ?>
                                                    <i>dilakukan secara offline</i>
                                                <?php else : ?>
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $row->id; ?>"><?= $row->bukti ?></a>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($row->status == 'proses') : ?>
                                                    <a href="" class="badge rounded-pill bg-warning">proses</a>
                                                <?php else : ?>
                                                    <button href="" class="badge rounded-pill bg-success" disabled>Sukses <i class="fas fa-check"></i> </button>
                                                <?php endif; ?>
                                            </td>

                                        </tr>
                                    <?php $jml += $row->nominal;
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
                    <form action="<?= base_url('petugas/pembayaran_bulanan') ?>" method="post" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <label for="nama_lengkap" class="form-label">Nama</label>
                                <input type="hidden" name="id_petugas" id="" value="<?= $user['id'] ?>">
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" readonly value="<?= $user['nama_lengkap']  ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <label for="tanggal" class="form-label">Tanggal Pembayaran</label>
                                <input type="date" class="form-control" id="tanggal" autocomplete="off" name="tanggal" min="<?= $tgl_akhir; ?>" max="<?= $penyelenggara->tanggal_selesai; ?>" required>
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
    foreach ($rows as $row) :
        $count = $count + 1;
    ?>
        <div class="modal fade" id="exampleModal<?= $row->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Bukti Bayar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="<?= base_url('assets/img/bukti_bayar/') . $row->bukti; ?>" class="img-fluid " style="width: 500px; height: 500px; display:block; margin:auto;">
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Modal hapus data pembayaran-->
    <?php
    $count = 0;
    foreach ($rows as $row) :
        $count = $count + 1;
    ?>
        <div class="modal fade" id="hapus<?= $row->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Yakin akan menghapus data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tidak</button>
                        <a href="<?= base_url('petugas/hapus_pembayaran/') . $row->id ?>" class="btn btn-danger btn-sm">Ya</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>