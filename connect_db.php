<?php
    $servername = "";
    $username = "";
    $password = "";
    $dbname = "";
    $port = ;
    $flag = 0;
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;port=$port", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
