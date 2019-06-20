<?php
include "conn.php";
session_start();
if (isset($_POST["submit"])){
    $title = htmlspecialchars($_POST["title"]);
    $content = htmlspecialchars($_POST["content"]);
    $userID = $_SESSION["id"];
    $sql = "INSERT INTO suggestions (title, content, userid) VALUES (:title, :content, :userid)";
    $st = $conn->prepare($sql);
    $st->execute(['title' => $title, 'content' => $content, 'userid' => $userID]);

    $lastID = $conn->lastInsertID();
    $sql = "INSERT INTO suggestionoptions (`option`, pollid) VALUES ('Up Vote', $lastID)";
    $conn->exec($sql);
    $sql = "INSERT INTO suggestionoptions (`option`, pollid) VALUES ('Down Vote', $lastID)";
    $conn->exec($sql);
}

$sql = "SELECT suggestions.*, users.username FROM suggestions JOIN users ON (suggestions.userid = users.id) ORDER BY id DESC";
$st = $conn->prepare($sql);
$st->execute();
$suggestions = $st->fetchAll(PDO::FETCH_ASSOC);
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
        <script>
            var isEdge = !isIE && !!window.StyleMedia;
            var isIE = /*@cc_on!@*/false || !!document.documentMode;

            if (isEdge || isIE) {
                window.location.replace("edgeindex.php")
            }
        </script>
        <?php include "nav.php" ?>
        <noscript>
            <h4>JavaScript is not used on this website except for redirecting users of Edge and IE <a href="edgeindex.php">here</a> and giving users alerts.</h4>
        </noscript>
        <h1>Puff.io Suggestions</h1>
        <h2>What would <i>you</i> like to see in Puff.io</h2>
        <details>
            <summary>Create new suggestion</summary>
            <div class="border border-info p-3 mt-3">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Title" name="title">
                    </div>
                    <div class="form-group">
                        <label for="idea">Idea/Content</label>
                        <textarea type="text" class="form-control" id="id" placeholder="Idea/Content" name="content" rows="3"></textarea>
                    </div>
                    <button name="submit" class="btn btn-success" <?php if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){echo "disabled";} ?>>Submit</button>
                </form>
                <?php if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){ ?>
                    <br>
                    <h3>To create suggestions, register an account <a href="register.php">here</a>, and sign in <a href="login.php">here</a>.</h3>
                <?php } ?>
            </div>
        </details>
        <hr>
        <div class="row">
            <div class="col">
                <p><b>Title</b></p>
            </div>
            <div class="col">
                <p><b>Shortened Description</b></p>
            </div>
            <div class="col">
                <p><b>Made by</b></p>
            </div>
            <div class="col">
                <p><b>Created at</b></p>
            </div>
        </div>
        <?php foreach ($suggestions as $suggestion) {?>
            <div class="row">
                <div class="col">
                    <a href="suggestion.php?id=<?php echo $suggestion["id"] ?>"><?php echo $suggestion["title"] ?></a>
                </div>
                <div class="col">
                    <?php echo substr($suggestion['content'], 0, 20) . "..." ?>
                </div>
                <div class="col">
                    <?php echo $suggestion['username'] ?>
                </div>
                <div class="col">
                    <?php echo date("n/j/Y g:i a", strtotime($suggestion["created_at"])) ?>
                </div>
            </div>
        <?php } ?>
        <?php include "footer.php" ?>
    </div>
</body>
</html>