<?php

/**User Model */

class User{
    //public $id; //gehört das hier rein?
    public $salutation;
    public $fname;
    public $lname;
    public $streetname;
    public $streetnr;
    public $zip;
    public $location;
    public $country;
    public $username;
    public $email;
    public $pw;

    public function __construct(string $salutation, string $fname, string $lname,string $streetname, int $streetnr,
                                int $zip, string $location, string $country, string $username, string $email, string $pw){
        $this->salutation       = $salutation;
        $this->fname            = $fname;
        $this->lname            = $lname;
        $this->streetname       = $streetname;
        $this->streetnr         = $streetnr;
        $this->zip              = $zip;
        $this->location         = $location;
        $this->username         = $username;
        $this->email            = $email;
        $this->pw               = $pw;
    }
    function get_salutation(){
        return $this->salutation;
    }
    function get_fname(){
        return $this->fname;
    }
    function get_lname(){
        return $this->lname;
    }
    function get_streetname(){
        return $this->streetname;
    }
    function get_zip(){
        return $this->streetnr;
    }
    function get_location(){
        return $this->salutation;
    }
    
}
?>