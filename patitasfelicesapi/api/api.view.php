<?php

class ApiView{

    public function response($data, $code = 200){
        header("Content-Type: application/json");
        header("HTTP/1.1 " . $code . " " . $this->requestStatus($code));
        echo json_encode($data);
    }

    private function requestStatus($code){
        $status = array(
            200 => "OK",
            201 => "CREATED",
            400 => "BAD REQUEST",
            401 => "UNAUTHORIZED",
            403 => "FORBIDDEN",
            404 => "NOT FOUND",
            500 => "INTERNAL SERVER ERROR"
        );

        return (isset($status[$code]))? $status[$code] : $status[500];
    }

}