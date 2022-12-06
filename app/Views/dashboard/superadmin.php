<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h5 class="my-4 fw-500"><?= isset($title) ? $title : '' ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Pie Chart</h5>
                    <h6 class="card-subtitle text-muted">Pie charts are excellent at showing the relational proportions between data.</h6>
                </div>
                <div class="card-body">
                    <div class="chart chart-sm">
                        <canvas id="chartjs-pie"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Bar Chart</h5>
                    <h6 class="card-subtitle text-muted">A bar chart provides a way of showing data values represented as vertical bars.</h6>
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



<script>
document.addEventListener("DOMContentLoaded", function() {
    // Pie chart
    new Chart(document.getElementById("chartjs-pie"), {
        type: "pie",
        data: {
            labels: ["Social", "Search Engines", "Direct", "Other"],
            datasets: [{
                data: [260, 125, 54, 146],
                backgroundColor: [
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
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Bar chart
    new Chart(document.getElementById("chartjs-bar"), {
        type: "bar",
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Last year",
                backgroundColor: window.theme.primary,
                borderColor: window.theme.primary,
                hoverBackgroundColor: window.theme.primary,
                hoverBorderColor: window.theme.primary,
                data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
                barPercentage: .75,
                categoryPercentage: .5
            }, {
                label: "This year",
                backgroundColor: "#dee2e6",
                borderColor: "#dee2e6",
                hoverBackgroundColor: "#dee2e6",
                hoverBorderColor: "#dee2e6",
                data: [69, 66, 24, 48, 52, 51, 44, 53, 62, 79, 51, 68],
                barPercentage: .75,
                categoryPercentage: .5
            }]
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