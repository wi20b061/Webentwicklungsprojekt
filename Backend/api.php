<?php
include_once "logic/session.php";
include_once "model/user.php";
include_once "service/registrationservice.php";
include_once "service/loginservice.php";
include_once "service/productservice.php";
include_once "service/orderservice.php";
include_once "service/userservice.php";

class Api{

    public function __construct(){
        $this->registrationService = new RegistrationService();
        $this->loginService = new LoginService();
        $this->productService = new ProductService();
        $this->orderService = new OrderService();
        $this->userService = new UserService();
    }

    //switch request method
    public function processRequest($method){
        if(!($method == "POST" || $method == "GET" || $method == "DELETE")){
            $this->error(405, ["Allow: GET, POST, DELETE"], "Method not allowed - only GET, POST, DELETE");
        }
        if($method == "POST"){
            isset($_POST["request"]) ? $request = $_POST["request"] : false;
            switch($request){
                case "registration":
                    $result = $this->processRegistration();
                    break;
                case "login":
                    $result = $this->processLogin();
                    break;
                case "products":
                    $result = $this->processProducts();
                    break;
                case "order":
                    $result = $this->processOrder();
                    break;
                case "user":
                    $result = $this->processUserRequests();
                    break;
                default:
                    $result = null;
            }
        }else if($method == "GET"){
            if(isset($_GET["productID"])){
                $result = $this->getProductByID();
            }
            else if(isset($_SESSION["userID"]) && isset($_GET["request"]) && $_GET["request"] == "cart"){
                $result = $this->getShoppinCart();
            }
            else if(isset($_GET["products"])){
                $result = $this->getAllProducts();
            }
            else if(isset($_GET["search"])){
                $result = $this->search();
            }
            else if(isset($_GET["allUsers"])){
                $result = $this->getAllUsers();
            }
            else if(isset($_GET["userID"]) && isset($_GET["request"]) && $_GET["request"] == "adminOrders"){
                $result = $this->getOrdersByUserIdAdmin();
            }
            else if(isset($_GET["category"])){
                $result = $this->getProductByType();
            }
            else if(isset($_GET["userProfile"])){
                $result = $this->getUserDetails();
            }
            else if(isset($_GET["request"]) && $_GET["request"] == "orders"){
                $result = $this->getOrdersByUserId();
            }
            else if(isset($_GET["request"]) && $_GET["request"] == "invoice"){
                $result = $this->getInvoicePath();
            }
        }
        return $result;
    }

    /***** USER ******/
    private function processUserRequests(){
        if(!isset($_POST["userRequest"]) || empty($_POST["userRequest"])){
            $this->error(400, [], "Bad Request - userRequest-type required!");
        }else if($_POST["userRequest"] == "deactivateUser" && isset($_POST["userID"]) && !empty($_POST["userID"])){
            $userID = $this->test_input($_POST["userID"], "i");
            return $this->userService->deActivateUser($userID, 0);
        }else if($_POST["userRequest"] == "activateUser" && isset($_POST["userID"]) && !empty($_POST["userID"])){
            $userID = $this->test_input($_POST["userID"], "i");
            return $this->userService->deActivateUser($userID, 1);
        }
        //update Userdata (customer)
        else if($_POST["userRequest"] == "updateUserData"){
            if(!isset($_SESSION["userID"]) ||!isset($_POST["salutation"]) || !isset($_POST["fname"]) || !isset($_POST["lname"]) || !isset($_POST["streetname"]) || !isset($_POST["streetnr"]) || !isset($_POST["zip"])
            || !isset($_POST["location"]) || !isset($_POST["country"]) || !isset($_POST["email"]) ||
            empty($_SESSION["userID"]) || empty($_POST["salutation"]) || empty($_POST["fname"]) || empty($_POST["lname"]) || empty($_POST["streetname"]) || empty($_POST["streetnr"]) || empty($_POST["zip"])
            || empty($_POST["location"]) || empty($_POST["country"])  || empty($_POST["email"])){
                $this->error(400, [], "Bad Request - userID (Session), salutation, fname, lname, streetname, streetnr, zip, location, country, username, email are required!");
            }
            //Validation of data
            $userID =       $_SESSION["userID"];
            $salutation =   $_POST["salutation"];
            $fname =        $this->test_input($_POST["fname"], "s");
            $lname =        $this->test_input($_POST["lname"], "s");
            $streetname =   $this->test_input($_POST["streetname"], "s");
            $streetnr =     $this->test_input($_POST["streetnr"], "i");
            $zip =          $this->test_input($_POST["zip"], "i");
            $location =     $this->test_input($_POST["location"], "s");
            $country =      $this->test_input($_POST["country"], "s");
            $email =        $this->test_input($_POST["email"], "e");
            //pw, userID and username cannot be changed by the user
            return $this->userService->updateUserData($userID, $salutation, $fname, $lname, $streetname, $streetnr, $zip, $location, $country, $email);
        }
        //Check if password is valid to proceed with edit on user profile
        else if($_POST["userRequest"] == "checkPw" && isset($_SESSION["userID"]) && !empty($_SESSION["userID"])
        && isset($_POST["pw"]) && !empty($_POST["pw"])){
            return $this->userService->checkPassword($_SESSION["userID"], $_POST["pw"]);
        }
    }
    private function getInvoicePath(){
        if(!isset($_SESSION["userID"]) || !isset($_GET["salesheaderID"]) || empty($_SESSION["userID"]) || empty($_GET["salesheaderID"])){
            $this->error(400, [], "Bad Request - userID and salesheaderID are required!");
        }
        $userID = $_SESSION["userID"];
        $salesheaderID = $this->test_input($_GET["salesheaderID"], "i");
        return $this->userService->getInvoicePath($userID, $salesheaderID);
    }
    //Get Information for userprofile
    private function getUserDetails(){
        if(empty($_SESSION["userID"])){
            $this->error(400, [], "Bad Request - userID is required!");
        }
        return $this->userService->getUserDetails($_SESSION["userID"]);
    }
    //get a list of all customers
    private function getAllUsers(){
        return $this->userService->getAllUsers();
    }
    //get all finished orders of a user
    private function getOrdersByUserIdAdmin(){
        if(empty($_GET["userID"])){
            $this->error(400, [], "Bad Request - userID is required!");
        }
        //validation of userID
        $userID = $this->test_input($_GET["userID"], "i");
        return $this->userService->getOrdersByUserId($userID);
    }
    
    /***** ORDER ******/
    private function processOrder(){
        if(!isset($_POST["orderRequest"]) || empty($_POST["orderRequest"])){
            $this->error(400, [], "Bad Request - orderRequest-type required!");
        }
        //complete order (customer)
        if($_POST["orderRequest"] == "completeOrder"){
            if(!isset($_SESSION["userID"]) || empty($_SESSION["userID"])){
                $this->error(400, [], "Bad Request - userID is not set in session!");
            }
            $userID = $this->test_input($_SESSION["userID"], "i");
            return $this->orderService->completeOrder($userID);
        }
        
        //delete product from cart (customer)
        if($_POST["orderRequest"] == "deleteSalesline"){
            //VALIDATION
            if(!isset($_POST["saleslineID"]) || empty($_POST["saleslineID"])){
                $this->error(400, [], "Bad Request - saleslineID is required!");
            }
            $saleslineID = $this->test_input($_POST["saleslineID"], "i");
            return $this->orderService->deleteSalesLine($saleslineID);
        }
        //add new product to cart (customer)
        //Benötigte Infos: userID, productID, quantity
        //1.) Prüfen ob für diese Person salesheader (mit done = 0) existiert
        //2.) Wenn nicht -> neuen sales Header anlegen, ansonsten zum current hinzufügen
        //neue salesline hinzufügen
        if($_POST["orderRequest"] == "addProduct"){
            //VALIDATION
            if(!isset($_SESSION["userID"]) || !isset($_POST["productID"]) || !isset($_POST["quantity"]) || 
            empty($_SESSION["userID"]) ||empty($_POST["productID"]) || empty($_POST["quantity"])){
                $this->error(400, [], "Bad Request - userID, productID, quantity are required!");
            }
            $userID =       $this->test_input($_SESSION["userID"], "i");
            $productID =    $this->test_input($_POST["productID"], "i");
            $quantity =     $this->test_input($_POST["quantity"], "i");
            
            return $this->orderService->addProductToCart($userID, $productID, $quantity);
        }
        //update quantiy of a product in the cart
        if($_POST["orderRequest"] == "updateQty"){
            if(!isset($_POST["newQty"]) || !isset($_POST["salesLineID"]) || 
            empty($_POST["newQty"]) ||empty($_POST["salesLineID"])){
                $this->error(400, [], "Bad Request - newQty, salesLineID are required!");
            }
            $newQty =       $this->test_input($_POST["newQty"], "i");
            $salesLineID =    $this->test_input($_POST["salesLineID"], "i");
            return $this->orderService->updateProductQty($newQty, $salesLineID);
        }
    }
    //get the shopping cart of a customer
    private function getShoppinCart(){
        if(empty($_SESSION["userID"])){
            $this->error(400, [], "Bad Request - userID is empty"); 
        }
        $userID = $this->test_input($_SESSION["userID"], "i");
        return $this->orderService->getCart($userID); //List of products in Cart & sumprice of order
    }
    private function getOrdersByUserId(){
        if(!isset($_SESSION["userID"]) || empty($_SESSION["userID"])){
            $this->error(400, [], "Bad Request - userID is empty");
        }
        return $this->userService->getOrdersByUserId($_SESSION["userID"]);
    }

    /***** PRODUCTS ******/
    private function processProducts(){ //request says what to do
        if(!isset($_POST["productsrequest"]) || empty($_POST["productsrequest"]) ){
            $this->error(400, [], "Bad Request - products request type is required!");
        }
        //POST-Requests for products:
        //update Product
        if($_POST["productsrequest"] == "update" && isset($_POST["productID"]) && !empty($_POST["productID"]) && isset($_POST["name"]) && !empty($_POST["name"])
        && isset($_POST["productID"]) && !empty($_POST["productID"]) && isset($_POST["description"]) && !empty($_POST["description"])
        && isset($_POST["img"]) && !empty($_POST["img"]) && isset($_POST["type"]) && !empty($_POST["type"])
        && isset($_POST["price"]) && !empty($_POST["price"])){
            $productID =    $this->test_input($_POST["productID"], "i");
            $name =         $this->test_input($_POST["name"], "s");
            $description =  $this->test_input($_POST["description"], "s");
            $type =         $this->test_input($_POST["type"], "s");
            $price =        $this->test_input($_POST["price"], "f");
            $img =          $_POST["img"];

            return $this->productService->updateProduct($productID, $name, $description, $img, $type, $price);
        }
        //delete product
        if($_POST["productsrequest"] == "delete" && isset($_POST["productID"]) && !empty($_POST["productID"])){
            $productID = $this->test_input($_POST["productID"], "i");
            return $this->productService->deleteProduct($productID);
        }
        //add new product (with upload for pic)
        if($_POST["productsrequest"] == "newProduct" && isset($_POST["description"]) && !empty($_POST["description"])
        && isset($_POST["img"]) && !empty($_POST["img"]) && isset($_POST["type"]) && !empty($_POST["type"])
        && isset($_POST["price"]) && !empty($_POST["price"])&& isset($_POST["name"]) && !empty($_POST["name"])){
            $name =         $this->test_input($_POST["name"], "s");
            $description =  $this->test_input($_POST["description"], "s");
            $type =         $this->test_input($_POST["type"], "s");
            $price =        $this->test_input($_POST["price"], "i");
            $img =          $_POST["img"];
            return $this->productService->newProduct($name, $description, $img, $type, $price);
        }
        
        
    }
    //get product-details by the ID
    private function getProductByID(){
        if(empty($_GET["productID"])){
            $this->error(400, [], "Bad Request - productID is empty"); 
        }
        $productID = $this->test_input($_GET["productID"], "i");
        $product = $this->productService->getProductById($productID);
        if($product == null){
            $this->error(400, [], "Bad Request - productID does not exist");
        }
        return $product;
    }
    //get all products
    private function getAllProducts(){
        $products = $this->productService->getAllProducts();
        return $products;
    }
    //search products
    private function search(){        
        //if searchterm empty, alle Produkte zurück geben
        $productList = $this->productService->getSearchProducts($_GET["search"]);
        return $productList;
    }
    //get all Products by a Type
    private function getProductByType(){
        if(empty($_GET["category"])){
            $this->error(400, [], "Bad Request - category is required!");
        }else if($_GET["category"] != "shelf" && $_GET["category"] != "table" && $_GET["category"] != "chair" &&
        $_GET["category"] != "plant" && $_GET["category"] != "decoration" && $_GET["category"] != "couch"){
            $this->error(400, [], "Bad Request - category doesnt exist!");
        }
        $productList = $this->productService->getProductByType($_GET["category"]);
        return $productList;
    }

    /***** LOGIN ******/
    private function processLogin(){
        if(!isset($_POST["username"]) || !isset($_POST["pw"]) || empty($_POST["username"]) || empty($_POST["pw"])){
            $this->error(400, [], "Bad Request - username & pw are required!");
        }
        //Validation
        $username =     $this->test_input($_POST["username"], "u");
        $pw =           $_POST["pw"];
        if(!$result = $this->loginService->login($username, $pw)){
            $this->error(401, [], "Bad Request - username and pw dont match");
        }
        $this->success(201, $result);
    }

    /***** REGISTRATION ******/
    private function processRegistration(){
        //fetch data from posted body
        //!!Note that php://input is not available for requests specifying a Content-Type: multipart/form-data header 
        //(enctype="multipart/form-data" in HTML forms). This results from PHP already having 
        //parsed the form data into the $_POST superglobal.
        /*$data = json_decode(file_get_contents('php://input'));*/
        
        /***VALIDIERUNG ****/      
        if(!isset($_POST["salutation"]) || !isset($_POST["fname"]) || !isset($_POST["lname"]) || !isset($_POST["streetname"]) || !isset($_POST["streetnr"]) || !isset($_POST["zip"])
        || !isset($_POST["location"]) || !isset($_POST["country"]) || !isset($_POST["username"]) || !isset($_POST["email"]) || !isset($_POST["pw"]) ||
        empty($_POST["salutation"]) || empty($_POST["fname"]) || empty($_POST["lname"]) || empty($_POST["streetname"]) || empty($_POST["streetnr"]) || empty($_POST["zip"])
        || empty($_POST["location"]) || empty($_POST["country"]) || empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["pw"])){
            $this->error(400, [], "Bad Request - salutation, fname, lname, streetname, streetnr, zip, location, country, username, email, pw are required!");
        }

        //Valitation
        $salutation =   $_POST["salutation"];
        $fname =        $this->test_input($_POST["fname"], "s");
        $lname =        $this->test_input($_POST["lname"], "s");
        $streetname =   $this->test_input($_POST["streetname"], "s");
        $streetnr =     $this->test_input($_POST["streetnr"], "i");
        $zip =          $this->test_input($_POST["zip"], "i");
        $location =     $this->test_input($_POST["location"], "s");
        $country =      $this->test_input($_POST["country"], "s");
        $email =        $this->test_input($_POST["email"], "e");
        $username =     $this->test_input($_POST["username"], "u");
        $pw =           $this->test_input($_POST["pw"], "pw");      

        //create new user
        $user = new User($salutation, $fname, $lname, $streetname, $streetnr, $zip, $location, $country, $email, $username, $pw, "", 1);
        
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
        if(!preg_match("/^[a-zA-Z0-9\s]+$/", $data)){
            $this->error(402, [], "<br>Bad Request - invalid input: text"); 
        }
        return $data;
    }
    private function test_int($data){     
        if(!preg_match("/^\d+$/",$data)){  
            $this->error(402, [], "<br>Bad Request - invalid input: integer"); 
        }
        return $data;          
    }
    private function test_email($data){
        if(!filter_var($data, FILTER_VALIDATE_EMAIL)){
            $this->error(402, [], "<br>Bad Request - invalid input: email"); 
        }
        return $data;          
    }
    private function test_username($data){
        if(!preg_match("/^[a-zA-Z0-9\s]+$/",$data)){
            $this->error(402, [], "<br>Bad Request - invalid input: username"); 
        }
        return $data;          
    }
    private function test_pw($pw){
        if(!preg_match("/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.{8,})/",$pw)){
            $this->error(402, [], "<br>Bad Request - invalid input: password"); 
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