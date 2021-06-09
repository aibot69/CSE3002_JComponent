<?php
    include 'connect_db.php';
    $sql = "SELECT ISBN, title FROM books";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $str = '';
    foreach($rows as $row){
        $str .= '<tr>'.
            '<td id=\''.$row['ISBN'].'\' onclick="getBook(this.id)">'.$row['ISBN'].'<br>'.$row['title'].'</td>'.'</tr>';
    }
    echo $str;
?>