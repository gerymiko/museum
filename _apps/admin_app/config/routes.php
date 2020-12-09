<?php defined('BASEPATH') OR exit('No direct script access allowed');

// SCRIPT FILE LINK
$route['s_url/logo/(:any)'] = 'clink/logo/$1';
$route['s_url/(:any)'] = 'clink/$1';

$route['login'] = 'clogin';
$route['check/auth'] = 'clogin/auth_login';

$route['logout'] = 'panel/cpanel/logout';

// MUSEUM
$route['dashboard'] = 'panel/cpanel/dashboard';

$route['msm/submenu'] = 'msm/csubmenu/submenu_list';
$route['table/submenu'] = 'msm/csubmenu/table_submenu';
$route['save/add/submenu'] = 'msm/csubmenu/save_add_submenu';
$route['save/edit/submenu'] = 'msm/csubmenu/save_edit_submenu';
$route['save/delete/submenu'] = 'msm/csubmenu/delete_submenu';

$route['msm/category'] = 'msm/ccategory/category_list';
$route['table/category'] = 'msm/ccategory/table_category';
$route['save/add/category'] = 'msm/ccategory/save_add_category';
$route['save/edit/category'] = 'msm/ccategory/save_edit_category';
$route['save/delete/category'] = 'msm/ccategory/delete_category';

$route['msm/detail'] = 'msm/cdetail/detail_list';
$route['table/detail'] = 'msm/cdetail/table_detail';
$route['save/add/detail'] = 'msm/cdetail/save_add_detail';
$route['save/edit/detail'] = 'msm/cdetail/save_edit_detail';
$route['save/delete/detail'] = 'msm/cdetail/delete_detail';

$route['msm/about'] = 'msm/cabout/about_list';
$route['table/about'] = 'msm/cabout/table_about';
$route['save/edit/about'] = 'msm/cabout/save_edit_about';

// MEMORIAL
$route['mom/school'] = 'mom/cschool/school_list';
$route['table/school'] = 'mom/cschool/table_school';
$route['save/edit/school'] = 'mom/cschool/save_edit_school';

$route['mom/submenu']  = 'mom/csubmenu/submenu_list';
$route['table/submenu'] = 'mom/csubmenu/table_submenu';
$route['save/edit/submenu'] = 'mom/csubmenu/save_edit_submenu';

$route['mom/ensiklopedia'] = 'mom/censiklopedia/ensiklopedia_list';
$route['table/ensiklopedia'] = 'mom/censiklopedia/table_ensiklopedia';
$route['save/add/ensiklopedia'] = 'mom/censiklopedia/save_add_ensiklopedia';
$route['save/edit/ensiklopedia'] = 'mom/censiklopedia/save_edit_ensiklopedia';
$route['save/delete/ensiklopedia'] = 'mom/censiklopedia/delete_ensiklopedia';

$route['mom/about'] = 'mom/cabout/about_list';
$route['table/about'] = 'mom/cabout/table_about';
$route['save/edit/about'] = 'mom/cabout/save_edit_about';

$route['mom/alumni'] = 'mom/calumni/alumni_list';
$route['table/alumni'] = 'mom/calumni/table_alumni';
$route['save/add/alumni'] = 'mom/calumni/save_add_alumni';
$route['save/edit/alumni'] = 'mom/calumni/save_edit_alumni';
$route['save/delete/alumni'] = 'mom/calumni/delete_alumni';

$route['mom/alumni/category'] = 'mom/ccategory/category_alumni_list';
$route['table/alumni/category'] = 'mom/ccategory/table_category_alumni';
$route['save/add/alumni/category'] = 'mom/ccategory/save_add_category_alumni';
$route['save/edit/alumni/category'] = 'mom/ccategory/save_edit_category_alumni';
$route['save/delete/alumni/category'] = 'mom/ccategory/delete_category_alumni';

$route['mom/alumni/detail'] = 'mom/cdetail/detail_alumni_list';
$route['table/alumni/detail'] = 'mom/cdetail/table_detail_alumni';
$route['save/add/alumni/detail'] = 'mom/cdetail/save_add_detail_alumni';
$route['save/edit/alumni/detail'] = 'mom/cdetail/save_edit_detail_alumni';
$route['save/delete/alumni/detail'] = 'mom/cdetail/delete_detail_alumni';

$route['access'] = 'access/caccess/access_list';
$route['table/user'] = 'access/caccess/table_user';
$route['save/add/user'] = 'access/caccess/save_add_user';
$route['save/edit/user'] = 'access/caccess/save_edit_user';

$route['default_controller'] = 'clogin';
$route['404_override'] = 'cerror';
$route['translate_uri_dashes'] = FALSE;
