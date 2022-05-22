<?php
include_once "model/product.php";

class ProductService{
    public function getAllProducts(){
        $db_obj = new mysqli(HOST, USER, PASSWORD, DATABASE);
        if ($db_obj->connect_error) {
            echo "Collection failed!";
            exit();
        }
        $sql = "SELECT * FROM product";
        
        $stmt = $db_obj->query($sql);
        $i=0;
        $products = array();
        if($result = $db_obj->query($sql)){
            while($row = $result ->fetch_row()){
                $products[$i] = new Product($row[0], $row[1], $row[2], $row[3], $row[4]);
                $i++;
            }
        }
        //close the connection
        $db_obj->close();

        return $products;
    }
}