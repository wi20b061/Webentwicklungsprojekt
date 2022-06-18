<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/popper.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">    
    <script src="../js/checkout.js"></script>

</head>
<body class="">
    <div class="container-fluid bg-white">
    
        <header class="sticky-top bg-white" >
            <?php include("nav.php")?>
            
            
            
        </header>

        <main class="pt-1 pb-1 ps-5 pe-5 mt-1">
            
            <div class="row">
                <div class="col">
                    <h2>Checkout</h2>
                    <!--style="background-color: #9AB4CE; font-weight: bold;"-->
                    <div class="row border rounded m-2 p-1" >
                        <div class="col border-end m-1" style="font-weight: bold;">
                            <div class="row">Shipping Information</div>
                        </div>
                        <div class="col m-1">
                            <div class="row">Standard delivery</div>
                            <div class="row">Estimated delivery date:</div>
                            <div class="row">20.06.2022</div>
                        </div>
                    </div>
                    <div class="row border rounded m-2 p-1">
                        <div class="col border-end m-1" style="font-weight: bold;">
                            <div class="row">Shipping Address</div>
                        </div>
                        <div class="col m-1" id="shippingAddress">
                            
                        </div>
                    </div>
                    <div class="row border rounded m-2 p-1">
                        <div class="col border-end m-1" style="font-weight: bold;">
                            <div class="row">Payment Information</div>
                        </div>
                        <div class="col m-1">
                            <div class="row">Payment by invoice</div>
                            <div class="row">Payment within 20 days after receipt</div>
                        </div>
                    </div>

                </div>
                <div class="col border-start">
                    <h3 class="border-bottom pb-1">Order Summary</h3>
                    <div class="row m-1">
                        <div class="col text-muted" >Product Price</div>
                        <div class="col text-end text-muted" id="product"></div> 
                    </div>
                    <div class="row border-bottom m-1 pb-1">
                        <div class="col text-muted">Shipping Costs</div>
                        <div class="col text-muted text-end" id="shipping">6.90</div> 
                    </div>
                    <div class="row m-1">
                        <div class="col " style="font-weight: bold;">Total</div>
                        <div class="col text-end" style="font-weight: bold;" id="total"></div> 
                    </div>
                    <div class="row m-1">
                        <div class="col text-muted">Total excl. USt.</div>
                        <div class="col text-muted text-end" id="totalExcl"></div> 
                    </div>
                    <div class="row m-1">
                        <div class="col text-muted">USt.</div>
                        <div class="col text-muted text-end" id="ust"></div> 
                    </div>
                    <div class="row m-1">
                        <button type="button" onclick="order()" class="btn btn-dark m-2" style="background-color: #365370;">Order <i class="bi bi-check-lg ms-1" style="font-size: 1.5rem; color: white;"></i></button>
                    </div>
                </div>
            </div>

        </main>
        <?php include("footer.php")?>
    </div>
</body>

</html>