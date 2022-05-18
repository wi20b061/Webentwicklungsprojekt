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
        /*$data = json_decode(file_get_contents('php://input'));

        echo $data->salutation;
        */
        /***VALIDIERUNG ****/
        /*
        //Validierung ob alle Felder befüllt sind und übergeben wurden (evtl mit Schleife verschönern)
        if(!isset($data->salutation) || !isset($data->fname) || !isset($data->lname) || !isset($data->streetname) || !isset($data->streetnr) || !isset($data->zip)
        || !isset($data->location) || !isset($data->country) || !isset($data->username) || !isset($data->email) || !isset($data->pw) ||
        empty($data->salutation) || empty($data->fname) || empty($data->lname) || empty($data->streetname) || empty($data->streetnr) || empty($data->zip)
        || empty($data->location) || empty($data->country) || empty($data->username) || empty($data->email) || empty($data->pw)){
            $this->error(400, [], "Bad Request - salutation, fname, lname, streetname, streetnr, zip, location, country, username, email, pw are required!");
        }
        //hier fehlt noch weitere Validierung

        //create new user
        $user = new User($data->salutation, $data->fname, $data->lname, $data->streetname, $data->streetnr,
                        $data->zip, $data->location, $data->country, $data->username, $data->email, $data->pw);
        if(($result = $this->registrationService->save($user)) === false){
            $this->error(400, [], "Bad Request - error saving user");
        }
        */
        echo "<br>Salutation is: " .$_POST["salutation"];
        if(!isset($_POST["salutation"]) || !isset($_POST["fname"]) || !isset($_POST["lname"]) || !isset($_POST["streetname"]) || !isset($_POST["streetnr"]) || !isset($_POST["zip"])
        || !isset($_POST["location"]) || !isset($_POST["country"]) || !isset($_POST["username"]) || !isset($_POST["email"]) || !isset($_POST["pw"]) ||
        empty($_POST["salutation"]) || empty($_POST["fname"]) || empty($_POST["lname"]) || empty($_POST["streetname"]) || empty($_POST["streetnr"]) || empty($_POST["zip"])
        || empty($_POST["location"]) || empty($_POST["country"]) || empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["pw"])){
            $this->error(400, [], "Bad Request - salutation, fname, lname, streetname, streetnr, zip, location, country, username, email, pw are required!");
        }
        //hier fehlt noch weitere Validierung

        //create new user
        $user = new User($_POST["salutation"], $_POST["fname"], $_POST["lname"], $_POST["streetname"],$_POST["streetnr"],
        $_POST["zip"],$_POST["location"],$_POST["country"], $_POST["username"],$_POST["email"], $_POST["pw"]);
        
        echo "<br>The username is: ". $user->get_username() ."<br>"; //TESTING
        
        $result = $this->registrationService->save($user);
        if($result == "username exists"){
            $this->error(401, [], "Bad Request - username already exists");
        }else if($result == "executed"){
            $this->success(201, $result);
        }else{
            $this->error(400, [], "Bad Request - error saving user");
        }
        /*if(($result = $this->registrationService->save($user)) === false){
            $this->error(400, [], "Bad Request - error saving user");
        }*/

        //status code 201 = "created"
        $this->success(201, $result);

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