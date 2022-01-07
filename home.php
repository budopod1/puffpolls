<?php
include "conn.php";
session_start();

if (isset($_POST["delete"])){
    if (isset($_POST["check"])){
        $userid = $_SESSION["id"];
        $sql = "UPDATE users SET pass = '' WHERE id = $userid";
        $conn->exec($sql);
        header("Location: index.php");
        die();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <?php
        include "nav.php";
        include "sess.php"
        ?>
        <h1>Welcome <?php echo $_SESSION["username"]?></h1>
        <br>
        <form action="" method="POST">
            <button class="btn btn-danger" name="delete">DELETE</button>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="doubleCheck" name="check">
                <label class="form-check-label" for="doubleCheck">Are you sure?</label>
            </div>
        </form>
        <br>
        <h2 class="text-success">Login Success ✔️</h2>
        <?php include "footer.php" ?>
    </div>
</body>
</html>