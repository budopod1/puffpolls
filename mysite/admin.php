<?php
include "conn.php";
if (isset($_POST["poll"])){
    $title=$_POST["title"];
    $userid=$_SESSION["id"];
    $sql = "INSERT INTO polls (title, userid) VALUES ('$title', '$userid')";
    $conn->exec($sql);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <?php include "nav.php" ?>
        <?php include "sess.php" ?>
        <?php
        if ($_SESSION["type"] != "admin") {
            header("Location: login.php");
            die();
        }
        ?>
        <h1>Welcome admin <?php echo $_SESSION["username"] ?></h1>
        <h4>Fill out the form below to create a poll</h4>
        <form action="" method="post">
            <div class="form-group">
                <label for="title">Poll question</label>
                <input type="text" class="form-control" id="title" placeholder="Enter poll title" name="title">
            </div>
            <button type="submit" class="btn btn-primary" name="poll">Create Poll</button>
        </form>
        <?php include "footer.php" ?>
    </div>
</body>

</html>