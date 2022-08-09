<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arisan Paket Lebaran SuMas</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style_halaman_utama.css') ?>">
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/logo/logocircle.png') ?>">
</head>

<body>
    <div class="banner">
        <div class="navbar">
            <img src="<?= base_url('assets/img/halamanutama/logo.png') ?>" class="logo">
            <ul>
                <li><a href="<?= base_url('auth/utama') ?>">Beranda</a></li>
                <li><a href="<?= base_url('auth/tentang') ?>">Tentang</a></li>
            </ul>
        </div>
        <div class=" content">
            <h1>Selamat datang <br>di Arisan Paket Lebaran SuMas<br></h1>
            <p> Login sebagai : </p>
            <div>
                <a href="<?= base_url('auth/login_peserta') ?>" class="button" style="color: white; text-decoration: none;"><button type="button"><span></span>Peserta</button></a>
                <a href="<?= base_url('auth/login_petugas') ?>" class="button" style="color: white; text-decoration: none;"><button type="button"><span></span>Petugas</button></a>
                <a href="<?= base_url('auth') ?>" class="button" style="color: white; text-decoration: none;"><button type="button"><span></span>Penyelenggara</button></a>
            </div>
        </div>
    </div>

</body>

</html>