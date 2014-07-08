<?php
$db = mysql_connect("localhost","fred", "zap")
   or die('Fail message');
mysql_select_db("contacts") or die("Fail message");
?>