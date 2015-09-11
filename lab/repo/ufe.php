

<centering>
<img src="img/eu.jpg" alt="European Union" width="304" height="228">
<img src="img/eib.jpg" alt="European Investment Bank width="304" height="228"">
</centering>
<FORM METHOD="LINK" ACTION="conf2.html">
<INPUT TYPE="submit" VALUE="Back to main administration menu">
</FORM>
<br>
<img src="img/usfe.jpg">

<FORM METHOD="POST" ACTION="ufe.php">
<input type="hidden" name="generate" value="1">
<INPUT TYPE="submit"  VALUE="Generate the User Front-End!">
</FORM>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST["generate"]) & $_POST["generate"]==1) {

echo "Generating the link...";
exec("rmdir Jessica.zip");
echo ".";

exec("rmdir JESSICA\www\Library /S /Q");
echo ".";
exec("mkdir JESSICA\www\Library");
echo ".";
exec("copy Library\*.* JESSICA\www\Library");
echo ".";

exec("del JESSICA\www\config.xml");
echo ".";

exec("copy config.xml JESSICA\www\config.xml");
echo ".";


pclose(popen("start 7z a -tzip Jessica.zip JESSICA","r"));

echo ".";
exec("rmdir JESSICA\www\Library /S /Q");
exec("del JESSICA\config.xml");

echo "I generated it!<br><br>";

echo "Download it <a href=\"Jessica.zip\">here</a>";


} }

?>
