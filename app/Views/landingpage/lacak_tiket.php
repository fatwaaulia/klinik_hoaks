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
                        <p class="text-muted">Silahkan ...!</p>
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
if($lacak_tiket) { ?>

<section>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="text-success text-center">Tiket ditemukan</h1>
        </div>
    </div>
</div>
</section>

<?php } else { ?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="text-danger text-center">Tiket tidak ditemukan</h1>
        </div>
    </div>
</div>
</section>

<?php } ?>