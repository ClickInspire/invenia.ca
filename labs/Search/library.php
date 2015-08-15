<centering>
<img src="img/eu.jpg" alt="European Union" width="304" height="228">
<img src="img/eib.jpg" alt="European Investment Bank width="304" height="228"">
</centering>

<FORM METHOD="LINK" ACTION="conf.html">
<INPUT TYPE="submit" VALUE="Back to main administration menu">
</FORM>
<form method="POST" enctype="multipart/form-data">



<img src="img/libconf.jpg">




<?php



$conf=simplexml_load_file('config.xml');
$library=simplexml_load_file('./Library/library.xml');

$n=1; 
$nd=0; $kd=0;
if ($_SERVER["REQUEST_METHOD"] == "POST")  {
 $myFile2 = "./Library/library.xml";
 $fh2 = fopen($myFile2, 'w') or die("can't open file");
 fwrite($fh2,sprintf ("<?xml version=\"1.0\" ?>\r\n"));
 fwrite($fh2,sprintf ("<library>\r\n\r\n"));

}



if ($_SERVER["REQUEST_METHOD"] == "POST")  {
 if (isset($_POST["addevst"])) {

echo "<br><br><br><table>";

echo "<tr><td>Document description:</td><td> <input type=\"text\" value=\"Unknown\" name=\"newevstdesc\"></td></tr>";
echo "<tr><td>Choose file name:</td><td> <input type=\"text\" name=\"newevstfile\" value=\"Library/\"></td></tr>";
echo "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"2000\">";
echo "<tr><td>File to upload (pdf):</td><td><input name=\"userfile\" type=\"file\"></td></tr>";
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
                 printf("<tr><td>%d)</td><td> <input type=\"text\"  value=\"%s\" size=\"50\" name=\"evtxt%d\"></td><td>File:<input type=\"text\" value=\"%s\" name=\"fl%d\"></td></tr>",$n-$nd,$_POST["evtxt$n"],$n-$nd,$_POST["fl$n"],$n-$nd);    
           } else {
                 printf("<tr><td>%d)</td><td> <input type=\"text\"  value=\"%s\" size=\"50\" name=\"evtxt%d\"></td><td>File:<input type=\"text\" value=\"%s\" name=\"fl%d\"></td></tr>",$n-$nd,$evstudy->description,$n-$nd,$_POST["fl$n"],$n-$nd);    
           }
    } else {
          printf("<tr><td>%d)</td><td> <input type=\"text\"  value=\"%s\" size=\"50\" name=\"evtxt%d\"></td><td>File:<input type=\"text\" value=\"%s\" name=\"fl%d\"></td></tr>",$n-$nd,$evstudy->description,$n-$nd,$evstudy->file,$n-$nd);    
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
            printf("<tr><td>Tag %d</td><td>Description:<input value=\"%s\" size=\"10\"  name=\"evtagn%d_%d\">&nbsp;Page<input value=\"%d\" size=\"5\" name=\"evtagp%d_%d\"></td></tr>",$tn-$tnd,$_POST["evtagn" . $n . "_" . $tn],$n-$nd,$tn-$tnd,$_POST["evtagp" . $n . "_" . $tn],$n-$nd,$tn-$tnd);
       

   } else {

        printf("<tr><td>Tag %d</td><td>Description:<input value=\"%s\" size=\"10\"  name=\"evtagn%d_%d\">&nbsp;Page<input value=\"%d\" size=\"5\" name=\"evtagp%d_%d\"></td></tr>",$tn,$evtag->description,$n,$tn,$evtag->pag,$n,$tn);

   }
$tn++;
}

    if (( $_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST["addtagsub"]))  {
      if ( ($n==$_POST["tagstnum"]) && ($_POST["tagprnum"]==0)) {
           fwrite($fh2,"    <tag>\r\n");
           fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("     <description>%s</description>\r\n",$_POST["tagdesc"])));
           fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("     <pag>%s</pag>\r\n",$_POST["tagpag"])));
           fwrite($fh2,"    </tag>\r\n");
        printf("<tr><td>Tag %d</td><td>Description:<input value=\"%s\" size=\"10\"  name=\"evtagn%d_%d\">&nbsp;Page<input value=\"%d\" size=\"5\" name=\"evtagp%d_%d\"></td></tr>",$tn-$tnd,$_POST["tagdesc"],$n-$nd,$tn-$tnd,$_POST["tagpag"],$n-$nd,$tn-$tnd);
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
        printf("<tr><td>Tag %d)</td><td>Description:<input value=\"%s\" size=\"10\"  name=\"tagn%d_%d_%d\">&nbsp;Page<input value=\"%d\" size=\"5\" name=\"tagp%d_%d_%d\"></td></tr>",$p-$pd,$tag->description,$n-$nd,$k-$kd,$p,$tag->pag,$n-$nd,$k-$kd,$p);
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
        printf("<tr><td>Tag %d)</td><td>Description:<input value=\"%s\" size=\"10\"  name=\"tagn%d_%d_%d\">&nbsp;Page<input value=\"%d\" size=\"5\" name=\"tagp%d_%d_%d\"></td></tr>",$p,$_POST["tagdesc"],$n-$nd,$k-$kd,$p,$_POST["tagpag"],$n-$nd,$k-$kd,$p);
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


$uploadfile = $_POST["newevstfile"];
echo "$uploadfile\n";
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {

      fwrite($fh2,"   <evstudy>\r\n");
      echo "<table border=\"1\">";
printf("<tr><td>%d)</td><td> <input type=\"text\" value=\"%s\" size=\"50\" name=\"evtxt%d\"> </td><td>File:<input type=\"text\" value=\"%s\" name=\"fl%d\"></td></tr>",$n-$nd,$_POST["newevstdesc"],$n-$nd,$_POST["newevstfile"],$n-$td);
      fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("    <description>%s</description>\r\n",$_POST["newevstdesc"])));
      fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("    <file>%s</file>\r\n",$_POST["newevstfile"])));
      fwrite($fh2,"   </evstudy>\r\n");
      echo "</table>";
print_r($_FILES);

} else {
    echo "Upload failed. Try again ";
}







      
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

