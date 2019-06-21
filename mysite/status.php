<?php
include "conn.php";
session_start();

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

        <h3>Select a users to add options</h2>

        <div class="pl-3">
            <?php
            if ($result && $statement->rowCount() > 0) {
                foreach ($result as $row) { ?>
                    <div class="row">
                        <div class="col">
                            <form action="" method="POST">
                                <button class="btn btn-success">Admintize (I made up that word)</button>
                            </form>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>


        <?php include "footer.php" ?>
    </div>
</body>

</html>