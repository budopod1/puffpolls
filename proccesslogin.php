<?php
#Include connection file
include "./conn.php";
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $pass = $_POST["pass"];
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $st = $conn->prepare($sql);
    $st->execute();
    $user = $st->fetch(PDO::FETCH_ASSOC);

    if ($user['username'] == $username) {
        if (password_verify($pass, $user["pass"])) {
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            $_SESSION["id"] = $user["id"];
            $_SESSION["type"] = $user["type"];
            if ($user["type"] == "admin"){
                header("Location: admin.php");
                die();
            } else {
                header("Location: home.php");
                die();
            }
        } else {
            header("Location: login.php?error=Password not found");
            die();
        }
    } else {
        header("Location: login.php?error=Username not found");
        die();
    }
}
