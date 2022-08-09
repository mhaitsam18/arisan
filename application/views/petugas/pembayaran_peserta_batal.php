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
                        Data Pembayaran Peserta
                    </div>
                    <div class="card-body">
                        <?= $this->session->flashdata('message'); ?>
                        <table id="datatablesSimple">
                            <thead>
                                <tr class="table-warning">
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Nominal</th>
                                    <th>Bukti</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 0;
                                foreach ($rows as $row) :
                                    $count = $count + 1;
                                ?>
                                    <tr>
                                        <th scope=" row"><?= $count ?></th>
                                        <td><?= $row->nama_lengkap ?></td>
                                        <?php $tgl = tgl_indo($row->tanggal) ?>
                                        <td><?= $tgl ?></td>
                                        <td><?= number_format($row->nominal, 0, ',', '.') ?></td>
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
                                                <button href="" class="badge rounded-pill bg-danger" disabled>Batal <i class="fas fa-times"></i> </button>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="" class="badge rounded-pill bg-danger" style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#hapus<?= $row->id; ?>">Hapus</a>

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