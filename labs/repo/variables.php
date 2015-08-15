
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
<a href="../index.html"><li href="">HOME</li></a>
<a href="conf.php"><li href="">BACK</li></a>
</ul>


<!-- section menu -->

<section class="menu">

<div class="menu-content">

<div class="logo"><font color="#000099">Invenia</font> <font color="#3399ff">Labs</font></div>

<ul id="menu">
<li><a href="../index.html">HOME</a></li>
<a href="conf.php"><li href="">BACK</li></a>
</ul>
</div>


</section>


<!-- section research -->



<form method="POST" enctype="multipart/form-data">
<input type="submit" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="addvar" value="Add New Attribute"><br><br>
<?php
    
    
    
    //$content = utf8_encode(file_get_contents('config.xml'));
    $conf=simplexml_load_file('config.xml');
    
    if ($_SERVER["REQUEST_METHOD"] == "POST")  {
        $myFile = "config.xml";
        $fh = fopen($myFile, 'w') or die("can't open file");
        fwrite($fh,sprintf ("<?xml version=\"1.0\" ?>\r\n"));
fwrite($fh,sprintf ("<conf>\r\n\r\n"));



}




$n=0;

foreach ($conf->variable as $variable) {
    $n++;
    $k=0;
    
    $showtable=1;
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($_POST["$n"])) {
        $showtable=0;
    }
    
    if ($showtable) {
        
        echo "<table border=\"1\">";
        
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            if (isset($_POST["update"])) {
                fwrite($fh,iconv("ISO-8859-1", "UTF-8", sprintf ("   <variable>\r\n<name>%s</name>\r\n<description>%s</description>\r\n",$variable->name,$_POST["$n"])));
                
                
                
                printf("<tr><td>Attribute name:</td><td><input type=\"text\"  value=\"%s\" name=\"%d\"></td></tr>",$_POST["$n"],$n);
            } else {
                fwrite($fh,sprintf ("   <variable>\r\n<name>%s</name>\r\n<description>%s</description>\r\n",$variable->name,$variable->description));
                printf("<tr><td>Attribute name:</td><td><input type=\"text\"  value=\"%s\" name=\"%d\"></td></tr>",$variable->description,$n);
            }
            
        } else {
            printf("<tr><td>Attribute name:</td><td><input type=\"text\"  value=\"%s\" name=\"%d\"></td></tr>",$variable->description,$n);
        }
        
        
        
        foreach ($variable->option as $option) {
            $k++;
            
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
                if (isset($_POST["update"])) {
                    
                    if (!empty($_POST["option$n$k"])) {
                        printf("<tr><td>Option %d:</td><td><input type=\"text\"  value=\"%s\" name=\"option%d%d\"></td></tr>",$k,$_POST["option$n$k"],$n,$k);
                        fwrite($fh,iconv("ISO-8859-1", "UTF-8", sprintf ("    <option>%s</option>\r\n ",$_POST["option$n$k"])));
                    }
                    
                    
                    
                } else {
                    
                    printf("<tr><td>Option %d:</td><td><input type=\"text\"  value=\"%s\" name=\"option%d%d\"></td></tr>",$k,$option,$n,$k);
                    fwrite($fh,iconv("ISO-8859-1", "UTF-8", sprintf ("    <option>%s</option>\r\n ",$option)));
                    
                }
                
                
            } else {
                printf("<tr><td>Option %d:</td><td><input type=\"text\"  value=\"%s\" name=\"option%d%d\"></td></tr>",$k,$option,$n,$k);
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    fwrite($fh,iconv("ISO-8859-1", "UTF-8",sprintf ("    <option>%s</option>\r\n ",$option)));
                }
            }
            
            
        }
        
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["$variable->name"])) {
                printf("<tr><td><font color=\"red\">New Option</font></td><td><input type=\"text\"  value=\"Unkown\" name=\"option%d%d\"></td></tr>",$n,$k+1);
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST["$variable->name"])) {
                        fwrite($fh,iconv("ISO-8859-1", "UTF-8", sprintf ("    <option>Unknown</option>\r\n ",$option)));
                    }
                }
            }
        }
        
        
        printf("<tr><td></td><td><input type=\"submit\"  action=\"%s\" name=\"%s\" value=\"Add New Option\"></td></tr>",htmlspecialchars($_SERVER["PHP_SELF"]),$variable->name);
        
        echo "</table>";
        echo "<br>";
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            fwrite($fh,"</variable>\r\n");
        }
        
        
    }
    
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST["addvar"])) {
        $n++;
        $k=1;
        echo "<table border=\"1\">";
        printf("<tr><td><font color=\"red\">Attribute name:</font></td><td><input type=\"text\"  value=\"Unkown\" name=\"%d\"></td></tr>",$n);
        printf("<tr><td><font color=\"red\">Option</font></td><td><input type=\"text\"  value=\"All\" name=\"option%d%d\"></td></tr>",$n,$k);
        printf("<tr><td><font color=\"red\">Option</font></td><td><input type=\"text\"  value=\"Unkown\" name=\"option%d%d\"></td></tr>",$n,$k+1);
        echo "</table>";
        echo "<br>";
        
        
        
        fwrite($fh,"  <variable>\r\n");
        fwrite($fh,sprintf ("    <name>var%d</name>\r\n ",$n));
        fwrite($fh,sprintf ("    <description>Unknown</description>\r\n "));
        fwrite($fh,sprintf ("    <option>All</option>\r\n ",$n,$k));
        fwrite($fh,sprintf ("    <option>Unknown</option>\r\n ",$n,$k));
        fwrite($fh,"  </variable>\r\n\r\n");
        
    }
    
    
    
    fwrite($fh,"</conf>\r\n\r\n");
    
    $fh = fclose($fh) or die("can't close  file");
}

?>



<input type="submit" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="update" value="Update Attributes">



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