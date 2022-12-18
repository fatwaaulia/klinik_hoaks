<section style="margin-top:100px">
<div class="container">
    <div class="row">
        <div class="offset-lg-3 offset-lg-3 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h2 class="fw-600">Subscribe</h2>
                        <p class="text-muted">Silahkan langganan untuk mendapatkan update informasi terkini!</p>
                    </div>
                    <form action="<?= base_url('subscriber/create') ?>" method="post">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control <?= $val->hasError('nama') ? "is-invalid" : '' ?>" name="nama" id="nama" value="<?= old('nama') ?>" placeholder="Masukkan nama anda">
                            <div class="invalid-feedback">
                                <?= $val->getError('nama') ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control <?= $val->hasError('email') ? "is-invalid" : '' ?>" name="email" id="email" value="<?= old('email') ?>" placeholder="Masukkan email">
                            <div class="invalid-feedback">
                                <?= $val->getError('email') ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</section>