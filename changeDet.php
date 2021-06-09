<?php
    include 'connect_db.php';
    session_start();
    $un = $_POST['u'];
    $type = $_POST['t'];
    $arr = array();
    $sql = '';
    if (!strcmp($type, 'pass')){
        $sql = "UPDATE users SET user_p=? WHERE user_n=?";
        $pwd = md5($_POST['p']);
        $arr = array($pwd, $un);
    } elseif (!strcmp($type, 'name')){
        $sql = "UPDATE users SET user_f = :fn , user_l = :ln  WHERE user_n = :un";
        $arr = array('fn'=>$_POST['f'], 'ln'=>$_POST['l'], 'un'=>$un);
        $_SESSION['GET']['fname'] = $_POST['f'];
        $_SESSION['GET']['lname'] = $_POST['l'];
    }
    $stmt = $conn->prepare($sql);
    $stmt->execute($arr);
?>