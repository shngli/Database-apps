<?php
require_once "db.php";
session_start();

if ( isset($_POST['delete']) && isset($_POST['id']) ) {
    $id = $_POST['id'];
    $sql = "DELETE FROM contacts WHERE id = $id";
    mysql_query($sql);
    $_SESSION['success'] = 'Record deleted';
    header( 'Location: index.php' ) ;
    return;
}

if ( ! isset($_GET['id']) ) {
    $_SESSION['error'] = 'Missing value for id';
    header( 'Location: index.php' ) ;
    return;
}

$id = $_GET['id'];
$result = mysql_query("SELECT name,id FROM contacts WHERE id='$id'");
$row = mysql_fetch_row($result);
if ( $row == FALSE ) {
    $_SESSION['error'] = 'Bad value for id';
    header( 'Location: index.php' ) ;
    return;
}

echo "<p>Confirm: Deleting $row[0]</p>\n";

echo('<form method="post"><input type="hidden" ');
echo('name="id" value="'.$row[1].'">'."\n");
echo('<input type="submit" value="Delete" name="delete">');
echo('<a href="index.php">Cancel</a>');
echo("\n</form>\n");
?>