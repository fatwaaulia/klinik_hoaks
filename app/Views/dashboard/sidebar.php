<?php 
// USER SESSION
$user_session = session()->get('user');
$user = model('User')->where('id', $user_session['id'])->first();
?>


<div class="wrapper">
	<nav id="sidebar" class="sidebar js-sidebar">
		<div class="sidebar-content js-simplebar">
			<a class="sidebar-brand" href="<?= base_url('dashboard') ?>">
				<img src="<?= base_url().'/assets/img/logo-seal.png' ?>" class="w-100" alt="<?= getenv('app.name') ?>">
			</a>

			<ul class="sidebar-nav">

				<!-- Sidebar Menu -->
				<?php
				$sidebar = [
					// SEMUA ROLE
					[
						'text'    => 'Dashboard',
						'url'     => 'dashboard',
						'icon'    => 'fa-solid fa-house',
						'active'  => 'dashboard',
						'role'    => ['1','2','3'],
					],
					// SUPERADMIN
					[
						'text'    => 'Kelola Pengguna',
						'url'     => 'user',
						'icon'    => 'fa-solid fa-user-group',
						'active'  => 'user',
						'role'    => ['1'],
					],
					[
						'text'    => 'VALIDASI BERITA',
						'role'   => ['1'],
					],
					[
						'text'    => 'Pengaduan',
						'url'     => 'pengaduan',
						'icon'    => 'fa-regular fa-paper-plane',
						'active'  => 'pengaduan',
						'role'    => ['1'],
					],
					[
						'text'    => 'BERITA',
						'role'   => ['1'],
					],
					[
						'text'    => 'Informasi',
						'url'     => 'informasi',
						'icon'    => 'fa-solid fa-newspaper',
						'active'  => 'informasi',
						'role'    => ['1'],
					],
					[
						'text'    => 'Platform',
						'url'     => 'platform',
						'icon'    => 'fa-solid fa-hashtag',
						'active'  => 'platform',
						'role'    => ['1'],
					],
					[
						'text'    => 'Subscriber',
						'url'     => 'subscriber',
						'icon'    => 'fa-solid fa-check',
						'active'  => 'subscriber',
						'role'    => ['1'],
					],
					[
						'text'    => 'KEAMANAN',
						'role'   => ['1'],
					],
					[
						'text'    => 'Handling 404',
						'url'     => 'handling-404',
						'icon'    => 'fa-solid fa-circle-exclamation',
						'active'  => 'handling-404',
						'role'    => ['1'],
					],
					// ADMIN
					// == sidebar
					// STARTED
					// == sidebar
					// SEMUA ROLE
					[
						'text'    => 'AKUN SAYA',
						'role'   => ['1','2','3'],
					],
					[
						'text'    => 'Profil',
						'url'     => 'profile',
						'icon'    => 'fa-regular fa-user',
						'active'  => 'profile',
						'role'    => ['1','2','3'],
					],
					[
						'text'    => 'Keluar',
						'url'     => 'logout',
						'icon'    => 'fa-solid fa-arrow-right-from-bracket',
						'active'  => '',
						'role'    => ['1','2','3'],
					],

				];
				?>

				<?php 
				$uri_1 = service('uri')->getSegment(1);
				foreach ($sidebar as $v) : 
					// Cek role
					if ( in_array($user['id_role'], $v['role'] )) :
						// Cek url
						if (!empty($v['url'])) {
							
							if ($uri_1 == $v['active']) {
								$active = 'active';
							} else {
								$active = '';
							}
							?>
							<li class="sidebar-item <?= $active ?>">
								<a class="sidebar-link" href="<?= base_url().'/'.$v['url'] ?>">
									<i class="align-middle <?= $v['icon'] ?>"></i> <span class="align-middle"><?= $v['text'] ?></span>
								</a>
							</li>
					<?php } else { ?>
						<li class="sidebar-header">
							<?= $v['text'] ?>
						</li>
					<?php } ?>
				<?php 
					endif;
				endforeach; 
				?>
		</div>
	</nav>

	<div class="main">
		<nav class="navbar navbar-expand navbar-light navbar-bg">
			<a class="sidebar-toggle js-sidebar-toggle">
				<i class="hamburger align-self-center"></i>
			</a>

			<div class="navbar-collapse collapse">
				<ul class="navbar-nav navbar-align">
					<li class="nav-item dropdown">
						<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
							<i class="align-middle" data-feather="settings"></i>
						</a>

						<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
						<?php
								if ($user['img']) {
									$img = base_url('assets/img/user/'.$user['img']);
								} else {
									$img = base_url('assets/img/user-default.png');
								}
							?>
							<img src="<?= $img ?>" class="avatar img-fluid img-style rounded-circle me-1" alt="" /> <span class="text-dark"><?= mb_strimwidth($user['nama'], 0, 15, "..."); ?></span>
						</a>
						<div class="dropdown-menu dropdown-menu-end">
							<a class="dropdown-item" href="<?= base_url().'/profile' ?>">
								<i class="fa-regular fa-user me-1"></i>
								Profil
							</a>
								<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="<?= base_url().'/logout' ?>">
								<i class="fa-solid fa-arrow-right-from-bracket me-1"></i>
								Keluar
							</a>
						</div>
					</li>
				</ul>
			</div>
		</nav>
