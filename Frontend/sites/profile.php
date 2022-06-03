<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">    
</head>
<body class="">
    <div class="container-fluid bg-white">
        <header class="sticky-top bg-white">
            <?php include("nav.php")?>
            
        </header>
        <main class="pt-1 pb-1 ps-5 pe-5">
        
            <?php
                require_once ('../../Backend/db/dbaccess.php');

                $db_obj = new mysqli(HOST, USER, PASSWORD, DATABASE);
                if ($db_obj->connect_error) {
                    echo "Connection Error: " . $db_obj->connect_error;
                    exit();
                }

                $sql = "SELECT * FROM users WHERE userID='1'";
                $stmt = $db_obj->prepare($sql);
                $stmt->execute();
                $stmt->bind_result($userId ,$salutation, $fname, $lname, $streetName, $streetNr, $zip, $location, $country, $email, $username, $password, $paymentOption, $status, $adminUser);
            ?>
        <!--
            <div class="row mt-2 rounded text-white p-1 opacity-75" style="background-color: #365370;">
                <div class="col border-bottom ms-1 me-1 pt-1">
                    <h4 style="font-weight: normal;">Personal Information</h4>
                </div>
                <div class="col-auto text-end ms-1 me-1 pt-1">
                    <i class="bi bi-pencil-square " style="color: white;"> Edit</i>
                </div>
                <div class="m-2">
                    <?php/*
                    while ($stmt->fetch()) {
                    
                        echo $salutation . '<br>';
                        echo $fname . ' ' . $lname . '<br>';
                        echo $email . '<br>';
                        echo $username . '<br>';*/
                    ?>
                </div>
            </div>
            <div class="row mt-2 rounded text-white p-1 opacity-75" style="background-color: #365370;">
                <div class="col border-bottom ms-1 me-1 pt-1">
                    <h4 style="font-weight: normal;">Address</h4>
                </div>
                <div class="col-auto text-end ms-1 me-1 pt-1">
                    <i class="bi bi-pencil-square " style="color: white;"> Edit</i>
                </div>
                <div class="m-2">
                <?php/*
                echo $streetName . ' ' . $streetNr . '<br>';
                echo $zip .' '. $location .'<br>';
                echo $country . '<br>';
                }*/
                ?>
                </div>
                
            </div>
            -->

            <div>
                <h3 class="pb-1" style="border-bottom: 1pt solid #365370; ">My Profile</h3>

                <div class="p-2">
                <?php
                
                    while($stmt->fetch()) {
                        echo $salutation . '<br>';
                        echo $fname . ' ' . $lname . '<br>';
                        echo $email . '<br>';
                        echo $username . '<br>';
                        echo $streetName . ' ' . $streetNr . '<br>';
                        echo $zip .' '. $location .'<br>';
                        echo $country;
                    }
                
                ?>
                </div>
            </div>
        </main>
        <?php include("footer.php")?>
    </div>  
</body>


</html>