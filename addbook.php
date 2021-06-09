<?php
    include 'connect_db.php';
    $cart = [
        'isbn' => $_POST['isbn'],
        'user' => $_POST['user'],
        'title' => $_POST['tit'],
    ];
    $data_check = "SELECT * FROM cart WHERE isbnc=? AND usernc=? ";
    $st = $conn->prepare($data_check);
    $st->execute(array($_POST['isbn'], $_POST['user']));
    $check = $st->fetchAll(PDO::FETCH_ASSOC);
    if (empty($check)) {
        $sql = "INSERT INTO cart (isbnc,usernc,titlec) VALUES (:isbn,:user,:title)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($cart);
        $sql = "UPDATE books SET avail = avail - 1 WHERE ISBN = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($_POST['isbn']));
        echo "Successfully added to cart.";
    } else {
        echo "You can take only one book at a time.";
    }
?>