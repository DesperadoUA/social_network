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
$route['default_controller'] = 'main';
$route['how-it-works'] = 'main';
$route['ua/how-it-works-ua'] = 'main';
$route['for-specialists'] = 'main';
$route['ua/for-specialists-ua'] = 'main';
$route['thx'] = 'main';
$route['ua/thx-ua'] = 'main';
$route['o-platforme'] ='main';
$route['ua/o-platforme-ua'] ='main';
$route['o-klinicheskih-issledovaniyah'] ='main';
$route['ua/o-klinicheskih-issledovaniyah-ua'] ='main';
$route['prava-i-obyazannosti-uchastnikov'] ='main';
$route['ua/prava-i-obyazannosti-uchastnikov-ua'] ='main';
$route['bezopasnost-patsientov'] ='main';
$route['ua/bezopasnost-patsientov-ua'] ='main';
$route['kontakty'] ='main';
$route['ua/kontakty-ua'] ='main';
$route['ua'] ='main';


$route['api/mailer'] = 'API_Controller/mailer';
$route['api/clinics'] = 'API_Controller/clinics';
$route['api/research'] = 'API_Controller/research';

$route['research'] = 'Research_Controller';
$route['ua/research-ua'] = 'Research_Controller';
$route['research/page/(:any)'] = 'Research_Controller';
$route['ua/research-ua/page/(:any)'] = 'Research_Controller';
$route['research/(:any)'] = 'Research_Controller/single/$1';
$route['ua/research/(:any)'] = 'Research_Controller/single/$1';

$route['city/(:any)'] = 'City_Controller/single/$1';
$route['ua/city/(:any)'] = 'City_Controller/single/$1';

$route['clinics'] = 'Clinic_Controller';
$route['ua/clinics-ua'] = 'Clinic_Controller';
$route['clinics/page/(:any)'] = 'Clinic_Controller';
$route['ua/clinics-ua/page/(:any)'] = 'Clinic_Controller';
$route['clinics/page'] = 'Clinic_Controller';
$route['clinic/(:any)/page'] = 'Clinic_Controller/single/$1/$2';
$route['clinic/(:any)/page/(:any)'] = 'Clinic_Controller/single/$1/$2';
$route['ua/clinic/(:any)/page/(:any)'] = 'Clinic_Controller/single/$1/$2';
$route['clinic/(:any)'] = 'Clinic_Controller/single/$1/$2';
$route['ua/clinic/(:any)'] = 'Clinic_Controller/single/$1/$2';

$route['blog'] = 'Blog_Controller/index';
$route['ua/blog-ua'] = 'Blog_Controller/index';
$route['blog/page/(:any)'] = 'Blog_Controller/index';
$route['ua/blog-ua/page/(:any)'] = 'Blog_Controller/index';
$route['blog/(:any)'] = 'Blog_Controller/single/$1';
$route['ua/blog/(:any)'] = 'Blog_Controller/single/$1';


/* Admin */
$route['admin/static-page/update'] = 'admin/staticPageUpdate';
$route['admin/static-page/(:any)'] = 'admin/pageEdit/$1';
$route['admin/settings'] = 'admin/settings';
$route['admin/settings/update'] = 'admin/settingsUpdate';
$route['admin/settings/(:any)'] = 'admin/settingsEdit/$1';
$route['admin/options'] = 'admin/options';
$route['admin/options/update'] = 'admin/optionsUpdate';
$route['admin/options/(:any)'] = 'admin/optionsEdit/$1';

$route['admin/research'] = 'Admin_research';
$route['admin/research/update'] = 'admin_research/update';
$route['admin/research/delete'] = 'admin_research/delete';
$route['admin/research/add'] = 'admin_research/add';
$route['admin/research/add-post'] = 'admin_research/addPost';
$route['admin/research/(:any)'] = 'admin_research/single/$1';

$route['admin/post/update'] = 'admin_post/update';
$route['admin/post/delete'] = 'admin_post/delete';
$route['admin/post/add-post'] = 'admin_post/addPost';

$route['admin/clinic'] = 'admin_post';
$route['admin/clinic/add'] = 'admin_post/add';
$route['admin/clinic/(:any)'] = 'admin_post/single/$1';

$route['admin/city'] = 'admin_post';
$route['admin/city/add'] = 'admin_post/add';
$route['admin/city/(:any)'] = 'admin_post/single/$1';

$route['admin/blog'] = 'admin_post';
$route['admin/blog/add'] = 'admin_post/add';
$route['admin/blog/(:any)'] = 'admin_post/single/$1';


$route['404_override'] = 'main/show_404';
$route['translate_uri_dashes'] = FALSE;
