<?php

include_once "model/user.php";
require_once('dbaccess.php');

/**** COMMUNICATION WITH DB ****/

$db_obj = new mysqli($host, $user, $password, $database);
  if ($db_obj->connect_error) {
      echo "Collection failed!";
      exit();
  }

class RegistrationService{

    //Save the user
    public function save(User $user){
        //Überprüfung ob Username schon vergeben ist
        $sql = "SELECT username FROM user WHERE username = ?";
        
        $stmt = $db_obj->prepare($sql);
        $stmt->bind_param("s", $user->get_username());
        $stmt->execute();

        //"exists" beinhaltet Usernamen, die mit dem ausgewählten Usernamen übereinstimmen. 
        //Ist "exists" leer, ist der Username noch nicht in Verwendung und frei zur Wahl.
        $stmt->bind_result($exists);
        $stmt->fetch();
        //close statement
        $stmt->close();

        //???? Verschiedene Fehlermeldungen ausgeben ob fail oder ob username schon existiert
        if(!empty($exists)){
            //fehlermeldung zurück schicken - username gibt es bereits
            return false;
        }else{
            $sql = "INSERT INTO user (salutation, fname, lname, streetName, streetNr, zip, `location`, country, email, username, `password`)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt->bind_param("ssssiisssss", $user->get_salutation(), $user->get_fname(), $user->get_lname(),
                            $user->get_streetname(),$user->get_streetnr(),$user->get_zip(),$user->get_location(),
                            $user->get_country(),$user->get_email(),$user->get_username(),$user->get_pw());
            if($stmt->execute()){
                return true;
            }
        }
    }
}

?>