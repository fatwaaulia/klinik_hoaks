<section style="margin-top:70px">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <img src="<?= base_url() . '/assets/img/404.png' ?>" class="img-style w-100" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4><b><?= $error_msg ?? 'OOOPS, HALAMAN INI TIDAK DITEMUKAN!' ?></b></h4>
                        <p>Halaman yang Anda cari mungkin telah dihapus, diganti namanya, atau tidak tersedia untuk sementara.</p>
                        <a href="<?= base_url() ?>">
                            <button class="btn btn-outline-primary">Kembali</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>