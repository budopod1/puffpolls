<?php
include "../mysite/conn.php";

// SELECT * FROM DATABASE WITH fetchAll
try {
    $sql = "SELECT * FROM users";

    $statement = $conn->prepare($sql);
    $statement->execute();

    $users = $statement->fetchALL();
} catch (PDOException $error) {
    echo $sql . '<br />' . $error->getMessage();
}

//$sql = "SELECT * FROM users WHERE id = 2";
//$statement = $conn->prepare($sql);
//$statement->execute();
//$result = $statement->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TESTING</title>
</head>

<body>
    <!--
    <?php echo $result['username'] ?><br>
    <?php echo $result['pass'] ?><br>
    <?php echo $result['created_at'] ?><br>
    <?php echo $result['updated_at'] ?><br>
    <?php echo $result['id'] ?><br>
    -->

    <?php
    if ($users && $statement->rowCount() > 0) {
        foreach ($users as $row) { ?>
            <div class="row">
                <div class="col">
                    <?php echo $row['username'] ?><br>
                    <?php echo $row['pass'] ?><br>
                    <?php echo $row['created_at'] ?><br>
                    <?php echo $row['updated_at'] ?><br>
                    <?php echo $row['id'] ?><br>
                    <br>
                </div>
            </div>
        <?php
        }
    }
    ?>

</body>

</html>