<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/popper.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">    
    <script src="../js/shoppingCart.js"></script>

</head>
<body class="">
    <div class="container-fluid bg-white">
    
        <header class="sticky-top bg-white" >
            <?php include("nav.php")?>
        </header>

        <main class="pt-1 pb-1 ps-5 pe-5 mt-1">
            <h1 class="display-6">Shopping Cart</h1>

            <div class="row m-4">
                <div id="cart" class="col-md-8">

                </div>
                <div class="col-md-4 mt-3 border-start">
                    <h2 style="" class="border-bottom">Order Summary</h2>
                    <div class="row">
                        <div class="col" style="font-weight: bold;">Subtotal</div>
                        <div class="col text-end" id="subtotal"></div> 
                    </div>
                    <div class="row">
                        <div class="col text-muted">Total excl. USt.</div>
                        <div class="col text-muted text-end" id="totalExcl"></div> 
                    </div>
                    <div class="row">
                        <div class="col text-muted">USt.</div>
                        <div class="col text-muted text-end" id="ust"></div> 
                    </div>
                    <div class="row" id="checkOut">
                        <button type="button" onclick="checkOut()" class="btn btn-dark m-2" style="background-color: #365370;">Checkout <i class="bi bi-cart-check-fill ms-1" style="font-size: 1.5rem; color: white;"></i></button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>