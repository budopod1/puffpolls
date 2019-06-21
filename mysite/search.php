<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Searching</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <?php include "nav.php" ?>
        <h1>Searching</h1>
        <div class="row">
            <div class="col-4"><b>Symbol</b></div>
            <div class="col-8"><b>Description</b></div>
        </div>

        <div class="row">
            <div class="col-4">%</div>
            <div class="col-8">Stands for zero or more characters (letters/symbols)</div>
        </div>
        <div class="row">
            <div class="col-4">_</div>
            <div class="col-8">Stands for one character (letter/symbol)</div>
        </div>
        <div class="row">
            <div class="col-4">[...]</div>
            <div class="col-8">Stand for any of the characters in the brackets (Replace ... with the characters)</div>
        </div>
        <div class="row">
            <div class="col-4">[^...]</div>
            <div class="col-8">Stand for any of the characters <i>NOT</i> in the brackets (Replace ... with the characters)</div>
        </div>
        <div class="row">
            <div class="col-4">[...1-...2]</div>
            <div class="col-8">Stands for a character in the range of ...1 to ...2 (meaning [a-b] = a, b, c, d)</div>
        </div>
        
        <?php include "footer.php" ?>
        <div class="ml-3">
            <p>Source: <a href="https://www.w3schools.com/sql/sql_wildcards.asp">w3schools.com</a></p>
        </div>
    </div>
</body>
</html>