<section style="margin-top:100px">
<div class="container">
    <div class="row">
        <div class="offset-lg-3 offset-lg-3 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h2 class="fw-600">Permohonan Klarifikasi Informasi</h2>
                        <p class="text-muted">Kirimkan detail informasi yang kamu dapat, akan kami bantu cari klarifikasinya dalam 1x24 jam.</p>
                    </div>
                    <form action="<?= base_url('pengaduan/create') ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control <?= $val->hasError('nama') ? "is-invalid" : '' ?>" name="nama" id="nama" value="<?= old('nama') ?>" placeholder="Masukkan namamu">
                            <div class="invalid-feedback">
                                <?= $val->getError('nama') ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="telp" class="form-label">No. Telp</label>
                            <input type="text" class="form-control <?= $val->hasError('telp') ? "is-invalid" : '' ?>" name="telp" id="telp" value="<?= old('telp') ?>" placeholder="Masukkan no. telp">
                            <div class="invalid-feedback">
                                <?= $val->getError('telp') ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control <?= $val->hasError('email') ? "is-invalid" : '' ?>" name="email" id="email" value="<?= old('email') ?>" placeholder="Masukkan email">
                            <div class="invalid-feedback">
                                <?= $val->getError('email') ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Isi Laporan</label>
                            <textarea class="form-control <?= $val->hasError('deskripsi') ? "is-invalid" : '' ?>" name="deskripsi" id="deskripsi" rows="3" placeholder="Masukkan isi laporan"><?= old('deskripsi') ?></textarea>
                            <div class="invalid-feedback">
                                <?= $val->getError('deskripsi') ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="img" class="form-label">Gambar Pendukung</label>
                            <input class="form-control <?= $val->hasError('img') ? "is-invalid" : '' ?>" type="file" name="img" id="img">
                            <div class="invalid-feedback">
                                <?= $val->getError('img') ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="sumber" class="form-label">Sumber</label>
                            <input type="text" class="form-control <?= $val->hasError('sumber') ? "is-invalid" : '' ?>" name="sumber" id="sumber" value="<?= old('sumber') ?>" placeholder="Masukkan sumber">
                            <div class="invalid-feedback">
                                <?= $val->getError('sumber') ?>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>