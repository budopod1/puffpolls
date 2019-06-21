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

$sortBy="votenum DESC";
if (isset($_GET["change"])){
    $sortBy=$_GET["sort"];
}

if (isset($_POST["search"])){
    $phrase = "%".$_POST["phrase"]."%";
    $sql = "SELECT suggestions.*, users.username FROM suggestions JOIN users ON (suggestions.userid = users.id) WHERE title LIKE '$phrase' OR content LIKE '$phrase' ORDER BY $sortBy";
    try {
        $st = $conn->prepare($sql);
        $st->execute();
        $suggestions = $st->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $error) {
        echo $sql.'<br />'.$error->getMessage();
    }
} else {
    $sql = "SELECT suggestions.*, users.username FROM suggestions JOIN users ON (suggestions.userid = users.id) ORDER BY $sortBy";
    $st = $conn->prepare($sql);
    $st->execute();
    $suggestions = $st->fetchAll(PDO::FETCH_ASSOC);
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
            <div class="col-10">
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
                        <div class="col-3" style="word-break: break-word">
                            <a href="suggestion.php?id=<?php echo $suggestion["id"] ?>"><?php 
                            if (strlen($suggestion['title']) > 20){
                                echo substr($suggestion['title'], 0, 40) . "...";
                            } else {
                                echo $suggestion["title"];
                            }
                            ?></a>
                        </div>
                        <div class="col-3" style="word-break: break-word">
                            <?php 
                            if (strlen($suggestion['content']) > 20){
                                echo substr($suggestion['content'], 0, 20) . "...";
                            } else {
                                echo $suggestion["content"];
                            }
                            ?>
                        </div>
                        <div class="col-3">
                            <?php echo $suggestion['username'] ?>
                        </div>
                        <div class="col-3">
                            <?php echo date("n/j/Y g:i a", strtotime($suggestion["created_at"])) ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-2">
                <form action="" method="GET">
                    <div class="form-group">
                        <label for="sortBy">Sort By:</label>
                        <select id="sortBy" class="form-control" name="sort">
                            <option selected value="votenum DESC">Trending</option>
                            <option value="id DESC">Newest</option>
                            <option value="id ASC">Oldest</option>
                        </select>
                    </div>
                    <button name="change" class="btn btn-info">Update</button>
                </form>
                <hr>
                <form action="" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search..." name="phrase">
                    </div>
                    <button name="search" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
        <?php include "footer.php" ?>
    </div>
</body>
</html>