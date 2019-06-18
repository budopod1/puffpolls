<?php
include "conn.php";
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
            <h4>JavaScript is not used on this website except for redirecting users of Edge and IE <a href="edgeindex.php">here</a>.</h4>
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
                    <button name="submit" class="btn btn-success">Submit</button>
                </form>
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
        </div>
        <div class="row">
            <div class="col"><a href="#">PUT DATA HERE</a></div>
            <div class="col"><p>PUT DATA HERE</p></div>
        </div>
        <?php include "footer.php" ?>
    </div>
</body>
</html>