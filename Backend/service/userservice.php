<?php
include_once "model/user.php";
include_once "model/cartline.php";
include_once "model/order.php";
include_once "service/productservice.php";
include_once "service/orderservice.php";

class UserService{

    public function __construct(){
        $this->productService = new ProductService(); 
        $this->orderService = new OrderService(); 
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
    
    public function deActivateUser($userID, $active){
        $db_obj = $this->dbConnection();
        $sql = "UPDATE user SET active = ? WHERE userID = ?";
        $stmt = $db_obj->prepare($sql);
        $stmt->bind_param("ii", $active,$userID);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    //get user details for user profile
    public function getUserDetails($userID){
        $db_obj = $this->dbConnection();
        $sql = "SELECT userID, salutation, fname, lname, streetName, streetNr, zip, `location`, country, email, username, paymentOption FROM `user` WHERE userID = ?";
        $stmt = $db_obj->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $stmt->bind_result($userID, $salutation, $fname, $lname, $streetname, $streetNr, $zip, $location, $country, $email, $username, $paymentOption);
        $stmt->fetch();
        $stmt->close();
        $user = new User($salutation, $fname, $lname, $streetname, $streetNr, $zip, $location, $country, $email, $username, "", $paymentOption, 1);
        $user->set_userID($userID);
        return $user;
    }

    //get information of all users (as array)
    public function getAllUsers(){
        $db_obj = $this->dbConnection();
        $sql = "SELECT * FROM user WHERE adminUser = 0";
        $i=0;
        $users = array();
        if($result = $db_obj->query($sql)){
            while($row = $result ->fetch_row()){
                $users[$i] = new User($row[1], $row[2], $row[3], $row[4], $row[5],$row[6],$row[7],$row[8],$row[9],$row[10],"", $row[12], $row[13]);
                $users[$i]->set_userID($row[0]);
                $i++;
            }
        }
        //close the connection
        $db_obj->close();
        return $users;
    }

    public function getOrdersByUserId($userID){
        $db_obj = $this->dbConnection();
        $salesHeaderIDs = $this->orderService->getSalesHeaderID($userID, $db_obj, 1);
        $orders = array();
        for($i=0; $i < count($salesHeaderIDs); $i++){
            $returnArr = $this->orderService->getCartlineList($salesHeaderIDs[$i]);
            $curCartlineList = $returnArr[0];
            $curSumprice = $returnArr[1];
            $orderDate = $this->getOrderDate($salesHeaderIDs[$i]);
            $orders[$i] = new Order($salesHeaderIDs[$i], $userID, $curCartlineList, $curSumprice, $orderDate);
        }
        //close the connection
        $db_obj->close();
        return $orders;
    }

    public function getOrderDate($salesHeaderID){
        $db_obj = $this->dbConnection();
        $sql = "SELECT orderDate FROM salesheader WHERE salesID = ?";
        
        $stmt = $db_obj->prepare($sql);
        $stmt->bind_param("i", $salesHeaderID);
        $stmt->execute();
        $stmt->bind_result($orderDate);
        $stmt->fetch();
        $stmt->close();

        return $orderDate;
    }


}