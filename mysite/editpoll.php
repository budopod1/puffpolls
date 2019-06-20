<?php
include "conn.php";
session_start();

if (isset($_GET["id"])){
    $id=$_GET["id"];
    $sql = "SELECT * FROM suggestions WHERE id = $id";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $poll = $statement->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST["deleteEntire"])){
    if (isset($_POST["check"])){
        $pollid=$_GET["id"];
        $sql = "DELETE FROM suggestions WHERE id = $pollid";
        $conn->exec($sql);
        header("Location: admin.php");
        die();
    }
}

if (isset($_POST["update"])){
    $option = $_POST["option"];
    $optionid = $_POST["optionid"];
    $sql = "UPDATE suggestionoptions SET `option` = '$option' WHERE id = $optionid";
    $conn->exec($sql);
}

if (isset($_POST["delete"])){
    $optionid = $_POST["optionid"];
    $sql = "DELETE FROM suggestionoptions WHERE id = $optionid";
    $conn->exec($sql);
}

if (isset($_POST["submit"])) {
    $option = $_POST["option"];
    $pollid = $_POST["pollid"];
    $sql = "INSERT INTO suggestionoptions (`option`, pollid) VALUES ('$option', $pollid)";
    $conn->exec($sql);
}

// SELECT * FROM DATABASE WITH fetchAll

try {
    $sql = "SELECT * FROM suggestionoptions WHERE pollid=$id";

    $statement = $conn->prepare($sql);
    $statement->execute();

    $result = $statement->fetchALL();
} catch (PDOException $error) {
    echo $sql . '<br />' . $error->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Options</title>
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

        <div class="p-3 border border-danger text-center">
            <form action="" method="post">
                <button class="btn btn-danger" name="deleteEntire">DELETE</button>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="doubleCheck" name="check">
                    <label class="form-check-label" for="doubleCheck">Are you sure?</label>
                </div>
            </form>
        </div>

        <div class="p-4">
            <h4>Add Options to Poll <?php echo $poll['title'] ?></h4>
            <form action="" method="post">
                <div class="form-group">
                    <label for="option">Please enter poll option</label>
                    <input type="text" class="form-control" id="option" placeholder="Poll option" name="option">
                </div>
                <input type="hidden" name="pollid" value="<?php echo $poll['id'] ?>">
                <button type="submit" class="btn btn-primary" name="submit">Create New Poll Option</button>
            </form>
        </div>
        <hr>
        <h2>Current poll options</h2>

        <?php
        if ($result && $statement->rowCount() > 0) {
            foreach ($result as $row) { ?>
                <hr>
                <b><?php echo $row['option'] ?></b>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="option">Edit poll option</label>
                        <input type="text" class="form-control" id="option" placeholder="Poll option" name="option" value="<?php echo $row['option'] ?>">
                    </div>
                    <input type="hidden" name="optionid" value="<?php echo $row['id'] ?>">
                    <button type="submit" class="btn btn-primary" name="update">Update poll option</button>
                </form>
                <div class="float-right">
                    <form action="" method="post">
                        <input type="hidden" name="optionid" value="<?php echo $row['id'] ?>">
                        <button type="submit" class="btn btn-danger" name="delete">Delete Option</button>
                    </form>
                </div>
                <br>
                <?php
            }
        }
        ?>


        <?php include "footer.php" ?>
    </div>
</body>

</html>