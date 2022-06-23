<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Admin ===================================================================================================

// Admin Auth
$route['admin/login'] = 'auth/admin/login';

// Slider
$route['admin/slider'] = 'admin/slider';
$route['admin/slider/halaman/(:num)'] = 'admin/slider/index/$1';
$route['admin/slider/(:num)'] = 'admin/slider/single/$1';
$route['admin/slider/tambah'] = 'admin/slider/store_index';
$route['admin/slider/tambah/execute'] = 'admin/slider/store';
$route['admin/slider/edit/(:num)'] = 'admin/slider/edit_index/$1';
$route['admin/slider/edit/execute'] = 'admin/slider/edit';
$route['admin/slider/hapus/(:num)'] = 'admin/slider/destroy/$1';

// Kategori
$route['admin/kategori'] = 'admin/kategori';
$route['admin/kategori/halaman/(:num)'] = 'admin/kategori/index/$1';
$route['admin/kategori/(:num)'] = 'admin/kategori/single/$1';
$route['admin/kategori/tambah'] = 'admin/kategori/store_index';
$route['admin/kategori/tambah/execute'] = 'admin/kategori/store';
$route['admin/kategori/edit/(:num)'] = 'admin/kategori/edit_index/$1';
$route['admin/kategori/edit/execute'] = 'admin/kategori/edit';
$route['admin/kategori/hapus/(:num)'] = 'admin/kategori/destroy/$1';

// Transaksi
$route['admin/transaksi'] = 'admin/transaksi';
$route['admin/transaksi/halaman/(:num)'] = 'admin/transaksi/index/$1';
$route['admin/transaksi/halaman'] = 'admin/transaksi/index';
$route['admin/transaksi/konfirmasi/(:num)'] = 'admin/transaksi/konfirmasi_index/$1';
$route['admin/transaksi/konfirmasi'] = 'admin/transaksi/konfirmasi';

// Saldo Toko
// $route['admin/saldo-toko/pengeluaran'] = 'admin/saldo';
// $route['admin/saldo-toko/pengeluaran/halaman/(:num)'] = 'admin/saldo/index/$1';
// $route['admin/saldo-toko/pengeluaran/konfirmasi'] = 'admin/saldo/store';


// User ====================================================================================================

// User Auth
$route['login'] = 'auth/user/login';
$route['register']['get'] = 'auth/user/daftar';
$route['register']['post'] = 'auth/user/register';
$route['logout'] = 'auth/user/logout';
$route['reset-password'] = 'auth/user/reset_password_index';
$route['reset-password/store'] = 'auth/user/send_email';
$route['reset-password/key/(:any)'] = 'auth/user/set_password_index/$1';
$route['reset-password/set-password'] = 'auth/user/set_password';
$route['aktivasi/key/(:any)'] = 'auth/user/set_aktif/$1';

// Profil
$route['user/profil'] = 'user/profil';
$route['user/profil/edit'] = 'user/profil/edit';

// Password
$route['user/password/change'] = 'user/password/change_password';

// Wishlist
$route['user/wishlist'] = 'user/wishlist';
$route['user/wishlist/(:num)'] = 'user/wishlist/index/$1';
$route['user/wishlist/delete/(:num)'] = 'user/wishlist/destroy/$1';
$route['user/wishlist/store/(:num)'] = 'user/wishlist/store/$1';

// Keranjang
$route['user/keranjang'] = 'user/keranjang';
$route['user/keranjang/(:num)'] = 'user/keranjang/index/$1';
$route['user/keranjang/single/(:num)'] = 'user/keranjang/single/$1';
$route['user/keranjang/edit/(:num)'] = 'user/keranjang/edit_page/$1';
$route['user/keranjang/edit-keranjang'] = 'user/keranjang/edit';
$route['user/keranjang/delete/(:num)'] = 'user/keranjang/destroy/$1';
$route['user/keranjang/store/(:num)/(:num)'] = 'user/keranjang/store/$1/$2';
$route['user/keranjang/ajax'] = 'user/keranjang/get_ajax';
$route['user/keranjang/delete-ajax/(:num)'] = 'user/keranjang/destroy_ajax/$1';

// Alamat
$route['user/alamat'] = 'user/alamat';
$route['user/alamat/(:num)'] = 'user/alamat/index/$1';
$route['user/alamat/tambah'] = 'user/alamat/create_page';
$route['user/alamat/store']['post'] = 'user/alamat/store';
$route['user/alamat/edit/(:num)'] = 'user/alamat/edit_page/$1';
$route['user/alamat/delete/(:num)'] = 'user/alamat/destroy/$1';

// Transaksi
$route['user/transaksi'] = 'user/transaksi';
$route['user/transaksi/detail/(:num)'] = 'user/transaksi/single/$1';
$route['user/transaksi/add/(:num)'] = 'user/transaksi/store/$1';
$route['user/transaksi/bayar-sekarang/(:num)'] = 'user/transaksi/bayar_index/$1';
$route['user/transaksi/bayar'] = 'user/transaksi/bayar';
$route['user/transaksi/batalkan-transaksi/(:num)'] = 'user/transaksi/batal/$1';
$route['user/transaksi/terima-barang/(:num)'] = 'user/transaksi/terima/$1';

// Toko
$route['user/toko'] = 'user/toko';
$route['user/toko/edit'] = 'user/toko/edit';
$route['user/toko/(:num)'] = 'user/toko/index/$1';
$route['user/toko/konfigurasi'] = 'user/toko/configuration';
$route['user/toko/set-aktivasi'] = 'user/toko/aktivasi';

// Pesanan Toko
$route['user/toko/pesanan'] = 'user/pesanantoko';
$route['user/toko/pesanan/halaman/(:num)'] = 'user/pesanantoko/index/$1';
$route['user/toko/pesanan/detail/(:num)'] = 'user/pesanantoko/single/$1';
$route['user/toko/pesanan/konfirmasi/(:num)'] = 'user/pesanantoko/konfirmasi_index/$1';
$route['user/toko/pesanan/konfirmasi/execute'] = 'user/pesanantoko/konfirmasi';

// Produk
$route['user/toko/produk'] = 'user/produk';
$route['user/toko/produk/halaman/(:num)'] = 'user/produk/index/$1';
$route['user/toko/produk/single/(:num)'] = 'user/produk/single/$1';
$route['user/toko/produk/tambah'] = 'user/produk/index_store';
$route['user/toko/produk/tambah/execute'] = 'user/produk/store';
$route['user/toko/produk/edit/(:num)'] = 'user/produk/index_edit/$1';
$route['user/toko/produk/edit/execute'] = 'user/produk/edit';
$route['user/toko/produk/delete/(:any)'] = 'user/produk/destroy/$1';
$route['user/toko/produk/get-kategori'] = 'user/produk/get_kategori';
$route['user/toko/produk/single/json/(:num)'] = 'user/produk/single_json/$1';

// Saldo Toko
// $route['user/toko/saldo/pemasukan'] = 'user/saldo/pemasukan';
// $route['user/toko/saldo/pemasukan/halaman/(:num)'] = 'user/saldo/pemasukan/$1';
// $route['user/toko/saldo/pemasukan/detail/(:num)'] = 'user/saldo/single_pemasukan/$1';
// $route['user/toko/saldo/pengeluaran'] = 'user/saldo/history_withdraw';
// $route['user/toko/saldo/tarik/request'] = 'user/saldo/withdraw_index';
// $route['user/toko/saldo/tarik/request/execute'] = 'user/saldo/withdraw';
// $route['user/toko/saldo/tarik/batal/(:num)'] = 'user/saldo/cancel_withdraw/$1';


// Guest ===================================================================================================
// Toko
$route['toko/semua'] = 'guest/toko';
$route['toko/semua/(:num)'] = 'guest/toko/index/$1';
$route['toko/detail/(:any)'] = 'guest/toko/single/$1';
$route['toko/detail/(:any)/halaman'] = 'guest/toko/single/$1/$2';
$route['toko/detail/(:any)/halaman/(:num)'] = 'guest/toko/single/$1/$2';

// Produk
$route['produk/semua'] = 'guest/produk';
$route['produk/semua/(:num)'] = 'guest/produk/index/$1';
$route['produk/cari'] = 'guest/produk/search';
$route['produk/cari/halaman'] = 'guest/produk/search';
$route['produk/cari/halaman/(:num)'] = 'guest/produk/search/$1';
$route['produk/detail/(:any)'] = 'guest/produk/single/$1';
$route['produk/kategori/(:any)'] = 'guest/produk/by_kategori/$1';
$route['produk/kategori/(:any)/halaman'] = 'guest/produk/by_kategori/$1';
$route['produk/kategori/(:any)/halaman/(:any)'] = 'guest/produk/by_kategori/$1/$2';
