<?php

include("api.php");
require_once ('db/dbaccess.php');

$method = "";
//$data = json_decode(file_get_contents('php://input'));
//echo "method is: " . $data->method; //method wird ausgeben (für Testing)

echo "method is: " . $_POST["method"]; //method wird ausgeben (für Testing)
isset($_POST["method"]) ? $method = $_POST["method"] : false;

$api = new Api();
$result = $api->processRequest($method);
if($result == null){
    response("POST", 400, null);
}else{
    response("POST", 200, $result);
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
        default:
            http_response_code(405);
            echo ("Method not supported yet!");
    }
}
