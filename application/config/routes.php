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
$route['default_controller']          			= "home";
$route['ondemand']          					= "home/ondemand";
$route['change_password']          					= "User/change_password";
$route['about']          						= "about";
$route['in_studio']          				= "home/in_studio";
$route['favourites']          					= "home/favourites";
$route['journal']          						= "home/journal";
$route['live_stream_classes']          			= "home/live_stream_classes";
$route['memberships']          				    = "home/memberships";
$route['privacy_terms']          				= "home/privacy_terms"; 
$route['posts']          				        = "home/posts";
$route['journal_detail']          				= "home/journal_detail";
$route['private_corporate']          			= "home/private_corporate";
$route['purchase_history']          			= "home/purchase_history";

$route['retreats_book']          			= "home/retreats_book";
$route['retreats']          					= "home/retreats";
$route['login']          					 	= "user/login_page";
$route['myAccount']          					= "user/myAccount";
$route['register']          					= "user/register_page";
$route['products/booking']          			= "Products/index/booking";
$route['admin/blogs/(:num)'] 	  		  		= "admin/blogs/index";
$route['news/(:num)'] 	  		  				= "news/index";
$route['admin/media/(:num)'] 	  		  		= "admin/media/index";
$route['admin/modifiergroup/(:num)'] 	    	= "admin/modifiergroup/index/$1";
$route['admin/products/(:num)'] 	  		  	= "admin/products/index/$1";
$route['admin/caterindCat/(:num)'] 	  		  	= "admin/caterindCat/index/$1";
$route['admin/category/(:num)'] 	  		  	= "admin/category/index/$1";
$route['admin/catering/(:num)'] 	  		  	= "admin/catering/index/$1";
$route['admin/gifts/(:num)'] 	  		  		= "admin/gifts/index/$1";
$route['admin/services/(:num)'] 	  		  	= "admin/services/index";
$route['admin/reviews/(:num)'] 	  		  		= "admin/reviews/index";
$route['admin/portfolio/(:num)'] 	  		  	= "admin/portfolio/index";
$route['admin/Users/(:num)'] 	  	  			= "admin/Users/index";
$route['admin'] 					  			= 'admin/login';
$route['route'] 					 		 	= 'admin/user/login';
$route['page/(:any)'] 				  			= 'page/index';
$route['about-artin-group'] 	  		  		= "page/about";
$route['ar/about-artin-group'] 	  		  		= "page/about";
$route['404_override'] 				  			= '';
$route['translate_uri_dashes'] 		  			= FALSE;



