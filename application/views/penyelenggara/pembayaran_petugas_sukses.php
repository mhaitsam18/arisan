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
            <a href="<?= base_url('penyelenggara/cetak_pembayaran') ?>" class="btn btn-secondary btn-sm mb-3"><i class="fas fa-file-pdf"></i> Cetak</a>
            <div class="row">

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Pembayaran Petugas
                    </div>
                    <div class="card-body">
                        <?= $this->session->flashdata('message'); ?>
                        <form action="<?= base_url('penyelenggara/pembayaran_petugas_sukses_by_tanggal') ?>" method="POST" enctype="multipart/form-data">
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
                                    <a href="<?= base_url('penyelenggara/pembayaran_petugas_sukses') ?>" class="btn btn-secondary btn-sm" style="margin-top: 32px;">Reset</a>
                                </div>
                            </div>
                        </form>
                        <table id="datatablesSimple">
                            <thead>
                                <tr class="table-warning">
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Nominal</th>
                                    <th>Bukti</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 0;
                                $jml = 0;
                                foreach ($rows as $row) :
                                    $count = $count + 1;
                                ?>
                                    <tr>
                                        <th scope=" row"><?= $count ?></th>
                                        <td><?= $row->nama_lengkap ?></td>
                                        <?php $tgl = tgl_indo($row->tanggal_bayar) ?>
                                        <td><?= $tgl ?></td>
                                        <td><?= number_format($row->nominal, 0, ',', '.') ?></td>
                                        <td>
                                            <?php if ($row->bukti == 'Diinput oleh penyelenggara') : ?>
                                                <i>Diinput oleh penyelenggara</i>
                                            <?php else : ?>
                                                <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $row->id_bayar; ?>"><?= $row->bukti ?></a>
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
        <div class="modal fade" id="exampleModal<?= $row->id_bayar; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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