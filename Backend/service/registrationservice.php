<?php

/**** COMMUNICATION WITH DB ****/

include_once "model/user.php";

class RegistrationService{

    //Save the user
    public function save(User $user1){
        $db_obj = new mysqli(HOST, USER, PASSWORD, DATABASE);
        if ($db_obj->connect_error) {
            echo "Collection failed!";
            exit();
        }
        $salutation     = $user1->get_salutation();
        $fname          = $user1->get_fname();
        $lname          = $user1->get_lname();
        $streetname     = $user1->get_streetname();
        $streetnr       = $user1->get_streetnr();
        $zip            = $user1->get_zip();
        $location       = $user1->get_location();
        $country        = $user1->get_country();
        $username       = $user1->get_username();
        $email          = $user1->get_email();
        $pw             = $user1->get_pw();
        $active         = $user1->get_active();

        //Überprüfung ob Username schon vergeben ist
        $sql = "SELECT username FROM user WHERE username = ?";
        
        $stmt = $db_obj->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        //"exists" beinhaltet Usernamen, die mit dem ausgewählten Usernamen übereinstimmen. 
        //Ist "exists" leer, ist der Username noch nicht in Verwendung und frei zur Wahl.
        $stmt->bind_result($exists);
        $stmt->fetch();
        //close statement
        $stmt->close();
        
        //password hashen
        if(!empty($exists)){
            //fehlermeldung zurück schicken - username gibt es bereits
            return "username exists";
        }else{
            $sql = "INSERT INTO user (salutation, fname, lname, streetName, streetNr, zip, `location`, country, email, username, `password`, active)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $db_obj->prepare($sql);
            $stmt->bind_param("ssssiisssssi", $salutation, $fname, $lname,
                            $streetname,$streetnr,$zip,$location,
                            $country,$email,$username,$pw, $active);
            if($stmt->execute()){
                return "executed";
            }
        }
        $db_obj->close();
    }
}

?>