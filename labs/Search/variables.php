<?php
$path="./library";
if ($_SERVER["REQUEST_METHOD"] == "POST") 

{


}

?>
<body>

<centering>
<img src="img/eu.jpg" alt="European Union" width="304" height="228">
<img src="img/eib.jpg" alt="European Investment Bank width="304" height="228"">
</centering>

<FORM METHOD="LINK" ACTION="conf.html">
<INPUT TYPE="submit" VALUE="Back to main administration menu">
</FORM>

<img src="img/attconf.jpg"><br><br>

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
