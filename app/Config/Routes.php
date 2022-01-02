<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/homes', 'Home::homes');
$routes->get('/homes/(:any)/contact', 'Home::home_contact/$1');
$routes->post('/homes/(:any)/contact', 'Home::home_contact/$1');
$routes->get('/homes/(:any)', 'Home::home_details/$1');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::login_post');
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::register_post');
$routes->get('/logout', 'Auth::logout');

$routes->get('/account/messages', 'Account::messages');
$routes->get('/account/messages/(:any)', 'Account::discussion/$1');
$routes->post('/account/messages/(:any)', 'Account::discussion/$1');
$routes->get('/account/homes', 'Account::homes');
$routes->get('/account/homes/add', 'Account::add_home');
$routes->post('/account/homes/add', 'Account::add_home');
$routes->get('/account/homes/(:any)/edit', 'Account::edit_home/$1');
$routes->post('/account/homes/(:any)/edit', 'Account::edit_home/$1');
$routes->get('/account/homes/(:any)/publish', 'Account::publish_home/$1');
$routes->post('/account/homes/(:any)/publish', 'Account::publish_home/$1');
$routes->get('/account/homes/(:any)/delete', 'Account::delete_home/$1');
$routes->post('/account/homes/(:any)/delete', 'Account::delete_home/$1');
$routes->get('/account/homes/(:any)/archive', 'Account::archive_home/$1');
$routes->post('/account/homes/(:any)/archive', 'Account::archive_home/$1');
$routes->get('/account/homes/(:any)', 'Account::home/$1');
$routes->get('/account/settings', 'Account::settings');
$routes->post('/account/settings', 'Account::settings');
$routes->get('/account/settings/delete', 'Account::delete');
$routes->post('/account/settings/delete', 'Account::delete');

$routes->get('/admin/users', 'Admin::users');
$routes->get('/admin/users/(:any)/mail', 'Admin::user_mail/$1');
$routes->get('/admin/users/(:any)/delete', 'Admin::user_delete/$1');
$routes->post('/admin/users/(:any)/delete', 'Admin::user_delete/$1');
$routes->get('/admin/users/(:any)/block', 'Admin::user_block/$1');
$routes->post('/admin/users/(:any)/block', 'Admin::user_block/$1');
$routes->get('/admin/users/(:any)/unblock', 'Admin::user_unblock/$1');
$routes->post('/admin/users/(:any)/unblock', 'Admin::user_unblock/$1');
$routes->get('/admin/users/(:any)', 'Admin::user/$1');
$routes->post('/admin/users/(:any)', 'Admin::user/$1');
$routes->get('/admin/homes', 'Admin::homes');
$routes->get('/admin/homes/(:any)/messages/(:any)', 'Admin::delete_discussion/$1/$2');
$routes->post('/admin/homes/(:any)/messages/(:any)', 'Admin::delete_discussion/$1/$2');
$routes->get('/admin/homes/(:any)/block', 'Admin::block_home/$1');
$routes->post('/admin/homes/(:any)/block', 'Admin::block_home/$1');
$routes->get('/admin/homes/(:any)/unblock', 'Admin::unblock_home/$1');
$routes->post('/admin/homes/(:any)/unblock', 'Admin::unblock_home/$1');
$routes->get('/admin/homes/(:any)/delete', 'Admin::delete_home/$1');
$routes->post('/admin/homes/(:any)/delete', 'Admin::delete_home/$1');
$routes->get('/admin/homes/(:any)', 'Admin::home/$1');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
