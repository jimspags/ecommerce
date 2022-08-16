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
$route['default_controller'] = 'customers';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Login page
$route['login'] = "users/login";

// Login process
$route['login/authenticate'] = "users/login_process";


// Register page
$route['register'] = "users/register";
// Register process
$route['register/process'] = "users/register_process";

// Logoff
$route['logoff'] = "users/logoff";

// Admin
$route['dashboard'] = "admins/index";
$route['dashboard/products'] = "admins/dashboard_products";
$route['dashboard/order_detail/(:num)'] = "admins/order_details/$1";

// Products
$route['dashboard/add_product'] = "products/add_product"; // Add product
$route['dashboard/delete_product/(:num)'] = "products/delete_product/$1";
$route['dashboard/get_product(:num)'] = "products/get_product/$1";

// Customers
$route['profile'] = "customers/edit_profile";
$route['profile/edit_password'] = "customers/edit_password";

$route['cart'] = "customers/shopping_cart";
$route['product/(:num)'] = "customers/product_details/$1";
$route['order_history'] = "customers/order_history";
$route['order_history_detail/(:num)'] = "customers/order_history_details/$1";



