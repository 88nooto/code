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
//$route['default_controller'] = 'welcome';
//$route['404_override'] = '';
//$route['translate_uri_dashes'] = FALSE;


//$route['manage_munu'] = 'nav/view';

//$route['news'] = 'news';


//$route['loginpage'] = 'Login/loginPage';

$route['default_controller'] = 'Pages';  //修改默认加载的控制器，为controllers/Pages.php下的view方法    
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['index'] = 'Pages';
$route['novel'] = 'Novel/novel';
//$route['test'] = 'Pages/view';
$route['anime'] = 'Pages/view/demo02';
$route['image'] = 'Pages/view/demo03';
$route['music'] = 'Pages/view/demo04';
//$route['usermenu'] = 'usermenu';
$route['logout'] = 'Logout';
//$route['login'] = 'Login';
//$route['register'] = 'Register';

//$route['(:any)'] = '404';		//URL 的第一段是 "product" ，第二段是数字时，将重定向到 "catalog" 类的 "product_lookup_by_id" 方法，并将第二段的数字作为参数传递给它。

