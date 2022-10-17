<?php

header('Content-type: application/json; charset=utf-8');

require 'connect.php';
require 'functions.php';
$q = $_GET['q'];

$method = $_SERVER['REQUEST_METHOD'];

$params = explode('/', $q);
$type = $params[0];

if(isset($params[1])){
    $id = $params[1];
}
else{
    $id = null;
}


switch ($method){
    case "GET":
        /*if($type === 'users'){
            if (!empty($connect)) {
                if(isset($id) && $id != null){
                    getUser($connect, $id);
                }
                else {
                    getUsers($connect);
                }
            }
        } else */
        if($type === "products"){
            if(!empty($conn)){
                if(isset($id) && $id != null){
                    getProduct($conn, $id);
                }
                else {
                    getProducts($conn);
                }
            }
        } else if($type === "tables"){
            if(!empty($conn)){
                if(isset($id) && $id != null){
                    getRestourantTable($conn, $id);
                }
                else {
                    getRestourantTables($conn);
                }
            }
        } else if($type === "categories"){
            if(!empty($conn)){
                if(isset($id) && $id != null){
                    getCategory($conn, $id);
                }
                else {
                    getCategories($conn);
                }
            }
        }

        break;
    case "POST":
        if($type === 'order'){
            if (!empty($conn)) {
                $data = file_get_contents('php://input');
                $data = json_decode($data);
                postOrder($conn, $data);
            }
        } if($type === 'orderproduct'){
            if (!empty($conn)) {
                $data = file_get_contents('php://input');
                $data = json_decode($data);
                postOrderProduct($conn, $data);
            }
        }
        break;
}




