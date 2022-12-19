<?php
$tiket = $_GET['kode']??'';
?>

<section style="margin-top:100px">
<div class="container">
    <div class="row">
        <div class="offset-lg-3 offset-lg-3 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h2 class="fw-600">Lacak Tiket</h2>
                        <p class="text-muted">Silahkan masukkan nomor tiket Anda untuk periksa hasil permohonan klarifikasi informasi.</p>
                    </div>
                    <form action="" method="get">
                        <div class="mb-3">
                            <label for="kode" class="form-label">Nomor Tiket</label>
                            <input type="text" class="form-control <?= $val->hasError('kode') ? "is-invalid" : '' ?>" name="kode" id="kode" value="<?= $tiket ?>" placeholder="Masukkan Nomor Tiket">
                            <div class="invalid-feedback">
                                <?= $val->getError('kode') ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Lacak</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<?php
$lacak_tiket = model('pengaduan')->where('kode',$tiket)->first();
if ($lacak_tiket) {
    if($lacak_tiket['id_informasi'] != 0) {  
?>

<section>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h4 class="text-success text-center mb-3">Validasi Informasi</h4>
            <div class="alert alert-primary" role="alert">
                <?= $lacak_tiket['kode'] ?>
            </div>
            <div class="alert alert-primary" role="alert">
                <?= $lacak_tiket['nama'] ?>
            </div>
            <div class="alert alert-primary" role="alert">
                <?= $lacak_tiket['deskripsi'] ?>
            </div>
            <?php
                if ($lacak_tiket['img']) {
                    $img = base_url('assets/img/pengaduan/'.$lacak_tiket['img']);
                } else {
                    $img = base_url('assets/img/user-default.png');
                }
            ?>
            <img src="<?= $img ?>" class="w-50 img-style" id="frame">
            <div class="alert alert-primary mt-3" role="alert">
                <?= $lacak_tiket['sumber'] ?>
            </div>
            <div class="alert alert-success" role="alert">
                Hasil Klarifikasi
            </div>
            <div class="alert alert-success" role="alert">
                <?php 
                    $informasi = model('Informasi')->where('id',$lacak_tiket['id_informasi'])->first();
                    if ($informasi['img']) {
                        $img = base_url('assets/img/informasi/'.$informasi['img']);
                    } else {
                        $img = base_url('assets/img/default.png');
                    }
                ?>
                <img src="<?= $img ?>" class="w-50 img-style" id="frame">
            </div>
        </div>
    </div>
</div>
</section>

<?php } elseif($lacak_tiket['id_informasi'] == 0) { ?>

    <section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="text-primary text-center">Pengaduan Anda sedang kami proses.</h4>
            </div>
        </div>
    </div>
    </section>

<?php 
    } 
} else {

if (isset($_GET['kode'])) { ?>
    
    <section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="text-danger text-center">Tiket tidak ditemukan.</h4>
            </div>
        </div>
    </div>
    </section>

<?php 
    }
}
 ?>
