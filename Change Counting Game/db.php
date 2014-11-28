<?php
$db = mysql_connect("localhost", "jennifer", "darling");
if ( $db === FALSE ) die("Can't connect to database");
if ( mysql_select_db("changegame") === FALSE ) die("Database doesn't exist");
?>