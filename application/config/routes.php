<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// User routes
$route['login'] = 'usuario/login';
$route['entrar'] = 'usuario/login';
$route['registrar'] = 'usuario/register';
$route['logout'] = 'usuario/logout';
$route['sair'] = 'usuario/logout';
$route['inicio'] = 'usuario/dashboard';
$route['perfil'] = 'usuario/profile';

/*//admin routs
$route['admin'] = 'admin/index';
$route['admin/forget-password'] = 'admin/forget_password';

$route['admin/dashboard'] = 'admin/dashboard';

$route['admin/change-password'] = 'admin/get_admin_data';
$route['admin/update-profile'] = 'admin/update_admin_profile';

$route['admin/users/add-user'] = 'admin/add_user';
$route['admin/users'] = 'admin/users';
$route['admin/users/update-user/(:any)'] = 'admin/update_user/$1';

$route['admin/testimonials/add'] = 'administrator/add_testimonial';
$route['admin/testimonials/list'] = 'administrator/list_testimonial';
$route['admin/testimonials/update/(:any)'] = 'administrator/update_testimonial/(:any)';
*/

$route['default_controller'] = 'home';
$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;