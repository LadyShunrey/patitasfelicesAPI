<?php

class ApiView{

    public function response($data){
        header("Content-Type: application/json");

        echo json_encode($data);
    }

}