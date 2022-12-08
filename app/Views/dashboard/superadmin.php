<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h5 class="my-4 fw-500"><?= isset($title) ? $title : '' ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <h5 class="fw-600">Platform peredaran berita</h5>
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
                        <canvas id="chartjs-bar"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
    $berita_hoaks = model('Berita')->joinKategori(1)->getResultArray();
    
    $nama_platform_hoaks = [];
    foreach ($berita_hoaks as $v){
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
    $berita_fakta = model('Berita')->joinKategori(3)->getResultArray();
    
    $nama_platform_fakta = [];
    foreach ($berita_fakta as $v){
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
    $berita_disinformasi = model('Berita')->joinKategori(2)->getResultArray();
    
    $nama_platform_disinformasi = [];
    foreach ($berita_disinformasi as $v){
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
    $berita_hatespeech = model('Berita')->joinKategori(4)->getResultArray();
    
    $nama_platform_hatespeech = [];
    foreach ($berita_hatespeech as $v){
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
    $barchart = model('Barchart')->orderBy('id','DESC')->findAll(12);
?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Bar chart
    new Chart(document.getElementById("chartjs-bar"), {
        type: "bar",
        data: {
            labels: [
                <?php
                    foreach ($barchart as $v) {
                        echo '"'.$v['bulan'].'",';
                    }    
                ?>
            ],
            datasets: [
                {
                    label: "Hoaks",
                    backgroundColor: window.theme.danger,
                    data: [
                        <?php
                            foreach ($barchart as $v) {
                                echo '"'.$v['hoaks'].'",';
                            }    
                        ?>
                    ],
                    barPercentage: .75,
                    categoryPercentage: .5
                },
                {
                    label: "Fakta",
                    backgroundColor: window.theme.success,
                    data: [
                        <?php
                            foreach ($barchart as $v) {
                                echo '"'.$v['fakta'].'",';
                            }    
                        ?>
                    ],
                    barPercentage: .75,
                    categoryPercentage: .5
                },
                {
                    label: "Disinformasi",
                    backgroundColor: window.theme.primary,
                    data: [
                        <?php
                            foreach ($barchart as $v) {
                                echo '"'.$v['disinformasi'].'",';
                            }    
                        ?>
                    ],
                    barPercentage: .75,
                    categoryPercentage: .5
                },
                {
                    label: "Hate Speech",
                    backgroundColor: window.theme.warning,
                    data: [
                        <?php
                            foreach ($barchart as $v) {
                                echo '"'.$v['hate_speech'].'",';
                            }    
                        ?>
                    ],
                    barPercentage: .75,
                    categoryPercentage: .5
                },
            ]
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        display: false
                    },
                    stacked: false,
                    ticks: {
                        stepSize: 20
                    }
                }],
                xAxes: [{
                    stacked: false,
                    gridLines: {
                        color: "transparent"
                    }
                }]
            }
        }
    });
});
</script>