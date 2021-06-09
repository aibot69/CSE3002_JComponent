<?php
    require 'connect_db.php';
    session_start();
    function addUser(){
        global $conn;
        $us = $_SESSION['DEETS']['u'];
        $pwd = $_SESSION['DEETS']['p'];
        $pw = md5($pwd);
        $f = $_SESSION['DEETS']['fname'];
        $l = $_SESSION['DEETS']['lname'];
        $reg_data = [
            'u' => $us,
            'p' => $pw,
            'f' => $f,
            'l' => $l,
        ];
        try {
        $sql = "INSERT INTO users VALUES (:u,:p,:f,:l)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($reg_data);
        header("Location: /index.php?msg=21#login");
        exit;
        } catch(PDOException $e) {
            header("Location: /index.php?msg=23#login");
        }
    }
    if(isset($_POST['otp'])){
        if($_POST['otp'] == $_SESSION['otp']){
            addUser();
            exit;
        }
    } else {
        header("Location: /index.php?msg=22#login");
    }
?>