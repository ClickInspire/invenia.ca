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
    
?>

<!DOCTYPE html>
<html lang="en">


<title>Invenia Labs Repo</title>


<img src="img/InveniaLabs.jpg"><br><br>

<a href="index.php">Go back</a><br><br>
 
            
            <li>
                <a href="files.php">Add Files</a>
            </li>
            
            <li><a href="variables.php">Change Variables</a>
            </li>
            
            <li><a href="library.php">Configure Library</a>
            </li>


    
</html>