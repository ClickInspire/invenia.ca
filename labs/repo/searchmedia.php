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

function radiovl() {
var radios = document.getElementsByName('radiob');

for (var i = 0, length = radios.length; i < length; i++) {
    if (radios[i].checked) {
        // do whatever you want with the checked radio
        document.getElementById('link').value=radios[i].value;

        // only one radio can be logically checked, don't check the rest
        break;
    }
}
}
</script>

















<br><br><br><br>

<form method="POST" name="formt">
<div class="test-form">
Add your text here:<br>
<input type="text" id="mytext" value="My Text"><input id='insert_shortcode' type='button' class='button' value='Insert link' onClick="radiovl();">
<input type="hidden" id="link" value="">
<br>

Note: Keyword search applies to project and document descriptions, not inside the document. And redirection to pages optimized for Internet Explorer.<br><br><br><br><br>

<br>
Choose an element from your library:
<br>


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









              printf("<tr><td><input type=\"radio\" name=\"radiob\" value=\"%s\"></td><td></td><td><font size=\"4\">%s</font></td><td><a href=\"%s\">Document</a></td></tr>",$myfile,$evstudy->description,$myfile);        





              if ($_POST["details"]==1) {      

               $s=1;

              foreach ($evstudy->tag as $evtag) {

              printf("<tr><td><input type=\"radio\" name=\"radiob\" value=\"%s#page=%d\"></td><td></td><td>Tag %d: %s</td><td><a href=\"%s#page=%d\">Go to page</a></td></tr>",$myfile,$evtag->pag,$s,$evtag->description,$myfile,$evtag->pag);    

              $s++;

              }

             }

            $initial=1;

            }

             

             printf("<tr><td>%d)</td><td>%s</td><td></td></tr>",$k,$proj->description);    

           

             if ($_POST["details"]==1) {

             $s=1;

              foreach ($proj->tag as $tag) {

               printf("<tr><td><input type=\"radio\" name=\"radiob\" value=\"%s#page=%d\"></td><td></td><td>Tag %d: %s</td><td><a href=\"%s#page=%d\">Go to page</a></td></tr>",$myfile,$tag->pag,$s,$tag->description,$myfile,$tag->pag);    

               $s++;

               }

              }



          } else {









            if ($initial==0) {





if(strpos($evstudy->file, "http")!==false) {

       printf("<tr><td><input type=\"radio\" name=\"radiob\" value=\"%s\"></td><<td></td><td><font size=\"4\">%s</font></td><td><a href=\"%s\">Document</a></td></tr>",$myfile,$evstudy->description,$myfile);        

} else {

             printf("<tr><td></td><td><font size=\"4\">%s</font></td><td><input type=\"submit\" action=\"%s\" name=\"submit\" value=\"Document\" onclick=\"changevalue('%s',0);\" /></td></tr>",$evstudy->description,htmlspecialchars($_SERVER["PHP_SELF"]),$myfile);    



}



             if ($_POST["details"]==1) {

              $s=1;

              foreach ($evstudy->tag as $evtag) {

if(strpos($evstudy->file, "http")!==false) {

              printf("<tr><td><input type=\"radio\" name=\"radiob\" value=\"%s#page=%d\"></td><td></td><td>Tag %d: %s</td><td><a href=\"%s#page=%d\">Go to page</a></td></tr>",$myfile,$evtag->pag,$s,$evtag->description,$myfile,$evtag->pag); 

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

                 printf("<tr><td><input type=\"radio\" name=\"radiob\" value=\"%s#page=%d\"></td><td></td><td>Tag %d: %s</td><td><a href=\"%s#page=%d\">Go to page</a></td></tr>",$myfile,$tag->pag,$s,$tag->description,$myfile,$tag->pag);      

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


</div>
</form>





		