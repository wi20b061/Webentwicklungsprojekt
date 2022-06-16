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

    //add product to shooping cart
    public function addProduct($userID, $productID, $quantity){
        $db_obj = $this->dbConnection();
        $salesID = $this->getSalesHeaderID($userID, $db_obj, 0);

        //if customer doesn't have a shopping cart yet, create new one
        if(empty($salesID)){
            //create new salesheader
            $sql = "INSERT INTO salesheader (customerID, done) VALUES (?, ?)";
            $stmt = $db_obj->prepare($sql);
            $done = 0;
            $stmt->bind_param("ii", $userID, $done);
            $stmt->execute();
            $salesID = $this->getSalesHeaderID($userID, $db_obj, 0);
        }
        //check if product is already in shopping cart of this customer
        $sql = "SELECT saleslineID, quantity FROM salesline WHERE productID = ? AND salesheaderID = ?";
        $stmt = $db_obj->prepare($sql);
        $stmt->bind_param("ii", $productID, $salesID);
        $stmt->execute();
        $stmt->bind_result($salesLineID, $productqty);
        $stmt->fetch();
        $stmt->close();

        //increase qty of existing product in cart
        if(!empty($salesLineID)){
            $newqty = $productqty + $quantity;
            $sql = "UPDATE salesline SET quantity = ? WHERE saleslineID = ?";
            $stmt = $db_obj->prepare($sql);
            $stmt->bind_param("ii", $newqty, $salesLineID);
            if($stmt->execute()){
                return true;
            }
            return false;
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
        $salesHeaderID = $this->getSalesHeaderID($userID, $db_obj, 0);
        $returnArr = $this->getCartlineList($salesHeaderID);
        $cartlineList = $returnArr[0];
        $sumprice = $returnArr[1];
        $cart = new Cart($salesHeaderID[0], $userID, $cartlineList, $sumprice);
        //close the connection
        $db_obj->close();
        return $cart;
    }
    public function getCartlineList($salesHeaderID){
        $db_obj = $this->dbConnection();
        $sql = "SELECT saleslineID, productID, quantity FROM salesline WHERE salesheaderID = ?";
        $stmt = $db_obj->prepare($sql);
        $stmt->bind_param("i", $salesHeaderID);
        $stmt->execute();
        $cartlineList = array();
        $i = $sumprice = 0;
        $result = $stmt->get_result();
        while($row = $result->fetch_row()){
            $curproduct = $this->productService->getProductById($row[1]);
            //hier können auch noch mehr variablen ausgelesen werden für die Sales Line
            $cartlineList[$i] = new Cartline($row[0], $row[1], $curproduct->get_name(), $row[2], $curproduct->get_price());
            $sumprice += $curproduct->get_price() * $row[2];
            $i++;
        }
        $returnArr[0] = $cartlineList;
        $returnArr[1] = $sumprice;
        return $returnArr;
    }

    //delete product from cart - NOT DONE!
    public function deleteProduct($userID, $productID){
        $db_obj = $this->dbConnection();
        $salesID = $this->getSalesHeaderID($userID, $db_obj,0);  
    }

    //change qty of product in cart 
    public function updateProductQty($newQty, $salesLineID){
        $db_obj = $this->dbConnection();
        $sql = "UPDATE salesline SET quantity = ? WHERE saleslineID = ?";
        $stmt = $db_obj->prepare($sql);
        $stmt->bind_param("ii", $newQty, $salesLineID);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    
    //to get current sales header (warenkorb) of this user
    public function getSalesHeaderID($userID, $db_obj, $done){
        $sql = "SELECT salesID FROM salesheader WHERE customerID = ? AND done = ?";
        $stmt = $db_obj->prepare($sql);
        $stmt->bind_param("ii", $userID, $done);
        $stmt->execute();
        $salesIDs = array();
        $i = 0;
        $result = $stmt->get_result();
        while($row = $result->fetch_row()){
            $salesIDs[$i] = $row[0];
            $i++;
        }
        //close statement
        $stmt->close();
        return $salesIDs;
    }

}