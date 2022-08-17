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
                        Data Petugas
                    </div>
                    <div class="card-body">
                        <?= $this->session->flashdata('message'); ?>
                        <a href="" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#inputPetugas"> <i class="fas fa-user-plus"></i> Tambah Data Petugas</a>
                        <table id="datatablesSimple">
                            <thead>
                                <tr class="table-warning">
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No HP</th>
                                    <th>Jumlah Peserta</th>
                                    <th>Jumlah Bayar</th>
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
                                    <?php if ($row->status == 'nonaktif') : ?>
                                        <tr style="background-color: #fa8e8e;">
                                        <?php else : ?>
                                        <tr>
                                        <?php endif; ?>
                                        <th scope=" row"><?= $count ?></th>
                                        <td><?= $row->nama_lengkap ?></td>
                                        <td><?= $row->alamat ?></td>
                                        <td><?= $row->no_hp ?></td>
                                        <td><?= $row->jumlah_peserta ?> Peserta</td>
                                        <td><?= number_format($row->total_bayar, 0, ',', '.') ?></td>
                                        <td><?= $row->status ?></td>
                                        <td>
                                            <?php if ($row->status == 'aktif') : ?>
                                                <a href="" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#nonaktif<?= $row->id; ?>"> Ubah Status</a>
                                                <button class="btn btn-danger btn-sm" data-placement="top" title="status peserta aktif" disabled> Hapus</button>
                                            <?php else : ?>
                                                <a href="" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#aktif<?= $row->id; ?>"> Ubah Status</a>
                                                <a href="" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus<?= $row->id; ?>"> Hapus</a>
                                                <a href="" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#kirim<?= $row->id; ?>"> Kirim Akun</a>
                                            <?php endif; ?>
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
    <div class="modal fade" id="inputPetugas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Input Data Petugas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('penyelenggara/input_petugas') ?>" method="POST">
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" autocomplete="off" required oninvalid="this.setCustomValidity('Masukan Nama Lengkap')" oninput="setCustomValidity('')">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" autocomplete="off" required oninvalid="this.setCustomValidity('Masukan Alamat')" oninput="setCustomValidity('')">
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No WhatsApp</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" minlength="11" maxlength="13" autocomplete="off" required oninvalid="this.setCustomValidity('Masukan No WhatsApp')" oninput="setCustomValidity('')" onkeypress="return restrictAlphabets(event)">
                        </div>
                        <button type="submit" class="btn btn-success  btn-sm">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nonaktif petugas-->
    <?php
    $count = 0;
    foreach ($rows as $row) :
        $count = $count + 1;
    ?>
        <div class="modal fade" id="nonaktif<?= $row->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah status petugas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Yakin akan merubah status?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tidak</button>
                        <a href="<?= base_url('penyelenggara/nonaktif_petugas/') . $row->id ?>" class="btn btn-success btn-sm">Ya</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Modal aktif petugas-->
    <?php
    $count = 0;
    foreach ($rows as $row) :
        $count = $count + 1;
    ?>
        <div class="modal fade" id="aktif<?= $row->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah status petugas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Yakin akan merubah status?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tidak</button>
                        <a href="<?= base_url('penyelenggara/aktif_petugas/') . $row->id ?>" class="btn btn-success btn-sm">Ya</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Modal Kirim-->
    <?php
    $count = 0;
    foreach ($rows as $row) :
        $count = $count + 1;
    ?>
        <div class="modal fade" id="kirim<?= $row->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Kirim Username & Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('penyelenggara/kirim_wa') ?>" method="POST">
                            <div class="mb-3">
                                <input type="hidden" name="id" value="<?= $row->id; ?>">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required autocomplete="off" required autocomplete="off" required oninvalid="this.setCustomValidity('Masukan username')" oninput="setCustomValidity('')">
                            </div>
                            <div class="mb-3">
                                <?php
                                $string = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; ?>
                                <label for="password" class="form-label">Password</label>
                                <input type="text" class="form-control" id="password" name="password" required autocomplete="off" value="<?= substr(str_shuffle($string), 0, 6); ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No WhatsApp</label>
                                <input type="number" class="form-control" id="no_hp" name="no_hp" required autocomplete="off" value="<?= $row->no_hp; ?>" readonly>
                            </div>
                            <button type="submit" class="btn btn-success  btn-sm">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Modal hapus petugas-->
    <?php
    $count = 0;
    foreach ($rows as $row) :
        $count = $count + 1;
    ?>
        <div class="modal fade" id="hapus<?= $row->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus petugas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Yakin akan menghapus data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tidak</button>
                        <a href="<?= base_url('penyelenggara/hapus_petugas/') . $row->id ?>" class="btn btn-danger btn-sm">Ya</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <script>
        function restrictAlphabets(e) {
            var x = e.which || e.keycode;
            if ((x >= 48 && x <= 57))
                return true;
            else
                return false;
        }
    </script>