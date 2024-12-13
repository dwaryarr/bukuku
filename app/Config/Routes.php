<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/products', 'Product::index');
$routes->get('/product/(:num)', 'Product::detail/$1');
$routes->get('/popular-products', 'Product::popular');
$routes->get('/new-arrivals', 'Product::new_arrivals');

// Auth
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::loginAuth');
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::store');
$routes->get('/logout', 'Auth::logout');

// Order
$routes->get('/cart', 'Order::cart');
$routes->get('/cart/add/(:num)', 'Order::add_to_cart/$1');
$routes->post('/cart/add/(:num)', 'Order::add_to_cart/$1');
$routes->post('/cart/update/(:num)', 'Order::update_cart_qty/$1');
$routes->delete('/cart/remove/(:num)', 'Order::remove_from_cart/$1');
$routes->get('/cart/clear', 'Order::clear_cart');

$routes->group('', ['filter' => 'authcheck:user'], function ($routes) {
    $routes->post('/checkout', 'Order::checkout');
    $routes->get('/pembayaran/(:num)', 'Order::pembayaran/$1');
    $routes->post('/pembayaran/(:num)', 'Order::upload_bukti_bayar/$1');
    $routes->get('/order-detail/(:num)', 'Order::detail/$1');
    $routes->get('/riwayat-order', 'Order::index');
});

$routes->group('', ['filter' => 'authcheck:admin'], function ($routes) {
    $routes->get('/admin', 'Admin::index');
    $routes->get('/admin/orders', 'Order::admin_order');
    $routes->get('/admin/order-detail/(:num)', 'Order::admin_order_detail/$1');
    $routes->get('/admin/order/delete/(:num)', 'Order::admin_delete_order/$1');

    $routes->get('/admin/products', 'Product::products');
    $routes->get('/admin/product/add', 'Product::add_product');
    $routes->post('/admin/product/add', 'Product::store');
    $routes->get('/admin/product/edit/(:num)', 'Product::edit_product/$1');
    $routes->post('/admin/product/edit/(:num)', 'Product::update_product/$1');
    $routes->get('/admin/product/delete/(:num)', 'Product::delete_product/$1');

    $routes->get('/admin/categories', 'Product::categories');
    $routes->post('/admin/category/add', 'Product::add_category');
    $routes->post('/admin/category/edit/(:num)', 'Product::update_category/$1');
});

$routes->group('', ['filter' => 'authcheck:user,admin'], function ($routes) {
    $routes->get('/profil', 'Auth::profil');
    $routes->post('/profil', 'Auth::edit_profil');
});
