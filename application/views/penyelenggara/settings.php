<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4"><?= $title;  ?></h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Ubah Profil</li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="col-lg-8">
                                        <?= $this->session->flashdata('message'); ?>
                                        <form action="<?= base_url('penyelenggara/edit_profile') ?>" method="post" enctype="multipart/form-data">
                                            <div class="row mb-3">
                                                <label for="username" class="col-sm-3 col-form-label">Username</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="username" name="username" readonly value="<?= $user['username']; ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="nama_lengkap" autocomplete="off" name="nama_lengkap" value="<?= $user['nama_lengkap']; ?>">
                                                    <?= form_error('nama_lengkap', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="alamat" autocomplete="off" name="alamat" value="<?= $user['alamat']; ?>">
                                                    <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="no_hp" class="col-sm-3 col-form-label">No Telp</label>
                                                <div class="col-sm-9">
                                                    <input type="number" min="62" class="form-control" id="no_hp" autocomplete="off" name="no_hp" value="<?= $user['no_hp'];  ?>">
                                                    <input type="hidden" class="form-control" id="tanggal_mulai" autocomplete="off" name="tanggal_mulai" value="<?= $user['tanggal_mulai'];  ?>">
                                                    <input type="hidden" class="form-control" id="tanggal_selesai" autocomplete="off" name="tanggal_selesai" value="<?= $user['tanggal_selesai'];  ?>">
                                                    <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">Foto</div>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <img src="<?= base_url('assets/img/profile/') . $user['image'];  ?>" class="img-thumbnail">
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="image" name="image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row justify-content-end">

                                                <div class="col-sm-9">
                                                    <button type="submit" class="btn btn-success btn-sm btn-user btn-block"">Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ol class=" breadcrumb mb-4">
                                                        <li class="breadcrumb-item active">Ubah Password</li>
                                                        </ol>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="card shadow mb-4">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="card-body">
                                                                                <div class="col-lg-8">
                                                                                    <?= $this->session->flashdata('message_password'); ?>
                                                                                    <form action="<?= base_url('penyelenggara/ubah_password') ?>" method="post" enctype="multipart/form-data">
                                                                                        <div class="row mb-3">
                                                                                            <label for="current_password" class="col-sm-3 col-form-label">Password lama</label>
                                                                                            <div class="col-sm-9">
                                                                                                <div class="input-group mb-3">
                                                                                                    <input type="password" class="form-control" id="current_password" name="current_password" value="<?= set_value('current_password')  ?>">
                                                                                                    <span class="input-group-text" id="basic-addon1" onclick="lihat_password1()">
                                                                                                        <i id="lihat1" class="fas fa-eye" style="display: none;"></i>
                                                                                                        <i id="tutup1" class="fas fa-eye-slash"></i>
                                                                                                    </span>
                                                                                                </div>
                                                                                                <?= form_error('current_password', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mb-3">
                                                                                            <label for="new_password1" class="col-sm-3 col-form-label">Password baru</label>
                                                                                            <div class="col-sm-9">
                                                                                                <div class="input-group mb-3">
                                                                                                    <input type="password" class="form-control" id="new_password1" autocomplete="off" name="new_password1" value="<?= set_value('new_password1')  ?>">
                                                                                                    <span class="input-group-text" id="basic-addon1" onclick="lihat_password2()">
                                                                                                        <i id="lihat2" class="fas fa-eye" style="display: none;"></i>
                                                                                                        <i id="tutup2" class="fas fa-eye-slash"></i>
                                                                                                    </span>
                                                                                                </div>
                                                                                                <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mb-3">
                                                                                            <label for="new_password2" class="col-sm-3 col-form-label">Konfirmasi password</label>
                                                                                            <div class="col-sm-9">
                                                                                                <div class="input-group mb-3">
                                                                                                    <input type="password" class="form-control" id="new_password2" autocomplete="off" name="new_password2" value="">
                                                                                                    <span class="input-group-text" id="basic-addon1" onclick="lihat_password3()">
                                                                                                        <i id="lihat3" class="fas fa-eye" style="display: none;"></i>
                                                                                                        <i id="tutup3" class="fas fa-eye-slash"></i>
                                                                                                    </span>
                                                                                                </div>
                                                                                                <?= form_error('new_password2', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row justify-content-end">

                                                                                            <div class="col-sm-9">
                                                                                                <button type="submit" class="btn btn-success btn-sm btn-user btn-block"">Simpan</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
    </main>

    <script>
        function lihat_password1() {
                var a = document.getElementById('current_password');
                var b = document.getElementById('lihat1');
                var c = document.getElementById('tutup1');
                if (a.type === 'password') {
                 a.type = " text"; b.style.display="block" ; c.style.display="none" ; } else { a.type="password" ; b.style.display="none" ; c.style.display="block" ; } } function lihat_password2() { var d=document.getElementById('new_password1'); var e=document.getElementById('lihat2'); var f=document.getElementById('tutup2'); if (d.type==='password' ) { d.type=" text" ; e.style.display="block" ; f.style.display="none" ; } else { d.type="password" ; e.style.display="none" ; f.style.display="block" ; } } function lihat_password3() { var g=document.getElementById('new_password2'); var h=document.getElementById('lihat3'); var i=document.getElementById('tutup3'); if (g.type==='password' ) { g.type=" text" ; h.style.display="block" ; i.style.display="none" ; } else { g.type="password" ; h.style.display="none" ; i.style.display="block" ; } } </script>