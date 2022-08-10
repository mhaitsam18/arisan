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
                        <a href="" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#inputPeserta"> <i class="fas fa-user-plus"></i> Tambah Data Peserta</a>
                        <table id="datatablesSimple">
                            <thead>
                                <tr class="table-warning">
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No HP</th>
                                    <th>Status Akun</th>
                                    <th>Status Pembayaran</th>
                                    <!-- <th>Total Iuran</th> -->
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $jml = 0;
                                $count = 0;
                                ?>
                                <?php foreach ($rows as $row) : ?>
                                    <?php
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
                                    <tr style="<?= ($row->status == 'nonaktif') ? 'background-color: #fa8e8e;' : '' ?>">
                                        <th scope=" row"><?= $count ?></th>
                                        <td><?= $row->nama_lengkap ?></td>
                                        <td><?= $row->alamat ?></td>
                                        <td><?= $row->no_hp ?></td>
                                        <td><?= $row->status ?></td>
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
                                            <?php if ($row->status == 'aktif') : ?>
                                                <a href="" class="btn btn-secondary btn-sm" data-bs-toggle="modal" title="Ubah Status Peserta" data-bs-target="#nonaktif_user<?= $row->id; ?>"> <i class="fas fa-user"></i></a>
                                                <button class="btn btn-danger btn-sm" data-placement="top" title="status peserta aktif" disabled> <i class="fas fa-trash"></i></button>
                                                <a href="<?= base_url('petugas/data_barang_peserta/' . $row->id) ?>" class="btn btn-warning btn-sm" title="Lihat Paket Lebaran"><i class="fas fa-box-open"></i></a>
                                                <a href="<?= base_url('petugas/progres_peserta/' . $row->id) ?>" class="btn btn-success btn-sm" title="Lihat Progres Peserta"><i class=" fas fa-list"></i></a>
                                            <?php else : ?>
                                                <a href="" class="btn btn-secondary btn-sm" data-bs-toggle="modal" title="Ubah Status Peserta" data-bs-target="#aktif_user<?= $row->id; ?>"> <i class="fas fa-user"></i></a>
                                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus_user<?= $row->id; ?>"><i class="fas fa-trash"></i></button>
                                                <a href="<?= base_url('petugas/data_barang_peserta/' . $row->id) ?>" class="btn btn-warning btn-sm" title="Lihat Paket Lebaran"><i class="fas fa-box-open"></i></a>
                                                <a href="<?= base_url('petugas/progres_peserta/' . $row->id) ?>" class="btn btn-success btn-sm" title="Lihat Progres Peserta"><i class=" fas fa-list"></i></a>
                                                <a href="" data-bs-toggle="modal" data-bs-target="#kirim<?= $row->id; ?>" class="btn btn-info btn-sm" title="Kirim Akun"><i class="fas fa-paper-plane"></i></a>
                                                </button>
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

    <!-- Modal Tambah Peserta -->
    <div class="modal fade" id="inputPeserta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Input Data Peserta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('petugas/input_peserta') ?>" method="POST">
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
                            <input type="text" minlength="11" maxlength="13" class="form-control no" id="no_hp" name="no_hp" placeholder="Harus diawali dengan angka 62" autocomplete="off" required oninvalid="this.setCustomValidity('Masukan No Whatsapp')" oninput="setCustomValidity('')" onkeypress="return restrictAlphabets(event)">
                        </div>
                        <div class="mb-3">
                            <label for="nama_petugas" class="form-label">Nama Petugas</label>
                            <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" required autocomplete="off" readonly value="<?= $user['nama_lengkap'];  ?>">
                            <input type="hidden" name="id_petugas" value="<?= $user['id'];  ?>">
                        </div>
                        <button type="submit" class="btn btn-success btn-sm">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal nonaktif user -->
    <?php
    $count = 0;
    foreach ($rows as $row) :
        $count = $count + 1;
    ?>
        <div class="modal fade" id="nonaktif_user<?= $row->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Yakin untuk ubah status peserta?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tidak</button>
                        <a href="<?= base_url('petugas/nonaktif_user/') . $row->id ?>" class="btn btn-success btn-sm">Ya</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Modal aktif user -->
    <?php
    $count = 0;
    foreach ($rows as $row) :
        $count = $count + 1;
    ?>
        <div class="modal fade" id="aktif_user<?= $row->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Yakin untuk ubah status peserta?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tidak</button>
                        <a href="<?= base_url('petugas/aktif_user/') . $row->id ?>" class="btn btn-success btn-sm">Ya</a>
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
                        <form action="<?= base_url('petugas/kirim_wa') ?>" method="POST">
                            <div class="mb-3">
                                <input type="hidden" name="id" value="<?= $row->id; ?>">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required autocomplete="off" value="<?= $row->nama_lengkap; ?>" readonly>
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

    <!-- Modal hapus user -->
    <?php
    $count = 0;
    foreach ($rows as $row) :
        $count = $count + 1;
    ?>
        <div class="modal fade" id="hapus_user<?= $row->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Peserta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Yakin untuk menghapus peserta?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tidak</button>
                        <a href="<?= base_url('petugas/hapus_user/') . $row->id ?>" class="btn btn-danger btn-sm">Ya</a>
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