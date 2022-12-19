<section>
<div class="container position-absolute top-50 start-50 translate-middle">
	<div class="row">
		<div class="offset-lg-4 col-lg-4 offset-lg-4">

			<div class="card">
				<div class="card-body">
					<h4 class="mb-2 fw-600">Selamat datang👋</h4>
					<p class="mb-4">Silakan masuk ke akun Anda.</p>

					<form class="mb-3" action="<?= base_url().'/login-process' ?>" method="POST">
						<div class="mb-3">
							<label for="email" class="form-label">Email</label>
							<input type="email" class="form-control <?= $val->hasError('email') ? "is-invalid" : '' ?>" id="email" name="email" placeholder="name@gmail.com" autofocus autocomplete="off">
							<div class="invalid-feedback">
								<?= $val->getError('email') ?>
							</div>
						</div>
						<div class="mb-3">
							<div class="d-flex justify-content-between">
								<label class="form-label" for="password">Password</label>
								<a href="<?= base_url('forgot-password') ?>">
								<small>Lupa Password?</small>
								</a>
							</div>
							<div class="position-relative">
								<input type="password" class="form-control <?= $val->hasError('password') ? "is-invalid" : '' ?>" id="password" name="password" placeholder="Password" autocomplete="off">
								<div class="invalid-feedback">
									<?= $val->getError('password') ?>
								</div>
								<i class="bi bi-eye fa-lg position-absolute" id="passwordEye" style="right:12px;top:8px;z-index:100"></i>
							</div>
						</div>
						<div class="mb-3">
							<button class="btn btn-primary d-grid w-100" type="submit">Masuk</button>
						</div>
					</form>

					<!-- <div class="text-center">
						<span>Belum punya akun?</span>
						<a href="<?= base_url('register') ?>">
						<span>Daftar</span>
						</a>
					</div> -->
				</div>
			</div>

		</div>
	</div>
</div>
</section>