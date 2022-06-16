<?php
include_once "model/user.php";

class UserService{

    //Connection to Database
    public function dbConnection(){
        $db_obj = new mysqli(HOST, USER, PASSWORD, DATABASE);
        if ($db_obj->connect_error) {
            echo "Collection failed!";
            exit();
        }
        return $db_obj;
    }

    public function getAllUsers(){
        $db_obj = $this->dbConnection();
        $sql = "SELECT * FROM user WHERE adminUser = 0";
        $i=0;
        $users = array();
        if($result = $db_obj->query($sql)){
            while($row = $result ->fetch_row()){
                $users[$i] = new User($row[1], $row[2], $row[3], $row[4], $row[5],$row[6],$row[7],$row[8],$row[9],$row[10],"", $row[12], $row[13]);
                $users[$i]->set_userID($row[0]);
                $i++;
            }
        }
        //close the connection
        $db_obj->close();
        return $users;
    }


}