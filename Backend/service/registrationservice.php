<?php

include_once "model/user.php";

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
    }
}

?>