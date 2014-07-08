<?php
require_once "db.php";
session_start();
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
    }

if ( isset($_POST['name']) && isset($_POST['email']) 
   && isset($_POST['zip']) && isset($_POST['phone']) && !empty($_POST['name']) 
   && !empty($_POST['email']) 
   && !empty($_POST['zip']) && !empty($_POST['phone'])) {
   $n = mysql_real_escape_string($_POST['name']);
   $e = mysql_real_escape_string($_POST['email']);
   $z = mysql_real_escape_string($_POST['zip']);
   $p = mysql_real_escape_string($_POST['phone']);
   $sql = "INSERT INTO contacts (name, email, zip, phone) 
              VALUES ('$n', '$e', '$z', '$p')";
   mysql_query($sql);
   $_SESSION['success'] = 'Record Added';
      header( 'Location: index.php' ) ;
   return;
}
if ( isset($_POST['name']) && isset($_POST['email']) 
   && isset($_POST['zip']) && isset($_POST['phone']) && 
   empty($_GET['name']) 
   && empty($_GET['email']) 
   && empty($_GET['zip']) && empty($_GET['phone'])) {
   $_SESSION['error'] = 'Record not Added. All values are required';
   header( 'Location: index.php' ) ;
   return;
}
?>
<p>Add A New Contact</p>
<form method="post">
<p>Name:
<input type="text" name="name"></p>
<p>Email:
<input type="text" name="email"></p>
<p>Phone:
<input type="numeric" name="phone"></p>
<p>Zip:
<input type="numeric" name="zip"></p>
<p><input type="submit" value="Add New"/>
<a href="index.php">Cancel</a></p>
</form>
