<div class="container-fluid img-style" style="background-image:url('<?= base_url().'/assets/img/header-beranda.png' ?>');height:50vh;border-radius:0 0 70px 70px">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 text-white">
                <h1 class="fw-600 mt-5 yay" style="font-size:60px">Cari Fakta <br> atau Hoaks</h1>
                <style>
                @media (max-width: 576px) { 
                    .yay {
                        font-size:40px!important;
                    }
                 }
                </style>
                <p>Berantas hoaks mulai sekarang!</p>
            </div>
            <div class="col-lg-8">
                <!--  -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="position-relative mt-4">
                    <form action="<?= base_url().'/pencarian' ?>" method="get">
                        <input type="text" class="form-control p-4" name="kata_kunci" style="border-radius:50px" placeholder="Cari informasi disini.." required>
                        <button type="submit" class="btn btn-primary position-absolute" style="right:30px;top:13px;border-radius:50px">
                            <i class="fa-solid fa-magnifying-glass fa-2x"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<section>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card bg-danger">
                <div class="card-body">
                    <div class="row text-white pt-5 pb-1">
                        <div class="col-md-6 text-center">
                            <i class="fa-solid fa-person-circle-question" style="font-size:100px"></i>
                            <h4 class="fw-600 mt-5">Cek Klarifikasi Informasi</h4>
                            <p>Yuk, cek kebenaran informasi disini!</p>
                            <a href="<?= base_url('pengaduan/klarifikasi') ?>">
                                <button class="btn btn-secondary rounded-circle mb-4">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </button>
                            </a>
                        </div>
                        <div class="col-md-6 text-center">
                            <i class="fa-solid fa-magnifying-glass" style="font-size:100px"></i>
                            <h4 class="fw-600 mt-5">Lacak Tiket</h4>
                            <p>Lacak tiket permohonan klarifikasi informasi disini!</p>
                            <a href="<?= base_url('pengaduan/lacak-tiket') ?>">
                                <button class="btn btn-secondary rounded-circle mb-4">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<section>
<div class="container">
    <div class="row mb-4">
        <div class="col-lg-12">
            <h3 class="text-center fw-600">Statistik</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <h5 class="fw-600">Platform peredaran informasi</h5>
                        <div class="col-6">
                            <p class="text-center text-danger fw-500">Hoaks</p>
                            <div class="">
                                <canvas id="chartjs-pie"></canvas>
                            </div>
                        </div>
                        <div class="col-6">
                            <p class="text-center text-success fw-500">Fakta</p>
                            <div class="">
                                <canvas id="chartjs-pie2"></canvas>
                            </div>
                        </div>
                        <div class="col-6">
                            <p class="text-center text-primary fw-500 mt-3">Disinformasi</p>
                            <div class="">
                                <canvas id="chartjs-pie3"></canvas>
                            </div>
                        </div>
                        <div class="col-6">
                            <p class="text-center text-warning fw-500 mt-3">Hate Speech</p>
                            <div class="">
                                <canvas id="chartjs-pie4"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="fw-600">Jumlah persebaran data per bulan</h5>
                    <div class="chart">
                        <canvas id="chartjs-line"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<section>
<div class="container">
    <div class="row mb-4">
        <div class="col-lg-12">
            <h3 class="text-center fw-600">Kategori Informasi</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="card mb-3" style="border:2px solid red">
                <div class="card-body">
                    <h5 class="fw-600">Hoaks</h5>
                    <p class="text-secondary">Informasi yang mengandung data palsu/salah/tidak terbukti kebenarannya</p>
                    <div class="text-center">
                        <button class="btn btn-outline-danger rounded-circle">
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card mb-3" style="border:2px solid green">
                <div class="card-body">
                    <h5 class="fw-600">Fakta</h5>
                    <p class="text-secondary">Data yang benar terjadi dan dapat dibuktikan</p>
                    <div class="text-center">
                        <button class="btn btn-outline-success rounded-circle">
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card mb-3" style="border:2px solid blue">
                <div class="card-body">
                    <h5 class="fw-600">Disinformasi</h5>
                    <p class="text-secondary">Informasi yang diolah sehingga menimbulkan bias makna pada suatu isu</p>
                    <div class="text-center">
                        <button class="btn btn-outline-primary rounded-circle">
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card mb-3" style="border:2px solid orange">
                <div class="card-body">
                    <h5 class="fw-600">Hate Speech</h5>
                    <p class="text-secondary">Pendapat/ide/pikiran seseorang terhadap suatu isu yang ditunjukan untuk membangun kebencian</p>
                    <div class="text-center">
                        <button class="btn btn-outline-warning rounded-circle">
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<section>
<div class="container">
    <div class="row mb-4">
        <div class="col-lg-12">
            <h3 class="text-center fw-600">Informasi Terkini</h3>
        </div>
    </div>
    <div class="row">
        <?php 
            $informasi = model('Informasi')->findAll();
            foreach ($informasi as $v) :
        ?>
        <div class="col-lg-4 konten">
            <div class="card mb-3">
                <?php
                if ($v['img']) {
                    $img = base_url('assets/img/informasi/'.$v['img']);
                } else {
                    $img = base_url('assets/img/default.png');
                }
                ?>
                <img src="<?= $img ?>" class="img-style w-100" style="min-height:100px" loading="lazy">
                <div class="card-body">
                    <p class="fw-600">
                    <?php
                        $kategori = model('Kategori')->where('id', $v['id_kategori'])->first();
                        echo $kategori['nama'].', '. $v['nama'];
                    ?>
                    </p>
                    <a href="<?= $v['sumber'] ?>" target="_blank">
                        <button class="btn btn-outline-primary">Sumber</button>
                    </a>
                </div>
            </div>
        </div>
        <?php  endforeach; ?>
        <div class="row">
            <div class="col-lg-12 text-center mt-3">
                <button class="btn btn-success load-more">Lebih banyak</button>
            </div>
        </div>
    </div>
</div>
</section>

<style>
.konten {
    display:none;
}    
</style>
<script>
$('.konten').slice(0,3).show();

$('.load-more').on('click', function(){
    $('.konten:hidden').slice(0,3).show();

    if ($('.konten:hidden').length == 0) {
        $('.load-more').fadeOut();
    }
})
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- PIE CHART -->
<?php
    $informasi_hoaks = model('Informasi')->joinKategori(1)->getResultArray();
    
    $nama_platform_hoaks = [];
    foreach ($informasi_hoaks as $v){
        $platform = model('Platform')->where('id',$v['id_platform'])->first();
        $nama_platform_hoaks[]=$platform['nama'];
    }

    $jumlah = array_count_values($nama_platform_hoaks);
    $nama_platform = array_unique($nama_platform_hoaks);
?>
<script>
  const pie = document.getElementById('chartjs-pie');
  new Chart(pie, {
    type: 'pie',
    data: {
      labels: [
        <?php
        foreach ($nama_platform as $v) {
            echo '"'.$v.'",';
        }    
        ?>
      ],
      datasets: [{
        data: [
            <?php
            foreach ($jumlah as $v) {
                echo $v.',';
            }    
            ?>
        ],
        borderWidth: 1
      }]
    },
    options: {
        maintainAspectRatio: false,
        legend: {
            display: false
        }
    }
  });
</script>

<?php
    $informasi_fakta = model('Informasi')->joinKategori(2)->getResultArray();
    
    $nama_platform_fakta = [];
    foreach ($informasi_fakta as $v){
        $platform = model('Platform')->where('id',$v['id_platform'])->first();
        $nama_platform_fakta[]=$platform['nama'];
    }

    $jumlah = array_count_values($nama_platform_fakta);
    $nama_platform = array_unique($nama_platform_fakta);
?>
<script>
  const pie2 = document.getElementById('chartjs-pie2');
  new Chart(pie2, {
    type: 'pie',
    data: {
      labels: [
        <?php
        foreach ($nama_platform as $v) {
            echo '"'.$v.'",';
        }    
        ?>
      ],
      datasets: [{
        data: [
            <?php
            foreach ($jumlah as $v) {
                echo $v.',';
            }    
            ?>
        ],
        borderWidth: 1
      }]
    },
    options: {
        maintainAspectRatio: false,
        legend: {
            display: false
        }
    }
  });
</script>

<?php
    $informasi_disinformasi = model('Informasi')->joinKategori(3)->getResultArray();
    
    $nama_platform_disinformasi = [];
    foreach ($informasi_disinformasi as $v){
        $platform = model('Platform')->where('id',$v['id_platform'])->first();
        $nama_platform_disinformasi[]=$platform['nama'];
    }

    $jumlah = array_count_values($nama_platform_disinformasi);
    $nama_platform = array_unique($nama_platform_disinformasi);
?>
<script>
  const pie3 = document.getElementById('chartjs-pie3');
  new Chart(pie3, {
    type: 'pie',
    data: {
      labels: [
        <?php
        foreach ($nama_platform as $v) {
            echo '"'.$v.'",';
        }    
        ?>
      ],
      datasets: [{
        data: [
            <?php
            foreach ($jumlah as $v) {
                echo $v.',';
            }    
            ?>
        ],
        borderWidth: 1
      }]
    },
    options: {
        maintainAspectRatio: false,
        legend: {
            display: false
        }
    }
  });
</script>

<?php
    $informasi_hatespeech = model('Informasi')->joinKategori(4)->getResultArray();
    
    $nama_platform_hatespeech = [];
    foreach ($informasi_hatespeech as $v){
        $platform = model('Platform')->where('id',$v['id_platform'])->first();
        $nama_platform_hatespeech[]=$platform['nama'];
    }

    $jumlah = array_count_values($nama_platform_hatespeech);
    $nama_platform = array_unique($nama_platform_hatespeech);
?>
<script>
  const pie4 = document.getElementById('chartjs-pie4');
  new Chart(pie4, {
    type: 'pie',
    data: {
      labels: [
        <?php
        foreach ($nama_platform as $v) {
            echo '"'.$v.'",';
        }    
        ?>
      ],
      datasets: [{
        data: [
            <?php
            foreach ($jumlah as $v) {
                echo $v.',';
            }    
            ?>
        ],
        borderWidth: 1
      }]
    },
    options: {
        maintainAspectRatio: false,
        legend: {
            display: false
        }
    }
  });
</script>

<!-- LINE CHART -->
<?php
    $linechart = model('Linechart')->findAll(12);
?>
<script>
  const line = document.getElementById('chartjs-line');
  new Chart(line, {
    type: 'line',
    data: {
      labels: [
        <?php
            foreach ($linechart as $v) {
                echo '"'.$v['bulan'].'",';
            }    
        ?>
      ],
      datasets: [
        {
            label: 'Hoaks',
            data: [
                <?php
                    foreach ($linechart as $v) {
                        echo '"'.$v['hoaks'].'",';
                    }   
                ?>
            ],
            borderWidth: 2,
            borderColor: "red",
        },
        {
            label: 'Fakta',
            data: [
                <?php
                    foreach ($linechart as $v) {
                        echo '"'.$v['fakta'].'",';
                    }   
                ?>
            ],
            borderWidth: 2,
            borderColor: "green",
        },
        {
            label: 'Disinformasi',
            data: [
                <?php
                    foreach ($linechart as $v) {
                        echo '"'.$v['disinformasi'].'",';
                    }   
                ?>
            ],
            borderWidth: 2,
            borderColor: "blue",
        },
        {
            label: 'Hate Speech',
            data: [
                <?php
                    foreach ($linechart as $v) {
                        echo '"'.$v['hate_speech'].'",';
                    }   
                ?>
            ],
            borderWidth: 2,
            borderColor: "orange",
        },
    ]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
