<?php
include "./conn.php";

if (isset($_GET["id"])){
    $id = $_GET["id"];

    $sql = "SELECT * FROM suggestions WHERE id=$id";
    $st = $conn->prepare($sql);
    $st->execute();
    $suggestion = $st->fetch(PDO::FETCH_ASSOC);

    $suggestionid = $suggestion["id"];
    $sql = "SELECT * FROM suggestionoptions WHERE pollid = $suggestionid";
    $st = $conn->query($sql);
    $options = $st->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Feedback</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <?php include "nav.php" ?>
        <h1><?php echo $suggestion["title"] ?></h1>
        <div class="border border-success">
            <p><?php echo $suggestion["content"] ?></p>
        </div>
        <br>
        <div class="row">
            <div class="col"><p><?php echo "PUT DATA HERE" ?> Votes</p></div>
            <!--
            <div class="col"><form action="" method="POST">
                <button name="up" class="btn btn-primary" <?php if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){echo "disabled";}?>>Up Vote</button>
            </form></div>
            <div class="col"><form action="" method="POST">
                <button name="down" class="btn btn-danger" <?php if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){echo "disabled";}?>>Down Vote</button>
            </form></div>
            -->
            <?php
            foreach ($options as $option) {
                if ($option["option"] == "Down Vote"){
                    $color = "danger";
                } elseif ($option["option"] == "Up Vote") {
                    $color = "primary";
                } else {
                    $color = "success";
                }
                ?>
                <div class="col">
                    <button class="btn btn-<?php echo $color ?>" 
                    <?php if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){echo "disabled";}?>>
                    <?php echo $option["option"] ?></button>
                </div>
                <?php
            }
            ?>
        </div>
        
        <?php if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){?>
            <br>
            <br>
            <h3>To vote register an account <a href="register.php">here</a>, and sign in <a href="login.php">here</a>.</h3>    
        <?php } ?>
        <br>
        <?php include "footer.php" ?>
    </div>
</body>
</html>