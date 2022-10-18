<?php

function getProducts($conn): void {
    $sql = "SELECT * FROM Product";
    $result = sqlsrv_query($conn, $sql);
    $json = [];
    if($result) {


        while($obj = sqlsrv_fetch_object($result)) {
            $onePart = array("IDProduct" => mb_convert_encoding($obj->IDProduct, 'utf-8', 'windows-1251'),
                "ProductName" => mb_convert_encoding($obj->ProductName, 'utf-8', 'windows-1251'),
                "Cost" => mb_convert_encoding($obj->Cost, 'utf-8', 'windows-1251'));

            if($obj->Description == null){
                $description = array("Description" => $obj->Description);
            }
            else{
                $description = array("Description" => mb_convert_encoding($obj->Description, 'utf-8', 'windows-1251'));
            }

            $twoPart = array( "Weight" => mb_convert_encoding($obj->Weight, 'utf-8', 'windows-1251'),
                "Composition" => mb_convert_encoding($obj->Composition, 'utf-8', 'windows-1251'),
                "IDCategory" => mb_convert_encoding($obj->IDCategory, 'utf-8', 'windows-1251'));

            if($obj->MainImage == null) {
                $image = array("MainImage" => $obj->MainImage);
            }
            else {
                $image = array("MainImage" => mb_convert_encoding($obj->MainImage, 'utf-8', 'windows-1251'));
            }

            $json[] = $onePart + $description + $twoPart + $image;
        }
        echo json_encode($json);
    }
    else{
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => "DB error"
        ];
        echo json_encode($res);
    }
}

function getProduct($conn, $id): void {
    $sql = "SELECT * FROM Product WHERE IDProduct = {$id}";
    $result = sqlsrv_query($conn, $sql);
    $json = [];
    if($result) {


        while($obj = sqlsrv_fetch_object($result)) {
            $onePart = array("IDProduct" => mb_convert_encoding($obj->IDProduct, 'utf-8', 'windows-1251'),
                "ProductName" => mb_convert_encoding($obj->ProductName, 'utf-8', 'windows-1251'),
                "Cost" => mb_convert_encoding($obj->Cost, 'utf-8', 'windows-1251'));

            if($obj->Description == null){
                $description = array("Description" => $obj->Description);
            }
            else{
                $description = array("Description" => mb_convert_encoding($obj->Description, 'utf-8', 'windows-1251'));
            }

            $twoPart = array( "Weight" => mb_convert_encoding($obj->Weight, 'utf-8', 'windows-1251'),
                "Composition" => mb_convert_encoding($obj->Composition, 'utf-8', 'windows-1251'),
                "IDCategory" => mb_convert_encoding($obj->IDCategory, 'utf-8', 'windows-1251'));

            if($obj->MainImage == null) {
                $image = array("MainImage" => $obj->MainImage);
            }
            else {
                $image = array("MainImage" => mb_convert_encoding($obj->MainImage, 'utf-8', 'windows-1251'));
            }

            $json[] = $onePart + $description + $twoPart + $image;
        }
        echo json_encode($json[0]);
    }
    else{
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => "DB error"
        ];
        echo json_encode($res);
    }
}

function getRestourantTables($conn): void {
    $sql = "SELECT * FROM RestourantTable";
    $result = sqlsrv_query($conn, $sql);
    $json = [];
    if($result) {


        while($obj = sqlsrv_fetch_object($result)) {
            $json[] = array("IDTable" => mb_convert_encoding($obj->IDTable, 'utf-8', 'windows-1251'),
                "CountOfSeats" => mb_convert_encoding($obj->CountOfSeats, 'utf-8', 'windows-1251'));
        }
        echo json_encode($json);
    }
    else{
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => "DB error"
        ];
        echo json_encode($res);
    }
}

function getRestourantTable($conn, $id): void {
    $sql = "SELECT * FROM RestourantTable WHERE IDTable = {$id}";
    $result = sqlsrv_query($conn, $sql);
    $json = [];
    if($result) {


        while($obj = sqlsrv_fetch_object($result)) {
            $json[] = array("IDTable" => mb_convert_encoding($obj->IDTable, 'utf-8', 'windows-1251'),
                "CountOfSeats" => mb_convert_encoding($obj->CountOfSeats, 'utf-8', 'windows-1251'));
        }
        echo json_encode($json[0]);
    }
    else{
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => "DB error"
        ];
        echo json_encode($res);
    }
}

function getCategories($conn): void {
    $sql = "SELECT * FROM Category";
    $result = sqlsrv_query($conn, $sql);
    $json = [];
    if($result) {


        while($obj = sqlsrv_fetch_object($result)) {
            $json[] = array("IDCategory" => mb_convert_encoding($obj->IDCategory, 'utf-8', 'windows-1251'),
                "NameCategory" => mb_convert_encoding($obj->NameCategory, 'utf-8', 'windows-1251'));
        }
        echo json_encode($json);
    }
    else{
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => "DB error"
        ];
        echo json_encode($res);
    }
}

function getCategory($conn, $id): void {
    $sql = "SELECT * FROM Category WHERE IDCategory = {$id}";
    $result = sqlsrv_query($conn, $sql);
    $json = [];
    if($result) {


        while($obj = sqlsrv_fetch_object($result)) {
            $json[] = array("IDCategory" => mb_convert_encoding($obj->IDCategory, 'utf-8', 'windows-1251'),
                "NameCategory" => mb_convert_encoding($obj->NameCategory, 'utf-8', 'windows-1251'));
        }
        echo json_encode($json[0]);
    }
    else{
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => "DB error"
        ];
        echo json_encode($res);
    }
}

function postOrder($conn, $data): void{
    //Перевод всех пришедших данных в правильную кодировку
    $rowTotalCost =  mb_convert_encoding($data->TotalCost, "windows-1251", "utf-8");
    $rowIDEmployee =  mb_convert_encoding($data->IDEmployee, "windows-1251", "utf-8");
    $rowIDRestourantTable =  mb_convert_encoding($data->IDRestourantTable, "windows-1251", "utf-8");
    $rowIsCashless =  mb_convert_encoding($data->IsCashless, "windows-1251", "utf-8");
    $rowIDPromocode =  $data->IDPromocode;
    $rowIDStatus =  mb_convert_encoding($data->IDStatus, "windows-1251", "utf-8");

    //Запрос
    $sql = "INSERT INTO [Order] (TotalCost, IDEmployee, IDRestourantTable, IsCashless, IDPromocode, IDStatus) VALUES (?, ?, ?, ?, ?, ?); SELECT SCOPE_IDENTITY()";
    $params = array("{$rowTotalCost}", "{$rowIDEmployee}", "{$rowIDRestourantTable}", "{$rowIsCashless}", $rowIDPromocode, "{$rowIDStatus}");
    $result = sqlsrv_query($conn, $sql, $params);
    sqlsrv_next_result($result);
    sqlsrv_fetch($result);
    $id = sqlsrv_get_field($result, 0);
    if(isset($id) && $id != null){
        http_response_code(201);
        $json = array("status" => true, "IDOrder" => $id);
        echo json_encode($json);
    } else{
        http_response_code(500);
        $res = [
            "status" => false,
            "message" => "DB insert Order data error"
        ];
        echo json_encode($res);
    }

}

function postOrderProduct($conn, $data): void{
    //Перевод всех пришедших данных в правильную кодировку
    $rowIDOrder =  mb_convert_encoding($data->IDOrder, "windows-1251", "utf-8");
    $rowIDProduct =  mb_convert_encoding($data->IDProduct, "windows-1251", "utf-8");
    $rowCount =  mb_convert_encoding($data->Count, "windows-1251", "utf-8");


    //Запрос
    $sql = "INSERT INTO [OrderProduct] (IDOrder, IDProduct, [Count]) VALUES (?, ?, ?); SELECT SCOPE_IDENTITY()";
    $params = array("{$rowIDOrder}", "{$rowIDProduct}", "{$rowCount}");
    $result = sqlsrv_query($conn, $sql, $params);
    sqlsrv_next_result($result);
    sqlsrv_fetch($result);
    $id = sqlsrv_get_field($result, 0);
    if(isset($id) && $id != null){
        http_response_code(201);
        $json = array("status" => true,"IDOrderProduct" => $id);
        echo json_encode($json);
    } else{
        http_response_code(500);
        $res = [
            "status" => false,
            "message" => "DB insert OrderProduct data error"
        ];
        echo json_encode($res);
    }
}

function getFile($id): void{

    $directory = "uploads";
    if(is_dir($directory)){

        $file = $directory . "/{$id}";
        if(file_exists($file)){

            $mime = mime_content_type($file);
            header("Content-type: $mime");
            echo readfile($file);

        } else {

            http_response_code(404);
            echo json_encode(null);
        }

    } else {

        http_response_code(404);
        echo json_encode(null);
    }
}