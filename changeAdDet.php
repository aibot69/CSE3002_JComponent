<?php
    include 'connect_db.php';
    $un = $_POST['u'];
    $type = $_POST['t'];
    $arr = array();
    $sql = '';
    if (!strcmp($type, 'pass')){
        $sql = "UPDATE admins SET password=? WHERE username=?";
        $pwd = md5($_POST['p']);
        $arr = array($pwd, $un);
    } elseif (!strcmp($type, 'name')){
        $sql = "UPDATE admins SET fname = :fn , lname = :ln  WHERE username = :un";
        $arr = array('fn'=>$_POST['f'], 'ln'=>$_POST['l'], 'un'=>$un);
    }
    $stmt = $conn->prepare($sql);
    $stat = $stmt->execute($arr);
    echo $stat;
    exit;
?>