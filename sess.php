<?php
if ($_SESSION["loggedin"] != true){
    header("Location: login.php?error=Please sign in");
    die();
}