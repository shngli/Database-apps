<?php
	require_once("db.php");
	session_start();

	if (isset($_SESSION['username']['admin'])) {
	}
	
	else {
		header("Location: login.php");
	}
	
	if (isset($_POST['cancel'])) {
		header("Location: users.php");
		return;
	}
	
	if ( isset($_POST['delete']) && isset($_POST['id']) ) {
		$id = $_POST['id'];
		$sql = "DELETE FROM user WHERE id = $id";
		mysql_query($sql);
		$_SESSION['success'] = 'Record Deleted';
		header( 'Location: users.php' ) ;
		return;
	}
	
	$id = $_GET['id'];
	$result = mysql_query("SELECT name,id FROM user WHERE id='$id'");
	$row = mysql_fetch_row($result);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Delete</title>
		<link href="game.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<p>Confirm: Deleting <?php echo "$row[0]"; ?></p>
		<form method="post">
			<input type="hidden" name="id" value="<?php echo "$row[1]"?> ">
			<input type="submit" value="Delete" name="delete">
			<input type="submit" value="Cancel" name="cancel">
		</form>
	</body>
</html>