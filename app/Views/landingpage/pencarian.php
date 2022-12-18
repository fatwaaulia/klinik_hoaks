<section style="margin-top:100px">
<div class="container">
    <div class="row mb-2">
        <div class="col-lg-12">
            <?php $kategori = model('Kategori')->where('slug', service('uri')->getSegment(2))->first(); ?>
            <h3 class="text-center fw-600">Pencarian Informasi</h3>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-lg-12">
            <div class="position-relative mt-4">
                <form action="<?= base_url().'/pencarian' ?>" method="get">
                    <input type="text" class="form-control p-4" name="kata_kunci" value="<?= $_GET['kata_kunci'] ?>" style="border-radius:50px" placeholder="Cari informasi disini.." required>
                    <button type="submit" class="btn btn-primary position-absolute" style="right:30px;top:13px;border-radius:50px">
                        <i class="fa-solid fa-magnifying-glass fa-2x"></i>
                    </button>
                </form>
            </div>
            <?php $informasi = model('Informasi')->like('nama',$_GET['kata_kunci'])->findAll(); ?>
            <p class="mt-3 fw-600 <?= count($informasi) > 0 ? 'text-success':'text-danger' ?>"><?= count($informasi) ?> informasi ditemukan</p>
        </div>
    </div>
    <div class="row">
        <?php 
            foreach ($informasi as $v) :
        ?>
        <div class="col-lg-4 konten">
            <div class="card mb-3">
                <?php
                if ($v['img']) {
                    $img = base_url('assets/img/informasi/'.$v['img']);
                } else {
                    $img = base_url('assets/img/default.png');
                }
                ?>
                <img src="<?= $img ?>" class="img-style w-100" style="min-height:100px" loading="lazy">
                <div class="card-body">
                    <p class="fw-600">
                    <?php
                        $kategori = model('Kategori')->where('id', $v['id_kategori'])->first();
                        echo $kategori['nama'].', '. $v['nama'];
                    ?>
                    </p>
                    <a href="<?= $v['sumber'] ?>" target="_blank">
                        <button class="btn btn-outline-primary">Sumber</button>
                    </a>
                </div>
            </div>
        </div>
        <?php  endforeach; ?>
        <div class="row">
            <div class="col-lg-12 text-center mt-3">
                <button class="btn btn-success load-more">Lebih banyak</button>
            </div>
        </div>
    </div>
</div>
</section>


<style>
.konten {
    display:none;
}    
</style>
<script>
$('.konten').slice(0,3).show();

$('.load-more').on('click', function(){
    $('.konten:hidden').slice(0,3).show();

    if ($('.konten:hidden').length == 0) {
        $('.load-more').fadeOut();
    }
})
</script>
