<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['test'] = "test";
$route['test/(:any)'] = "test/$1";
$route['dice'] = "dice/view";
$route['dice/(:any)'] = "dice/view/$1";
$route['gold'] = "gold/view";
$route['gold/site/(:any)/(:num)'] = "gold/view/node/$1/$2";
$route['gold/site/(:any)'] = "gold/view/site/$1";
$route['gold/(:any)'] = "gold/view/$1";
$route['beta'] = "beta/view";
$route['beta/site/(:any)/(:num)'] = "beta/view/node/$1/$2";
$route['beta/site/(:any)'] = "beta/view/site/$1";
$route['beta/(:any)'] = "beta/view/$1";
$route['alpha'] = "alpha/view";
$route['alpha/(:any)'] = "alpha/view/$1";
$route['(:any)'] = "alpha/view/$1";
//$route['default_controller'] = "alpha/view";
$route['default_controller'] = "beta/view";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */