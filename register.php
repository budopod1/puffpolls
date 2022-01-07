<?php
#Include connection file
include "./conn.php";
session_start();
if (isset($_POST["submit"])) { 
    $username = $_POST["username"];
    $pass = $_POST["pass"];
    $pass1 =$_POST["pass1"];
    if ($pass == $pass1){
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, pass) VALUES ('$username', '$pass')";
        $conn->exec($sql);
        header("Location: login.php");
        die();
    } else {
        echo "<script>alert(\"Your passwords don't match!\")</script>";
        echo "<noscript><h1>Your passwords don't match</h1></noscript>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Account</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <?php include "nav.php" ?>
        <div class="text-center">
            <h1 class="text-center">Get Your Account</h1>
            <small>(FOR FREE)</small>
        </div>
        <div class="p-5">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="pass">Password</label>
                    <input type="password" class="form-control" id="pass" placeholder="Enter password" name="pass" required>
                </div>
                <div class="form-group">
                    <label for="pass1">Confirm Password</label>
                    <input type="password" class="form-control" id="pass1" placeholder="Confirm Password" name="pass1" required>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Register Account</button>
            </form>
        </div>
        <?php include "footer.php" ?>
    </div>
</body>

</html>