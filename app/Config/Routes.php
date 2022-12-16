<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override(
    function(){
        $data['title'] = '404';
        
        $field = [
            'ip_address' => getHostByName(getHostName()),
            'url'        => current_url(),
        ];
        model('Handling_404')->insert($field);

        $data['content'] = view('errors/e404');
        return view('dashboard/header',$data);
    }
);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
$routes->get('/', 'Landingpage::home');

// Pengaduan Masyarakat
$routes->get('pengaduan/klarifikasi', 'Landingpage::pengaduanKlarifikasi');
$routes->get('pengaduan/lacak-tiket', 'Landingpage::lacakTiket');
// Subscribe
$routes->get('subscribe', 'Landingpage::subscribe');
$routes->post('create-subscribe', 'Landingpage::createSubscribe');
$routes->get('delete-subscribe/(:any)', 'Landingpage::deleteSubscribe/$1');

// AUTENTIKASI
// Login
$routes->get('login', 'Auth::login');
$routes->post('login-process', 'Auth::loginProcess');
$routes->get('logout', 'Auth::logout');
// Lupa password
$routes->get('forgot-password', 'Auth::forgotPassword');
$routes->post('forgot-password-process', 'Auth::forgotPasswordProcess');
$routes->get('reset-password/(:any)', 'Auth::resetPassword/$1');
$routes->post('reset-password-process/(:any)', 'Auth::resetPasswordProcess/$1');
// Register
$routes->get('register', 'Auth::register');
$routes->post('register-process', 'Auth::registerProcess');
// Aktivasi akun
$routes->get('account-activation/(:any)', 'Auth::accountActivation/$1');

// SEND EMAIL
$routes->get('email-template', 'Auth::template');

// IS LOGIN
$routes->get('dashboard', 'Dashboard::dashboard', ['filter' => 'Auth']);

// PROFILE
$routes->group('profile', ['filter' => 'Auth'], static function ($routes) {
$routes->get('/', 'User::profile');
$routes->post('update', 'User::updateProfile');
$routes->post('update/password', 'User::updatePassword');
$routes->post('delete/image', 'User::deleteProfileImg');
});

// SUPERADMIN
// User
$routes->group('user', ['filter' => 'Superadmin'], static function ($routes) {
    $routes->get('/', 'User::index');
    $routes->get('new', 'User::new');
    $routes->post('create', 'User::create');
    $routes->get('edit/(:segment)', 'User::edit/$1');
    $routes->post('update/(:segment)', 'User::update/$1');
    $routes->post('delete/(:segment)', 'User::delete/$1');
    $routes->post('delete-image/(:segment)', 'User::deleteImg/$1');
});
// Pengaduan
$routes->group('pengaduan', static function ($routes) {
    $routes->get('/', 'Pengaduan::index', ['filter' => 'Superadmin']);
    // $routes->get('new', 'Pengaduan::new');
    $routes->post('create', 'Pengaduan::create');
    $routes->get('edit/(:segment)', 'Pengaduan::edit/$1', ['filter' => 'Superadmin']);
    $routes->post('update/(:segment)', 'Pengaduan::update/$1', ['filter' => 'Superadmin']);
    $routes->post('delete/(:segment)', 'Pengaduan::delete/$1', ['filter' => 'Superadmin']);
});
// Berita
$routes->group('informasi', ['filter' => 'Superadmin'], static function ($routes) {
    $routes->get('/', 'Informasi::index');
    $routes->get('new', 'Informasi::new');
    $routes->post('create', 'Informasi::create');
    $routes->get('edit/(:segment)', 'Informasi::edit/$1');
    $routes->post('update/(:segment)', 'Informasi::update/$1');
    $routes->post('delete/(:segment)', 'Informasi::delete/$1');
});
// Platform
$routes->group('platform', ['filter' => 'Superadmin'], static function ($routes) {
    $routes->get('/', 'Platform::index');
    $routes->get('new', 'Platform::new');
    $routes->post('create', 'Platform::create');
    $routes->get('edit/(:segment)', 'Platform::edit/$1');
    $routes->post('update/(:segment)', 'Platform::update/$1');
    $routes->post('delete/(:segment)', 'Platform::delete/$1');
});
$routes->get('subscriber', 'Dashboard::subscriber', ['filter' => 'Superadmin']);
// Handling 404
$routes->group('handling-404', ['filter' => 'Superadmin'], static function ($routes) {
    $routes->get('/', 'Handling_404::index');
    $routes->post('delete/(:segment)', 'Handling_404::delete/$1');
    $routes->post('delete-all', 'Handling_404::deleteAll');
});


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
