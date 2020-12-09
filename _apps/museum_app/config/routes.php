<?php defined('BASEPATH') OR exit('No direct script access allowed');

// SCRIPT FILE LINK
$route['s_url/logo/(:any)'] = 'clink/logo/$1';
$route['s_url/icon/(:any)'] = 'clink/icon/$1';

$route['show/file/(:any)'] = 'cdetail/show_file/$1';
$route['show/thumb/(:any)'] = 'cdetail/show_thumbnail/$1';

$route['home'] = 'chome';
$route['menu'] = 'csubmenu';
$route['about'] = 'cabout';
$route['category/(:any)'] = 'ccategory/category/$1';
$route['detail/(:any)'] = 'cdetail/detail/$1';


$route['default_controller']   = 'chome';
$route['404_override']         = 'cerror';
$route['translate_uri_dashes'] = FALSE;
