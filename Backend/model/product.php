<?php
/**Product Model */

class Product{
    public $id;
    public $name;
    public $path;
    public $type;
    public $price;

    public function __construct(string $id, string $name, string $path,string $type, int $price){
        $this->id         = $id;
        $this->name       = $name;
        $this->path       = $path;
        $this->type       = $type;
        $this->price      = $price;
    }

    function get_id(){
        return $this->id;
    }
    function get_name(){
        return $this->name;
    }
    function get_path(){
        return $this->path;
    }
    function get_type(){
        return $this->type;
    }
    function get_price(){
        return $this->price;
    }
    
}