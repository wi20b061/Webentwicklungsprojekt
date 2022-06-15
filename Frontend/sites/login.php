<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">    <script src="../js/login.js"></script>
    <title>Login</title>

</head>

<body class="">
    <div class="container-fluid bg-white">
        <header class="sticky-top">
            <?php include("nav.php")?>
        </header>
        <main class="pt-1 pb-1 ps-5 pe-5">

            <h2 class="display-6 mb-3">Log in to your Profile</h2>
            
            <!-- type="" auf text setzen und required weggegeben, da wir die validierung komplett selbst mit js implementieren-->
            <form  id="LoginForm" method="post" name="LoginForm">
                
            

                <div class="row mt-1">
                    <div class="col">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username">
                        <div class="text-danger" id="userErr" name="userErr"></div>
                    </div>
                </div>


                <div class="row mt-1">
                    <div class="col">
                        <label for="pw" class="form-label">Password</label>
                        <input type="password" class="form-control" id="pw" name="pw">
                        <div class="text-danger" id="pwErr" name="pwErr"></div>
                    </div>
                </div>

                <div class="row mt-1 justify-content-end">
                    <div class="col-auto">
                        <button class="btn text-white mt-2 mb-2" type="submit" name="submit" id="submit" style="background-color: #365370;">Submit</button>
                    </div>

                    <div class="col pt-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" style="background-color: #365370;" checked>
                            <label class="form-check-label" for="flexCheckChecked">Remember me</label>
                        </div>
                    </div>



                    <div class="col-auto text-end">
                        <span class="psw">Forgot <a href="#">password?</a></span>
                    </div>
                </div>

            </form>
        </main>
        <?php include("footer.php")?>
    </div>


    <script src="../js/login.js"></script>

</body>

</html>