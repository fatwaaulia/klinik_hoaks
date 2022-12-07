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
                        <a href="<?= $route.'/new' ?>" class="btn btn-primary mb-3" style="padding:5px 10px">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    </div>
                </div>

                <table class="table-default table-striped display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Gambar</th>
                            <th>Nama Berita</th>
                            <th>Sumber</th>
                            <th>Kategori</th>
                            <th>Platform</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $key => $v) : ?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td>
                                <?php
                                if ($v['img']) {
                                    $img = base_url('assets/img/'.$name.'/'.$v['img']);
                                } else {
                                    $img = base_url('assets/img/default.png');
                                }
                                ?>
                                <img src="<?= $img ?>" class="wh-40 img-style" loading="lazy">
                            </td>
                            <td><?= $v['nama'] ?></td>
                            <td><?= $v['sumber'] ?></td>
                            <td>
                                <?php
                                    $kategori = model('Kategori')->where('id', $v['id_kategori'])->first();
                                    echo $kategori['nama'];
                                ?>
                            </td>
                            <td>
                                <?php
                                    $platform = model('Platform')->where('id', $v['id_platform'])->first();
                                    echo $platform['nama'];
                                ?>
                            </td>
                            <td>
                                <a href="<?= $route.'/edit/'.model('Env')->encode($v['id']) ?>">
                                    <i class="fa-regular fa-pen-to-square fa-lg me-2"></i>
                                </a>
                                <a data-bs-toggle="modal" data-bs-target="#hapus_data<?= model('Env')->encode($v['id']) ?>">
                                    <i class="fa-regular fa-trash-can fa-lg text-danger"></i>
                                </a>
                                <!-- Modal -->
                                <div class="modal fade" id="hapus_data<?= model('Env')->encode($v['id']) ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="ws-normal mb-2"><b>Nama:</b> <?= $v['nama'] ?></div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <form action="<?= $route.'/delete/'.model('Env')->encode($v['id']) ?>" method="post">
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>
</section>
