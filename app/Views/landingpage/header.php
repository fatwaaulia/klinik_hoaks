<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="description" content="" />
    <link rel="shortcut icon" href="<?= base_url().'/assets/img/logo_provinsi_jawa_timur.png' ?>" />

    <title><?= isset($title) ? $title .' | '. getenv('app.name') : getenv('app.name') ?></title>

    <!-- BOOTSTRAP 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

    <!-- MY STYLE -->
    <link rel="stylesheet" href="<?=base_url().'/assets/css/'?>style.css">

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- SWEETALERT 2 -->
    <script src="<?=base_url().'/assets/js/sweetalert2.js' ?>"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg" style="background-color:#020d5c">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <img src="<?= base_url().'/assets/img/logo_provinsi_jawa_timur.png' ?>" style="width:30px" alt="<?= getenv('app.name') ?>">
                <span class="ms-2 text-white fw-500">Klinik Hoaks</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="<?= base_url() ?>">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="#">Dokumen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="#">Klarifikasi Informasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="#">Kategori</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="#">Lacak Tiket</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="<?= base_url('subscribe') ?>">Subscribe</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>

    <?= session()->getFlashdata('message') ?>

    <?php
    echo $content??'';
    ?>



    <!-- BOOTSTRAP 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- MY SCRIPT -->
    <script src="<?=base_url().'/assets/js/script.js' ?>"></script>

</body>
</html>
