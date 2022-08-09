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
            <div class="row">

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Pembayaran Petugas
                    </div>
                    <div class="card-body">
                        <?= $this->session->flashdata('message'); ?>

                        <table id="datatablesSimple">
                            <thead>
                                <tr class="table-warning">
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Nominal</th>
                                    <th>Bukti</th>
                                    <th>Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($proses)) : ?>
                                    <?php
                                    $count = 0;
                                    $jml = 0;
                                    foreach ($proses as $row) :
                                        $count = $count + 1;

                                    ?>
                                        <tr>
                                            <th scope=" row"><?= $count ?></th>
                                            <td><?= $row->nama_lengkap ?></td>
                                            <?php $tgl = tgl_indo($row->tanggal) ?>
                                            <td><?= $tgl ?></td>
                                            <td>Rp. <?= number_format($row->nominal, 0, ',', '.') ?></td>
                                            <td>
                                                <?php if ($row->bukti == "dilakukan secara offline") : ?>
                                                    <i>dilakukan secara offline</i>
                                                <?php else : ?>
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $row->id_pembayaran; ?>"><?= $row->bukti ?></a>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($row->status == 'proses') : ?>
                                                    <a href="" class="badge rounded-pill bg-warning" style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#approve<?= $row->id_pembayaran; ?>">Approve</a>
                                                    <a href="" class="badge rounded-pill bg-danger" style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#cancel<?= $row->id_pembayaran; ?>">Cancel</a>
                                                <?php else : ?>
                                                    <a href="" class="btn btn-success btn-sm" style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#approve<?= $row->id_pembayaran; ?>"><i class="fas fa-check-circle"></i></a>
                                                    <!-- <a href="" class="badge rounded-pill bg-success">Sukses</a> -->
                                                    <a href="" class="btn btn-danger btn-sm" style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#cancel<?= $row->id_pembayaran; ?>"><i class="fas fa-times-circle"></i></a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php $jml += $row->nominal;
                                    endforeach; ?>
                                    <tr>
                                        <th colspan="3">Total</th>
                                        <th colspan="2">Rp.<?= number_format($jml, 0, ',', '.') ?></th>
                                    </tr>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <?php
    $count = 0;
    foreach ($proses as $row) :
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
                        <img src="<?= base_url('assets/img/bukti_bayar/') . $row->bukti; ?>" class="img-fluid " style="width: 500px; height: 500px; display:block; margin:auto;">
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Modal -->
    <?php
    $count = 0;
    foreach ($proses as $row) :
        $count = $count + 1;
    ?>
        <div class="modal fade" id="approve<?= $row->id_pembayaran; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Approve pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Yakin untuk approve?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tidak</button>
                        <a href="<?= base_url('penyelenggara/proses_status/') . $row->id_pembayaran ?>" class="btn btn-success btn-sm">Ya</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Modal -->
    <?php
    $count = 0;
    foreach ($proses as $row) :
        $count = $count + 1;
    ?>
        <div class="modal fade" id="cancel<?= $row->id_pembayaran; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tolak Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= base_url('penyelenggara/cancel_status/') . $row->id_pembayaran ?>" method="POST">
                        <div class="modal-body">
                            Yakin untuk tolak?
                            <input type="text" class="form-control mt-3 mb-2" name="no_hp" value="<?= $row->noHP; ?>" readonly>
                            <textarea name="keterangan" class="form-control" id="" cols="30" rows="10" placeholder="Masukan Pesan" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success btn-sm" data-bs-dismiss="modal">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>