<?php

include_once "model/cartline.php";
include_once "model/cart.php";
include_once "service/productservice.php";

class OrderService{

    public function __construct(){
        $this->productService = new ProductService(); 
    }

    //Connection to Database
    public function dbConnection(){
        $db_obj = new mysqli(HOST, USER, PASSWORD, DATABASE);
        if ($db_obj->connect_error) {
            echo "Collection failed!";
            exit();
        }
        return $db_obj;
    }

    public function addProduct($userID, $productID, $quantity){
        $db_obj = $this->dbConnection();
        $salesID = $this->getSalesHeaderID($userID, $db_obj);

        if(empty($salesID)){
            //create new salesheader
            $sql = "INSERT INTO salesheader (customerID, done) VALUES (?, ?)";
            $stmt = $db_obj->prepare($sql);
            $done = 0;
            $stmt->bind_param("ii", $userID, $done);
            $stmt->execute();

            $salesID = $this->getSalesHeaderID($userID, $db_obj);
        }
        //create new salesLine with product
        $sql = "INSERT INTO salesline (productID, quantity, salesheaderID) VALUES (?, ?, ?)";
        $stmt = $db_obj->prepare($sql);
        $stmt->bind_param("iii", $productID, $quantity, $salesID);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    //get shopping cart of user
    public function getCart($userID){
        $db_obj = $this->dbConnection();
        $salesHeaderID = $this->getSalesHeaderID($userID, $db_obj);
        
        $sql = "SELECT saleslineID, productID, quantity FROM salesline WHERE salesheaderID = ?";
        $stmt = $db_obj->prepare($sql);
        $stmt->bind_param("i", $salesHeaderID);
        $stmt->execute();
        $cartlineList = array();
        $i = $sumprice = 0;
        //if($result = $db_obj->query($sql)){
        $result = $stmt->get_result(); //hier ist das Problem!
        while($row = $result->fetch_row()){
            echo "this is " . $row[0];
            $curproduct = $this->productService->getProductById($row[1]);
            //hier können auch noch mehr variablen ausgelesen werden für die Sales Line
            $cartlineList[$i] = new Cartline($row[0], $row[1], $curproduct->get_name(), $row[2], $curproduct->get_price());
            $sumprice += $curproduct->get_price() * $row[2];
            $i++;
        }
        foreach ($cartlineList as $key => $value) {
            echo "CartLine - Key: " . $key . " Value: " . $value;
        }
        $cart = new Cart($salesHeaderID, $userID, $cartlineList, $sumprice);
        //close the connection
        $db_obj->close();
        return $cart;
    }

    public function deleteProduct($userID, $productID){
        $db_obj = $this->dbConnection();
        $salesID = $this->getSalesHeaderID($userID, $db_obj);  
    }
    
    //to get current sales header (warenkorb) of this user
    private function getSalesHeaderID($userID, $db_obj){
        $sql = "SELECT salesID FROM salesheader WHERE customerID = ? AND done = 0";
        
        $stmt = $db_obj->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $stmt->bind_result($salesID);
        $stmt->fetch();
        //close statement
        $stmt->close();

        return $salesID;
    }

}