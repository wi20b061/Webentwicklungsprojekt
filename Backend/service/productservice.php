<?php
include_once "model/product.php";

class ProductService{

    //Connection to Database
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
        $stmt->bind_result($productID, $name, $desc, $img, $type, $price);
        $stmt->fetch();
        $stmt->close();
        if($productID == null){
            return null;
        }
        $product = new Product($productID, $name, $desc, $img, $type, $price);
        //close the connection
        $db_obj->close();
        
        return $product;
    }

    public function getSearchProducts($searchterm){
        $db_obj = $this->dbConnection();
        $sql = "SELECT * FROM `product` WHERE `name` LIKE ? OR `description` LIKE ? OR `type` LIKE ? LIMIT 0, 20;";
        $stmt = $db_obj->prepare($sql);
        $searchterm	= "%".$searchterm."%";
        $stmt->bind_param("sss", $searchterm,$searchterm,$searchterm);
        $stmt->execute();
        $productList = array();
        $i = 0;
        $result = $stmt->get_result(); //hier ist das Problem!
        while($row = $result->fetch_row()){
            //hier können auch noch mehr variablen ausgelesen werden für die Sales Line
            $productList[$i] = new Product($row[0], $row[1], $row[2],$row[3],$row[4],$row[5]);
            $i++;
        }
        //close the connection
        $db_obj->close();
        return $productList;
    }
}