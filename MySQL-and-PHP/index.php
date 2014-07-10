// Author: Chisheng Li
// PHP code to store the name, email, phone number and zip codes of contacts added to the database.

<?php
error_reporting(-1);
require_once "db.php";
session_start();
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
if ( isset($_SESSION['success']) ) {
    echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
    unset($_SESSION['success']);
}
echo '<table border="1">'."\n";
echo "<tr><td>";
echo(htmlentities('Name'));
echo("</td><td>");
echo(htmlentities('Email'));
echo("</td><td>");
echo(htmlentities('Phone'));
echo("</td><td>\n"); 
echo(htmlentities('Zip'));
echo("</td><td>");
echo(htmlentities('Action'));
    echo("</td><td>");
$result = mysql_query("SELECT name, email, phone, zip, id FROM contacts");
while ( $row = mysql_fetch_row($result) ) {
    echo "<tr><td>";
    echo(htmlentities($row[0]));
    echo("</td><td>");
    echo(htmlentities($row[1]));
    echo("</td><td>");
    echo(htmlentities($row[2]));
    echo("</td><td>\n");
    echo(htmlentities($row[3]));
    echo("</td><td>");
    echo('<a href="edit.php?id='.htmlentities($row[4]).'">Edit</a> / ');
    echo('<a href="delete.php?id='.htmlentities($row[4]).'">Delete</a>');
    echo("</td></tr>\n");
}
Echo '</table>';
?>
</table>
<a href="contacts_add.php">Add New</a>
