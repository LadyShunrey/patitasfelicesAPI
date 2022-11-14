<?php

require_once 'libs/Router.php';
require_once 'api/api-product.controller.php';
require_once 'api/api-user.controller.php';

//creo el router
$router = new Router();

//tabla de ruteo
$router->addRoute('products', 'GET', 'ApiProductController', 'getAllProducts');
$router->addRoute('products/:ID', 'GET', 'ApiProductController', 'getProduct');
$router->addRoute('products', 'POST', 'ApiProductController', 'addProduct');
$router->addRoute('products/:ID', 'DELETE', 'ApiProductController', 'deleteProduct');
$router->addRoute('products/:ID', 'PUT', 'ApiProductController', 'updateProduct');

$router->addRoute('users/token', 'GET', 'ApiUserController', 'getToken');

$resource = $_GET['resource'];
$method = $_SERVER['REQUEST_METHOD'];
$router->route($resource, $method);  