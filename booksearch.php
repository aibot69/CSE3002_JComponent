<?php
    include 'connect_db.php';
    function getBook($conn, $term){ 
        $query = "SELECT * FROM books WHERE Title LIKE '%".$term."%' ORDER BY Title ASC";
        $stmt = $conn->query($query);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data; 
    }
    function getAuthor($conn, $term){ 
        $query = "SELECT * FROM books WHERE author LIKE '%".$term."%' ORDER BY Title ASC";
        $stmt = $conn->query($query);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data; 
    }
    if (isset($_GET['term'])) {
        $bookT = getBook($conn, $_GET['term']);
        $bookA = getAuthor($conn, $_GET['term']);
        $nList = array();
        foreach($bookT as $b){
        $nList[] = $b['title'].', '.$b['author'];
        }
        foreach($bookA as $b){
        $nList[] = $b['title'].', '.$b['author'];
        }
        echo json_encode(array_unique($nList));
    }
?>