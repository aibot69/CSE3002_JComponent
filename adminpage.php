<?php
    session_start();
    if(!isset($_SESSION['POST'])){
        header("Location: /adminlog.php?msg=3");
    }
    $fname=$_SESSION['POST']['id'];
?>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
        <script src="js/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Antonio:wght@300&family=Girassol&display=swap" rel="stylesheet">  
        <title>Homepage for Developers</title>
        <link href="css/devpage.css" rel="stylesheet">
    </head>
    <body>
        <div id="header">
            <h1>Welcome, <?php echo $fname; ?></h1>
            <button id="logout" onclick="logOut()">Logout</button>
        </div>
        <div id="anchor">
            <div onclick="showUsers()" class="tile" onmouseover="changeText(user)" onmouseout="changeText('')">
                View Users<br><span class="desc">View and modify users' details.</span>
            </div>
            <div onclick="showBooks()" class="tile" onmouseover="changeText(book)" onmouseout="changeText('')">
                View Books<br><span class="desc">View and modify books' details.</span>
            </div>
            <br>
            <div onclick="showTile('#sett')" class="tile" onmouseover="changeText(sett)" onmouseout="changeText('')">
                Your Settings<br><span class="desc">Change your password, username, etc.</span>
            </div>
            <div onclick="showTile('#per')" class="tile" onmouseover="changeText(perm)" onmouseout="changeText('')">
                Permissions<br><span class="desc">Revoke or grant permissions.</span>
            </div>
            <div id="mes"></div>
        </div>
        <div id="user" class="side">
            <table>
                <thead><th>Users</th></thead>
                <tbody id="users"></tbody>
            </table>
        </div>
        <div id="book" class="side">
            <table>
                <thead><th>Books</th></thead>
                <tbody id="books"></tbody>
            </table>
        </div>
        <div id="sett" class="side">
            <div>
                Change Name:<br>
                <input type="text" id="af" placeholder="First name"><br>
                <input type="text" id="al" placeholder="Last name"><br>
                <button onclick="changeAdDet('name')">Change Name</button><br><br>
                Change password:<br>
                <input type="password" id="ap" placeholder="Password"><br>
                <button onclick="changeAdDet('pass')">Change Password</button><br><br>
            </div>
        </div>
        <div id="per" class="side">
            Permissions
        </div>
        <div id="Usermenu" class="modal">
            <div class="modal-content">
                <div id="Username"></div><br>
                <div>
                    Change Name:<br>
                    <input type="text" id="f" placeholder="First name"><br>
                    <input type="text" id="l" placeholder="Last name"><br>
                    <button onclick="changeDet('name')">Change Name</button><br><br>
                    Change password:<br>
                    <input type="password" id="p" placeholder="Password"><br>
                    <button onclick="changeDet('pass')">Change Password</button><br><br>
                    <div id="msg"></div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var user = "Add a user, change their password and remove accounts.";
            var book = "See all books and change their availability.";
            var sett = "Change your password, username and personal settings.";
            var perm = "Allows you to make users administrators, show/hide a book or suspend user account.";
            var un = '';
            var modal = document.getElementById('Usermenu');
            window.onclick = function(event) {
                if (event.target == modal){
                    $(modal).fadeOut();
                }
            }
            function changeText(text){
                $("#mes").html(text);
            }
            function showTile(e){
                $('.side').fadeOut();
                $(e).delay(400).fadeIn();
            }
            function logOut(){
                window.location.replace('/logout.php?f=a');
            }
            function showUsers(){
                $('#users').html('');
                showTile('#user');
                $.ajax({
                url: '/getusers.php',
                success: function(rows){
                    $('#users').append(rows);
                    }
                });
            }
            function showBooks(){
                $('#books').html('');
                showTile('#book');
                $.ajax({
                url: '/getbooks.php',
                success: function(rows){
                    $('#books').append(rows);
                    }
                });
            }
            function changeAdDet(e){
                if(!e.localeCompare('pass')){
                    var pw = $('#ap').val();
                    $.ajax({
                        type:"POST",
                        url:"/changeAdDet.php",
                        data:'t='+e+'&p='+pw+'&u='+un,
                        success: function(){
                            console.log('pwd');
                        }
                    });
                } else if(!e.localeCompare('name')){
                    var fn = $('#af').val();
                    var ln = $('#al').val();
                    $.ajax({
                        type:"POST",
                        url:"/changeAdDet.php",
                        data:'t='+e+'&f='+fn+'&l='+ln+'&u='+un,
                        success: function(){
                            console.log('name');
                        }
                    });
                }
            }
            function changeDet(e){
                if(!e.localeCompare('pass')){
                    var pw = $('#p').val();
                    $.ajax({
                        type:"POST",
                        url:"/changeDet.php",
                        data:'t='+e+'&p='+pw+'&u='+un,
                        success: function(){
                            $('#msg').html('Password changed');
                        }
                    });
                } else if(!e.localeCompare('name')){
                    var fn = $('#f').val();
                    var ln = $('#l').val();
                    $.ajax({
                        type:"POST",
                        url:"/changeDet.php",
                        data:'t='+e+'&f='+fn+'&l='+ln+'&u='+un,
                        success: function(){
                            $('#msg').html('Name changed');
                        }
                    });
                }
            }
            function getUser(u){
                un = u;
                $('#Usermenu').fadeOut();
                $('#Username').html(u);
                $('#Usermenu').fadeIn();
            }
            function getBook(b){
                book = b;
                console.log(book);
            }
        </script>
    </body>
</html>