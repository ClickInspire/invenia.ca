<?php
    /* These are our valid username and passwords */
    include 'credential.php';
    if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
        
        if (($_COOKIE['username'] != $user) || ($_COOKIE['password'] != md5($pass))) {
            
            
            header('Location: login.php');
            
        }
    } else {
        header('Location: login.php');
    }


$myFile = "config.xml";
$myFile2 = "library.xml";




?>




