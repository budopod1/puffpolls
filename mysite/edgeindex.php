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
        <h1>Puff.io Suggestions</h1>
        <h2>What would <i>you</i> like to see in Puff.io</h2>
        <h4>For a better experience please switch browsers.
            As Edge and IE have worse support here. <br> Sorry for the inconvenience!</h4>
        <small>The reason they have worse support is due to lack of HTML &#x3C;details&#x3E;
            tag and HTML &#x3C;summary&#x3E; tag</small>
        <div class="border border-info p-3 mt-3">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" placeholder="title" name="title">
                </div>
                <div class="form-group">
                    <label for="idea">Idea/Content</label>
                    <textarea type="text" class="form-control" id="id" placeholder="Idea/Content" name="content" rows="3"></textarea>
                </div>
                <button name="submit" class="btn btn-success">Submit</button>
            </form>
        </div>

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
            <div class="col">
                <p>PUT DATA HERE</p>
            </div>
        </div>
    </div>
</body>

</html>