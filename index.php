<?php 
require 'vendor/autoload.php';
session_start();
 $path = parse_url( trim( $_SERVER['REQUEST_URI'], '/' ), PHP_URL_PATH);
 $routes = [
  '' => 'views/frontend/home.php',
  'about' => 'views/frontend/about.php',
  'author' => 'views/frontend/author.php',
  'category' => 'views/frontend/category.php',
  'post' => 'views/frontend/post.php',
  //guests user
  'login' => 'views/frontend/login.php',
  'register' => 'views/frontend/register.php',
  //authenticate user
  'logout' => 'views/frontend/logout.php',
  
  'dashboard/post' => 'views/dashboard/post_read.php',
  'dashboard/post/create' => 'views/dashboard/post_create.php',
  'dashboard/post/update' => 'views/dashboard/post_update.php',
  'dashboard/post/delete' => 'views/dashboard/post_delete.php',
  'dashboard/category' => 'views/dashboard/category_read.php',
  'dashboard/category/update' => 'views/dashboard/category_update.php',
  'dashboard/category/delete' => 'views/dashboard/category_delete.php',
 ];
$guest_routes = ['login', 'register'];
 $auth_routes = [
  'logout',
  'dashboard/post',
  'dashboard/post/create',
  'dashboard/post/update',
  'dashboard/post/delete',
  'dashboard/category',
  'dashboard/category/update',
  'dashboard/category/delete'
];
 if (array_key_exists($path, $routes)) {
  if (in_array($path, $auth_routes)) {
    if (is_authenticate()) {
      require $routes[$path] ;
    } else {
      header('Location: /login');
    }
  } else if (in_array($path, $guest_routes)) {
    if (is_authenticate()) {
      header('Location: /');
    } else {
      require $routes[$path] ;
    }
  } else {
    require $routes[$path] ;
  }
 }else {
  require 'views/frontend/notfound.php';
 }