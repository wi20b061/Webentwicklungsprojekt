<?php

include_once "model/user.php";
include_once "service/registrationservice.php";


class Api{
    private $registrationService;

    public function __construct(){
        $this->registrationService = new RegistrationService();
    }

    //switch request method
    public function processRequest($method){
        switch($method){
            case "registration":
                $result = $this->processRegistration();
                break;
            default:
                $result = null;
        }
        return $result;
    }

    private function processRegistration(){
        //fetch data from posted body
        //!!Note that php://input is not available for requests specifying a Content-Type: multipart/form-data header 
        //(enctype="multipart/form-data" in HTML forms). This results from PHP already having 
        //parsed the form data into the $_POST superglobal.
        /*$data = json_decode(file_get_contents('php://input'));*/
        
        /***VALIDIERUNG ****/      
        echo "<br>Salutation is: " .$_POST["salutation"]; //TESTING
        if(!isset($_POST["salutation"]) || !isset($_POST["fname"]) || !isset($_POST["lname"]) || !isset($_POST["streetname"]) || !isset($_POST["streetnr"]) || !isset($_POST["zip"])
        || !isset($_POST["location"]) || !isset($_POST["country"]) || !isset($_POST["username"]) || !isset($_POST["email"]) || !isset($_POST["pw"]) ||
        empty($_POST["salutation"]) || empty($_POST["fname"]) || empty($_POST["lname"]) || empty($_POST["streetname"]) || empty($_POST["streetnr"]) || empty($_POST["zip"])
        || empty($_POST["location"]) || empty($_POST["country"]) || empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["pw"])){
            $this->error(400, [], "Bad Request - salutation, fname, lname, streetname, streetnr, zip, location, country, username, email, pw are required!");
        }

        //valitation
        $salutation =   $_POST["salutation"];
        $fname =        $this->test_input($_POST["fname"], "s");
        $lname =        $this->test_input($_POST["lname"], "s");
        $streetname =   $this->test_input($_POST["streetname"], "s");
        $streetnr =     $this->test_input($_POST["streetnr"], "i");
        $zip =          $this->test_input($_POST["zip"], "i");
        $location =     $this->test_input($_POST["location"], "s");
        $country =      $this->test_input($_POST["country"], "s");
        $username =     $this->test_input($_POST["username"], "u");
        $email =        $this->test_input($_POST["email"], "e");
        $pw =           $this->test_input($_POST["pw"], "pw");      

        //create new user
        $user = new User($salutation, $fname, $lname, $streetname,$streetnr,$zip,$location,$country, $username,$email, $pw);
        
        echo "<br>The username is: ". $user->get_username() ."<br>"; //TESTING
        
        $result = $this->registrationService->save($user);
        if($result == "username exists"){
            $this->error(401, [], "Bad Request - username already exists");
        }else if($result == "executed"){
            $this->success(201, $result);
        }else{
            $this->error(400, [], "Bad Request - error saving user");
        }

        //status code 201 = "created"
        $this->success(201, $result);

    }

    /* VALIDATION FUNCTIONS */
    //Test der Einzelnen Eingaben (s = String, i = Integer, e = email)
    private function test_input($data, $type){
        $data = trim($data);
        $data = stripslashes($data);
        if($type == "i"){
            $data = $this->test_int($data);
        }else if($type == "e"){
            $data = $this->test_email($data);
        }else if($type == "s"){
            $data = $this->test_string($data);
        }else if($type == "u"){
            $data = $this->test_username($data);
        }else if($type == "pw"){
            $data = $this->test_pw($data);
        }
        return $data;
    }

    private function test_string($data){
        if(!preg_match("/^[a-zA-Z\s]+$/", $data)){
            $this->error(402, [], "Bad Request - invalid string"); 
        }
        return $data;
    }
    private function test_int($data){
        if(!preg_match("/^\d+$/",$data)){  
            $this->error(402, [], "Bad Request - invalid integer"); 
        }
        return $data;          
    }
    private function test_email($data){
        if(!filter_var($data, FILTER_VALIDATE_EMAIL)){
            $this->error(402, [], "Bad Request - invalid email"); 
        }
        return $data;          
    }
    private function test_username($data){
        if(!preg_match("/^[a-zA-Z0-9\s]+$/",$data)){
            $this->error(402, [], "Bad Request - invalid username"); 
        }
        return $data;          
    }
    private function test_pw($pw){
        if(!preg_match("/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.{8,})/",$pw)){
            $this->error(402, [], "Bad Request - invalid password"); 
        }
        $pw = password_hash($pw, PASSWORD_DEFAULT);
        return $pw;          
    }
    

     /** format success response and exit
     * @param int $code HTTP code (2xx)
     * @param $obj result object
    */
    private function success(int $code, $obj) {
        http_response_code($code);
        header('Content-Type: application/json');
        echo(json_encode($obj));
        exit;
    }


    /** format error (with headers) and exit
     * @param int $code HTTP response code (4xx or 5xx)
     * @param array $headers
     * @param string $msg 
     */
    private function error(int $code, array $headers, $msg) {
        http_response_code($code);
        foreach ($headers as $hdr) {
            header($hdr);
        }    
        echo ($msg);
        exit;
    }  
}

?>