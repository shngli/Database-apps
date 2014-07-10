// Author: Chisheng Li
// PHP code to connect to the MySQL database.
<?php
$db = mysql_connect("localhost","fred", "zap")
   or die('Fail message');
mysql_select_db("contacts") or die("Fail message");
?>
