<?php

include_once "api.php";
require_once ('db/dbaccess.php');

//$data = json_decode(file_get_contents('php://input'));
//echo "method is: " . $data->method; //method wird ausgeben (für Testing)

isset($_SERVER['REQUEST_METHOD']) ? $method = $_SERVER['REQUEST_METHOD'] : false;

$api = new Api();

$result = $api->processRequest($method);
if($result == null){
    response($method, 400, null);
}else{
    response($method, 200, $result);
}

//aus bsp kopiert
function response($method, $httpStatus, $data)
{
    header('Content-Type: application/json');
    switch ($method) {
        case "POST":
            http_response_code($httpStatus);
            echo (json_encode($data));
            break;
        case "GET":
            http_response_code($httpStatus);
            echo (json_encode($data));
            break;
        default:
            http_response_code(405);
            echo ("Method not supported yet!");
    }
}
