<section>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h5 class="my-4 fw-500"><?= isset($title) ? $title : '' ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?= session()->getFlashdata('message') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card p-3">
                    
                <div class="row">
                    <div class="col-12">
                        <a class="btn btn-primary mb-3" style="padding:5px 10px" data-bs-toggle="modal" data-bs-target="#kirim_pemberitahuan">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                        <div class="modal fade" id="kirim_pemberitahuan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Kirim Pemberitahuan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?php 
                                            $informasi = model('Informasi')->orderBy('id','DESC')->findAll(7);
                                            foreach($informasi as $key => $v) :
                                                $kategori = model('Kategori')->where('id',$v['id_kategori'])->first();
                                        ?>
                                        <div class="ws-normal mb-2"><b>Info <?= $key+1 ?>: </b> <br> <?= $kategori['nama'] .', '. $v['nama'] ?></div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <form action="<?= $route.'/create' ?>" method="post">
                                            <button type="submit" class="btn btn-primary">Kirim</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table-default table-striped display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Info 1</th>
                            <th>Info 2</th>
                            <th>Info 3</th>
                            <th>Info 4</th>
                            <th>Info 5</th>
                            <th>Info 6</th>
                            <th>Info 7</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $key => $v) : ?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td><?= date('d-m-Y H:i:s', strtotime($v['created_at'])) ?></td>
                            <td><?= $v['info_1'] ?></td>
                            <td><?= $v['info_2'] ?></td>
                            <td><?= $v['info_3'] ?></td>
                            <td><?= $v['info_4'] ?></td>
                            <td><?= $v['info_5'] ?></td>
                            <td><?= $v['info_6'] ?></td>
                            <td><?= $v['info_7'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>
</section>
