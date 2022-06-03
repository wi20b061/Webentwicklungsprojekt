<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>

</head>

<body class="">
    <div class="container-fluid bg-white">
        <header class="sticky-top">
            <?php include("nav.php")?>
        </header>
        <main class="pt-1 pb-1 ps-5 pe-5">
            <!--onSubmit="validateForm()"   -> nicht verwendet, da sobald die validierung abgeschlossen ist die errormessages verschwinden-->
            <!-- type="" auf text setzen und required weggegeben, da wir die validierung komplett selbst mit js implementieren-->
            <form id="LoginForm" method="post" name="LoginForm">
                <label class="form-label" for="enterLoginInformation">Please Enter Your Login Informations</label>


                <div class="col">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" placeholder="Enter Username" class="form-control" id="username" name="username">
                    <div class="text-danger" id="userErr" name="userErr"></div>
                </div>


                <div class="col">
                    <label for="pw" class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="Enter Password" id="pw" name="pw">
                    <div class="text-danger" id="pwErr" name="pwErr"></div>
                </div>


                <button class="btn btn-primary mt-2 mb-2" type="submit" name="submit" id="submit">Submit</button>
                <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>

                <div class="col">
                    <span class="psw">Forgot <a href="#">password?</a></span>
                </div>


            </form>
        </main>
        <?php include("footer.php")?>
    </div>


    <script src="../js/login.js"></script>

</body>

</html>