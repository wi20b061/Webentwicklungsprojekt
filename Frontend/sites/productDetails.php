<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProductDeatils</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">    
</head>

<body class="">
    <div class="container-fluid bg-white">
        <header>
            <?php
                include('nav.php')
            ?>
        </header>
        <main class="pt-1 pb-1 ps-5 pe-5">
            <?php
                require_once ('../../Backend/db/dbaccess.php');

                $db_obj = new mysqli(HOST, USER, PASSWORD, DATABASE);
                if ($db_obj->connect_error) {
                    echo "Connection Error: " . $db_obj->connect_error;
                    exit();
                }

                $sql = "SELECT * FROM product WHERE productID = 1";
                $stmt = $db_obj->prepare($sql);
                $stmt->execute();
                $stmt->bind_result($id, $name, $description, $img, $type, $price);
            
                
                ?>

            <div class="border row">
                <?php
                while ($stmt->fetch()) {
                ?>
                        <div class="col-8 border"> 
                            <?php
                                echo '<img class="img-fluid mx-auto d-block border" src="' .$img . '">';     
                            ?>
                        </div>
                        <div class="col-4 p-4 border">
                            <div class="row">
                                <div class="col-7 border">
                            <?php
                                echo '<h1 class="display-6">' . $name . '</h1><br>';
                            ?>
                                </div>
                                <div class="col-5 border">
                            <?php
                                echo  '<p class="text-muted" style="">'.number_format($price, 2, ",", ".") . '€</p>';    
                            ?>
                                </div>
                            </div>
                            <?php
                                echo '<p>'.$description.'<p><br>';
                            ?>
                            <button type="button" class="btn btn-dark" style='background-color: #365370;'>Add to cart <i class="bi bi-basket-fill ms-1" style='font-size: 1.5rem; color: white;'></i></button>
                        </div>
                        <?php

                }?>
                
            </div>
                
        </main>
        <?php include("footer.php")?>
    </div>
</body>
</html>