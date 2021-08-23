<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);

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
$route['default_controller'] = 'dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

$route['dashboard'] = "dashboard/index";

//Barang
$barang = "barang";
$route[$barang]                     = "barang/listBarang";
$route[$barang."/datas"]            = "barang/getListBarang";
$route[$barang."/delete/(:any)"]    = "barang/deleteBarang/$1";
$route[$barang."/form"]             = "barang/barangFormActions";
$route[$barang."/(:any)"]           = "barang/barangData/$1";

// $stok = $barang."/stok";
// $route[$stok]                           = "barang/stokBarang";
// $route[$stok."/set-tanggal"]["post"]    = "barang/setTanggalStok";
// $route[$stok."/tanggal/(:any)"]         = "barang/viewStokPerTanggal/$1";
// $route[$stok."/save/(:any)"]            = "barang/saveStok/$1";
// $route[$stok."/delete/tanggal/(:num)"]  = "barang/deleteStokBarangTanggal/$1";
// $route[$stok."/delete/(:any)"]          = "barang/deleteStokBarang/$1";
// $route[$stok."/datas"]                  = "barang/getListStokBarang";
// $route[$stok."/datas/(:any)"]           = "barang/getListStokBarangPertanggal/$1";


// //Simpanan
// $simpanan = "simpanan";
// $route[$simpanan]                   = "simpanan/show_all";
// $route[$simpanan."/save"]           = "simpanan/saveSimpanan";
// $route[$simpanan."/datas"]          = "simpanan/getListSimpanan";
// $route[$simpanan."/delete/(:num)"]  = "simpanan/deleteSimpanan/$1";
// $route[$simpanan."/(:num)"]         = "simpanan/showSimpanan/$1";

// //Transaksi
// $transaksi                            = "transaksi";
// $route[$transaksi]                    = "transaksi/showAll";
// $route[$transaksi."/datas"]           = "transaksi/getDataTransaksi";
// $route[$transaksi."/save"]            = "transaksi/saveTransaksi";
// $route[$transaksi."/delete/(:any)"]   = "transaksi/deleteTransaksi/$1";
// $route[$transaksi."/faktur/new-code"] = "transaksi/generateNewId";

// //Laporan
// $laporanTransaksi = "laporan";
// $laporanKoperasi  = $laporanTransaksi."/penjualan/koperasi";
// $laporanByFaktur  = $laporanTransaksi."/penjualan/by-faktur";

// $route[$laporanKoperasi]            = "transaksi/laporanKoperasiShowAll";
// $route[$laporanKoperasi."/process"] = "transaksi/laporanKoperasiProcessData";
// $route[$laporanByFaktur]            = "transaksi/laporanByFakturShowAll"; 
// $route[$laporanByFaktur."/process"] = "transaksi/laporanByFakturProcessData"; 

// $bagi_hasil = $laporanTransaksi."/bagi-hasil";
// $route[$bagi_hasil]            = "transaksi/laporanBagiHasilShowAll";
// $route[$bagi_hasil."/process"] = "transaksi/laporanBagiHasilProcessData";

// $route[$transaksi."/(:any)"]          = "transaksi/showTransaksi/$1";
