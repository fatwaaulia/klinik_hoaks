<section>
<div class="container">
    <div class="row">
        <?php for ($i=0; $i<15; $i++) : ?>
        <div class="col-lg-4 konten">
            <div class="card mb-3">
                <div class="card-body">
                    Konten <b><?= $i+1 ?></b>
                </div>
            </div>
        </div>
        <?php  endfor; ?>
        <div class="row">
            <div class="col-lg-12 text-center">
                <button class="btn btn-primary load-more">Berikut</button>
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
