<section>
<div class="container position-absolute top-50 start-50 translate-middle">
	<div class="row">
		<div class="offset-lg-4 col-lg-4 offset-lg-4">

			<div class="card">
				<div class="card-body">
					<h4 class="mb-2 fw-600">Reset Password</h4>
					<p class="mb-4"><?= $user['email'] ?></p>

					<form class="mb-3" action="<?= base_url().'/reset-password-process/'.$user['token'] ?>" method="POST">
						<div class="mb-3">
							<label for="password" class="form-label">Password Baru</label>
							<div class="mb-2 position-relative">
								<input type="password" class="form-control <?= $val->hasError('password') ? "is-invalid" : '' ?>" name="password" id="password" value="<?= old('password') ?>" placeholder="Password baru">
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
						<div class="mb-3">
							<button class="btn btn-primary d-grid w-100" type="submit">Simpan</button>
						</div>
					</form>

					<div class="text-center">
						<a href="<?= base_url('login') ?>">
						<span>
							<i class="fa-solid fa-angle-left me-1"></i>
							Kembali
						</span>
						</a>
					</div>
				</div>
			</div>			

		</div>
	</div>
</div>
</section>