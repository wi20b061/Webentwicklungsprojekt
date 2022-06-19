<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(isset($_GET['logout']) && $_GET['logout'] == 'true'){

    session_unset();
    session_destroy();
    header('../../Frontend/sites/products.php');
    die();
}