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
        $data = json_decode(file_get_contents('php://input'));

        echo $data->salutation;
        
        /***VALIDIERUNG ****/
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

        //status code 201 = "created"
        $this->success(201, $result);

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