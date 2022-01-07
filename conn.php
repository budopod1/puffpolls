<?php

#CONNECTION FILE 
# Wow
$host = 'localhost';
$username = 'budopod';
$pass = '';
$dbname = 'puffsuggestions';
$dsn = "mysql:host=$host;dbname=$dbname";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
);
$conn = new PDO($dsn, $username, $pass, $options);
