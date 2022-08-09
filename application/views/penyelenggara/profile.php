<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4"><?= $title;  ?></h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"></li>
            </ol>
            <?= $this->session->flashdata('message'); ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="card-body">

                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" class="img-fluid rounded-circle" style="width: 200px; height: 200px;">
                                        <h5 class="card-title mt-3"><?= $user['nama_lengkap']  ?></h5>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <h6 class="font-weight-bold text-dark">Username</h6>
                                            <small><?= $user['username']  ?></small>
                                        </li>
                                        <li class="list-group-item">
                                            <h6 class="font-weight-bold text-dark">Alamat</h6>
                                            <small><?= $user['alamat']  ?></small>
                                        </li>
                                        <li class="list-group-item">
                                            <h6 class="font-weight-bold text-dark">No Telp</h6>
                                            <small><?= $user['no_hp']  ?></small>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>