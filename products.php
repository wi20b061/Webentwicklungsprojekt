<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="style.css"></script>

</head>
<body class="pt-1 pb-1 ps-5 pe-5">
    <div class="container-fluid mt-1 mb-1 bg-white">
        <header>
        <?php include("nav.php")?>
        <div class="row p-3">
            <!--Suchfeld-->
            <div class="col-10 border">
                <input name="search" id="search" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Search">
            </div>
            <!--Kategoriefilter - Default 1. Produktkategorie--> 
            <div class="col-2 border">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown button
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
            </div>
        </div>

        </header>
        <main class="p-3">
            <?php
                require_once ('dbaccess.php');

                $db_obj = new mysqli($host, $user, $password, $database);
                if ($db_obj->connect_error) {
                    echo "Connection Error: " . $db_obj->connect_error;
                    exit();
                }

                $sql = "SELECT * FROM product";
                $stmt = $db_obj->prepare($sql);
                $stmt->execute();
                $stmt->bind_result($id, $name, $details, $price, $img);
            
                $colCount = 0;
                ?>

            <div class="border row">

                <?php
                while ($stmt->fetch()) {
                ?>
                    
                    
                        <div class="col p-2 border">
                            
                        <?php
                            $colCount++;
                        
                            echo '<img class="img-fluid mx-auto d-block" src="' .$img . '">';
                            echo '<strong>' . $name . '</strong><br>';
                            echo number_format($price, 2, ",", ".") . '€<br>';

                        ?>
                        
                    </div>
                    

                <?php

                        if($colCount == 4){ // Reihe abschließen?>
                            
                            </div>
                            <div class="row">
                        <?php                 
                        }

                        
                    ?>
                        
                        <?php
                    }
                ?>
                <!--Reihe finally abschließen-->
                </div>

            

        </main>
        <footer>
            
        </footer>  
    </div>  
</body>
</html>