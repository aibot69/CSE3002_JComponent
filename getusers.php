<?php
    include 'connect_db.php';
    $sql = "SELECT user_n FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $str = '';
    foreach($rows as $row){
        $str .= '<tr><td id=\''.$row['user_n'].'\' onclick="getUser(this.id)">'.$row['user_n'].'</td></tr>';
    }
    echo $str;
?>