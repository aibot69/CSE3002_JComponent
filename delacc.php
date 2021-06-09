<?php
    include 'connect_db.php';
    session_start();
    $un = $_SESSION['GET']['un'];
    $sql = "DELETE FROM users WHERE user_n=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($un));
    $sql = "SELECT isbnc FROM cart WHERE usernc=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($un));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $sql = "UPDATE books SET avail = avail+1 WHERE ISBN = ?";
    $stmt = $conn->prepare($sql);
    $i = 0;
    while(!empty($rows[$i])){
        $stmt->execute(array($rows[$i]));
        $i++;
    }
    $sql = "DELETE FROM cart WHERE usernc=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($un));
    $sql = "DELETE FROM users WHERE user_n=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($un));
    session_unset();
    session_destroy();
    header("Location: /index.php?msg=14#login");
    exit;
?>