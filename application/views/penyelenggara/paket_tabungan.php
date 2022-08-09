<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4"><?= $title;  ?></h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"></li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Paket Tabungan
                        </div>
                        <div class="card-body">
                            <?= $this->session->flashdata('message'); ?>
                            <table id="datatablesSimple">
                                <thead>
                                    <tr class="table-warning">
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Paket Tabungan</th>
                                        <!-- <th>Progres</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    $total = 0;
                                    foreach ($rows as $row) :
                                        $count = $count + 1;
                                        // $total += $row->harga;
                                    ?>
                                        <tr>
                                            <th scope="row"><?= $count ?></th>
                                            <td><?= $row->nama_lengkap ?></td>
                                            <td><a href="<?= base_url('penyelenggara/detail_tabungan/') . $row->id_user  ?>">lihat</a></td>
                                            <!-- <td><a href="<?= base_url('penyelenggara/detail_progres/') . $row->id_user  ?>">lihat</a></td> -->
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>