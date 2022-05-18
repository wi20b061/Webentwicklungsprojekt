<?php

/**** COMMUNICATION WITH DB ****/

include_once "model/user.php";
//include_once "../db/dbaccess.php";
//require_once ('../db/dbaccess.php');

class RegistrationService{

    /*public function connectDB(){
        $host ="localhost";
        $user ="filara";
        $password= "filara";
        $database = "webentwicklungsprojekt";
        
        $db_obj = new mysqli($host, $user, $password, $database);
          if ($db_obj->connect_error) {
              echo "Collection failed!";
              exit();
          }
    }*/

    //Save the user
    public function save(User $user1){
        //DB connection
        $host ="localhost";
        $user ="filara";
        $password= "filara";
        $database = "webentwicklungsprojekt";
        
        $db_obj = new mysqli($host, $user, $password, $database);
          if ($db_obj->connect_error) {
              echo "Collection failed!";
              exit();
          }

        $salutation     = $user1->get_username();
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
        echo $username; //TESTING

        //DB BEFEHLE FÜR SPÄTER:
        /*
        //TESTING
        //Überprüfung ob auslesen aus der DB funktioniert (read only) - erfolgreich!
        $sql = "SELECT fname, lname, username FROM user";
        
        $result = $db_obj->query($sql);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo "<br>Name: " . $row["fname"] . " ". $row["lname"] . " username: " . $row["username"];
            }
        }else{
            echo "0 results";
        }

        //TESTING
        //Überprüfung ob auslesen aus der DB funktioniert mit prepared Statements - erfolgreich!
        */
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

        echo "<br>Username in DB: " . $exists . "<br>";
        

        if(!empty($exists)){
            //fehlermeldung zurück schicken - username gibt es bereits
            return "username exists";
        }else{
            $sql = "INSERT INTO user (salutation, fname, lname, streetName, streetNr, zip, `location`, country, email, username, `password`)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $db_obj->prepare($sql);
            $stmt->bind_param("ssssiisssss", $salutation, $fname, $lname,
                            $streetname,$streetnr,$zip,$location,
                            $country,$email,$username,$pw);
            if($stmt->execute()){
                return "executed";
            }
        }
        $db_obj->close();
    }
}

?>