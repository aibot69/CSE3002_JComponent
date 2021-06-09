<?php
    include 'connect_db.php';
    $user = $_POST['u'];
    $pwd = $_POST['p'];
    $us = md5($user);
    $pw = md5($pwd);
    try {
        $stmt = $conn->query("SELECT * FROM admins");
        $data = $stmt->fetchAll(PDO::FETCH_NUM);
        foreach($data as $row) {  
                if ($us == $row[0] && $pw == $row[1]){
                    session_start();
                    $_POST['id'] = $row[2];
                    $_SESSION['POST'] = $_POST;
                    header("Location: /adminpage.php");
                    exit;
                }
        }
        header("Location: /adminlog.php?msg=1");
        exit;
        } catch(PDOException $e) {
        echo "Connection failed: ".$e->getMessage();
    }
?>