<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h5 class="my-4 fw-500"><?= isset($title) ? $title : '' ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <p class="fw-500 mb-2">Pengaduan</p>
                            <h4 class="mb-0 fw-600"><?= count(model('Pengaduan')->where('id_informasi =','')->findAll()) ?></h4>
                        </div>
                        <div class="col-3 text-end text-warning position-relative">
                            <i class="fa-regular fa-paper-plane fa-2x position-absolute top-50 start-50 translate-middle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <p class="fw-500 mb-2">Informasi</p>
                            <h4 class="mb-0 fw-600"><?= count(model('Informasi')->findAll()) ?></h4>
                        </div>
                        <div class="col-3 text-end text-primary position-relative">
                            <i class="fa-solid fa-newspaper fa-2x position-absolute top-50 start-50 translate-middle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <p class="fw-500 mb-2">Subscriber</p>
                            <h4 class="mb-0 fw-600"><?= count(model('Subscriber')->where('unsubscribe_at',NULL)->findAll()) ?></h4>
                        </div>
                        <div class="col-3 text-end text-success position-relative">
                            <i class="fa-solid fa-check fa-2x position-absolute top-50 start-50 translate-middle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <p class="fw-500 mb-2">Unsubscriber</p>
                            <h4 class="mb-0 fw-600"><?= count(model('Subscriber')->where('unsubscribe_at !=',NULL)->findAll()) ?></h4>
                        </div>
                        <div class="col-3 text-end text-danger position-relative">
                            <i class="fa-solid fa-xmark fa-2x position-absolute top-50 start-50 translate-middle"></i>
                        </div>
                    </div>
                </div>
            </div>
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
                <div class="card-header">
                    <h5 class="fw-600">Jumlah persebaran data per bulan</h5>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="chartjs-line"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
    $informasi_hoaks = model('Informasi')->joinKategori(1)->getResultArray();
    
    $nama_platform_hoaks = [];
    foreach ($informasi_hoaks as $v){
        $platform = model('Platform')->where('id',$v['id_platform'])->first();
        $nama_platform_hoaks[]=$platform['nama'];
    }

    $jumlah = array_count_values($nama_platform_hoaks);
    $nama_platform = array_unique($nama_platform_hoaks);

    // print_r( $jumlah); echo '<br>';
    // print_r( $nama_platform);
?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Pie chart
    new Chart(document.getElementById("chartjs-pie"), {
        type: "pie",
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
                backgroundColor: [
                    window.theme.danger,
                    window.theme.warning,
                    window.theme.primary,
                    window.theme.success,
                    "#dee2e6"
                ],
                borderColor: "transparent"
            }]
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            }
        }
    });
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
document.addEventListener("DOMContentLoaded", function() {
    // Pie chart
    new Chart(document.getElementById("chartjs-pie2"), {
        type: "pie",
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
                backgroundColor: [
                    window.theme.success,
                    window.theme.primary,
                    window.theme.warning,
                    window.theme.danger,
                    "#dee2e6"
                ],
                borderColor: "transparent"
            }]
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            }
        }
    });
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
document.addEventListener("DOMContentLoaded", function() {
    // Pie chart
    new Chart(document.getElementById("chartjs-pie3"), {
        type: "pie",
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
                backgroundColor: [
                    window.theme.primary,
                    window.theme.warning,
                    window.theme.success,
                    window.theme.danger,
                    "#dee2e6"
                ],
                borderColor: "transparent"
            }]
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            }
        }
    });
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
document.addEventListener("DOMContentLoaded", function() {
    // Pie chart
    new Chart(document.getElementById("chartjs-pie4"), {
        type: "pie",
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
                backgroundColor: [
                    window.theme.warning,
                    window.theme.success,
                    window.theme.danger,
                    window.theme.primary,
                    "#dee2e6"
                ],
                borderColor: "transparent"
            }]
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            }
        }
    });
});
</script>


<?php
    $linechart = model('Linechart')->findAll(12);
?>
<script>
document.addEventListener("DOMContentLoaded", function() {
        // Line chart
        new Chart(document.getElementById("chartjs-line"), {
            type: "line",
            data: {
                labels: [
                    <?php
                        foreach ($linechart as $v) {
                            echo '"'.$v['bulan'].'",';
                        }    
                    ?>
                ],
                datasets: [{
                    label: "Hoaks",
                    fill: true,
                    backgroundColor: "transparent",
                    borderColor: window.theme.danger,
                    data: [ 
                        <?php
                            foreach ($linechart as $v) {
                                echo '"'.$v['hoaks'].'",';
                            }   
                        ?>
                    ],
                },
                {
                    label: "Fakta",
                    fill: true,
                    backgroundColor: "transparent",
                    borderColor: window.theme.success,
                    data: [
                        <?php
                            foreach ($linechart as $v) {
                                echo '"'.$v['fakta'].'",';
                            }    
                        ?>
                    ]
                },
                {
                    label: "Disinformasi",
                    fill: true,
                    backgroundColor: "transparent",
                    borderColor: window.theme.primary,
                    data: [
                        <?php
                            foreach ($linechart as $v) {
                                echo '"'.$v['disinformasi'].'",';
                            }    
                        ?>
                    ]
                },
                {
                    label: "Hate Speech",
                    fill: true,
                    backgroundColor: "transparent",
                    borderColor: window.theme.warning,
                    data: [
                        <?php
                            foreach ($linechart as $v) {
                                echo '"'.$v['hate_speech'].'",';
                            }    
                        ?>
                    ]
                }
            ]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    intersect: false
                },
                hover: {
                    intersect: true
                },
                plugins: {
                    filler: {
                        propagate: false
                    }
                },
                scales: {
                    xAxes: [{
                        reverse: true,
                        gridLines: {
                            color: "rgba(0,0,0,0.05)"
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            stepSize: 500
                        },
                        display: true,
                        borderDash: [5, 5],
                        gridLines: {
                            color: "rgba(0,0,0,0)",
                            fontColor: "#fff"
                        }
                    }]
                }
            }
        });
    });
</script>
