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
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url($route.'/update/'.model('Env')->encode($data['id'])) ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <div class="w-50 position-relative">
                                    <?php
                                    if ($data['img']) {
                                        $img = base_url('assets/img/'.$name.'/'.$data['img']);
                                    } else {
                                        $img = base_url('assets/img/user-default.png');
                                    }
                                    ?>
                                        <img src="<?= $img ?>" class="<?= $val->hasError('img') ? "border border-danger" : '' ?> w-100 h-100 img-style" id="frame">
                                        <div class="position-absolute" style="bottom:0px;right:0px">
                                            <button class="btn btn-secondary rounded-circle" style="padding:8px 10px" type="button" data-bs-toggle="modal" data-bs-target="#option">
                                                <i class="fa-solid fa-pen fa-lg"></i>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="option" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div data-bs-dismiss="modal">
                                                                <input type="file" class="form-control" name="img" accept="image/*" onchange="preview()">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="<?= $val->hasError('img') ? "is-invalid" : '' ?>">
                                    </span>
                                    <div class="invalid-feedback">
                                        <?= $val->getError('img') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Berita</label>
                                    <input type="text" class="form-control <?= $val->hasError('nama') ? "is-invalid" : '' ?>" name="nama" id="nama" value="<?= old('nama') ?? $data['nama'] ?>" placeholder="Masukkan nama berita">
                                    <div class="invalid-feedback">
                                        <?= $val->getError('nama') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="sumber" class="form-label">Sumber</label>
                                    <input type="text" class="form-control <?= $val->hasError('sumber') ? "is-invalid" : '' ?>" name="sumber" value="<?= old('sumber') ?? $data['sumber'] ?>" id="sumber" placeholder="Masukkan sumber">
                                    <div class="invalid-feedback">
                                        <?= $val->getError('sumber') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="id_platform" class="form-label">Platform</label>
                                    <select class="form-select <?= $val->hasError('id_platform') ? "is-invalid" : '' ?>" name="id_platform">
                                        <?php
                                        $platform = model('Platform')->findAll();
                                        foreach ($platform as $v) : 
                                            if (old('id_platform') == $v['id']) {
                                                $selected = 'selected';
                                            }elseif ($data['id_platform'] == $v['id']) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }
                                        ?>
                                        <option value="<?= $v['id'] ?>" <?= $selected ?> ><?= $v['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $val->getError('id_platform') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="id_kategori" class="form-label">Kategori</label>
                                    <select class="form-select <?= $val->hasError('id_kategori') ? "is-invalid" : '' ?>" name="id_kategori">
                                        <?php
                                        $kategori = model('Kategori')->findAll();
                                        foreach ($kategori as $v) : 
                                            if (old('id_kategori') == $v['id']) {
                                                $selected = 'selected';
                                            }elseif ($data['id_kategori'] == $v['id']) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }
                                        ?>
                                        <option value="<?= $v['id'] ?>" <?= $selected ?> ><?= $v['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $val->getError('id_kategori') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!--  -->
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
</section>
