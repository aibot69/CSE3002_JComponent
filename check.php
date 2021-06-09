<?php
    include 'connect_db.php';
    $user = $_POST['u'];
    $pwd = $_POST['p'];
    $pw = md5($pwd);
    try {
        $stmt = $conn->query("SELECT * FROM users");
        $data = $stmt->fetchAll(PDO::FETCH_NUM);
        foreach($data as $row) {
                if ($user == $row[0] && $pw == $row[1]){
                    session_start();
                    $_GET['un'] = $user;
                    $_GET['fname'] = $row[2];
                    $_GET['lname'] = $row[3];
                    $_SESSION['GET'] = $_GET;
                    echo $row[0].' '.$pw.' '.$user;
                    header("Location: /home.php");
                    exit;
                }
        }
        header("Location: /index.php?msg=11#login");
        exit;
        } catch(PDOException $e) {
        echo "Connection failed: ".$e->getMessage();
    }
?>