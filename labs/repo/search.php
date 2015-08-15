<?php
    // define variables and initialize with empty values
    // choose 0 if internet visualization, 1 if portable
    $visualization=0;
    
    
    
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



<script>
function changevalue(file,page)
{
    
    
    //now we assign the new value to the input
    document.forms['formt'].open.value = 1;
    document.forms['formt'].file.value = file;
    document.forms['formt'].page.value = page;
    
}
</script>

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
<a href="../index.html"><li href="">HOME</li></a>

</ul>


<!-- section menu -->

<section class="menu">

<div class="menu-content">

<div class="logo"><font color="#000099">Invenia</font> <font color="#3399ff">Labs</font></div>

<ul id="menu">
<li><a href="../index.html">HOME</a></li>

</ul>
</div>


</section>


<!-- section search -->



<br><br><br><br>
<form method="POST" name="formt">
Note: Keyword search applies to project and document descriptions, not inside the document. And redirection to pages optimized for Internet Explorer.<br><br><br><br><br>
<?php
    
    if ($posted) {
        
        echo "Insert the keywords to look for:<br><input type=\"text\" name=\"searchstring\" value=\"$strtosearch\" size=\"100\"><br>";
        
    } else {
        
        echo "Insert the keywords to look for:<br><input type=\"text\" name=\"searchstring\" value=\"\" size=\"100\"><br>";
        
    }
    
    ?>



<input type="hidden" name="open" value="0">
<input type="hidden" name="file" value="">
<input type="hidden" name="page" value="">

<a href="#search" onClick="document.getElementById('advanced').style.display='block';">Show specific search criteria</a> &nbsp;&nbsp;&nbsp;

<?php
    echo "<a name=\"search\">";
    echo "<div id=\"advanced\" style=\"display:none;\"><a href=\"#search\" onClick=\"document.getElementById('advanced').style.display='none';\">Hide specific search criteria</a><table>";
    
    //$content=utf8_encode(file_get_contents('config.xml'));
    $configuration=simplexml_load_file('config.xml');
    $r=0;
    foreach($configuration->variable as $variable) {
        $r++;
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
        
        
    }
    
    
    ?>

</table></div>
<br><br>
<select name="details">
<option value="1" selected="selected">Show tags</option>
<option value="2">Do not show tags</option>
</select>

<input type="submit"  name="s" value="Search" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"><br>
<br><br>


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
        //$content2=$content=utf8_encode(file_get_contents('library.xml'));
        $library=simplexml_load_file('library.xml');
        $conf=simplexml_load_file('config.xml');
        
        $k=0;
        
        echo "<table border=\"1\">";
        foreach ($library->evstudy as $evstudy) {
            
            
            $file=simplexml_load_file('file.xml');
            foreach ($file->files as $vfile) {
                if ((int) $evstudy->file==(int) $vfile->index) {
                    $myfile=$vfile->name;
                    break;
                }
            }
            
            $initial=0;
            
            if ($isempty==0) {
                $isok=0;
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
                
                
                
                
                
                if ($isok2 || $isok) {
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
                
                
                
                if ($select && ($isok || $isok2 || $isok3)) {
                    
                    
                    $k++;
                    
                    if ($visualization==0) {
                        
                        
                        if ($initial==0) {
                            
                            
                            
                            
                            printf("<tr><td></td><td><font size=\"4\">%s</font></td><td><a href=\"%s\">Document</a></td></tr>",$evstudy->description,$myfile);
                            
                            
                            if ($_POST["details"]==1) {
                                $s=1;
                                foreach ($evstudy->tag as $evtag) {
                                    printf("<tr><td></td><td>Tag %d: %s</td><td><a href=\"%s#page=%d\">Go to page</a></td></tr>",$s,$evtag->description,$myfile,$evtag->pag);
                                    $s++;
                                }
                            }
                            $initial=1;
                        }
                        
                        printf("<tr><td>%d)</td><td>%s</td><td></td></tr>",$k,$proj->description);
                        
                        if ($_POST["details"]==1) {
                            $s=1;
                            foreach ($proj->tag as $tag) {
                                printf("<tr><td></td><td>Tag %d: %s</td><td><a href=\"%s#page=%d\">Go to page</a></td></tr>",$s,$tag->description,$myfile,$tag->pag);
                                $s++;
                            }
                        }
                        
                    } else {
                        
                        
                        
                        
                        if ($initial==0) {
                            
                            
                            if(strpos($evstudy->file, "http")!==false) {
                                printf("<tr><td></td><td><font size=\"4\">%s</font></td><td><a href=\"%s\">Document</a></td></tr>",$evstudy->description,$myfile);        
                            } else {
                                printf("<tr><td></td><td><font size=\"4\">%s</font></td><td><input type=\"submit\" action=\"%s\" name=\"submit\" value=\"Document\" onclick=\"changevalue('%s',0);\" /></td></tr>",$evstudy->description,htmlspecialchars($_SERVER["PHP_SELF"]),$myfile);    
                                
                            }
                            
                            if ($_POST["details"]==1) {
                                $s=1;
                                foreach ($evstudy->tag as $evtag) {
                                    if(strpos($evstudy->file, "http")!==false) {
                                        printf("<tr><td></td><td>Tag %d: %s</td><td><a href=\"%s#page=%d\">Go to page</a></td></tr>",$s,$evtag->description,$myfile,$evtag->pag); 
                                    } else {
                                        printf("<tr><td></td><td>Tag %d: %s</td><td><input type=\"submit\" action=\"%s\" name=\"submit\" value=\"Go to page\" onclick=\"changevalue('%s',%d);\" /></td></tr>",$s,$evtag->description,$myfile,htmlspecialchars($_SERVER["PHP_SELF"]),$evtag->pag);    
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
                                    printf("<tr><td></td><td>Tag %d: %s</td><td><a href=\"%s#page=%d\">Go to page</a></td></tr>",$s,$tag->description,$myfile,$tag->pag);      
                                } else {
                                    printf("<tr><td></td><td>Tag %d: %s</td><td><input type=\"submit\"  action=\"%s\" name=\"submit\" value=\"Go to page\" onclick=\"changevalue('%s',%d);\" /></td></tr>",$s,$tag->description,$myfile,htmlspecialchars($_SERVER["PHP_SELF"]),$tag->pag);    
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
<br>

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


		