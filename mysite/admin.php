<?php
include "conn.php";
session_start();

// SELECT * FROM DATABASE WITH fetchAll

try {
    $sql = "SELECT * FROM suggestions ORDER BY id DESC";

    $statement = $conn->prepare($sql);
    $statement->execute();

    $result = $statement->fetchALL();
} catch (PDOException $error) {
    echo $sql . '<br />' . $error->getMessage();
}

if (isset($_POST["poll"])) {
    $title = $_POST["title"];
    $userid = $_SESSION["id"];
    $content = $_POST["content"];
    $sql = "INSERT INTO suggestions (title, userid, content) VALUES ('$title', $userid, '$content')";
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
        <h4><a href="status.php">Click here to change user's status</a></h4>
        <h3>Fill out the form below to create a poll</h3>
        <div class="p-3">
            <form action="" method="post">
                <div class="form-group">
                    <label for="title">Poll question</label>
                    <input type="text" class="form-control" id="title" placeholder="Enter poll title" name="title">
                </div>
                <div class="form-group">
                    <label for="content">Poll content</label>
                    <textarea type="text" class="form-control" id="id" placeholder="Content" name="content" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="poll">Create Poll</button>
            </form>
        </div>
        <hr>

        <h3>Select a poll to add options</h2>

        <div class="pl-3">
            <?php
            if ($result && $statement->rowCount() > 0) {
                foreach ($result as $row) { ?>
                    <div class="row">
                        <div class="col">
                            <h5><a href="editpoll.php?id=<?php echo $row['id'] ?>">
                                <?php echo $row['title'] ?>
                            </a></h5>
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