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
                                    <label for="nama" class="form-label">Tiket</label>
                                    <input type="text" class="form-control" value="<?= $data['kode'] ?>" id="kode" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama" value="<?=$data['nama'] ?>" id="nama" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="telp" class="form-label">No. Telp</label>
                                    <input type="number" class="form-control" name="telp" value="<?= old('telp')??$data['telp'] ?>" id="telp" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="<?= $data['email'] ?>" id="email" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Isi Pengaduan</label>
                                    <textarea class="form-control <?= $val->hasError('deskripsi') ? "is-invalid" : '' ?>" id="deskripsi" rows="3" disabled><?= $data['deskripsi'] ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <div class="w-50 position-relative">
                                    <?php
                                    if ($data['img']) {
                                        $img = base_url('assets/img/'.$name.'/'.$data['img']);
                                    } else {
                                        $img = base_url('assets/img/default.png');
                                    }
                                    ?>
                                        <img src="<?= $img ?>" class="w-100 h-100 img-style" id="frame">
                                    </div>
                                    <span class="<?= $val->hasError('img') ? "is-invalid" : '' ?>">
                                    </span>
                                    <div class="invalid-feedback">
                                        <?= $val->getError('img') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="sumber" class="form-label">Sumber</label>
                                    <input type="text" class="form-control <?= $val->hasError('sumber') ? "is-invalid" : '' ?>" id="sumber" value="<?= $data['sumber'] ?>" disabled>
                                </div>
                                <hr>

                                <link rel="stylesheet" href="https://unpkg.com/@jarstone/dselect/dist/css/dselect.css">
                                <script src="https://unpkg.com/@jarstone/dselect/dist/js/dselect.js"></script>

                                <div class="mb-3">
                                    <label for="" class="form-label">Status</label> <span class="text-secondary">Pilih informasi untuk klarifikasi</span>
                                    <select class="form-select <?= $val->hasError('id_informasi') ? "is-invalid" : '' ?>" name="id_informasi" id="select_box">
                                    <option value="">-Pilih Informasi-</option>
                                        <?php
                                        $role = model('Informasi')->orderBy('id','DESC')->findAll();
                                        foreach ($role as $v) : 
                                            if ($data['id_informasi'] == $v['id']) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }
                                        ?>
                                        <option value="<?= $v['id'] ?>" <?= $selected ?>><?= $v['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $val->getError('id_informasi') ?>
                                    </div>
                                </div>

                                <script>
                                var select_box = document.querySelector('#select_box');
                                dselect(select_box, {
                                    search: true
                                });
                                </script>

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
