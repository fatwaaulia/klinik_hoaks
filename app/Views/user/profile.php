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
                    <form action="<?= base_url($route.'/update') ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <div class="wh-150 position-relative">
                                    <?php
                                    if ($data['img']) {
                                        $img = base_url('assets/img/'.$name.'/'.$data['img']);
                                    } else {
                                        $img = base_url('assets/img/user-default.png');
                                    }
                                    ?>
                                        <img src="<?= $img ?>" class="w-100 h-100 img-style rounded-circle" id="frame">
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
                                                            <?php if ($data['img']) : ?>
                                                            <!-- Tombol hapus foto profil -->
                                                            <div class="mt-3">
                                                                <a href="#" class="text-secondary" data-bs-toggle="modal" data-bs-target="#deleteImage">
                                                                    <i class="fa-solid fa-trash-can fa-lg"></i>
                                                                    Hapus
                                                                </a>
                                                            </div>
                                                            <?php endif; ?>
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
                                    <input type="text" class="form-control <?= $val->hasError('nama') ? "is-invalid" : '' ?>" name="nama" value="<?= old('nama')??$data['nama'] ?>" id="nama" placeholder="Masukkan namamu">
                                    <div class="invalid-feedback">
                                        <?= $val->getError('nama') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control <?= $val->hasError('username') ? "is-invalid" : '' ?>" name="username" value="<?= old('username')??$data['username'] ?>" id="username" placeholder="Masukkan username">
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
                                        }elseif ($data['jenis_kelamin'] == $v) {
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
                                    <textarea class="form-control <?= $val->hasError('alamat') ? "is-invalid" : '' ?>" name="alamat" id="alamat" rows="3" placeholder="Masukkan alamat"><?= old('alamat')??$data['alamat'] ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= $val->getError('alamat') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="telp" class="form-label">No. Telp</label>
                                    <input type="number" class="form-control <?= $val->hasError('telp') ? "is-invalid" : '' ?>" name="telp" value="<?= old('telp')??$data['telp'] ?>" id="telp" placeholder="08xxx">
                                    <div class="invalid-feedback">
                                        <?= $val->getError('telp') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" value="<?= $data['email'] ?>" id="email" disabled>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#ubah_password">
                                        <i class="fa-solid fa-lock me-2"></i>
                                        <span class="align-middle">Ubah Password</span>
                                    </a>
                                </div>
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


<!-- Modal hapus foto profil -->
<div class="modal fade" id="deleteImage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Hapus foto profil ?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <form action="<?= base_url('profile/delete/image') ?>" method="post">
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
        </div>
    </div>
</div>

<!-- Modal ubah password -->
<div class="modal fade" id="ubah_password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url().'/profile/update/password' ?>" method="post">
                <div class="modal-body">
                        <div class="mb-3">
                            <label for="oldpass" class="form-label">Password Saat Ini</label>
                            <div class="position-relative">
                                <input onkeyup="changeOldpass()" type="password" class="form-control" name="oldpass" value="<?= old('oldpass') ?>" id="oldpass" placeholder="Password saat ini">
                                <i class="bi bi-eye fa-lg position-absolute" id="oldpassEye" style="right:12px;top:8px;z-index:100"></i>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <div class="mb-2 position-relative">
                                <input onkeyup="changePassword()" type="password" class="form-control" name="password" value="<?= old('password') ?>" id="password" placeholder="Password baru">
                                <div class="invalid-feedback">
                                    <span id="msg_password"></span>
                                </div>
                                <i class="bi bi-eye fa-lg position-absolute" id="passwordEye" style="right:12px;top:8px;z-index:100"></i>
                            </div>
                            <div class="position-relative">
                                <input onkeyup="changePassconf()" type="password" class="form-control" name="passconf" value="<?= old('passconf') ?>" id="passconf" placeholder="Confirm password">
                                <div class="invalid-feedback">
                                    <span id="msg_passconf"></span>
                                </div>
                                <i class="bi bi-eye fa-lg position-absolute" id="passconfEye" style="right:12px;top:8px;z-index:100"></i>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="simpan_password" disabled>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// VALIDASI PASSWORD
function changeOldpass() {
    let str_oldpass = $('#oldpass').val();
    let str_password = $('#password').val();
    let str_passconf = $('#passconf').val();
    if (str_oldpass) {
        if (str_password.length >= 8 && str_passconf.length >= 8) {
            if (str_passconf == str_password) {
                $('#simpan_password').prop( "disabled", false);
            }
        }
    } else {
        $('#simpan_password').prop( "disabled", true);
    }
}
function changePassword() {
    let str_oldpass = $('#oldpass').val();
    let str_password = $('#password').val();
    let str_passconf = $('#passconf').val();
    if (str_password.length < 8) {
        // kurang dari 8 karakter
        $('#password').addClass('is-invalid');
        $('#msg_password').html('minimal 8 karakter');
        $('#simpan_password').prop( "disabled", true);
    } else if (str_passconf != str_password) {
        // password dan passconf tidak sama
        $('#password').removeClass('is-invalid');
        $('#passconf').addClass('is-invalid');
        $('#msg_passconf').html('password tidak sama');
        $('#simpan_password').prop( "disabled", true);
    } else if (str_passconf == str_password) {
        // true
        $('#password').removeClass('is-invalid');
        $('#msg_password').html('');
        $('#passconf').removeClass('is-invalid');
        $('#msg_passconf').html('');
        if (str_oldpass) {
            $('#simpan_password').prop( "disabled", false);
        } else {
            $('#simpan_password').prop( "disabled", true);
        }
    }
}
function changePassconf() {
    let str_oldpass = $('#oldpass').val();
    let str_password = $('#password').val();
    let str_passconf = $('#passconf').val();
    if (str_passconf.length < 8) {
        // kurang dari 8 karakter
        $('#passconf').addClass('is-invalid');
        $('#msg_passconf').html('minimal 8 karakter');
        $('#simpan_password').prop( "disabled", true);
    } else if (str_passconf != str_password) {
        // password dan passconf tidak sama
        $('#passconf').addClass('is-invalid');
        $('#msg_passconf').html('password tidak sama');
        $('#simpan_password').prop( "disabled", true);
    } else if (str_passconf == str_password) {
        // true
        $('#password').removeClass('is-invalid');
        $('#msg_password').html('');
        $('#passconf').removeClass('is-invalid');
        $('#msg_passconf').html('');
        if (str_oldpass) {
            $('#simpan_password').prop( "disabled", false);
        } else {
            $('#simpan_password').prop( "disabled", true);
        }
    }
}
</script>
