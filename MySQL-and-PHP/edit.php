// Author: Chisheng Li
// PHP code to edit contact in the database.

<?php
require_once "db.php";
session_start();
if ( isset($_POST['name']) && isset($_POST['email']) 
    && isset($_POST['phone']) && isset($_POST['zip'])
    && isset($_POST['id']) && !empty($_POST['name']) 
    && !empty($_POST['email']) 
    && !empty($_POST['zip']) && !empty($_POST['phone'])) {
    $n = mysql_real_escape_string($_POST['name']);
    $e = mysql_real_escape_string($_POST['email']);
    $p = mysql_real_escape_string($_POST['phone']);
    $z = mysql_real_escape_string($_POST['zip']);
    $id = mysql_real_escape_string($_POST['id']);
    $sql = "UPDATE contacts SET name='$n', email='$e',
              phone='$p', zip='$z' WHERE id='$id'"; 
    mysql_query($sql);
    $_SESSION['success'] = 'Record updated';
    header( 'Location: index.php' ) ;
    return;
}
if ( isset($_POST['name']) && isset($_POST['email']) 
   && isset($_POST['zip']) && isset($_POST['phone']) && 
   empty($_GET['name']) 
   && empty($_GET['email']) 
   && empty($_GET['zip']) && empty($_GET['phone'])) {
   $_SESSION['error'] = 'Record not Updated. One or More Empty Fields.';
   header( 'Location: index.php' ) ;
   return;
}
if ( ! isset($_GET['id']) ) {
    $_SESSION['error'] = 'Missing value for id';
    header( 'Location: index.php' ) ;
    return;
}

$id = $_GET['id'];
$result = mysql_query("SELECT name, email, phone, zip, id 
    FROM contacts WHERE id='$id'");
$row = mysql_fetch_row($result);
if ( $row == FALSE ) {
    $_SESSION['error'] = 'Bad value for id';
    header( 'Location: index.php' ) ;
    return;
}

$n = htmlentities($row[0]);
$e = htmlentities($row[1]);
$p = htmlentities($row[2]);
$z = htmlentities($row[3]);
$id = htmlentities($row[4]);

echo <<< _END
<p>Edit User</p>
<form method="post">
<p>Name:
<input type="text" name="name" value="$n"></p>
<p>Email:
<input type="text" name="email" value="$e"></p>
<p>Phone:
<input type="text" name="phone" value="$p"></p>
<p>Zip Code:
<input type="text" name="zip" value="$z"></p>
<input type="hidden" name="id" value="$id">
<p><input type="submit" value="Update"/>
<a href="index.php">Cancel</a></p>
</form>
_END
?>
