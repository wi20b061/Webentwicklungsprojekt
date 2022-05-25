<?php
include_once "model/product.php";

class ProductService{
    public function dbConnection(){
        $db_obj = new mysqli(HOST, USER, PASSWORD, DATABASE);
        if ($db_obj->connect_error) {
            echo "Collection failed!";
            exit();
        }
        return $db_obj;
    }


    public function getAllProducts(){
        $db_obj = $this->dbConnection();
        $sql = "SELECT * FROM product";
        
        $stmt = $db_obj->query($sql);
        $i=0;
        $products = array();
        if($result = $db_obj->query($sql)){
            while($row = $result ->fetch_row()){
                $products[$i] = new Product($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
                $i++;
            }
        }
        //close the connection
        $db_obj->close();

        return $products;
    }

    public function getProductById($productID){
        $db_obj = $this->dbConnection();
        
        $sql = "SELECT * FROM product WHERE productID = ?";
        $stmt = $db_obj->prepare($sql);
        $stmt->bind_param("i", $productID);
        $stmt->execute();

        //fertig machen!

    }
}