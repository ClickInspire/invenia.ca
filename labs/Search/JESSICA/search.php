


<!DOCTYPE HTML>
<!-- Website Template by freewebsitetemplates.com -->


<html>

<head>
	
<meta charset="UTF-8">
	
<title>Jessica Library</title>
	
<link rel="stylesheet" href="css/style.css" type="text/css">

</head>



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


<body>
	

<div id="header">

<div>

<a href="index.php" class="logo">
			
<h1>JESSICA Library and Guide</h1>
			<span><img src="img/eib.jpg" height="70"><img src="img/eu.jpg" height="70"></span>
		</div>
		
<ul>
			
<li class="selected">
				
<a href="index.php">home</a>
</li>
		
<li>
<a href="search.php">Search</a>
</li>

<li><a href="guide.php">Guide</a>
</li>

<li><a href="about.php">About</a>
</li>
			
<li><a href="contact.php">Contact</a>
</li>
		
<li><a href="conf.html">Configuration</a>
</li>

</ul>
	
</div>
<div id="body">
		
<div class="header">
			
<h1>we can help you to achieve success</h1>
			
<p>Some words here
</p>
		
</div>
		
<div class="body">

<h1>Bella cagata</h1>

<small><span>to match your specific business process</span> <a href="#">A button</a></small>
		
</div>
	
<br>	

<h3>Search</h3>


<br><br><br><br>
<form method="POST" action="search.php" name="formt">



<select name="details">
<option value="1" selected="selected">Show tags</option>
<option value="2">Do not show tags</option>
</select>

<input type="submit"  name="s" value="Search"><br><br>
<input type="hidden" name="open" value="0">
<input type="hidden" name="file" value="">
<input type="hidden" name="page" value="">


<?php

echo "<table>";

$configuration=simplexml_load_file('config.xml');

foreach($configuration->variable as $variable) {

printf("<tr><td><br>%s\n:<br>",$variable->description);

printf("<select multiple name=\"%s[]\">",$variable->name);
$n=0;
foreach($variable->option as $option) {
$n++;

       if ($posted==0 || empty($errorvar["$variable->name"])==0 ) {

             if ($n==1) {
             printf("<option selected=\"selected\" value=\"%d\">%s</option>\n",$n,$option);
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
echo "</select></td></tr>";


}


?>

</table>
<br>

<?php
if ($runsearch) {
echo "Results:<br><br>";

$library=simplexml_load_file('./Library/library.xml');
$conf=simplexml_load_file('./config.xml');

$k=0;

echo "<table border=\"1\">";
  foreach ($library->evstudy as $evstudy) {
  
   $initial=0;
   
    foreach ($evstudy->project as $proj) {
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


       if ($select) {


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


			
</div>

<div id="footer">

<centering>
<p>
&copy; Copyright 2013 EIB. All rights reserved.</p>


</centering>
</div>


</body>


</html>