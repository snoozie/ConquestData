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

$route['default_controller'] = "conquestdata";
$route['404_override'] = '';
$route['about_us'] = "conquestdata/about_us";
$route['projects'] = "conquestdata/projects";
$route['projects_login'] = "conquestdata/projects_login";
$route['projects_addtime/(:any)'] = "conquestdata/projects_addtime/$1";
$route['projects_add'] = "conquestdata/projects_add";
$route['user_login'] = "conquestdata/login";
$route['user_logout'] = "conquestdata/logout";
$route['services'] = "conquestdata/services";
$route['faq'] = "conquestdata/faq";
$route['contact'] = "conquestdata/contact";
$route['email'] = "conquestdata/email";

$route['hallpass'] = "hallpass/index";
$route['staff'] = "hallpass/staff";
$route['students'] = "hallpass/students";
$route['staffView'] = "hallpass/staffView";
$route['staff/(:any)'] = "hallpass/staff/$1";
$route['givepass'] = "hallpass/give_pass";
$route['givepass2'] = "hallpass/give_pass2";
$route['givepass3'] = "hallpass/give_pass3";
$route['givepass_popup'] = "hallpass/give_pass_popup";
$route['givepass_popup/(:any)'] = "hallpass/give_pass_popup/$1";
$route['sendPass'] = "hallpass/sendPass";
$route['sendPass/(:any)'] = "hallpass/sendPass/$1";
$route['checkCode'] = "hallpass/checkCode";
$route['index'] = "hallpass/index";
$route['expired'] = "hallpass/pass_expired";
$route['expired/(:any)'] = "hallpass/pass_expired/$1";
$route['addTime'] = "hallpass/add_time";
$route['addTime/(:any)'] = "hallpass/add_time/$1";
$route['checkPass'] = "hallpass/checkPass";
$route['revokePass'] = "hallpass/revokePass";
$route['revokePass/(:any)'] = "hallpass/revokePass/$1";
$route['changePass'] = "hallpass/changePass";
$route['changePass/(:any)'] = "hallpass/changePass/$1";
$route['passChanges/(:any)'] = "hallpass/passLog/$1";
$route['getPass'] = "hallpass/getCurrentPass";
$route['login'] = "hallpass/login";
$route['logout'] = "hallpass/logout";
$route['student_login'] = "hallpass/student_login";
$route['staff_login'] = "hallpass/staff_login";
$route['login_check'] = "hallpass/login_check";
$route['not_needed'] = "hallpass/not_needed";
$route['showPasses/(:any)/(:any)'] = "hallpass/showPasses/$1/$2";
$route['addStudent'] = "hallpass/add_student";
$route['createStudent'] = "hallpass/create_student";

$route['info'] = "conquestdata/info";
$route['intro_hallpass'] = "conquestdata/intro_hall_pass";
$route['intro_projectcostreport'] = "conquestdata/intro_project_cost_report";
$route['intro_castingkids'] = "conquestdata/intro_casting_kids";

$route['resume'] = "resume/index";

/* End of file routes.php */
/* Location: ./application/config/routes.php */