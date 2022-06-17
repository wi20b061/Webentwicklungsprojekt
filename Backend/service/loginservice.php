<?php

class LoginService{
    public function login($username, $pw){
        //DB connection
        $db_obj = new mysqli(HOST, USER, PASSWORD, DATABASE);
        if ($db_obj->connect_error) {
            echo "Collection failed!";
            exit();
        }
        $sql = "SELECT userID, username, `password`, adminUser FROM user WHERE username = ? AND active = 1";
        
        $stmt = $db_obj->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($userID, $usernameDB, $pwDB, $isAdmin);
        $stmt->fetch();
        
        if(!empty($pwDB) && password_verify($pw, $pwDB)){         
            $stmt->close();
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
            $_SESSION['userID'] = $userID;
            $_SESSION['adminUser'] = $isAdmin;
            return true;
        }
        //close the connection
        $db_obj->close();
        return false;
    }
}