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



<?php
    
    
    $conf=simplexml_load_file('config.xml');
    $library=simplexml_load_file('library.xml');
    
    $n=1;
    $nd=0; $kd=0;
    
    if ($_SERVER["REQUEST_METHOD"] == "POST")  {
        
        $myFile2 = "library.xml";
        $fh2 = fopen($myFile2, 'w') or die("can't open file");
        fwrite($fh2,sprintf ("<?xml version=\"1.0\" ?>\r\n"));
fwrite($fh2,sprintf ("<library>\r\n\r\n"));

}



if ($_SERVER["REQUEST_METHOD"] == "POST")  {
    if (isset($_POST["addevst"])) {
        
        echo "<br><br><br><table>";
        
        echo "<tr><td>Document description:</td><td> <input type=\"text\" value=\"Unknown\" name=\"newevstdesc\"></td></tr>";
        //echo "<tr><td>Choose file name:</td><td> <input type=\"text\" name=\"newevstfile\" value=\"Library/\"></td></tr>";
        //echo "<tr><td>File to upload (pdf):</td><td><input name=\"userfile\" type=\"file\"></td></tr>";
        
        $file=simplexml_load_file('file.xml');
        printf("File:<select  name=\"newevstfile\">");
        foreach ($file->files as $vfile) {
            printf("<option value=\"%d\"> %s</option>",$vfile->index,$vfile->name);
        }
        
        printf("</select><input type=\"button\" name=\"Submit\" value=\"View\"  onClick=\"window.open(newevstfile.options[newevstfile.selectedIndex].text,'newtab')\"></td>");
        
        echo "<tr><td></td><td><input type=\"submit\" name=\"addevssub\" value=\"Add Document\">";
        
        echo "</table>";
        
    }
    
    
    if (isset($_POST["addproj"])) {
        
        
        echo "Insert new sub-document<br>";
        echo "<table>";
        
        echo "<tr><td>Document number:</td><td> <input type=\"text\" value=\"1\" name=\"addevnumb\" size=\"5\"></td></tr>";
        echo "<tr><td>Sub-document description</td><td> <input type=\"text\" value=\"Unknown\" name=\"newprojdesc\"></td></tr>";
        
        
        
        echo "<tr>";
        foreach ($conf->variable as $variable) {
            echo "<td>$variable->description</td>";
        }
        echo "</tr><tr>";
        
        $z=1;
        foreach ($conf->variable as $variable) {
            printf("<td><select size=\"1\" name=\"nproj%d\">",$z);
            $t=1;
            foreach ($variable->option as $option) {
                echo "<option value=\"$t\">$option</option>";
                $t++;
            }
            echo "</select></td>";
            $z++;
        }
        
        echo "</td>";
        
        
        
        
        echo "<tr><td></td><td><input type=\"submit\" name=\"addprojsub\" value=\"Add Sub-Document\">";
        
        echo "</tr></table>";
    }
    
    
    if (isset($_POST["addtag"])) {
        
        echo "<br><br><br><table>";
        echo "<tr><td>Document number:</td><td> <input type=\"text\" value=\"1\" name=\"tagstnum\"></td></tr>";
        echo "<tr><td>Sub-Document number:</td><td> <input type=\"text\" value=\"1\" name=\"tagprnum\"></td></tr>";
        echo "<tr><td>Tag description:</td><td> <input type=\"text\" value=\"Unknown\" name=\"tagdesc\"></td></tr> ";
        echo "<tr><td>Page:</td><td><input type=\"text\" value=\"0\" name=\"tagpag\"></td><td><input type=\"submit\" name=\"addtagsub\" value=\"Add Tag\"></td></tr>";
        
        echo "</table>";
        echo "Note: Select sub-document number 0 if to be added to the whole document.";
    }
    
    
    
}




?>




<br><br><br><br><br><br>


Controls:<br>
<input type="submit" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="addevst" value="New document"> <input type="submit" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="addproj" value="Add new sub-document">
<input type="submit" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="addtag" value="Add new tag">
<br><br><br><br><br><br>

<?php
    printf("Documents<br> ");
    
    
    
    
    foreach ($library->evstudy as $evstudy) {
        $k=1;
        $kd=0;
        $nf=$n-$nd;
        if (isset($_POST["updatelib"]) &&  empty($_POST["evtxt$n"])) {
            $n++;
            $nd++;
            continue;
        }
        
        
        echo "<table border=\"1\">";
        
        if ($_SERVER["REQUEST_METHOD"] == "POST")  {
            if (isset($_POST["updatelib"]) || isset($_POST["addprojsub"])  ||  isset($_POST["addproj"]) ) {
                printf("<tr><td>%d)</td><td> <input type=\"text\"  value=\"%s\" size=\"50\" name=\"evtxt%d\"></td><td>",$n-$nd,$_POST["evtxt$n"],$n-$nd);
                $file=simplexml_load_file('file.xml');
                printf("File:<select  name=\"fl%d\">",$n-$nd);
                foreach ($file->files as $vfile) {
                    if ($_POST["fl$n"]==$vfile->index) {
                        printf("<option value=\"%d\" selected> %s</option>",$vfile->index,$vfile->name);
                    } else {
                        printf("<option value=\"%d\"> %s</option>",$vfile->index,$vfile->name);
                    }
                }
                printf("</select><input type=\"button\" name=\"Submit\" value=\"View\"  onClick=\"window.open(fl%d.options[fl%d.selectedIndex].text,'newtab')\"></td></tr>",$n-$nd,$n-$nd);
                
                
                
            } else {
                printf("<tr><td>%d)</td><td> <input type=\"text\"  value=\"%s\" size=\"50\" name=\"evtxt%d\"></td><td>",$n-$nd,$evstudy->description,$n-$nd);
                //                 printf("</td><td>File:<input type=\"text\" value=\"%s\" name=\"fl%d\"></td></tr>",$_POST["fl$n"],$n-$nd);
                
                $file=simplexml_load_file('file.xml');
                printf("File:<select  name=\"fl%d\">",$n-$nd);
                foreach ($file->files as $vfile) {
                    if ($_POST["fl$n"]==$vfile->index) {
                        printf("<option value=\"%d\" selected=\"selected\"> %s</option>",$vfile->index,$vfile->name);
                    } else {
                        printf("<option value=\"%d\"> %s</option>",$vfile->index,$vfile->name);
                    }
                }
                printf("</select><input type=\"button\" name=\"Submit\" value=\"View\"  onClick=\"window.open(fl%d.options[fl%d.selectedIndex].text,'newtab')\"></td></tr>",$n-$nd,$n-$nd);
                
                
                
            }
        } else {
            printf("<tr><td>%d)</td><td> <input type=\"text\"  value=\"%s\" size=\"50\" name=\"evtxt%d\"></td><td>",$n-$nd,$evstudy->description,$n-$nd);
            
            //File:<input type=\"text\" value=\"%s\" name=\"fl%d\"></td></tr>",$n-$nd,$evstudy->description,$n-$nd,$evstudy->file,$n-$nd);
            
            $file=simplexml_load_file('file.xml');
            printf("File:<select  name=\"fl%d\">",$n-$nd);
            foreach ($file->files as $vfile) {
                if ((int) $evstudy->file==(int) $vfile->index) {
                    printf("<option value=\"%d\" selected=\"selected\">%s</option>",$vfile->index,$vfile->name);
                } else {
                    printf("<option value=\"%d\"> %s</option>",$vfile->index,$vfile->name);
                }
            }
            
            printf("</select><input type=\"button\" name=\"Submit\" value=\"View\"  onClick=\"window.open(fl%d.options[fl%d.selectedIndex].text,'newtab')\"></td></tr>",$n-$nd,$n-$nd);
            
            
        }
        
        
        if ($_SERVER["REQUEST_METHOD"] == "POST")  {
            
            if (isset($_POST["updatelib"]) || isset($_POST["addprojsub"])  ||  isset($_POST["addproj"]) || isset($_POST["addvar"]) || isset($_POST["addevst"]) || isset($_POST["addtag"]) || isset($_POST["addtagsub"]) || isset($_POST["addevssub"]) ) {
                if (!empty($_POST["evtxt$n"])) {
                    fwrite($fh2,"  <evstudy>\r\n");
                    fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("   <description>%s</description>\r\n",$_POST["evtxt$n"])));
                    fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("   <file>%s</file>\r\n",$_POST["fl$n"])));
                    $delete=0;
                } else {
                    $delete=1;
                    
                }
            } else {
                if (!empty($evstudy->description)) {
                    $delete=0;
                    fwrite($fh2,"  <evstudy>\r\n");
                    fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("   <description>%s</description>\r\n",$evstudy->description)));
                    fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("   <file>%s</file>\r\n",$evstudy->file)));
                } else {
                    $delete=1;
                    
                }
            }
        }
        
        $tn=1;
        $tnd=0;
        foreach ( $evstudy->tag as $evtag) {
            
            if (isset($_POST["updatelib"]) &&  empty($_POST["evtagn" . $n . "_" . $tn])) {
                $tn++;
                $tnd++;
                continue;
            }
            
            
            if (($_SERVER["REQUEST_METHOD"] == "POST"))  {
                
                fwrite($fh2,"   <tag>\r\n");
                fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("    <description>%s</description>\r\n",$_POST["evtagn" . $n . "_" . $tn])));
                fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("    <pag>%s</pag>\r\n",$_POST["evtagp" . $n . "_" . $tn])));
                fwrite($fh2,"   </tag>\r\n");
                printf("<tr><td>Tag %d</td><td>Description:<input value=\"%s\" size=\"10\"  name=\"evtagn%d_%d\">&nbsp;Page<input value=\"%d\" size=\"5\" name=\"evtagp%d_%d\">",$tn-$tnd,$_POST["evtagn" . $n . "_" . $tn],$n-$nd,$tn-$tnd,$_POST["evtagp" . $n . "_" . $tn],$n-$nd,$tn-$tnd);
                
                
                
            } else {
                
                printf("<tr><td>Tag %d</td><td>Description:<input value=\"%s\" size=\"10\"  name=\"evtagn%d_%d\">&nbsp;Page<input value=\"%d\" size=\"5\" name=\"evtagp%d_%d\">",$tn,$evtag->description,$n,$tn,$evtag->pag,$n,$tn);
                
            }
            
            $added="#page=" . strval($evtag->pag);
            printf("<input type=\"button\" name=\"Submit\" value=\"View\"  onClick=\"window.open(fl%d.options[fl%d.selectedIndex].text + '%s','newtab')\"></td></tr>",$n-$nd,$n-$nd,$added);
            $tn++;
        }
        
        if (( $_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST["addtagsub"]))  {
            if ( ($n==$_POST["tagstnum"]) && ($_POST["tagprnum"]==0)) {
                fwrite($fh2,"    <tag>\r\n");
                fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("     <description>%s</description>\r\n",$_POST["tagdesc"])));
                fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("     <pag>%s</pag>\r\n",$_POST["tagpag"])));
                fwrite($fh2,"    </tag>\r\n");
                printf("<tr><td>Tag %d</td><td>Description:<input value=\"%s\" size=\"10\"  name=\"evtagn%d_%d\">&nbsp;Page<input value=\"%d\" size=\"5\" name=\"evtagp%d_%d\"></td>",$tn-$tnd,$_POST["tagdesc"],$n-$nd,$tn-$tnd,$_POST["tagpag"],$n-$nd,$tn-$tnd);
                $added="#page=" . strval($_POST["tagpag"]);
                printf("<input type=\"button\" name=\"Submit\" value=\"View\"  onClick=\"window.open(fl%d.options[fl%d.selectedIndex].text%s,'newtab')\"></td></tr>",$n-$nd,$n-$nd,$added);
            }
        }
        
        
        echo "<tr><td><td/>";
        foreach ($conf->variable as $variable) {
            echo "<td>$variable->description</td>";
        }
        
        
        echo "</tr>";
        foreach($evstudy->project as $project) {
            if (isset($_POST["updatelib"]) &&  empty($_POST["evtxt" . $n . "_" . $k])) {
                $k++;
                $kd++;
                continue;
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST")  {
                fwrite($fh2,"   <project>\r\n");
                if (isset($_POST["updatelib"]) || isset($_POST["addprojsub"])  ||  isset($_POST["addproj"]) || isset($_POST["addvar"]) || isset($_POST["addevst"]) || isset($_POST["addtag"]) || isset($_POST["addtagsub"]) || isset($_POST["addevssub"])) {
                    
                    fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("   <description>%s</description>\r\n",$_POST["evtxt" . $n . "_" . $k])));
                } else {
                    fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("    <description>%s</description>\r\n",$project->description)));
                }
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST")  {
                if (isset($_POST["updatelib"]) || isset($_POST["addprojsub"])  ||  isset($_POST["addproj"]) || isset($_POST["addvar"]) || isset($_POST["addevst"]) || isset($_POST["addtag"]) || isset($_POST["addtagsub"]) || isset($_POST["addevssub"])) {
                    printf("<tr><td>%d.%d:</td><td> <input type=\"text\"  value=\"%s\" size=\"40\" name=\"evtxt%d_%d\"> </td>",$n-$nd,$k-$kd,$_POST["evtxt" . $n . "_" . $k],$n-$nd,$k-$kd);
                    
                } else {
                    printf("<tr><td>%d.%d:</td><td> <input type=\"text\"  value=\"%s\" size=\"40\" name=\"evtxt%d_%d\"> </td>",$n-$nd,$k-$kd,$project->description,$n-$nd,$k-$kd);
                }
            }  else {
                printf("<tr><td>%d.%d:</td><td> <input type=\"text\"  value=\"%s\" size=\"40\" name=\"evtxt%d_%d\"> </td>",$n-$nd,$k-$kd,$project->description,$n,$k);
            }
            $t=1;
            foreach ($conf->variable as $variable) {
                $t++;
                if ($_SERVER["REQUEST_METHOD"] == "POST")  {
                    fwrite($fh2,"   <variable>\r\n");
                    fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("    <name>%s</name>\r\n",$variable->name)));
                }
                
                echo "<td><select multiple size=\"5\" name=\"opt" . $n ."_" . $k . "_" . $t . "[]\">";
                $r=1;
                $rs=0;
                foreach ($variable->option as $option) {
                    
                    $selected=0;
                    $everselected=0;
                    if ($_SERVER["REQUEST_METHOD"] == "POST")  {
                        if (isset($_POST["updatelib"]) || isset($_POST["addprojsub"])  ||  isset($_POST["addproj"]) || isset($_POST["addvar"]) || isset($_POST["addevst"]) || isset($_POST["addtag"]) || isset($_POST["addtagsub"]) || isset($_POST["addevssub"])) {
                            
                            
                            
                            foreach ($_POST["opt" . $n ."_" . $k . "_" . $t] as $selme) {
                                
                                if ($r == $selme) {
                                    
                                    $selected=1;
                                    $everselected=1;
                                }
                                
                            }
                            
                        } else {
                            
                            if (!strcmp ($projvar->name,$variable->name)) {
                                
                                foreach($projvar->value as $value) {
                                    if ($r==$value) {
                                        $selected=1;
                                        $everselected=1;
                                    }
                                }
                            }
                        }
                        
                    } else {
                        foreach ($project->variable as $projvar) {
                            
                            if (!strcmp ($projvar->name,$variable->name)) {
                                foreach($projvar->value as $value) {
                                    if ($r==$value) {
                                        $selected=1;
                                        $everselected=1;
                                        
                                    }
                                }
                            }
                        }
                    }
                    
                    if ($selected) {
                        echo "<option value=\"$r\" selected=\"selected\" >$option</option>";
                        
                    } else {
                        
                        echo "<option value=\"$r\">$option</option>";
                    }
                    
                    
                    
                    
                    if ($_SERVER["REQUEST_METHOD"] == "POST")  {
                        
                        
                        if ($selected) {
                            fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("    <value>%d</value>\r\n",$r)));
                        }
                        
                        
                    }
                    
                    $r++;
                }
                echo "</select></td>";
                
                if ($_SERVER["REQUEST_METHOD"] == "POST")  {
                    fwrite($fh2,"   </variable>\r\n");
                }
            }
            
            
            echo "</tr>";
            $pd=0;
            $p=1;
            
            foreach($project->tag as $tag) {
                if (($_SERVER["REQUEST_METHOD"] == "POST") &&  isset($_POST["updatelib"]))  {
                    if(empty($_POST["tagn" . $n . "_" . $k . "_" . $p])) {
                        
                        $p++;
                        $pd++;
                        continue;
                    }
                }
                printf("<tr><td>Tag %d)</td><td>Description:<input value=\"%s\" size=\"10\"  name=\"tagn%d_%d_%d\">&nbsp;Page<input value=\"%d\" size=\"5\" name=\"tagp%d_%d_%d\">",$p-$pd,$tag->description,$n-$nd,$k-$kd,$p,$tag->pag,$n-$nd,$k-$kd,$p);
                
                $added="#page=" . strval($tag->pag);
                printf("<input type=\"button\" name=\"Submit\" value=\"View\"  onClick=\"window.open(fl%d.options[fl%d.selectedIndex].text + '%s','newtab')\"></td></tr>",$n-$nd,$n-$nd,$added);
                
                if ($_SERVER["REQUEST_METHOD"] == "POST")  {
                    fwrite($fh2,"    <tag>");
                    fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("     <description>%s</description>\r\n",$_POST["tagn" . $n . "_" . $k . "_" . $p])));
                    fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("     <pag>%s</pag>\r\n",$_POST["tagp" . $n . "_" . $k . "_" . $p])));
                    fwrite($fh2,"    </tag>\r\n");
                }
                
                
                $p++;
            }
            
            if (( $_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST["addtagsub"]))  {
                if ( ($n==$_POST["tagstnum"]) && ($k==$_POST["tagprnum"])) {
                    fwrite($fh2,"    <tag>\r\n");
                    fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("     <description>%s</description>\r\n",$_POST["tagdesc"])));
                    fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("     <pag>%s</pag>\r\n",$_POST["tagpag"])));
                    fwrite($fh2,"    </tag>\r\n");
                    printf("<tr><td>Tag %d)</td><td>Description:<input value=\"%s\" size=\"10\"  name=\"tagn%d_%d_%d\">&nbsp;Page<input value=\"%d\" size=\"5\" name=\"tagp%d_%d_%d\">",$p,$_POST["tagdesc"],$n-$nd,$k-$kd,$p,$_POST["tagpag"],$n-$nd,$k-$kd,$p);
                    
                    $added="#page=" . strval($_POST["tagpag"]);
                    printf("<input type=\"button\" name=\"Submit\" value=\"View\"  onClick=\"window.open(fl%d.options[fl%d.selectedIndex].text + '%s','newtab')\"></td></tr>",$n-$nd,$n-$nd,$added);  
                    
                }
            }
            
            $k++;
            if ($_SERVER["REQUEST_METHOD"] == "POST")  {
                fwrite($fh2,"   </project>\r\n");
            }
            
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "POST")  {
            
            if (isset($_POST["addprojsub"])) {
                
                
                
                
                if ($n==(int) $_POST["addevnumb"]) {
                    
                    
                    printf("<tr><td>%d.%d:</td><td> <input type=\"text\"  value=\"%s\" size=\"40\" name=\"evtxt%d_%d\"> </td>",$n-$nd,$k-$kd,$_POST["newprojdesc"],$n-$nd,$k-$kd);
                    
                    fwrite($fh2,"   <project>\r\n");
                    fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("    <description>%s</description>\r\n",$_POST["newprojdesc"])));
                    $z=1;
                    foreach ($conf->variable as $variable) {
                        fwrite($fh2,"   <variable>\r\n");
                        fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("    <name>%s</name>\r\n",$variable->name)));
                        fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("    <value>%d</value>\r\n",$_POST["nproj$z"])));
                        fwrite($fh2,"   </variable>\r\n");
                        
                        /////////////
                        printf("<td><select multiple size=\"5\" name=\"opt%d_%d_%d[]\">",$n-$nd,$k-$kd,$z);
                        $r=1;
                        $rs=0;
                        foreach ($variable->option as $option) {
                            
                            $selected=0;
                            
                            foreach ($project->variable as $projvar) {
                                
                                if (strcmp ($projvar->name,$variable->name)) {
                                    if ($r==(int) $_POST["nproj$z"]) {
                                        $selected=1;           
                                        $rs=$r;          
                                    }
                                    
                                }
                            }
                            
                            if ($selected) {
                                echo "<option value=\"$r\" selected=\"selected\">$option</option>";
                            } else {
                                echo "<option value=\"$r\">$option</option>";
                            }
                            
                            $r++;
                            
                        }
                        echo "</td></select>";
                        ////////
                        
                        
                        $z++;
                    }
                    echo "</tr>";
                    fwrite($fh2,"   </project>\r\n");
                    
                }
            }
            $t++; 
        }
        
        
        
        $n++;
        
        
        
        if ($_SERVER["REQUEST_METHOD"] == "POST")  {
            if ($delete==0) {
                fwrite($fh2,"  </evstudy>\r\n");
            }
        }
        
        echo "</table><br><br><br>";
        
    }
    
    
    
    
    if ($_SERVER["REQUEST_METHOD"] == "POST")  {
        if (isset($_POST["addevssub"])) {
            fwrite($fh2,"   <evstudy>\r\n");
            
            echo "<table border=\"1\">";
            printf("<tr><td>%d)</td><td> <input type=\"text\" value=\"%s\" size=\"50\" name=\"evtxt%d\"> </td>",$n-$nd,$_POST["newevstdesc"],$n-$nd);
            
            
            //<td>File:<input type=\"text\" value=\"%s\" name=\"fl%d\"></td></tr>",,,$n-$td);
            
            $file=simplexml_load_file('file.xml');
            printf("File:<td><select  name=\"fl%d\">",$n-$nd);
            foreach ($file->files as $vfile) {
                if ((int)$_POST["newevstfile"]==(int) $vfile->index) {
                    printf("<option value=\"%d\" selected=\"selected\">%s</option>",$vfile->index,$vfile->name);
                } else {
                    printf("<option value=\"%d\"> %s</option>",$vfile->index,$vfile->name);
                }
            }
            
            printf("</select><input type=\"button\" name=\"Submit\" value=\"View\"  onClick=\"window.open(fl%d.options[fl%d.selectedIndex].text,'newtab')\"></td>",$n-$nd,$n-$nd);            
            
            
            fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("    <description>%s</description>\r\n",$_POST["newevstdesc"])));
            fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("    <file>%s</file>\r\n",$_POST["newevstfile"])));
            fwrite($fh2,"   </evstudy>\r\n");
            echo "</table>";
            
            $target_path = "Library/";
            
            $target_path = $target_path . basename( $_POST['newevstfile']); 
            
            
        }
    }
    
    
    ?>
<input type="submit" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="updatelib" value="Update Library"><br><br><br>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST")  {
        fwrite($fh2,sprintf ("</library>\r\n\r\n"));
    }
    ?>
</form>
</body>

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

