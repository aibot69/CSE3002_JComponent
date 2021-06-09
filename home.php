<?php
    session_start();
    if(empty($_SESSION)){
        header("Location: /index.php?msg=12#login");
    }
    $un = $_SESSION['GET']['un'];
    $fn = $_SESSION['GET']['fname'];
    $ln = $_SESSION['GET']['lname'];
?>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
        <script src="js/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Staatliches&family=Buda:wght@300&family=Chilanka&display=swap" rel="stylesheet"> 
        <title><?php echo $un; ?>: Home</title>
        <link href="css/homepage.css" rel="stylesheet">
        <link href="css/search.css" rel="stylesheet">
        <link href="css/settings.css" rel="stylesheet">
    </head>
    <body>
        <div id="header">
            <button id="logout" onclick="logOut()">Logout</button>
            <h1 id="hi">Hi <?php echo $fn.' '.$ln; ?>,</h1>
            <h2 id="wel">Welcome to Periyar library.</h2>
        </div>
        <div id="opts">
            <div class="opt" onclick="showTile('#search')"><img class="icon" src="css/img/icons/search.png"> Search Book</div>
            <div class="opt" onclick="showCart()"><img class="icon" src="css/img/icons/cart.png"> View Cart</div>
            <div class="opt" onclick="showTile('#settings')"><img class="icon" src="css/img/icons/settings.png"> Settings</div>
        </div>
        <div id="search" class="side">
            <input type="text" id="searchbook" placeholder="Search by title or author..">
            <div onclick="getBook()" id="getb">Get Book</div>
            <div id="bookdeets">
                <h1 id="title"></h1>
                <h2 id="auth"></h2>
                Available: <span id="count"></span><br>
                Price: <span id="price"></span><br>
                ISBN: <span id="isbn"></span><br>
                Binding type: <span id="bind"></span><br>
                <u>Description</u><br>
                <div id="desc"></div>
                <div id="cartopts">
                    <div id="add" onclick="addBook()">Add Book</div><br>
                    <div id="msg"></div>
                </div>
            </div>
        </div>
        <div id="cart" class="side">
            <div>
                <table>
                    <thead>
                        <th>ISBN</th>
                        <th>Title</th>
                    </thead>
                    <tbody id="cartbl">
                    </tbody>
                </table>
                <button class="chbut" onclick="checkOut()">Checkout</button>
            </div>
        </div>
        <div id="settings" class="side">
            <div class="o" onclick="showOpts('#nc')">Change Name</div>
                <div id="nc" class="container">
                    <div class="name"><input type="text" placeholder="First name" id="f"></div>
                    <div class="name"><input type="text" placeholder="Last name" id="l"></div>
                    <button class="chbut" onclick="changeDet('name')">Change</button>
                </div>
            <div class="o" onclick="showOpts('#uc')">Change Password</div>
                <div id="uc" class="container">
                    <div class="name"><input type="text" placeholder="Password" id="p"></div>
                    <button class="chbut" onclick="changeDet('pass')">Change</button>
                </div>
            <div id="myBtn" class="o" onclick="delBut()">Delete Account</div>
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span>Are you sure? You will lose<br> all data including cart items.</span><br><br>
                    <button onclick="delAcc()">Yes, go ahead</button>
                    <button onclick="javascript:$('#myModal').fadeOut();">No, take me back</button>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var isbn = '';
            var title = '';
            var count = 0;
            var un = '<?php echo $un;?>';
            var btn = document.getElementById("myBtn");
            var modal = document.getElementById("myModal");
            $(function() {
                $("#searchbook").autocomplete({
                    source: 'booksearch.php',
                });
            });
            function delBut() {
                $('#myModal').fadeIn();
            }
            window.onclick = function(event) {
                if (event.target == modal){
                    $('#myModal').fadeOut();
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
                            alert("Password changed!");
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
                            $('#hi').html('Hi '+fn+' '+ln+',');
                        }
                    });
                }
            }
            function addBook(){
            $('#msg').fadeIn();
            if (count == 0){
                $('#msg').html('Sorry, we\'re all out.');
            } else if (count > 0){
                $.ajax({
                    type:"POST",
                    url:"/addbook.php",
                    data:'isbn='+isbn+'&user='+'<?php echo $un; ?>'+'&tit='+title,
                    success: function(ans){
                        $('#msg').html(ans);
                        $("#count").html(count-1);
                    }
                });
            }
            $('#msg').delay(3000).fadeOut();
        }
        function showCart(){
            showTile('#cart');
            $('#cartbl').html('');
            $.ajax({
                url: '/getcart.php?name=<?php echo $un; ?>',
                type: "get",
                dataType: "JSON",
                success: function(rows){
                    var row, str;
                    for(var i = 0;i < rows.length;i++){
                        row = rows[i];
                        str = "<tr><td>"+row['isbnc']+"</td><td>"+row['titlec']+"</td></tr>";
                        $('#cartbl').append(str);
                    }
                }
            });
        }
        function getBook(){
            var bn = $('#searchbook').val();
            bn = bn.split(',');
            var str = ''; var c = bn.length;
            for (i = 0;i<c-2;i++){str = str.concat(bn[i].concat(','));}
            str = str.concat(bn[c-2]);
            $.getJSON('/getbook.php?name='+str, function(res){
                title = res.title;
                isbn = res.ISBN;
                count = res.avail;
                $('#bookdeets').fadeIn();
                $("#title").html(res.title);
                $("#auth").html(res.author+', '+res.publisher);
                $("#count").html(res.avail);
                $("#price").html(res.Price+'/-');
                $("#isbn").html(res.ISBN);
                $("#bind").html(res.bind);
                $("#desc").html(res.desc);
            });
        }
        function checkOut(){
            $.ajax({
                url: '/checkout.php?un='+un,
                type: "get",
                success: function(){
                    window.location.reload(true);
                }
            });
        }
        function showTile(e){
            $('.side').fadeOut('fast');
            $(e).delay(500).fadeIn();
        }
        function showOpts(e){
            if ($(e).css('display') == 'block'){
                $(e).fadeOut();
            } else {$(e).fadeIn(); console.log('coming');}
        }
        function delAcc(){
            window.location.replace('/delacc.php');
        }
        function logOut(){
            window.location.replace('/logout.php?f=u');
        }
        
        </script>
    </body>
</html>