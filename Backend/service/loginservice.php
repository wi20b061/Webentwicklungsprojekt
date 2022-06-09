<?php

class LoginService{
    public function login($username, $pw){
        //DB connection
        $db_obj = new mysqli(HOST, USER, PASSWORD, DATABASE);
        if ($db_obj->connect_error) {
            echo "Collection failed!";
            exit();
        }
        $sql = "SELECT username, `password` FROM user WHERE username = ? AND active = 1";
        
        $stmt = $db_obj->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($usernameDB, $pwDB);
        $stmt->fetch();
        
        if(!empty($pwDB) && password_verify($pw, $pwDB)){
            return true;
            //close statement
            $stmt->close();
        }
        //close the connection
        $db_obj->close();
        return false;
    }
}