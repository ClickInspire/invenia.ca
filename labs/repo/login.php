<?php
    /* These are our valid username and passwords */
    include 'credential.php';
//    echo $user;
 //   echo $_COOKIE['username'];
//    echo $_COOKIE['password'];
 //   echo $pass;
    if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
        
        if (($_COOKIE['username'] != $user) || ($_COOKIE['password'] != md5($pass))) {
            if (!strcmp($folder,'localhost')) {
            setcookie('username','',time()-60*60*24*$days,'/',false);
            setcookie('password','',time()-60*60*24*$days,'/',false);
            }   else {
                    setcookie('username','',time()-60*60*24*$days,$folder,$webaddr);
                    setcookie('password','',time()-60*60*24*$days,$folder,$webaddr);
                }
            if (isset($_POST['username']) && isset($_POST['password'])) {
                
                if (($_POST['username'] == $user) && ($_POST['password'] == $pass)) {
                    if (isset($_POST['rememberme'])) {
                        
                        /* Set cookie to last 31 days */
                        if (!strcmp($folder,'localhost')) {
      //                      echo 'I am here inside localhost';

                            setcookie('username', $_POST['username'], time()+60*60*24*$days, $folder, $webaddr);
                            setcookie('password', md5($_POST['password']), time()+60*60*24*$days, $folder, $webaddr);
        //                    echo 'I am here';
                        } else {

                            setcookie('username', $_POST['username'], time()+60*60*24*$days, '/', false);
                            setcookie('password', md5($_POST['password']), time()+60*60*24*$days, '/', false);
                        }
                        //echo 'cookies set';
                    } else {
                        /* Cookie expires when browser closes */
                        if (!strcmp($folder,'localhost')) {

                            setcookie('username', $_POST['username'], false, $folder, $webaddr);
                            setcookie('password', md5($_POST['password']), false, $folder, $webaddr);
                        } else {

                            setcookie('username', $_POST['username'], false, '/', false);
                            setcookie('password', md5($_POST['password']), false, '/', false);
                        }
                    }
                    header('Location: index.php');
                    
                } else {
                echo '<html>        <head>';
                    echo '<title>User Logon</title></head><img src="img/InveniaLabs.jpg"><br><br>';
                    echo ' <body><h2>User Login </h2>';
            
                echo '<form name="login" method="post" action="login.php">';
                echo 'Username: <input type="text" name="username"><br>';
                echo 'Password: <input type="password" name="password"><br>';
                echo 'Remember Me: <input type="checkbox" name="rememberme" value="1"><br>';
                echo '<input type="submit" name="submit" value="Login!">';
                echo '</form></body>        </html>';
            
            
               echo 'Invalid user or password.';
                }
        } else {
            echo '<html>        <head>';
            echo '<title>User Logon</title></head><img src="img/InveniaLabs.jpg"><br><br>';
            echo ' <body><h2>User Login </h2>';
            
            echo '<form name="login" method="post" action="login.php">';
            echo 'Username: <input type="text" name="username"><br>';
            echo 'Password: <input type="password" name="password"><br>';
            echo 'Remember Me: <input type="checkbox" name="rememberme" value="1"><br>';
            echo '<input type="submit" name="submit" value="Login!">';
            echo '</form></body>        </html>';
            
            
        }
        } else {
            header('Location: index.php');
        }
    } else {
     
    if (isset($_POST['username']) && isset($_POST['password'])) {
        
        if (($_POST['username'] == $user) && ($_POST['password'] == $pass)) {
            //echo 'Login successful!';
            if (isset($_POST['rememberme'])) {
                /* Set cookie to last 31 days */
                if (!strcmp($folder,'localhost')) {
                 //   echo 'test 1';
                setcookie('username', $_POST['username'], time()+60*60*24*$days, $folder, $webaddr);
                setcookie('password', md5($_POST['password']), time()+60*60*24*$days, $folder, $webaddr);
                } else {
                  //  echo 'test 2';
                 setcookie('username', $_POST['username'], time()+60*60*24*$days, '/', false);
                 setcookie('password', md5($_POST['password']), time()+60*60*24*$days, '/', false);
                }
                //echo 'cookies set';
            } else {
                /* Cookie expires when browser closes */
                if (!strcmp($folder,'localhost')) {
                //    echo 'test 3';
                setcookie('username', $_POST['username'], false, $folder, $webaddr);
                setcookie('password', md5($_POST['password']), false, $folder, $webaddr);
                } else {
                //    echo 'test 4';
                setcookie('username', $_POST['username'], false, '/', false);
                setcookie('password', md5($_POST['password']), false, '/', false);
                }
            }
            header('Location: index.php');
            
        } else {
            echo '<html>        <head>';
            
            echo '<title>User Logon</title></head><img src="img/InveniaLabs.jpg"><br><br>';
            echo ' <body><h2>User Login </h2>';
            
            echo '<form name="login" method="post" action="login.php">';
            echo 'Username: <input type="text" name="username"><br>';
            echo 'Password: <input type="password" name="password"><br>';
            echo 'Remember Me: <input type="checkbox" name="rememberme" value="1"><br>';
            echo '<input type="submit" name="submit" value="Login!">';
            echo '</form></body>        </html>';
            
            echo 'Username/Password Invalid';
        }
        
    } else {
        
        echo '<html>        <head>';
        echo '<title>User Logon</title></head><img src="img/InveniaLabs.jpg"><br><br>';
        echo ' <body><h2>User Login </h2>';
       
        echo '<form name="login" method="post" action="login.php">';
        echo 'Username: <input type="text" name="username"><br>';
        echo 'Password: <input type="password" name="password"><br>';
        echo 'Remember Me: <input type="checkbox" name="rememberme" value="1"><br>';
        echo '<input type="submit" name="submit" value="Login!">';
        echo '</form></body>        </html>';
        
        
        echo 'You must supply a username and password.';
    }
    }
?>