<?php

include("registrationapi.php");

$method = "";

isset($_POST["method"]) ? $method = $_POST["method"] : false;

$registrationapi = new RegistrationApi();
$result = $registrationapi->processRequest($method);
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
