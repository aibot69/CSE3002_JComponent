<?php 
    include 'connect_db.php';
    $un = $_GET['name'];
    $rows = array();
    if(!empty($un)) {
        $stmt = $conn->prepare("SELECT isbnc,titlec FROM cart WHERE usernc=?");
        $stmt->execute(array($un));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    echo json_encode($rows);
?>