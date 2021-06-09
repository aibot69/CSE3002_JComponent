<?php
    function userExist($email){
        require 'connect_db.php';
        $sql = "SELECT EXISTS(SELECT user_n FROM users WHERE user_n = ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($email));
        $row = $stmt->fetch(PDO::FETCH_NUM);
        return $row[0];
        exit;
    }
    function sendOTP($email,$OTP){
        require 'C:/PHPMailer/PHPMailer-master/src/PHPMailer.php';
        require 'C:/PHPMailer/PHPMailer-master/src/SMTP.php';
        require 'C:/PHPMailer/PHPMailer-master/src/Exception.php';
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->SMTPDebug = false;                             
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'librarymanagment95@gmail.com';
        $mail->Password = 'Abcdefgh1';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('librarymanagment95@gmail.com', 'Varun');
        $mail->addAddress($email);
        $mail->addReplyTo($email);
        $mail->isHTML(true);
        $mail->Subject = 'Verification email from Library Management';
        $mail->Body    = '<h4 style="text-align:center; font-family: \'Dubai\';">Do not share this OTP with anyone:<br>'.
                        '<br><div style="font-size:24px;">'.$OTP.'</div>'
                        .'</h4>';
        $mail->send();
    }
    session_start();
    $_SESSION['DEETS'] = $_POST;
    $OTP = random_int(111111,999999);

    if(userExist($_POST['u'])){
        header("Location: /index.php?msg=24#login");
    }
    sendOTP($_POST['u'],$OTP);
    $_SESSION['otp'] = $OTP;
?>
<form action="/register_user.php" method="post">
    <input type="number" name="otp" placeholder="Enter OTP">
    <input type="submit" value="Submit">
</form>