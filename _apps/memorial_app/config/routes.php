<?php defined('BASEPATH') OR exit('No direct script access allowed');

// SCRIPT FILE LINK
$route['s_url/logo/(:any)'] = 'clink/logo/$1';
$route['s_url/icon/(:any)'] = 'clink/icon/$1';

$route['home'] = 'chome/index';
$route['about'] = 'cabout';
$route['sekolah'] = 'csekolah';
$route['submenu/(:any)'] = 'csubmenu/submenu_page/$1';
$route['ensiklopedia/(:any)'] = 'censiklopedia/ensiklopedia/$1';
$route['alumni/(:any)'] = 'calumni/alumni_list/$1';
$route['category/(:any)'] = 'ccategory/category_list/$1';
$route['detail/(:any)'] = 'cdetail/detail_list/$1';

$route['show/file/(:any)'] = 'censiklopedia/show_file/$1';
$route['show/thumb/(:any)'] = 'censiklopedia/show_thumbnail/$1';

$route['dshow/file/(:any)'] = 'cdetail/show_file/$1';
$route['dshow/thumb/(:any)'] = 'cdetail/show_thumbnail/$1';

$route['default_controller']   = 'chome';
$route['404_override']         = 'cerror';
$route['translate_uri_dashes'] = FALSE;
