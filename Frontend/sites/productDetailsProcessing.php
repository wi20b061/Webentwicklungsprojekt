<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProductDeatils</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/editProductByID.js"></script>   
</head>

<body class="">
    <div class="container-fluid bg-white">
        <header class="sticky-top">
            <?php
                include('nav.php')
            ?>
        </header>
        <main class="pt-1 pb-1 ps-5 pe-5">
            <div class="row mt-3">
                <div class="col">
                    <div id="img"></div>
                </div>
                <div class="col">
                    <div class="row"> 
                        <div class="col" id="name"></div>
                        <div class="col display-6" id="price"></div>
                    </div>
                    <div class="row" id="description"></div>
                    <div class="row"> 
                        <div class="col" id="type"></div>
                        <div class="col" id="ID"></div>
                    </div>
                    <div class="row" id="edit"></div>
                    <div class="row" id="delet"></div>
                </div>
            </div>   
        </main>
        <?php include("footer.php")?>
    </div>
</body>
</html>