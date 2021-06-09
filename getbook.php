<?php
    include 'connect_db.php';
    $rows = array();
    if(isset($_GET['name'])) {
        $stmt = $conn->prepare("SELECT * FROM books WHERE title = ?");
        $stmt->execute(array($_GET['name']));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    echo json_encode($rows[0]);
?>