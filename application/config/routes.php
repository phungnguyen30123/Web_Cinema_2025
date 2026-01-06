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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'Index_Controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Rating routes
$route['rating/get_user_rating/(:num)'] = 'Rating_controller/get_user_rating/$1';
$route['rating/set_rating'] = 'Rating_controller/set_rating';
$route['rating/get_stats/(:num)'] = 'Rating_controller/get_stats/$1';
$route['rating/get_movie_ratings/(:num)'] = 'Rating_controller/get_movie_ratings/$1';
$route['rating/delete_rating'] = 'Rating_controller/delete_rating';
$route['rating/top_rated'] = 'Rating_controller/top_rated';
$route['rating/my_ratings'] = 'Rating_controller/my_ratings';

// Ranking page (rates)
$route['rates'] = 'Rating_page_controller/index';
