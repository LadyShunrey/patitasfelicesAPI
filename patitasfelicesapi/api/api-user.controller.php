<?php
//require_once 'models/user.model.php';
require_once 'api.view.php';
require_once 'helpers/api-auth.helper.php';

class ApiUserController{
    // private $model;
    private $view; 
    private $authHelper; 

    function __construct(){
        //$this->model = new UserModel();
        $this->view = new ApiView();
        $this->authHelper = new ApiAuthHelper();
    }

    public function getToken(){
        $userpass = $this->authHelper->getBasic();

        
        //obtengo el usuario de la bbdd
        //$user = $this->model->getUser($userName);

        //voy a inventar un user aca abajo para que funcione el token, esto despues lo traemos de la bbdd
        $user = array("user"=>$userpass["user"]);

        //if usuario existe y contrasena coincide
        if(true /*$user && password_verify($password, $user->password)*/){
            $token = $this->authHelper->createToken($user);
            //devolver un token
            $this->view->response(["token"=>$token], 200);
        }
        else{
            $this->view->response("Usuario o contraseña incorrecctos", 401);
        }
    }

    public function getUser($params = null){
        $id = $params[':ID'];
        $user = $this->authHelper->getUser();
        if($user){
            if($id == $user->sub){
                $this->view->response($user, 200);
            }
            else{
                $this->view->response("Forbidden", 403);
            }
        }
        else{
            $this->view->response("No autorizado!", 401);
        }
    }
}