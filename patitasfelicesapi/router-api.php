<?php

require_once 'libs/Router.php';
require_once 'api/api-product.controller.php';

//creo el router
$router = new Router();

//tabla de ruteo
$router->addRoute('products', 'GET', 'ProductApiController', 'getAll');

$resource = $_GET['resource'];
$method = $_SERVER['REQUEST_METHOD'];
$router->route($resource, $method);  