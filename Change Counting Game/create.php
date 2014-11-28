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
	
	if ( isset($_POST['name']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['type'])) {
		$name = mysql_real_escape_string($_POST['name']);
		$username = mysql_real_escape_string($_POST['username']);
		$password = mysql_real_escape_string($_POST['password']);
		$type = $_POST['type'];
		$sql = "INSERT INTO user (name, username, password, type) VALUES ('$name', '$username', '$password', '$type')";
	
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
			$_SESSION['success'] = 'Account Created';
			header( 'Location: users.php' ) ;
			return;
		}	
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Create Account</title>
		<link href="game.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<form method="post">
			<p>Name: <input type="text" name="name"></p>
			<p>Username: <input type="text" name="username"></p>
			<p>Password: <input type="password" name="password"></p>
			<p>
				Type:
				<input type="radio" name="type" value="admin">Admin
				<input type="radio" name="type" value="student">Student
			</p>
			<p>
				<input type="submit" name="create" value="Create Account"/>
				<input type="submit" name="cancel" value="Cancel" />
			</p>
		</form>
	</body>
</html>