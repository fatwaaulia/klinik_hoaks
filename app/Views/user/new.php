<section>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h5 class="my-4 fw-500"><?= isset($title) ? $title : '' ?></h5>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="<?= $route.'/create' ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <div class="wh-150 position-relative">
                                        <img src="<?= base_url('assets/img/user-default.png') ?>" class="w-100 h-100 img-style rounded-circle" id="frame">
                                        <div class="position-absolute" style="bottom:0px;right:0px">
                                            <button class="btn btn-secondary rounded-circle" style="padding:10px" type="button" data-bs-toggle="modal" data-bs-target="#option">
                                                <i class="fa-solid fa-camera fa-xl"></i>
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
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control <?= $val->hasError('nama') ? "is-invalid" : '' ?>" name="nama" id="nama" value="<?= old('nama') ?>" placeholder="Masukkan namamu">
                                    <div class="invalid-feedback">
                                        <?= $val->getError('nama') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control <?= $val->hasError('username') ? "is-invalid" : '' ?>" name="username" value="<?= old('username') ?>" id="username" placeholder="Masukkan username">
                                    <div class="invalid-feedback">
                                        <?= $val->getError('username') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select <?= $val->hasError('jenis_kelamin') ? "is-invalid" : '' ?>" name="jenis_kelamin">
                                        <?php
                                        $jenis_kelamin = ['Laki-laki', 'Perempuan'];
                                        foreach ($jenis_kelamin as $v) : 
                                            
                                        if (old('jenis_kelamin') == $v) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                        ?>
                                        <option value="<?= $v ?>" <?= $selected ?> ><?= $v ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $val->getError('jenis_kelamin') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control <?= $val->hasError('alamat') ? "is-invalid" : '' ?>" name="alamat" id="alamat" rows="3" placeholder="Masukkan alamat"><?= old('alamat') ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= $val->getError('alamat') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="id_role" class="form-label">Role</label>
                                    <select class="form-select <?= $val->hasError('id_role') ? "is-invalid" : '' ?>" name="id_role">
                                        <?php
                                        $role = model('Role')->find(['2', '3']);
                                        foreach ($role as $v) : 
                                            
                                        if (old('id_role') === $v['id']) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                        ?>
                                        <option value="<?= $v['id'] ?>" <?= $selected ?> ><?= $v['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $val->getError('id_role') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="telp" class="form-label">No. Telp</label>
                                    <input type="text" class="form-control <?= $val->hasError('telp') ? "is-invalid" : '' ?>" name="telp" id="telp" value="<?= old('telp') ?>" placeholder="08xxx">
                                    <div class="invalid-feedback">
                                        <?= $val->getError('telp') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control <?= $val->hasError('email') ? "is-invalid" : '' ?>" name="email" id="email" value="<?= old('email') ?>" placeholder="name@gmail.com">
                                    <div class="invalid-feedback">
                                        <?= $val->getError('email') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="mb-2 position-relative">
                                        <input type="password" class="form-control <?= $val->hasError('password') ? "is-invalid" : '' ?>" name="password" id="password" value="<?= old('password') ?>" placeholder="Password">
                                        <div class="invalid-feedback">
                                            <?= $val->getError('password') ?>
                                        </div>
                                        <i class="bi bi-eye fa-lg position-absolute" id="passwordEye" style="right:12px;top:8px;z-index:100"></i>
                                    </div>
                                    <div class="position-relative">
                                        <input type="password" class="form-control <?= $val->hasError('passconf') ? "is-invalid" : '' ?>" name="passconf" id="passconf" value="<?= old('passconf') ?>" placeholder="Confirm password">
                                        <div class="invalid-feedback">
                                            <?= $val->getError('passconf') ?>
                                        </div>
                                        <i class="bi bi-eye fa-lg position-absolute" id="passconfEye" style="right:12px;top:8px;z-index:100"></i>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">Tambahkan</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
</section>