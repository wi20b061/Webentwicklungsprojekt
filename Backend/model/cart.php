<?php
/**Cart Model */

class Cart{
    public $salesheaderID;
    public $customerID;
    public $cartlineList; //Array of Class Salesline
    public $sumprice;
    
    public function __construct(int $salesheaderID, int $customerID, $cartlineList, float $sumprice){
        $this->salesheaderID    = $salesheaderID;
        $this->customerID       = $customerID;
        $this->cartlineList     = $cartlineList;
        $this->sumprice         = $sumprice;
    }

    function get_salesheaderID(){
        return $this->salesheaderID;
    }
    function get_customerID(){
        return $this->customerID;
    }
    function get_cartlineList(){
        return $this->cartlineList;
    }
    function get_sumprice(){
        return $this->sumprice;
    }
    
}