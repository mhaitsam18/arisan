<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4"><?= $title;  ?></h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Data Pembayaran Peserta</li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data Pembayaran Peserta
                        </div>
                        <div class="card-body">
                            <?= $this->session->flashdata('message'); ?>
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    $jml = 0;
                                    foreach ($data_progres as $row) :
                                        $count = $count + 1;
                                    ?>
                                        <tr>
                                            <th scope=" row"><?= $count ?></th>
                                            <td><?= $row->tanggal ?></td>
                                            <td>Rp.<?= number_format($row->nominal, 0, ',', '.'); ?></td>
                                            <td>
                                                <?php if ($row->status_pembayaran == 'sukses') : ?>
                                                    <button class="btn btn-sm btn-success" disabled><i class="fas fa-check"></i></button>
                                                <?php else : ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php
                                        $jml += $row->nominal;
                                    endforeach; ?>
                                    <tr>
                                        <td colspan="2"><b>Total</b></td>
                                        <td colspan="2">Rp.<?= number_format($jml, 0, ',', '.') ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>