<?php
include "conn.php";
session_start();

if (isset($_POST["change"])){
    $id=$_POST["id"];
    try {
        $sql="UPDATE users SET `type` = 'admin' WHERE id = $id";
        $conn->exec($sql);
    } catch (PDOException $error) {
        echo $sql.'<br />'.$error->getMessage();
    }
}

$sql = "SELECT * FROM users";

$statement = $conn->prepare($sql);
$statement->execute();

$result = $statement->fetchALL();
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

        <h3>Select a users to make admins</h2>

        <div class="pl-3">
            <?php
            if ($result && $statement->rowCount() > 0) {
                foreach ($result as $row) { ?>
                    <div class="row">
                        <div class="col">
                            <form action="" method="POST">
                                <input type="hidden" name="id" value="<?php echo $row["id"] ?>">
                                <button class="btn btn-success" name="change"><?php echo $row["username"] ?></button>
                            </form>
                        </div>
                    </div>
                    <br>
                    <?php
                }
            }
            ?>
        </div>


        <?php include "footer.php" ?>
    </div>
</body>

</html>