<?php
/**Salesline Model */

class Cartline{
    public $saleslineID;
    public $productID;
    public $productName;
    public $quantity;
    public $productprice;
    //public $salesHeaderID;
    
    public function __construct(int $saleslineID, int $productID, string $productName, int $quantity, float $productprice){
        $this->saleslineID      = $saleslineID;
        $this->productID        = $productID;
        $this->productName      = $productName;
        $this->quantity         = $quantity;
        $this->productprice     = $productprice;
    }

    function get_SaleslineID(){
        return $this->saleslineID;
    }
    function get_productID(){
        return $this->productID;
    }
    function get_quantity(){
        return $this->quantity;
    }
    function get_productprice(){
        return $this->productprice;
    }
    
}