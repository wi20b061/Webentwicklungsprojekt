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
    <script src="../js/profile.js"></script>    
</head>
<body class="">
    <div class="container-fluid bg-white">
        <header class="sticky-top bg-white">
            <?php include("nav.php")?>
            
        </header>
        <main class="pt-1 pb-1 ps-5 pe-5">
        
            <?php
                /*require_once ('../../Backend/db/dbaccess.php');

                $db_obj = new mysqli(HOST, USER, PASSWORD, DATABASE);
                if ($db_obj->connect_error) {
                    echo "Connection Error: " . $db_obj->connect_error;
                    exit();
                }

                $sql = "SELECT * FROM users WHERE userID='1'";
                $stmt = $db_obj->prepare($sql);
                $stmt->execute();
                $stmt->bind_result($userId ,$salutation, $fname, $lname, $streetName, $streetNr, $zip, $location, $country, $email, $username, $password, $paymentOption, $status, $adminUser);
                */
            ?>

            <div class="row mt-3">
                <div class="col-4 border-end">
                    <h1 class="display-6">Hello <span class="badge" style="background-color: #365370;">Username<span></h1>

                    <div class="">
                        <!--onclick hinzufügen, dann wird im div #content der inhalt geladen-->
                        <div class="border-bottom" >
                            <button class="btn"  type="button" data-bs-toggle="button" id="personalData" style="color: #365370;">Personal Data</button>
                        </div> 
                        <div class="border-bottom" >
                            <button class="btn" type="button" data-bs-toggle="button" id="orders" style="color: #365370;">My Orders</button>
                        </div>
                    </div>
                </div>
                
                <div class="col-8">
                    <!--<h3 class="border display-6">My Profile</h3>-->
                    <div id="content">

                    </div>
                </div>
            </div>
        </main>
        <?php include("footer.php")?>
    </div>  
</body>


</html>