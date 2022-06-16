<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">    
    <script src="../js/registration.js"></script>
</head>
<body class="">
    <div class="container-fluid bg-white">
        <header class="sticky-top">
            <?php include("nav.php")?>
        </header>
        <main class="pt-1 pb-1 ps-5 pe-5 mt-2">
            <h1 class="display-6 mb-3">Create a Filara Profile</h1>

            <div  id="registrationForm"  name="registrationForm" >
                <label class="form-label" for="salutation" >Salutation</label>
                <select class="form-select" id="salutation" name="salutation">
                    <option value="mr">Mr.</option>
                    <option value="ms">Ms.</option>
                    <option value="various">Various</option>
                </select>

                <div class="row mt-1">
                    <div class="col">
                        <label for="fname" class="form-label">Firstname</label>
                        <input type="text"id="fname" name="fname" class="form-control" >
                        <div class="text-danger " id="fnameErr" name="fnameErr"></div>
                    </div>
                    <div class="col">
                        <label for="lname" class="form-label">Lastname</label>
                        <input type="text" id="lname" name="lname" class="form-control" >
                        <!--div container for error message-->
                        <div class="text-danger" id="lnameErr" name="lnameErr"></div>
                    </div>
                </div>

                <div class="row mt-1">
                    <div class="col">
                        <label for="streetname" class="form-label">Streetname</label>
                        <input type="text" class="form-control" id="streetname" name="streetname" >
                        <div class="text-danger" id="streetnErr" name="streetnErr"></div>
                    </div>
                    <div class="col">
                        <label for="streetnumber" class="form-label">Streetnumber</label>
                        <input type="text" class="form-control" id="streetnumber" name="streetnumber" >
                        <div class="text-danger" id="streetnrErr" name="streetnrErr"></div>
                    </div>
                </div>

                <div class="row mt-1">
                    <div class="col">
                        <label for="zip" class="form-label">Zip Code</label>
                        <input type="text" class="form-control" id="zip" name="zip" >
                        <div class="text-danger" id="zipErr" name="zipErr"></div>
                    </div>
                        <div class="col">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="location" name="location" >
                        <div class="text-danger" id="locErr" name="locErr"></div>
                    </div>
                </div>

                <label for="country" class="form-label mt-1">Country</label>
                <input type="text" class="form-control" id="country" name="country" >
                <div class="text-danger" id="counErr" name="counErr"></div>


                <div class="row mt-1">
                    <div class="col">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" >
                        <div class="text-danger" id="userErr" name="userErr"></div>
                    </div>
                    <div class="col">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email">
                        <div class="text-danger" id="emailErr" name="emailErr"></div>
                    </div>
                </div>

                <div class="row mt-1">
                    <div class="col">
                        <label for="pw" class="form-label">Password</label>
                        <input type="password" class="form-control" id="pw" name="pw">
                    </div>
                    <div class="col">
                        <label for="pw2" class="form-label">Repeat Password</label>
                        <input type="password" class="form-control" id="pw2" name="pw2">
                    </div>
                </div>
                <div class="text-danger" id="pwErr" name="pwErr"></div>
            
                <button class="btn text-white mt-2 mb-2"  name="submit" id="submit" style="background-color: #365370;">Submit</button>
                <button class="btn btn-secondary mt-2 mb-2" type="reset" name="reset">Reset</button>

            </div>
        </main>
        <?php include("footer.php")?>
    </div>

</body>
</html>