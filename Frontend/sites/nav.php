<?php
  session_start();
?>


<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #F0F2E6">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="../../Frontend/pictures/FILARA.png" alt="" width="100" height="65" class="d-inline-block align-text-top">
    </a>

    <div class="justify-content-end me-3">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item mt-1">
            <a class="nav-link" href="products.php">Products</a>
          </li>
          <?php
            //Überprüfung ob der User bereits eingeloggt ist, sollte das der fall sein, wird das if statement ausgeführt
            //und der User sieht die tickets, profile Page und den Logout button.
          if(isset($_SESSION["userID"])){
            echo "<li class='nav-item mt-1'><a class='nav-link' href='login.php'>Logout</a></li>";

            //Neben einem kleinen Warenkorbsymbol auf der Seite wird die aktuelle
            //Anzahl der sich gerade im Warenkorb befindlichen Produkte angezeigt
            //– diese Zahl wird ebenfalls via AJAX aktualisiert. Beim Stöbern durch
            //die Produkte und beim „Einkaufen“ soll der User nie die Seite verlassen
            //müssen.
            echo "<li class='nav-item mt-1'><a class='nav-link' href='profile.php'>Profile</a></li>";
            
          }
            //Sollte User nicht eingeloggt sein, werden ihm nur Register und Login angezeigt.
          else{
          
            echo "<li class='nav-item mt-1'><a class='nav-link' href='registration.php'>Register</a></li>";
            echo "<li class='nav-item mt-1'><a class='nav-link' href='login.php'>Login</a></li>";
            echo "<li class='nav-item ms-4'><i class='bi bi-basket-fill' style='font-size: 2rem; color: #365370;'></i></li>";
            echo "<li class='nav-item ms-1'><div class='' id='productCount' style='color: #365370; font-weight: bold;'>0</div></li>";

          }
          ?>
        </ul>
        <?php
        //Es wird hierbei geschaut ob der User eingeloggt ist mithilfe von Sessions, sollte er eingeloggt sein wird sein Name angezeigt.
          if(isset($_SESSION["usersID"])){
                echo "Hallo ". $_SESSION["username"];
          }
        ?>
      </div>
    </div>
  </div>
</nav>