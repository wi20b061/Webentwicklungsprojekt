<?php


class OrderService{

    public function addProduct($userID, $productID, $quantity){
        $db_obj = new mysqli(HOST, USER, PASSWORD, DATABASE);
        if ($db_obj->connect_error) {
            echo "Collection failed!";
            exit();
        }
        $salesID = $this->getSalesHeaderID($userID, $db_obj);

        if(empty($salesID)){
            //create new salesheader
            echo "\nnew salesheader needed";
            $sql = "INSERT INTO salesheader (customerID, done) VALUES (?, ?)";
            $stmt = $db_obj->prepare($sql);
            $done = 0;
            $stmt->bind_param("ii", $userID, $done);
            $stmt->execute();

            $salesID = $this->getSalesHeaderID($userID, $db_obj);
        }
        echo "\nsalesHeaderID: " . $salesID;
        //create new salesLine with product
        $sql = "INSERT INTO salesline (productID, quantity, salesheaderID) VALUES (?, ?, ?)";
        $stmt = $db_obj->prepare($sql);
        $stmt->bind_param("iii", $productID, $quantity, $salesID);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function deleteProduct($userID, $productID){
        $db_obj = new mysqli(HOST, USER, PASSWORD, DATABASE);
        if ($db_obj->connect_error) {
            echo "Collection failed!";
            exit();
        }
        $salesID = $this->getSalesHeaderID($userID, $db_obj);

        
    }
    
    //to get current sales header (warenkorb) of this user
    private function getSalesHeaderID($userID, $db_obj){
        $sql = "SELECT salesID FROM salesheader WHERE customerID = ? AND done = 0";
        
        $stmt = $db_obj->prepare($sql);
        $stmt->bind_param("s", $userID);
        $stmt->execute();
        $stmt->bind_result($salesID);
        $stmt->fetch();
        //close statement
        $stmt->close();

        return $salesID;
    }
}