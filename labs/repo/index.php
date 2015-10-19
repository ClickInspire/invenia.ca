<?php
        include 'credential.php';
    if (isset($_GET['logout'])) {
        if (strcmp($folder,'localhost')) {
            setcookie('username','',time()-60*60*24*$days,'/',false);
            setcookie('password','',time()-60*60*24*$days,'/',false);
            header('Location: index.php');
        } else {
                setcookie('username','',time()-60*60*24*$days,$folder,$webaddr);
                setcookie('password','',time()-60*60*24*$days,$folder,$webaddr);
            header('Location: index.php');
            }
        
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Invenia Labs</title>

<meta name="description" content="Free download theme onepage, clean and modern responsive for all"/>
<meta name="keywords" content="responsive, html5, onepage, themes, template, clean layout, free web"/>
<meta name="author" content="Thomsoon.com"/>

<link rel="shortcut icon" href="img/favicon.png">

<link rel="stylesheet" type="text/css" href="css/reset.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style-responsive.css" />

</head>

<body>




<script>
function changevalue(file,page)
{
    
    
    //now we assign the new value to the input
    document.forms['formt'].open.value = 1;
    document.forms['formt'].file.value = file;
    document.forms['formt'].page.value = page;
    
}
</script>

<?php

    // define variables and initialize with empty values
    // choose 0 if internet visualization, 1 if portable
    $visualization=1;
    
    
    
    $configuration=simplexml_load_file('config.xml');
    
    $runsearch=0;
    $posted=0;
    
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $runsearch=1;
        $posted=1;
        $strtosearch=$_POST["searchstring"];
        
        
        foreach($configuration->variable as $variable) {
            
            if (empty($_POST["$variable->name"]))  {
                $errorvar["$variable->name"] = "You must select 1 option or more";
                $runsearch=0;
            }
            else {
                $myvarval["$variable->name"] = $_POST["$variable->name"];
            }
            
        }
        
    }
    

    
    // the HTML code starts here
    ?>





<div class="container">


<!-- section start-page -->

<section class="start-page parallax-background" id="home">

<div class="opacity"></div>
<div class="content">
<div class="text">
<h1><font color="#000099">Invenia</font> <font color="#3399ff">Labs</font> repository</h1>


</div>
<div class="arrow-down"></div>
</div>

</section>

<!-- section menu mobile -->

<section class="menu-media">

<div class="menu-content">

<div class="logo"><font color="#000099">Invenia</font> <font color="#3399ff">Labs</font></div>

<div class="icon"><a href="#"><img src="img/icons/menu-media.png"/></a></div>

</div>

</section>

<ul class="menu-click">
<a href="../index.html"><li href="">Home</li></a>

</ul>


<!-- section menu -->

<section class="menu">

<div class="menu-content">

<div class="logo"><font color="#000099">Invenia</font> <font color="#3399ff">Labs</font></div>

<ul id="menu">
<li><a href="../index.html">Home</a></li>
<?php
    /* These are our valid username and passwords */
    
    if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
        
        if (($_COOKIE['username'] == $user) && ($_COOKIE['password'] == md5($pass))) {
            
            
            echo "<li><a href=\"conf.php\">Configuration</a></li>";
            echo "<li><a href=\"index.php?logout=1\">Logout</a></li>";
            
        }
    } else {
        
        echo "<li><a href=\"login.php\">Login</a></li>";
        
    }
    
    ?>

</ul>
</div>


</section>


<!-- section research -->

<form method="POST" action="search.php" name="formt">

<?php
    
    if ($posted) {
        
        echo "<input type=\"text\" name=\"searchstring\" value=\"$strtosearch\"><br>";
        
    } else {
        
        echo "<input type=\"text\" name=\"searchstring\" value=\"\"><br>";
        
    }
    
    ?>


<select name="details">
<option value="1" selected="selected">Show tags</option>
<option value="2">Do not show tags</option>
</select>

<input type="submit"  name="s" value="Search"><br><br>
<input type="hidden" name="open" value="0">
<input type="hidden" name="file" value="">
<input type="hidden" name="page" value="">


<a href="#search" onClick="document.getElementById('advanced').style.display='block';">Show specific search criteria</a> &nbsp;&nbsp;&nbsp;

<?php
    
    if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
        
        
        if (($_COOKIE['username'] == $user) && ($_COOKIE['password'] == md5($pass))) {
            $validated=1;
        } else { $validated=0; }
    } else { $validated=0; }
    
    echo "<a name=\"search\">";
    echo "<div id=\"advanced\" style=\"display:none;\"><a href=\"#search\" onClick=\"document.getElementById('advanced').style.display='none';\">Hide specific search criteria</a><table>";
    
    //$content=utf8_encode(file_get_contents('config.xml'));
    $configuration=simplexml_load_file('config.xml');
    $r=0;
    foreach($configuration->variable as $variable) {
        $r++;
        
        if ( strcmp($variable->description,'Permissions') || (!strcmp($variable->description,'Permissions') && ($validated==1))) {
            
            
            printf("<tr><td><br><a href=\"#%d\" onClick=\"document.getElementById('id%s').style.display='block';\">%s</a><br>",$r,$variable->name,$variable->description);
            
            printf("<div id=\"id%s\" style=\"display:none;\"><select multiple name=\"%s[]\"  width=\"800\" style=\"width: 800px\" size=\"7\">",$variable->name,$variable->name);
            $n=0;
            foreach($variable->option as $option) {
                $n++;
                
                if ($posted==0 || empty($errorvar["$variable->name"])==0 ) {
                    
                    if ($n==1) {
                        printf("<option selected=\"selected\" value=\"%d\">%s</option>\n",$n,$option,$n);
                    } else {
                        printf("<option value=\"%d\">%s</option>\n",$n,$option);
                    }
                }
                else
                {
                    $selectme=0;
                    foreach($_POST["$variable->name"] as $selvar) {
                        if ($selvar==$n)
                            $selectme=1;
                    }
                    
                    if ($selectme==1) {
                        printf("<option value=\"%d\" selected=\"selected\">%s</option>\n",$n,$option);
                    } else {
                        printf("<option value=\"%d\">%s</option>\n",$n,$option);
                    }
                    
                    
                }
                
            }
            echo "</select><a href=\"#$r\" onClick=\"document.getElementById('id$variable->name').style.display='none';\">Hide</a></div></td></tr>";
            
            
            
        } else {
            printf("<tr><td><br><a href=\"#1\" onClick=\"document.getElementById('idvar1').style.display='block';\">%s</a><br>",$variable->description);
            
            printf("<div id=\"id%s\" style=\"display:none;\"><select multiple name=\"%s[]\"  width=\"800\" style=\"width: 800px\" size=\"7\">",$variable->name,$variable->name);
            printf("<option value=\"3\" selected=\"selected\">%s</option>\n","Public");
            echo "</select><a href=\"#$r\" onClick=\"document.getElementById('id$variable->name').style.display='none';\">Hide</a></div></td></tr>";
        }
        
        
    }
    
    
    
    
    
    ?>

</table>
<br><br><br><br><br><br><br><br><br>&nbsp;

<?php
    if ($runsearch) {
        echo "Results:<br><br>";
        
        
        
        if (empty($strtosearch)) {
            $isempty=1;
        } else {
            $explodedsearch=explode(' ',$strtosearch);
            $isempty=0;
        }
        
        //$content1=utf8_encode(file_get_contents('config.xml'));
        //$content2=$content=utf8_encode(file_get_contents('./Library/library.xml'));
        $library=simplexml_load_file('./Library/library.xml');
        $conf=simplexml_load_file('config.xml');
        
        $k=0;
        
        echo "<table border=\"1\">";
        foreach ($library->evstudy as $evstudy) {
            
            $initial=0;
            
            if ($isempty==0) {
                $explodedtargetevs=explode(' ',$evstudy->description);
                foreach($explodedtargetevs as $var1) {
                    foreach($explodedsearch as $var2) {
                        
                        if (strtolower($var1)==strtolower($var2)) {
                            $isok=1;
                        }
                        
                    }
                }
                
            } else {
                $isok=1;
            }
            
            foreach ($evstudy->project as $proj) {
                
                $explodedtargetpr=explode(' ',$proj->descrition);
                
                
                if ($isempty==0) {
                    $isok2=0;
                    $explodedtargetproj=explode(' ',$proj->description);
                    foreach($explodedtargetproj as $var1) {
                        foreach($explodedsearch as $var2) {
                            
                            if (strtolower($var1)==strtolower($var2)) {
                                $isok2=1;
                                
                            }
                            
                        }
                    }
                    
                } else {
                    $isok2=1;
                }
                
                
                
                
                
                if ($isok2) {
                    $select=1;
                    foreach($conf->variable as $variable) {
                        
                        $test=0;
                        foreach($myvarval["$variable->name"] as $values) {
                            if ($values==1)
                                $test=1;
                            
                            foreach($proj->variable as $projvar) {
                                if (!strcmp($projvar->name,$variable->name)) {
                                    foreach($projvar->value as $checkvalues) {
                                        if ($checkvalues==$values)
                                            $test=1;
                                    }
                                }
                            }
                            
                        }
                        
                        $select=$select*$test;
                    }
                } else {
                    $select=0;
                }
                
                
                
                if ($select && ($isok || $isok2)) {
                    
                    
                    $k++;
                    
                    if ($visualization==0) {
                        
                        
                        if ($initial==0) {
                            printf("<tr><td></td><td><font size=\"6\">%s</font></td><td><a href=\"%s\">Document</a></td></tr>",$evstudy->description,$evstudy->file);
                            
                            
                            if ($_POST["details"]==1) {
                                $s=1;
                                foreach ($evstudy->tag as $evtag) {
                                    printf("<tr><td></td><td>Tag %d: %s</td><td><a href=\"%s#page=%d\">Go to page</a></td></tr>",$s,$evtag->description,$evstudy->file,$evtag->pag);
                                    $s++;
                                }
                            }
                            $initial=1;
                        }
                        
                        printf("<tr><td>%d)</td><td>%s</td><td></td></tr>",$k,$proj->description);
                        
                        if ($_POST["details"]==1) {
                            $s=1;
                            foreach ($proj->tag as $tag) {
                                printf("<tr><td></td><td>Tag %d: %s</td><td><a href=\"%s#page=%d\">Go to page</a></td></tr>",$s,$tag->description,$evstudy->file,$tag->pag);
                                $s++;
                            }
                        }
                        
                    } else {
                        
                        
                        
                        
                        if ($initial==0) {
                            
                            
                            if(strpos($evstudy->file, "http")!==false) {
                                printf("<tr><td></td><td><font size=\"6\">%s</font></td><td><a href=\"%s\">Document</a></td></tr>",$evstudy->description,$evstudy->file);        
                            } else {
                                printf("<tr><td></td><td><font size=\"6\">%s</font></td><td><input type=\"submit\" name=\"submit\" value=\"Document\" onclick=\"changevalue('%s',0);\" /></td></tr>",$evstudy->description,$evstudy->file);    
                                
                            }
                            
                            if ($_POST["details"]==1) {
                                $s=1;
                                foreach ($evstudy->tag as $evtag) {
                                    if(strpos($evstudy->file, "http")!==false) {
                                        printf("<tr><td></td><td>Tag %d: %s</td><td><a href=\"%s#page=%d\">Go to page</a></td></tr>",$s,$evtag->description,$evstudy->file,$evtag->pag); 
                                    } else {
                                        printf("<tr><td></td><td>Tag %d: %s</td><td><input type=\"submit\" name=\"submit\" value=\"Go to page\" onclick=\"changevalue('%s',%d);\" /></td></tr>",$s,$evtag->description,$evstudy->file,$evtag->pag);    
                                    }
                                    $s++;
                                }
                            }
                            $initial=1;
                        }
                        printf("<tr><td>%d)</td><td>%s</td><td></td></tr>",$k,$proj->description);    
                        
                        if ($_POST["details"]==1) {
                            $s=1;
                            foreach ($proj->tag as $tag) {
                                if(strpos($evstudy->file, "http")!==false) {
                                    printf("<tr><td></td><td>Tag %d: %s</td><td><a href=\"%s#page=%d\">Go to page</a></td></tr>",$s,$tag->description,$evstudy->file,$tag->pag);      
                                } else {
                                    printf("<tr><td></td><td>Tag %d: %s</td><td><input type=\"submit\" name=\"submit\" value=\"Go to page\" onclick=\"changevalue('%s',%d);\" /></td></tr>",$s,$tag->description,$evstudy->file,$tag->pag);    
                                }
                                $s++;
                            }
                        }
                        
                    } // $visualization
                    
                } // $ select
                
            } // $evstudy
            
        } // $library
        
        
        
        echo "</table>";
    } //$runsearch
    
    if (isset($_POST["open"]) && $_POST["open"]==1) {
        
        $file=$_POST["file"];
        
        if (isset($_POST["page"]) && $_POST["page"]>0) {
            $page=$_POST["page"];
        } else {
            $page=1;
        }
        
        pclose(popen(sprintf("start reader.exe \"%s\" -page %d -restrict",$file,$page),"r"));
        //exec(printf("reader.exe \"%s\" -page %d -restrict",$file,$page));
    }
    
    ?>

</form>


<section class="footer">

<div class="margin">

<div class="menu-footer">

<a href="#home">Home</a>
<a href="#">Privacy policy</a>
<a href="#">RSS</a>
<a href="#">Facebook</a>

</div>
<div> </div>
<div class="copyright">Invenia Labs, 57 Warren Close, CB2 1LB Cambridge (UK);              © 2015. All Rights Reserved.</div>

</div>


</section>


</div>



<!-- Scripts -->

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> <!-- jQuery -->
<script src="js/jquery.parallax.js"></script> <!-- jQuery Parallax -->
<script src="js/jquery.nicescroll.js"></script> <!-- jQuery NiceScroll -->
<script src="js/jquery.sticky.js"></script> <!-- jQuery Stick Menu -->
<script src="js/script.js"></script> <!-- All script -->

</body>

</html>