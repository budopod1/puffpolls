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
        <h1>Put suggestion title here</h1>
        <div class="border border-success">
            <p>Put Content here</p>
        </div>
        <br>
        <div class="row">
            <div class="col"><p>Votes: Put vote number here</p></div>
            <div class="col"><form action="" method="POST">
                <button name="up" class="btn btn-primary" <?php if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){echo "disabled";}?>>Up Vote</button>
            </form></div>
            <div class="col"><form action="" method="POST">
                <button name="down" class="btn btn-danger" <?php if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){echo "disabled";}?>>Down Vote</button>
            </form></div>
        </div>
        <br>
        <br>
        <?php if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){?>
            <h3>To vote register an account <a href="register.php">here</a></h3>    
        <?php } ?>
        <br>
        <?php include "footer.php" ?>
    </div>
</body>
</html>