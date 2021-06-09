<?php
    if(!empty($_GET)){
        $msg = $_GET["msg"];
        if($msg == 1) {
            $msg = "Invalid credentials";
        } elseif($msg == 2) {
            $msg = "Admin logged out";
        } elseif($msg == 3) {
            $msg = "Unauthorized access, don't cheat";
        }
    }
?>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
        <title>Administrator login</title>
        <script src="js/jquery.min.js"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poiret+One&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/admin.css">
    </head>
    <body>
        <div id="login">
            <h4><?php if(!empty($msg)){echo $msg;} ?></h4>
            <h2 style="text-align: left;">Administrator Login</h2>
            <form id="adminlog" action="/cred_check.php" method="POST" onsubmit="return validateDetails()" autocomplete="off">
                <label for="user">Username</label>
                <input type="text" id="user" name="u" placeholder="Username"><br>
                <label for="pwd">Password</label>
                <input type="password" id="pwd" name="p" placeholder="Password">
                <br><div id="err"></div>
                <input type="submit" value="Submit">
                <input type="reset" onclick="resetForm()">
            </form>
            <input type="button" onclick="location.href='/index.php';" value="Go back">
        </div>
        <script type="text/javascript">
            function resetForm(){
                $("#err").html('');
                $("h4").html('');
            }
            function validateDetails(){
                var str = "";
                var u = document.forms["adminlog"]["user"].value;
                var p = document.forms["adminlog"]["pwd"].value;
                var reg = /^[a-z0-9_]+$/i;
                if (u === ""){
                    str += "Username can't be blank!<br>";
                }
                else if (!reg.test(u)){
                    str += "Username should have only alphanumeric<br>characters and underscore!<br>";
                }
                if (p === ""){
                    str += "Password can't be blank!<br>";
                }
                if (str === ""){
                    return true;
                } else {
                    document.getElementById("err").innerHTML = str;
                    return false;
                }
            }
        </script>
    </body>
</html>