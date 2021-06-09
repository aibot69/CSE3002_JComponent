<?php
    include 'connect_db.php';
    $un = $_GET['un'];
    $sql = "DELETE FROM cart WHERE usernc=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($un));
?>