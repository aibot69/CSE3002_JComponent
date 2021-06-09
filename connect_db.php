<?php
    $servername = "127.0.0.1";
    $username = "root";
    $password = "kraken";
    $dbname = "library";
    $port = 3307;
    $flag = 0;
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;port=$port", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>