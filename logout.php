<?php
    session_start();
    session_unset();
    session_destroy();
    if ($_GET['f']=='a')
        header("Location: /adminlog.php?msg=2");
    elseif ($_GET['f']=='u'){
        header("Location: /index.php?msg=13#login");
    }
?>