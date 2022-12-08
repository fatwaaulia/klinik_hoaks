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

    <!-- ADMINKIT CSS -->
    <link href="<?= base_url().'/assets/adminkit/' ?>css/app.css" rel="stylesheet">

    <!-- MY STYLE -->
    <link rel="stylesheet" href="<?=base_url().'/assets/css/'?>style.css">
    <link rel="stylesheet" href="<?=base_url().'/assets/css/'?>dashboard.css">

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DATATABLES -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

    <!-- SWEETALERT 2 -->
    <script src="<?=base_url().'/assets/js/sweetalert2.js' ?>"></script>

</head>

<body>
    <?= session()->getFlashdata('message') ?>

    <div class="loader-bg position-absolute top-50 start-50 translate-middle">
        <div class="loader-p">
        </div>
    </div>

    <script>
        setTimeout(function() {
            $('.loader-bg').fadeToggle();
        });
    </script>

    <!-- Sidebar -->
    <?= $sidebar ?? '' ?>

        <main class="content">
            <div class="container-fluid p-0">
                <?= $content ?? view('errors/e404') ?>
            </div>
        </main>

    <?php if(isset($sidebar)) :
        echo '</div>
        </div>';
    endif; ?>
    <!-- Akhir Sidebar -->

    <!-- ADMINKIT JS -->
    <script src="<?= base_url().'/assets/adminkit/' ?>js/app.js"></script>

    <!-- BOOTSTRAP 5 JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> -->

    <!-- MY SCRIPT -->
    <script src="<?=base_url().'/assets/js/script.js' ?>"></script>
    

    <!-- DATATABLES -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.table-default').DataTable({
                "scrollX": true,
                "columnDefs": [{
                        "searchable": false,
                        "targets": [0],
                    }
                ],
            });
            $('.table-excel').DataTable({
                "scrollX": true,
                "columnDefs": [{
                        "searchable": false,
                        "targets": [0],
                    }
                ],
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'colvis',
                ],
            });
        });
    </script>

</body>
</html>
