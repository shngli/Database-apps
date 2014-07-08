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
	
	if ( isset($_SESSION['error']) ) {
		echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
		unset($_SESSION['error']);
	}
	
	if ( isset($_POST['name']) && isset($_POST['username']) && isset($_POST['password'])) {
		$name = mysql_real_escape_string($_POST['name']);
		$username = mysql_real_escape_string($_POST['username']);
		$password = mysql_real_escape_string($_POST['password']);
		$id = mysql_real_escape_string($_POST['id']);
		$sql = "UPDATE user SET name='$name', username='$username', password='$password' WHERE id=$id";
		
		if ( strlen($name) == 0 ) {
			$_SESSION['error'] = 'All values are required';
			header( 'Location: users.php' ) ;
			return;
		}
		
		if ( strlen($username) == 0 ) {
			$_SESSION['error'] = 'All values are required';
			header( 'Location: users.php' ) ;
			return;
		}
		
		if ( strlen($password) == 0 ) {
			$_SESSION['error'] = 'All values are required';
			header( 'Location: users.php' ) ;
			return;
		}
		
		else {
			mysql_query($sql);
			$_SESSION['success'] = 'Record Updated';
			header( 'Location: users.php' ) ;
			return;
		}	
	}

	$id = $_GET['id'];
	$result = mysql_query("SELECT name, username, password FROM user WHERE id=$id");
	$row = mysql_fetch_row($result);
	echo mysql_error();

	$name = $row[0];
	$username = $row[1];
	$password = $row[2];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Edit</title>
		<link href="game.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<form method="post">
			<p>Name: <input type="text" name="name" value="<?php echo "$name" ?>" /></p>
			<p>Username: <input type="text" name="username" value="<?php echo "$username" ?>" /></p>
			<p>Password: <input type="password" name="password" value="<?php echo "$password" ?>" /></p>
			<input type="hidden" name="id" value="<?php echo $id ?>" />
			<input type="submit" name="edit" value="Edit" />
			<input type="submit" name="cancel" value="Cancel" />
		</form>
	</body>
</html>