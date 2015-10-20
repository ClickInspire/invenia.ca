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
<html>
<title>Invenia Labs Repo</title>


<img src="img/InveniaLabs.jpg"><br><br>

<a href="variables.php">Go back</a><br><br>

<?php

$myFile = "config.xml";
$myFile2 = "library.xml";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

  $notswap=0;  

  $t=0;
  foreach ($_POST as $variable) {
   if ($variable=="Swap") {
    continue;
   }
   $t++;

    if ($t>2) {
    echo "<font color=\"red\">Too many options selected!</font><br>";
    $notswap=1;
    break;
   }

   
   if ($t==1) {
   $pieces=explode("-",$variable);
   } elseif ($t==2) {
   $pieces2=explode("-",$variable);
   }



  }

    if ($t<2) {
    echo "<font color=\"red\">Not enough options selected!</font><br>";
    $notswap=1;
   }




  if ($notswap==0) {

   if ($pieces[0]!=$pieces2[0] && $pieces[1]==0 && $pieces2[1]==0 ) {
  
    // Here I swap variables
   $conf=simplexml_load_file($myFile);
    

   // First I open $conf

   
   $fh = fopen($myFile, 'w') or die("can't open file");
   fwrite($fh,sprintf ("<?xml version=\"1.0\" ?>\r\n"));
   fwrite($fh,sprintf ("<conf>\r\n\r\n"));
  
   $k=0;
   foreach ($conf->variable as $variable) {
    $k++;
    if ($k!=$pieces[0] && $k!=$pieces2[0]) {
     fwrite($fh,sprintf ("   <variable>\r\n<name>%s</name>\r\n<description>%s</description>\r\n",$variable->name,$variable->description));
      foreach($variable->option as $option) {
        fwrite($fh,sprintf ("    <option>%s</option>\r\n ",$option));
      }
    
      } elseif ($k==$pieces[0]) {
       
       $k2=0; 
       foreach ($conf->variable as $variable2) {
        $k2++;
         if ($k2==$pieces2[0]) {
          fwrite($fh,sprintf ("   <variable>\r\n<name>%s</name>\r\n<description>%s</description>\r\n",$variable->name,$variable2->description));
          foreach($variable2->option as $option2) {
           fwrite($fh,sprintf ("    <option>%s</option>\r\n ",$option2));
          }
        }
       } 
        
      } elseif ($k==$pieces2[0]) {
        $k2=0; 
         foreach ($conf->variable as $variable2) {
           $k2++;
           if ($k2==$pieces[0]) {
            fwrite($fh,sprintf ("   <variable>\r\n<name>%s</name>\r\n<description>%s</description>\r\n",$variable->name,$variable2->description));
            foreach($variable2->option as $option2) {
             fwrite($fh,sprintf ("    <option>%s</option>\r\n ",$option2));
            }
          }
         } 
      }

      fwrite($fh,"</variable>\r\n");

    }


      fwrite($fh,"</conf>\r\n");
      fclose($fh);
//////////////////////////////


     $library=simplexml_load_file('library.xml');

     $myFile2 = "library.xml";
     $fh2 = fopen($myFile2, 'w') or die("can't open file");
     fwrite($fh2,sprintf ("<?xml version=\"1.0\" ?>\r\n"));
     fwrite($fh2,sprintf ("<library>\r\n\r\n"));


     foreach ($library->evstudy as $evstudy) {

       fwrite($fh2,"  <evstudy>\r\n");
       fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("   <description>%s</description>\r\n",$evstudy->description)));
       fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("   <file>%s</file>\r\n",$evstudy->file)));

       foreach ( $evstudy->tag as $evtag) {
           fwrite($fh2,"   <tag>\r\n");
           fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("    <description>%s</description>\r\n",$evtag->description)));
           fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("    <pag>%s</pag>\r\n",$evtag->pag)));
           fwrite($fh2,"   </tag>\r\n");       
        }

       foreach ($evstudy->project as $project) {
   
          fwrite($fh2,"   <project>\r\n");
          fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("    <description>%s</description>\r\n",$project->description)));

         foreach($project->tag as $tag) {
             fwrite($fh2,"   <tag>\r\n");
             fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("    <description>%s</description>\r\n",$tag->description)));
             fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("    <pag>%s</pag>\r\n",$tag->pag)));
             fwrite($fh2,"   </tag>\r\n");       
         }

        $k=0;
        foreach($project->variable as $variable) {
         fwrite($fh2,"   <variable>\r\n");
          
         // here code to swap


          $k++;
          if ($k!=$pieces[0] && $k!=$pieces2[0]) {

            fwrite($fh2,sprintf("   <name>%s</name>\r\n",$variable->name));
            foreach($variable->value as $value) {
              fwrite($fh2,sprintf("   <value>%s</value>\r\n",$value));
            }
    
           } elseif ($k==$pieces[0]) {
       
            $k2=0; 
            foreach ($project->variable as $variable2) {
             $k2++;
             if ($k2==$pieces2[0]) {
              fwrite($fh2,sprintf("   <name>%s</name>\r\n",$variable->name));
               foreach($variable2->value as $value2) {
               fwrite($fh2,sprintf("   <value>%s</value>\r\n",$value2));
               }
             }
            } 
        
          } elseif ($k==$pieces2[0]) {

            $k2=0; 
            foreach ($project->variable as $variable2) {
             $k2++;
             if ($k2==$pieces[0]) {
              fwrite($fh2,sprintf("   <name>%s</name>\r\n",$variable->name));
               foreach($variable2->value as $value2) {
               fwrite($fh2,sprintf("   <value>%s</value>\r\n",$value2));
               }
             }
            }

         //\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        
         }

         fwrite($fh2,"   </variable>\r\n");  
       }


       fwrite($fh2,"   </project>\r\n");
      }

    fwrite($fh2,"</evstudy>\r\n\r\n");
  }
  fwrite($fh2,"</library>");
    
//////////////////////////////

   } elseif ($pieces[0]==$pieces2[0] && $pieces[1]>0 && $pieces2[1]>0 ) {


   $conf=simplexml_load_file($myFile);
    

   // First I open $conf

   
   $fh = fopen($myFile, 'w') or die("can't open file");
   fwrite($fh,sprintf ("<?xml version=\"1.0\" ?>\r\n"));
   fwrite($fh,sprintf ("<conf>\r\n\r\n"));
  
  /////

   $k=0;
   foreach ($conf->variable as $variable) {
    $k++;
    if ($k!=$pieces[0]) {

       fwrite($fh,sprintf ("   <variable>\r\n<name>%s</name>\r\n<description>%s</description>\r\n",$variable->name,$variable->description));
       foreach($variable->option as $option) {
         fwrite($fh,sprintf ("    <option>%s</option>\r\n ",$option));
       }
      fwrite($fh,sprintf ("  </variable>\r\n ",$option));

     } elseif ($k==$pieces[0]) {
       fwrite($fh,sprintf ("   <variable>\r\n<name>%s</name>\r\n<description>%s</description>\r\n",$variable->name,$variable->description));
        $z=0;
        foreach($variable->option as $option) {
          $z++;
           if ( $z==$pieces[1] ) {

             $t2=0;
             foreach($variable->option as $option2) {
                $t2++;
                 if ($t2==$pieces2[1]) {
                   fwrite($fh,sprintf ("    <option>%s</option>\r\n ",$option2));
                 }
               }

           } elseif ($z==$pieces2[1]) {

              $t2=0;
              foreach($variable->option as $option2) {
                $t2++;
                if ($t2==$pieces[1]) {
                  fwrite($fh,sprintf ("    <option>%s</option>\r\n ",$option2));
                }
               }

      
           } else {
            fwrite($fh,sprintf ("    <option>%s</option>\r\n ",$option));
           }
      
        }




   
    fwrite($fh,sprintf ("  </variable>\r\n ",$option));
    }

     

   }


  /////


    fwrite($fh,"</conf>\r\n");
    fclose($fh);

//////////////////////////////



     $library=simplexml_load_file('library.xml');

     $myFile2 = "library.xml";
     $fh2 = fopen($myFile2, 'w') or die("can't open file");
     fwrite($fh2,sprintf ("<?xml version=\"1.0\" ?>\r\n"));
     fwrite($fh2,sprintf ("<library>\r\n\r\n"));


     foreach ($library->evstudy as $evstudy) {

       fwrite($fh2,"  <evstudy>\r\n");
       fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("   <description>%s</description>\r\n",$evstudy->description)));
       fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("   <file>%s</file>\r\n",$evstudy->file)));

       foreach ( $evstudy->tag as $evtag) {
           fwrite($fh2,"   <tag>\r\n");
           fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("    <description>%s</description>\r\n",$evtag->description)));
           fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("    <pag>%s</pag>\r\n",$evtag->pag)));
           fwrite($fh2,"   </tag>\r\n");       
        }

       foreach ($evstudy->project as $project) {
   
          fwrite($fh2,"   <project>\r\n");
          fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("    <description>%s</description>\r\n",$project->description)));

         foreach($project->tag as $tag) {
             fwrite($fh2,"   <tag>\r\n");
             fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("    <description>%s</description>\r\n",$tag->description)));
             fwrite($fh2,iconv("ISO-8859-1", "UTF-8", sprintf("    <pag>%s</pag>\r\n",$tag->pag)));
             fwrite($fh2,"   </tag>\r\n");       
         }

        $k=0;
        foreach($project->variable as $variable) {
         fwrite($fh2,"   <variable>\r\n");
          
         // here code to swap


        $k++;
        if ($k!=$pieces[0]) {
        fwrite($fh2,sprintf("   <name>%s</name>\r\n",$variable->name));
           foreach($variable->value as $value) {
             fwrite($fh2,sprintf("   <value>%s</value>\r\n",$value));
           }

         } elseif ($k==$pieces[0]) {  

             fwrite($fh2,sprintf("   <name>%s</name>\r\n",$variable->name));
             
           foreach($variable->value as $value) {

            $q=$value;          
            if ($value==$pieces[1]) {
                $q=$pieces2[1];
            } elseif ($value==$pieces2[1]) {
                $q=$pieces[1];
            }

             fwrite($fh2,sprintf("   <value>%s</value>\r\n",$q));
           }


         } 


         //\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        
         

         fwrite($fh2,"   </variable>\r\n");  
       }


       fwrite($fh2,"   </project>\r\n");
      }

    fwrite($fh2,"</evstudy>\r\n\r\n");
  }
  fwrite($fh2,"</library>");


//////////////////////////////

   } else {
    echo "<font color=\"red\">You didn't select the option correctly!</font><br>";
   }

  }




} 

?>


<b>Check Only Two Variables or Two Options of the same Variable</b><br><br> 


<form method="POST" enctype="multipart/form-data">
<input type="submit" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="swap" value="Swap"><br><br>
<?php



//$content = utf8_encode(file_get_contents('config.xml'));
$conf=simplexml_load_file('config.xml');

$n=0;

foreach ($conf->variable as $variable) {
$n++;
$k=0;
 
  echo "<table border=\"1\">";
   printf("<tr><td> <INPUT TYPE=\"checkbox\" NAME=\"opt%d-0\"  value=\"%d-0\" > </td><td>Attribute name:</td><td>%s</td></tr>",$n,$n,$variable->description);
  foreach ($variable->option as $option) {
   $k++;
   printf("<tr><td></td><td> <INPUT TYPE=\"checkbox\" NAME=\"opt%d-%d\" value=\"%d-%d\" ></td><td>Option %d</td><td>%s</td></tr>",$n,$k,$n,$k,$k,$option);
  }
  echo "</table>";
  echo "<br>";


}


?>

</html>


