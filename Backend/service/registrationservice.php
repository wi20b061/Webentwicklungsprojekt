<?php

include_once "model/user.php";

class RegistrationService{

    //Save the user
    public function save(User $user){
        //Überprüfung ob Username schon vergeben ist
        $sql = "SELECT username FROM users WHERE username = ?";
        $stmt = $db_obj->prepare($sql);
        //$stmt->bind_param("s", )//$user an der Stelle username?
    }
}

?>