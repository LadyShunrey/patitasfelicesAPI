<?php

require_once 'models/product.model.php';
require_once 'api.view.php';
require_once 'helpers/api-auth.helper.php';

class ApiProductController{

    private $model;
    private $view;
    private $data;
    private $authHelper;

    function __construct(){
        $this->model = new ProductModel();
        $this->view = new  ApiView();
        $this->data = file_get_contents("php://input");
        $this->authHelper = new ApiAuthHelper();
    }

    private function getData(){
        return json_decode($this->data);
    }

    public function getAllProducts($sort = null, $order = null, $limit = null, $offset = null){
        $attribute = null;
        $value = null;
        if(isset($_GET['sort'])){ 
            if($_GET['sort']=='name' || $_GET['sort']=='description' || $_GET['sort']=='color' || $_GET['sort']=='size' || $_GET['sort']=='price' || $_GET['sort']=='stock' || $_GET['sort']=='category_name' || $_GET['sort']=='type_name' || $_GET['sort']=='badge' || $_GET['sort']=='on_sale'){
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
        if(isset($_GET['offset'])){
            if($_GET['offset']=='1' || $_GET['offset']=='2' || $_GET['offset']=='3' || $_GET['offset']=='4' || $_GET['offset']=='5' || $_GET['offset']=='10' || $_GET['offset']=='15' || $_GET['offset']=='20'){
                $offset = $_GET['offset'];
            }
        }
        if(isset($_GET['category_name'])){
            if($_GET['category_name'] == 'Accesorios' || $_GET['category_name'] == 'Libreria' || $_GET['category_name'] == 'Bazar' || $_GET['category_name'] == 'Indumentaria'){
                $attribute = "category_name";
                $value = $_GET['category_name'];
            }
        }
        if(isset($_GET['type_name'])){
            if($_GET['type_name'] == 'Bandanas' || $_GET['type_name'] == 'Cartucheras' || $_GET['type_name'] == 'Llaveros' || $_GET['type_name'] == 'Anotadores' || $_GET['type_name'] == 'Calendarios' || $_GET['type_name'] == 'Cuadernos' || $_GET['type_name'] == 'Lapices' || $_GET['type_name'] == 'Lapiceras' || $_GET['type_name'] == 'Bolsos' || $_GET['type_name'] == 'Tazas' || $_GET['type_name'] == 'Remeras' || $_GET['type_name'] == 'Billeteras' || $_GET['type_name'] == 'Buzos'){
                $attribute = "type_name";
                $value = $_GET['type_name'];
            }
        }
        if(isset($_GET['badge'])){
            if($_GET['badge'] == 'true' || $_GET['badge'] == 'false'){
                $attribute = "badge";
                $value = $_GET['badge'];
                if($value == 'true'){
                    $value = 1;
                }
                if($value == 'false'){
                    $value = 0;
                }
            }
        }
        if(isset($_GET['on_sale'])){
            if($_GET['on_sale'] == 'true' || $_GET['on_sale'] == 'false'){
                $attribute = "on_sale";
                $value = $_GET['on_sale'];
                if($value == 'true'){
                    $value = 1;
                }
                if($value == 'false'){
                    $value = 0;
                }
            }
        }
        
        $products = $this->model->getAllProducts($sort, $order, $limit, $offset, $attribute, $value);
        $this->view->response($products, 200);
    }

    public function getProduct($params = null){
        $id = $params[':ID'];
        $product = $this->model->getProduct($id);

        if($product){
            $this->view->response($product, 200);
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
        $badge = $data->badge;
        $on_sale = $data->on_sale;
        $category_fk = $data->category_fk;
        $type_fk = $data->type_fk;

        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No está logeado, se requiere estar logueado para crear un producto nuevo", 401);
            return;
        }

        if(empty($name)||empty($description)||empty($color)||empty($size)||empty($price)||empty($stock)||empty($on_sale)||empty($category_fk)||empty($type_fk)){
            $this->view->response("Complete los datos para poder agregar el producto", 400);
        }
        else{
            $id = $this->model->addProduct($name, $description, $color, $size, $price, $stock, $badge, $on_sale, $category_fk, $type_fk);
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

        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("ERROR! Está intentando eliminar un producto! Debe estar loggeado para realizar esta acción!", 401);
            return;
        }

        $product = $this->model->getProduct($id);
        
        if($product){
            $this->model->deleteProduct($id);
            $this->view->response("El product con id = $id ha sido eliminado exitosamente", 200);
        }
        else{
            $this->view->response("El producto con id = $id no existe", 404);
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
        $badge = $data->badge;
        $on_sale = $data->on_sale;
        $category_fk = $data->category_fk;
        $type_fk = $data->type_fk;

        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No está logeado, se requiere estar logueado para modificar un producto", 401);
            return;
        }

        if($product){
            if(empty($name)||empty($stock)||empty($category_fk)||empty($type_fk)){
                $this->view->response("Complete los datos, los campos 'name', 'stock', 'category_fk' y 'type_fk' no pueden estar vacíos", 400);
            }
            else{
                $this->model->editProduct($id, $name, $description, $color, $size, $price, $stock, $category_fk, $type_fk, $badge, $on_sale);
                $this->view->response("El producto fue modificado con exito " , 200);
            }
        }
        else{
            $this->view->response("El producto con el id = $id no existe" , 404);
        }
    }
}