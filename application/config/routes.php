<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
// UNIVERSITAS

$route['universitas']         		= 'univ';
$route['universitas/order']         = 'univ/order';
$route['transaksi-universitas']     = 'univ/transaksi';
$route['universitas/payment']       = 'univ/payment';
$route['pengaturan-universitas']    = 'univ/pengaturan';
// END UNIVERSITAS

// LOGIN

$route['login']         		= 'authentication';
$route['logout']        		= 'authentication/logout';

$route['pendaftaran']        		= 'authentication/daftar';
$route['pendaftaran-univ']              = 'authentication/daftar_univ';


$route['pendaftaran']       		= 'authentication/daftar/1';
$route['pengajuan-penyelenggara']     	= 'authentication/daftar/2';

$route['aktivasi/(:any)']             	= 'authentication/aktivasi/$1';
$route['email-verification']          	= 'authentication/aktivasi_email';
$route['hold-verification']           	= 'authentication/waiting';

$route['lupa-password']               	= 'authentication/recovery';
$route['recovery-password/(:any)']    	= 'authentication/ubah_pass/$1';

$route['ubah-password']         		= 'authentication/ubah_password';

// END LOGIN

// ADMIN
$route['data-peserta']               	= 'admin/data_peserta';

$route['data-kegiatan']    	  			= 'admin/data_kegiatan';
$route['data-kompetisi']    	  		= 'admin/data_kompetisi';


$route['pengaturan-admin']				= 'admin/pengaturan';
$route['pengaturan-admin/akun-admin']	= 'admin/pengaturan_akunAdmin';
$route['pengaturan-admin/sistem']		= 'admin/pengaturan_sistem';
$route['pengaturan-admin/website']		= 'admin/pengaturan_website';

$route['aktivitas-sistem']            	= 'admin/aktivitas';
$route['aktivitas-sistem/(:num)']     	= 'admin/aktivitas';
$route['notifikasi-sistem']           	= 'admin/notifikasi';
$route['notifikasi-sistem/(:num)']    	= 'admin/notifikasi';
// END ADMIN

// PESERTA

$route['peserta/data-pendaftaran'] 		= 'peserta/data_pendaftaran';
$route['peserta/data-anggota'] 			= 'peserta/data_anggota';
$route['peserta/berkas-kompetisi'] 		= 'peserta/berkas_kompetisi';


// END PESERTA

// MANAGE KEGIATAN
$route['kegiatanku']								= 'admin/kegiatanku';
$route['buat-kegiatan']								= 'admin/buat_kegiatan';

$route['manage-kegiatan']							= 'manage_kegiatan';
$route['manage-kegiatan/notifikasi-kegiatan']		= 'manage_kegiatan/notifikasi';
$route['manage-kegiatan/aktivitas-kegiatan']		= 'manage_kegiatan/aktivitas';

$route['manage-kegiatan/pengaturan']				= 'manage_kegiatan/pengaturan';
$route['manage-kegiatan/atur-pendaftaran']			= 'manage_kegiatan/atur_pendaftaran';
$route['manage-kegiatan/data-peserta']				= 'manage_kegiatan/data_peserta';
$route['manage-kegiatan/verifikasi-berkas']			= 'manage_kegiatan/verifikasi_berkas';

$route['manage-kegiatan/pengaturan-umum']			= 'manage_kegiatan/pengaturan_umum';

// END MANAGE KEGIATAN

// MANAGE KOMPETISI
$route['kompetisi']									= 'manage_kompetisi';
$route['kompetisi/notifikasi-kompetisi']			= 'manage_kompetisi/notifikasi';
$route['kompetisi/aktivitas-kompetisi']				= 'manage_kompetisi/aktivitas';

$route['kompetisi/pengaturan']						= 'manage_kompetisi/pengaturan';
$route['kompetisi/atur-pendaftaran']				= 'manage_kompetisi/atur_pendaftaran';
$route['kompetisi/data-peserta']					= 'manage_kompetisi/data_peserta';
$route['kompetisi/verifikasi-berkas']				= 'manage_kompetisi/verifikasi_berkas';

$route['kompetisi/pengaturan-umum']					= 'manage_kompetisi/pengaturan_umum';

$route['kompetisi/data-juri']						= 'manage_kompetisi/data_juri';
$route['kompetisi/bidang-lomba']					= 'manage_kompetisi/bidang_lomba';
$route['kompetisi/tahap-penilaian']					= 'manage_kompetisi/tahap_penilaian';
$route['kompetisi/kriteria-penilaian']				= 'manage_kompetisi/kriteria_penilaian';
$route['kompetisi/kriteria-penilaian/(:num)/(:num)']= 'manage_kompetisi/data_kriteria/$1/$2';
$route['kompetisi/hasil-penilaian']					= 'manage_kompetisi/hasil_penilaian';

// END MANAGE KOMPETISI

// EVENT
$route['kegiatan/(:any)']         	 		= 'kegiatan/kegiatan_detail/$1';

// END EVENT

// ETC

$route['daftar/(:any)']			= 'pendaftaran/daftar/$1';
$route['daftar-kompetisi']		= 'pendaftaran/daftar_kompetisi';
$route['detail-daftar/(:any)']	= 'peserta/detail_daftar/$1';

$route['k-panel/init/(:any)']	= 'handlers/init_kpanel/$1';
$route['akses-kegiatan/(:any)']	= 'handlers/akses_kegiatan/$1';

$route['bidang-lomba']			= 'home/bidang_lomba';
$route['tentang-juri']			= 'home/tentang_juri';

// END ETC

// UTIL PAGE
$route['statistik']   		= 'utilities/statistik';
$route['jadwal']  	 		= 'utilities/jadwal';

$route['maintenance']   	= 'utilities/maintenance';
$route['coming-soon']   	= 'utilities/coming_soon';
$route['404-not-found'] 	= 'utilities/e_404';
	
$route['about-us']      	= 'utilities/about';
$route['contact-us']    	= 'utilities/contact';
$route['pusat-bantuan'] 	= 'utilities/bantuan';

$route['artikel/(:any)']	= 'pengumuman/artikel/$1';

$route['pricing']       	= 'utilities/package';

$route['careers']       	= 'utilities/careers';
$route['careers/(:any)']	= 'utilities/careers_detail/$1';
$route['hire-us']       	= 'utilities/hireus';

$route['privacy-policy']  	= 'utilities/privacy';
$route['term-of-service'] 	= 'utilities/term';

// END UTIL

// DEFAULT ROUTEs
$route['default_controller'] = 'home';
$route['404_override']       = 'utilities/e_404';
$route['translate_uri_dashes'] = FALSE;
