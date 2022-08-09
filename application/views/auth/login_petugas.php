<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style_login.css') ?>">
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/logo/logocircle.png') ?>">
</head>

<body>
    <div class="page">
        <div class="container">
            <div class="content-left">
                <div class="login">Login </div>
                <div class="text">Untuk menggunakan aplikasi, silahkan login terlebih dahulu yang sudah dibuat oleh penyelenggara.</div>
                <br>
                <br>
                <div class="card-footer text-center py-6">
                    <a href="<?= base_url('auth/utama') ?>" style="text-decoration: none; color:white;"> Kembali</a>
                </div>
            </div>
            <div class="content-right">
                <svg viewBox="0 0 320 300">
                    <defs>
                        <linearGradient inkscape:collect="always" id="linearGradient" x1="13" y1="193.49992" x2="307" y2="193.49992" gradientUnits="userSpaceOnUse">
                            <stop style="stop-color:#ff00ff;" offset="0" id="stop876" />
                            <stop style="stop-color:#ff0000;" offset="1" id="stop878" />
                        </linearGradient>
                    </defs>
                    <path d="m 40,120.00016 239.99984,-3.2e-4 c 0,0 24.99263,0.79932 25.00016,35.00016 0.008,34.20084 -25.00016,35 -25.00016,35 h -239.99984 c 0,-0.0205 -25,4.01348 -25,38.5 0,34.48652 25,38.5 25,38.5 h 215 c 0,0 20,-0.99604 20,-25 0,-24.00396 -20,-25 -20,-25 h -190 c 0,0 -20,1.71033 -20,25 0,24.00396 20,25 20,25 h 168.57143" />
                </svg>
                <div class="form">
                    <?= $this->session->flashdata('message'); ?>
                    <form method="POST" action="<?= base_url('auth/login_petugas') ?>">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control" autocomplete="off">
                        <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="Show">
                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                        <br>
                        <input type="checkbox" name="" onclick="myFunction()">
                        <a class="small text-dark" style="text-decoration: none; color:black;"> Show password</a>
                        <button type="submit" id="submit" class="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function myFunction() {
            var show = document.getElementById('Show');
            if (show.type == 'password') {
                show.type = 'text';
            } else {
                show.type = 'password';
            }
        }
    </script>
</body>

</html>