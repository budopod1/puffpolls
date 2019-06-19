<?php
//CONNECTION FILE -- This code allows us to connect to the data base server
$host = 'localhost';
$username = 'username';
$pass = 'password';
$dbname = 'dbname';
$dsn = "mysql:host=$host;dbname=$dbname";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
);
$conn = new PDO($dsn, $username, $pass, $options);

//INSERT - MAKING NEW ENTRY DIFFERENT WAY
$username = $_POST["username"];
$sql = "INSERT INTO users (username, `password`) VALUES ('$username', '$password')";
$conn->exec($sql);

// GET LAST INSERT ID
$last_id = $conn->lastInsertId();

// UPDATE - CHANGING INFORMATION IN A TABLE SHORT WAY
$sql = "UPDATE users SET username = $username, pass = $pass WHERE id = $userid";
$conn->exec($sql);

// DELETE A ROW IN A TABLE
$sql = "DELETE FROM users WHERE id = $id";
$conn->exec($sql);

// SELECT * FROM TABLE WITH FETCH GETTING ONLY ONE ROW
$sql = "SELECT * FROM badges WHERE badges.id = $badgeid";
$statement = $conn->prepare($sql);
$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);
echo $result['bname'];

// SELECT * FROM DATABASE WITH fetchAll
try {
        $sql = "SELECT * FROM users";

    $statement = $conn->prepare($sql);
    $statement->execute();

    $result = $statement->fetchALL();
} catch (PDOException $error) {
    echo $sql.'<br />'.$error->getMessage();
}

if ($result && $statement->rowCount() > 0) {
    foreach ($result as $row) {
        echo $row['fname'];
    }
}

//Add try catch to give you better error results
try {
} catch (PDOException $error) {
    echo $sql.'<br />'.$error->getMessage();
}

 