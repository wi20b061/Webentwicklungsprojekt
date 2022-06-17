<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/popper.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">    
    <script src="../js/getProducts.js"></script>

</head>
<body class="">
    <div class="container-fluid bg-white">
    
        <header class="sticky-top bg-white" >
            <?php include("nav.php")?>
            <div class="row justify-content-end">
                <!--Suchfeld-->
                <div class="col">
                    <input name="search" id="search" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Search">
                </div>
                <!--Kategoriefilter - Default 1. Produktkategorie--> 
                
                <div class="col-auto text-end">
                    <div class="dropdown">
                        <button class="btn text-white dropdown-toggle" style="background-color: #365370;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Category
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li class="dropdown-item">Table</li>
                            <li class="dropdown-item">Shelf</li>
                            <li class="dropdown-item">Chair</li>
                            <li class="dropdown-item">Couch</li>
                            <li class="dropdown-item">Plants</li>
                            <li class="dropdown-item">Decoration</li>
                        </ul>
                    </div>
                </div>
                
            </div>
            
        </header>

        <main class="pt-1 pb-1 ps-5 pe-5 mt-1">
            
            <div id="products">
                
            </div>

        </main>
        <?php include("footer.php")?>
    </div>
</body>

</html>