<section>
<div class="container position-absolute top-50 start-50 translate-middle">
	<div class="row">
		<div class="offset-lg-4 col-lg-4 offset-lg-4">

			<div class="card">
				<div class="card-body">
					<h4 class="mb-2 fw-600">Daftar</h4>
					<p class="mb-4">Buat akun cepat dan mudah.</p>

					<form class="mb-3" action="<?= base_url().'/register-process' ?>" method="POST">
						<div class="mb-3">
							<label for="nama" class="form-label">Nama Lengkap</label>
							<input type="nama" class="form-control <?= $val->hasError('nama') ? "is-invalid" : '' ?>" id="nama" name="nama" value="<?= old('nama') ?>" placeholder="Nama Lengkap" autofocus autocomplete="off">
							<div class="invalid-feedback">
								<?= $val->getError('nama') ?>
							</div>
						</div>
						<div class="mb-3">
						<label for="email" class="form-label">Email</label>
							<input type="email" class="form-control <?= $val->hasError('email') ? "is-invalid" : '' ?>" id="email" name="email" value="<?= old('email') ?>" placeholder="name@gmail.com" autocomplete="off">
							<div class="invalid-feedback">
								<?= $val->getError('email') ?>
							</div>
						</div>
						<div class="mb-3">
							<label for="password" class="form-label">Password</label>
							<div class="mb-2 position-relative">
								<input type="password" class="form-control <?= $val->hasError('password') ? "is-invalid" : '' ?>" name="password" id="password" value="<?= old('password') ?>" placeholder="Password" autocomplete="off">
								<div class="invalid-feedback">
									<?= $val->getError('password') ?>
								</div>
								<i class="bi bi-eye fa-lg position-absolute" id="passwordEye" style="right:12px;top:8px;z-index:100"></i>
							</div>
							<div class="position-relative">
								<input type="password" class="form-control <?= $val->hasError('passconf') ? "is-invalid" : '' ?>" name="passconf" id="passconf" value="<?= old('passconf') ?>" placeholder="Confirm password" autocomplete="off">
								<div class="invalid-feedback">
									<?= $val->getError('passconf') ?>
								</div>
								<i class="bi bi-eye fa-lg position-absolute" id="passconfEye" style="right:12px;top:8px;z-index:100"></i>
							</div>
						</div>

						<div class="mb-3">
						<button class="btn btn-primary d-grid w-100" type="submit">Daftar</button>
						</div>
					</form>

					<div class="text-center">
						<span>Sudah memiliki akun?</span>
						<a href="<?= base_url('login') ?>">
						<span>Masuk</span>
						</a>
					</div>
				</div>
			</div>			

		</div>
	</div>
</div>
</section>