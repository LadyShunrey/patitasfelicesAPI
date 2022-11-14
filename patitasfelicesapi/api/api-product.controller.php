<?php

require_once 'models/product.model.php';
require_once 'api.view.php';

class ApiProductController{

    private $model;
    private $view;
    private $data;

    function __construct(){
        $this->model = new ProductModel();
        $this->view = new  ApiView();
        $this->data = file_get_contents("php://input");
    }

    private function getData(){
        return json_decode($this->data);
    }

    public function getAllProducts($sort = null, $order = null, $limit = null){
        if(isset($_GET['sort'])){ 
            if($_GET['sort']=='name' || $_GET['sort']=='description' || $_GET['sort']=='color' || $_GET['sort']=='size' || $_GET['sort']=='price' || $_GET['sort']=='stock' || $_GET['sort']=='category_fk' || $_GET['sort']=='type_fk'){
                $sort = $_GET['sort'];
            }
        }
        if(isset($_GET['order'])){
            if($_GET['order'] == 'asc' || $_GET['order'] == 'desc' || $_GET['order'] == 'ASC' || $_GET['order'] == 'DESC'){
                $order = $_GET['order'];        
            }
        }
        if(isset($_GET['limit'])){
            if($_GET['limit']=='1' || $_GET['limit']=='2' || $_GET['limit']=='3' || $_GET['limit']=='4' || $_GET['limit']=='5' || $_GET['limit']=='10'){
                $limit = $_GET['limit'];
            }
        }
        //offset
        $products = $this->model->getAllProducts($sort, $order, $limit);
        $this->view->response($products, 200);
    }

    public function getProduct($params = null){
        $id = $params[':ID'];
        $product = $this->model->getProduct($id);

        if($product){
            $this->view->response($product);
        }
        else{
            $this->view->response("El producto de id = $id no existe", 404);
        }
    }

    public function addProduct($params = null){
        $data = $this->getData();
        $name = $data->name;
        $description = $data->description;
        $color = $data->color;
        $size = $data->size;
        $price = $data->price;
        $stock = $data->stock;
        $category_fk = $data->category_fk;
        $type_fk = $data->type_fk;

        if(empty($name) || empty($description) || empty($color)  || empty($size) || empty($price) || empty($stock) || empty($category_fk) || empty($type_fk)){
            $this->view->response("Complete los datos", 400);
        }
        else{
            $id = $this->model->addProduct($name, $description, $color, $size, $price, $stock, $category_fk, $type_fk);
            $product = $this->model->getProduct($id);
            if($product){
                $this->view->response($product, 201);
            }
            else{
                $this->view->response("La tarea no fue creada", 500);
            }
            
        }
    }

    public function deleteProduct($params = null){
        $id = $params[':ID'];
        $product = $this->model->getProduct($id);
        
        if($product){
            $this->model->deleteProduct($id);
            $this->view->response("Product id = $id removed successfuly", 200);
        }
        else{
            $this->view->response("Product id = $id NOT FOUND", 404);
        }
    }

    public function updateProduct($params = null){
        $id = $params[':ID'];
        $data = $this->getData();

        $product = $this->model->getProduct($id);

        $name = $data->name;
        $description = $data->description;
        $color = $data->color;
        $size = $data->size;
        $price = $data->price;
        $stock = $data->stock;
        $category_fk = $data->category_fk;
        $type_fk = $data->type_fk;

        if($product){
            $this->model->editProduct($id, $name, $description, $color, $size, $price, $stock, $category_fk, $type_fk);
            $this->view->response("El producto fue modificado con exito " , 200);
        }
        else{
            $this->view->response("El producto con el id = $id no existe" , 404);
        }
    }
}