<?php
//Middleware for redirecing guests to login
if(!isset($_SESSION['r_name'])){
    header("Location: login.php");
}
?>