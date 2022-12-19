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

    <style>
    section {
        margin-top:50px;
        margin-bottom:50px;
    }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color:#020d5c">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <img src="<?= base_url().'/assets/img/logo_provinsi_jawa_timur.png' ?>" style="width:30px" alt="<?= getenv('app.name') ?>">
                <span class="ms-2 text-white fw-500">Klinik Hoaks</span>
            </a>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <!-- <span class="navbar-toggler-icon"></span> -->
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <?php
                $uri_1 = service('uri')->getSegment(1);
                if($uri_1) {
                    $uri_2 = service('uri')->getSegment(2);
                } else {
                    $uri_2 = '';
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link active <?= $uri_1 == '' ? 'nav-item-active' : '' ?> text-white" aria-current="page" href="<?= base_url() ?>">Beranda</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dokumen
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="https://drive.google.com/file/d/1ID97OTKmvknmaqLdcj-PmlOOvLUCgzwv/view" target=_blank">Maklumat Pelayanan</a></li>
                        <li><a class="dropdown-item" href="https://drive.google.com/file/d/1EilHJxBS068ji7bPBFrulTGtPFOuFO3U/view" target=_blank">Standart Pelayanan</a></li>
                    </ul>
                </li>
                <li class="nav-item <?= $uri_2 == 'klarifikasi' ? 'nav-item-active' : '' ?>">
                    <a class="nav-link active text-white" aria-current="page" href="<?= base_url('pengaduan/klarifikasi') ?>">Klarifikasi Informasi</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link <?= $uri_1 == 'kategori' ? 'nav-item-active' : '' ?> text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Kategori
                    </a>
                    <ul class="dropdown-menu">
                        <?php
                        $kategori = model('Kategori')->findAll();
                        foreach ($kategori as $v) :
                        ?>
                        <li><a class="dropdown-item" href="<?= base_url().'/kategori/'.$v['slug'] ?>"><?= $v['nama'] ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li class="nav-item <?= $uri_2 == 'lacak-tiket' ? 'nav-item-active' : '' ?>">
                    <a class="nav-link active text-white" aria-current="page" href="<?= base_url('pengaduan/lacak-tiket') ?>">Lacak Tiket</a>
                </li>
                <li class="nav-item <?= $uri_1 == 'subscribe' ? 'nav-item-active' : '' ?>">
                    <a class="nav-link active text-white" aria-current="page" href="<?= base_url('subscribe') ?>">Subscribe</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <style>
        .nav-item-active {
            border-bottom:4px solid #dc3545;
            font-weight:600;
        }
        .nav-item {
            transition:.5s;
            margin-right:6px;
        }
        .nav-item:hover {
            border-bottom:4px solid #dc3545;
        }
    </style>

    <div style="margin-top:69px"></div>

    <?= session()->getFlashdata('message') ?>

    <?php
    echo $content??'';
    ?>

    <footer>
        <div class="container-fluid text-white img-style" style="background:#131F71;background-image:url('<?= base_url().'/assets/img/footer-gedung.png' ?>')">
            <div class="container">
                <div class="row py-5">
                    <div class="col-lg-3">
                        <h3 class="fw-600">Dinas Kominfo Provinsi Jawa Timur</h3>
                        <p class="mt-3">
                            Jl. Ahmad Yani No.242-244, Gayungan, Kec. Gayungan, Kota SBY, Jawa Timur 60235 Indonesia
                        </p>
                        <span>
                            <i class="fa-solid fa-phone me-2"></i>
                            (031) 8294608
                        </span>
                    </div>
                    <div class="col-lg-1">
                        <!--  -->
                    </div>
                    <div class="col-lg-4">
                        <h5 class="fw-600 mb-3">Resources</h5>
                        <a href="https://www.jatimprov.go.id/" class="text-white" target="_blank">
                            <p class="resource">> Pemerintah Provinsi Jawa Timur</p>
                        </a>
                        <a href="https://kominfo.jatimprov.go.id/" class="text-white" target="_blank">
                            <p class="resource">> Dinas Kominfo Prov Jatim</p>
                        </a>
                        <a href="https://jatim.lapor.go.id/" class="text-white" target="_blank">
                            <p class="resource">> Lapor Jatim</p>
                        </a>
                    </div>
                    <style>
                        .resource{
                            transition:.5s;
                        }
                        .resource:hover{
                            margin-left:10px;
                        }
                    </style>
                    <div class="col-lg-4">
                        <h5 class="fw-600 mb-3">Follow On</h5>
                        <a href="https://twitter.com/KominfoJatim" target="_blank">
                            <button class="btn btn-secondary me-2" style="border-radius:100px">
                                <i class="fa-brands fa-twitter"></i>
                            </button>
                        </a>
                        <a href="https://www.instagram.com/kominfojatim/" target="_blank">
                            <button class="btn btn-secondary me-2" style="border-radius:100px">
                                <i class="fa-brands fa-instagram"></i>
                            </button>
                        </a>
                        <a href="https://www.youtube.com/channel/UCEe1ees-scoEkTQv3he9PJw" target="_blank">
                            <button class="btn btn-secondary" style="border-radius:100px">
                                <i class="fa-brands fa-youtube"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>



    <!-- BOOTSTRAP 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- MY SCRIPT -->
    <script src="<?=base_url().'/assets/js/script.js' ?>"></script>

</body>
</html>
