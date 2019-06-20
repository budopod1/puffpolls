<?php
include "./conn.php";
session_start();

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

if (isset($_POST["submit"])){
    $userid=$_SESSION["id"];
    //$sql = "SELECT * FROM suggestionvotes WHERE userid = $userid";
    //$st = $conn->query($sql);
    //$votes = $st->fetchAll(PDO::FETCH_ASSOC);
    //foreach ($options as $option){
    //    foreach ($votes as $vote) {
    //        if ($vote["optionid"] == $option["id"]){
    //            header("Location: index.php");
    //            die();
    //        }
    //    }
    //}
    $optionid=$_POST["id"];

    $sql = "INSERT INTO suggestionvotes (optionid, userid) VALUES ($optionid, $userid)";
    $conn->exec($sql);
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
            <?php
            $votes=true;
            foreach ($options as $option) {
                if (($option["option"] != "Down Vote") && ($option["option"] != "Up Vote")){
                    $votes=false;
                }
            }
            if ($votes){
                foreach ($options as $option) {
                    if (($option["option"] != "Down Vote") && ($option["option"] != "Up Vote")){
                        $votes=false;
                    }
                }
                $upID=0;
                $downID=0;
                foreach ($options as $option) {
                    if ($option["option"] == "Up Vote"){
                        $upID=$option["id"];
                    }
                    if ($option["option"] == "Down Vote"){
                        $downID=$option["id"];
                    }
                }
                $sql="SELECT * FROM suggestionvotes WHERE optionid = $upID";
                $st = $conn->query($sql);
                $ups = $st->fetchAll(PDO::FETCH_ASSOC);

                $sql="SELECT * FROM suggestionvotes WHERE optionid = $downID";
                $st = $conn->query($sql);
                $downs = $st->fetchAll(PDO::FETCH_ASSOC);

                $votenum=count($ups);
                $votenum=$votenum-count($downs);

                ?>
                <div class="col"><p><?php echo $votenum ?></p></div>
                <?php
            }
            ?>
            <?php
            $sql = "SELECT * FROM suggestionvotes";
            $st = $conn->query($sql);
            $votes = $st->fetchAll(PDO::FETCH_ASSOC);
            $totalVotes=0;

            foreach ($votes as $vote) {
                foreach ($options as $option) {
                    if ($option["id"] == $vote["optionid"]){
                        $totalVotes=$totalVotes+1;
                    }
                }
            }
            ?>
            <div class="col"><?php echo $totalVotes ?> Total Vote(s)</div>
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
                    <form action="" method="post">
                        <button class="btn btn-<?php echo $color ?>" 
                        <?php if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){echo "disabled";}?>
                         name="submit">
                        <?php echo $option["option"] ?></button>
                        <input type="hidden" name="id" value="<?php echo $option["id"] ?>">
                    </form>
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
        <div class="row">
            <?php
            foreach ($options as $option) {
                ?>
                <div class="col"><b><?php echo $option["option"] ?></b></div>
                <?php
            }
            ?>
        </div>
        <div class="row">
            <?php
            foreach ($options as $option){
                $voteNum=0;
                foreach ($votes as $vote) {
                    if ($vote["optionid"] == $option["id"]){
                        $voteNum=$voteNum+1;
                    }
                }
                ?>
                <div class="col"><?php echo $voteNum ?></div>
                <?php
            }
            ?>
        </div>
        <div class="row">
            <?php
            foreach ($options as $option){
                $voteNum=0;
                foreach ($votes as $vote) {
                    if ($vote["optionid"] == $option["id"]){
                        $voteNum=$voteNum+1;
                    }
                }
                ?>
                <div class="col">
                    <?php 
                    if ($voteNum == 0){
                        echo "0%";
                    } else {
                        echo round($voteNum/$totalVotes*100, 1) . "%";
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
        <?php include "footer.php" ?>
    </div>
</body>
</html>