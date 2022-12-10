<div class="container-fluid" style="font-size:16px;font-family:sans-serif;">
    <!-- Header -->
    <div class="row">
        <div class="col-md-12">
            <div style="background:#ededed;text-align:center!important;padding:16px 12px">
                <img src="<?= base_url().'/assets/img/logo-kominfo.png' ?>" style="height:50px;vertical-align:middle">
            </div>
        </div>
    </div>
    <!-- Body -->
    <div class="row" style="padding:20px 12px">
        <div class="col-md-12">
            <div>
                <p>Hai, <b> <?= $name ?? 'Pengguna' ?>!</b></p>
                <p>
                    <?= $text ?? getenv('app.name') ?>
                </p>
            </div>

            <?php if($button_link != '') : ?>
            <div style="margin:2rem 0px">
                <a href="<?= $button_link ?? getenv('app.name') ?>" target="_blank">
                    <button style="color:#fff;background:#3b7ddd;border:1px solid transparent;padding:0.375rem 0.75rem;font-size:1rem;border-radius:0.25rem;">
                        <?= $button_name ?? 'Tombol' ?>
                    </button>
                </a>
            </div>
            <?php endif; ?>

            <div style="margin-bottom:2rem">
                <p>Terima kasih, <br>
                    <?= getenv('app.name') ?>
                </p>
            </div>

            <?php if($button_link != '') : ?>
            <p>
                Jika Anda mengalami masalah dengan menekan tombol "<?= $button_name ?? 'Tombol' ?>", salin dan tempel URL berikut ini di browser Anda:
                <a href="<?= $button_link ?? getenv('app.name') ?>"><?= $button_link ?? getenv('app.name') ?></a>
            </p>
            <?php endif; ?>
        </div>
    </div>
    <!-- Footer -->
    <div class="row">
        <div class="col-md-12">
            <div style="background:#ededed;text-align:center;color:#888888;padding:16px 12px">
                <span>
                    © <?= date('Y') .' '.  getenv('app.name') ?>
                </span>
            </div>
        </div>
    </div>
</div>