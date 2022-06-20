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
    <script src="../js/getnewProduct.js"></script>   
</head>

<body class="">
    <div class="container-fluid bg-white">
        <header class="sticky-top">
            <?php
                include('nav.php')
            ?>
        </header>
        <main class="pt-1 pb-1 ps-5 pe-5 ">
                <div class="col">
                    <div class="row"> 
                        <div class="col display-6">
                        <label for="productName" class="form-label">Productname</label>
                        <input type="text" id="productName" name="productName" class="form-control" >
                        </div>

                        <div class="col display-6">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" id="price" name="price" class="form-control" >
                        </div>
                    </div>
                    <div class="row">
                    <div class="col">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" id="description" name="description" class="form-control" >
                    </div>
                    </div>

                    <div class="row"> 
                        <div class="col" id="type">
                        <label class="form-label" for="type1" >Type</label>
                        <select class="form-select" id="type1" name="type1">
                        <option value="shelf">Shelf</option>
                        <option value="couch">Couch</option>
                        <option value="plants">Plants</option>
                        <option value="decoration">Decoration</option>
                        <option value="decoration">Table</option>
                        <option value="decoration">Chair</option>
                        </select>

                        </div>

                        </div>
                    </div>
                    <div class="row">
                    <button class="btn text-white mt-2 mb-2"  onclick="sendData()" name="save" id="save" type="submit" style="background-color: #365370;">Save</button>
                    </div>

                </div>
 
        </main>
        <?php include("footer.php")?>
    </div>
</body>
</html>