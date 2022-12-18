<section style="margin-top:100px">
<div class="container">
    <div class="row mb-4">
        <div class="col-lg-12">
            <h3 class="text-center fw-600">Informasi Terkini</h3>
        </div>
    </div>
    <div class="row">
        <?php 
            $informasi = model('Informasi')->findAll();
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
