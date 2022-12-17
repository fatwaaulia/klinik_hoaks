<section>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h5 class="my-4 fw-500"><?= isset($title) ? $title : '' ?></h5>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="<?= $route.'/create' ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Platform</label>
                                    <input type="text" class="form-control <?= $val->hasError('nama') ? "is-invalid" : '' ?>" name="nama" id="nama" value="<?= old('nama') ?>" placeholder="Masukkan nama platform">
                                    <div class="invalid-feedback">
                                        <?= $val->getError('nama') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!--  -->
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">Tambahkan</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
</section>