<?php

require_once 'libs/Router.php';
require_once 'api/api-product.controller.php';
require_once 'api/api-user.controller.php';

$router = new Router();

$router->addRoute('products', 'GET', 'ApiProductController', 'getAllProducts');
$router->addRoute('products/:ID', 'GET', 'ApiProductController', 'getProduct');
$router->addRoute('products', 'POST', 'ApiProductController', 'addProduct');
$router->addRoute('products/:ID', 'DELETE', 'ApiProductController', 'deleteProduct');
$router->addRoute('products/:ID', 'PUT', 'ApiProductController', 'updateProduct');

$router->addRoute('users/token', 'GET', 'ApiUserController', 'getToken');
$router->addRoute('users/:ID', 'GET', 'ApiUserController', 'getUser');

$resource = $_GET['resource'];
$method = $_SERVER['REQUEST_METHOD'];
$router->route($resource, $method);  