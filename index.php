<?php
    $msg = '';
    if(!empty($_GET)){
        $msg = $_GET["msg"];
        if($msg == 11) {
            $msg = "Invalid credentials";
        } elseif ($msg == 12) {
            $msg = "Don\'t play games man, just log in normally";
        } elseif ($msg == 13) {
            $msg = "Logged out successfully";
        } elseif ($msg == 14){
            $msg = "Account deleted successfully";
        } elseif ($msg == 21){
            $msg = "User registered successfully";
        } elseif ($msg == 22){
            $msg = "OTP is either incorrect or expired, try again";
        }elseif ($msg == 23){
            $msg = "Unexpected error occurred, try again";
        } elseif ($msg == 24){
            $msg = "Email already registered";
        }
    }
    session_start();
    session_unset();
    session_destroy();
?>
<html>
    <head>
        <title>Welcome To VIT Periyar Library</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
        <script src="js/jquery.min.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Staatliches&family=Dosis:wght@200&family=Gaegu&display=swap&family=Averia+Sans+Libre:wght@300&family=Girassol&display=swap" rel="stylesheet">
        <link href="css/index.css" rel="stylesheet">
        <link href="css/login.css" rel="stylesheet">
        <link href="css/home.css" rel="stylesheet">
        <script src="js/index.js"></script>
        <script>
        $(function(){
            $("#tabs").tabs();
        });
        </script>
    </head>
    <body>
        <div id="navbar">
            <a href="#home">Home</a>
            <a href="#login">Log in or sign up</a>
            <a id="adminbtn" href="adminlog.php">Administrator Portal</a>
            <a href="#about">About Us</a>
        </div>
        <div id="wrapper">
            <div class="section parallax" id="home">
                <div id="tabs">
                    <ul>
                        <li><a href="#tabs-1">Introduction</a></li>
                        <li><a href="#tabs-2">How to use</a></li>
                        <li><a href="#tabs-3">Booking and checkout</a></li>
                    </ul>
                    <div id="tabs-1">
                    <p>
                        This website helps you book your books from anywhere along with checking for availability of books. Books can be then checked out so that the cart is empty, yet the books are processed
                        in the library so that whenever they are picked up by the user it can be checked out without
                        formalities, thus saving the time.
                    </p>
                    </div>
                    <div id="tabs-2">
                    <p>
                        Anyone visiting this website can create an account or log in. The pages other than the index
                        cannot be visited directly and will bring the user back to the index page. All that is required
                        for an account is an email ID which cannot be altered after creating account, the full name and a password of minimum length required. Logging in takes you to a singular page which has tabs for cart, the library search and settings.
                    </p>
                    </div>
                    <div id="tabs-3">
                    <p>
                        Searching for a book gives you multiple dropdown options, one of which must be selected in order to get the book. This then shows a page of the book's description and various details along with the number of units left. Adding the book using the button at the bottom adds the book to your cart, from where you can checkout if there is a book or more in the cart. This empties the cart but also processes the added books so they can be taken from the library within 2 days.
                    </p>
                    </div>
                </div>
            </div>
            <div class="section static" id="login">
                <span id="errlog"></span>
                <div id="form">
                    <h1>Log In</h1>
                    <form id="log" action="/check.php" method="POST" onsubmit="return validateDetails()" autocomplete="off">
                        <label for="user" id="u">Email</label><br>
                        <input type="text" id="user" name="u" placeholder="Email"><br>
                        <label for="pwd" id="p">Password</label><br>
                        <input type="password" id="pwd" name="p" placeholder="Password">
                        <br><div id="err"></div>
                        <span class="but" onclick="submitForm('#log')">Submit</span>
                        <span class="but" onclick="resetForm('#log')">Reset</span>
                    </form><br>
                    <span class="newacc" onclick="getReg()">Not a user? Join today.</span>
                </div>
                <div id="regform">
                    <h1>Registration</h1>
                    <form id="reg" action="/verify_email.php" method="POST" onsubmit="return validateRegDetails()" autocomplete="off">
                        <label for="fn">First Name </label>
                        <input type="text" id="fn" name="fname"><br>
                        <label for="ln">Last Name </label>
                        <input type="text" id="ln" name="lname"><br>
                        <label for="user">Enter email </label>
                        <input type="email" id="user" name="u"><br>
                        <label for="pwd">New Password </label>
                        <input type="password" id="pwd" name="p"><br>
                        <label for="cp">Once again for luck </label>
                        <input type="password" name="cp">
                        <br><div id="er"></div>
                        <span class="but" action onclick="submitForm('#reg')">Submit</span>
                        <span class="but" onclick="resetForm('#reg')">Reset</span>
                        <span class="newacc" onclick="getLog()">Already a user? Log in here.</span>
                    </form>
                </div>
            </div>
            <div class="section static" id="about">
                <div id="abtnot">
                    This website is designed by Varun Tiwari
                    as a J-component project for the subject
                    Internet and Web Programming(CSE3002)
                    under Prof. Senthilkumar N. from VIT 
                    Vellore. For any more details, contact 
                    <a href="tel:+919811844188">+91-9811-844-188</a> or
                    email me at <a href="mailto:varuntiwari2001@gmail.com?subject=Feedback">varuntiwari2001@gmail.com</a>.
                </div>
            </div>
        </div>
        <script>
            var msg = '<?php echo $msg; ?>';
            $('#errlog').html(msg);
            $('#errlog').delay(5000).fadeOut('slow');
        </script>
    </body>
</html>