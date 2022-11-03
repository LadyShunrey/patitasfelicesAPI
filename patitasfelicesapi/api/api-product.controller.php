<?php

require_once 'models/product.model.php';
require_once 'api.view.php';

class ProductApiController{

    private $model;
    private $view;

    function __construct(){
        $this->model = new ProductModel();
        $this->view = new  ApiView();
    }

    function getAll(){
        $products = $this->model->getAllProducts();
        $this->view->response($products);
    }

}