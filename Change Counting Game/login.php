<?php
	require_once("db.php");
	session_start();

	if ( isset($_REQUEST['username']) && isset($_REQUEST['password'])  ) {
		$username = mysql_real_escape_string($_REQUEST['username']);
		$password = mysql_real_escape_string($_REQUEST['password']);
		$sql = "SELECT name FROM user WHERE username = '$username' AND password='$password'";
		$result = mysql_query($sql);
		$row = mysql_fetch_row($result);
		$finduser = "SELECT username,type FROM user WHERE username = '$username' AND password='$password'";
		$getuser = mysql_query($finduser);
		$userrow = mysql_fetch_row($getuser);
		$user = $userrow[0];
		$type = $userrow[1];
		
		if ( $row === FALSE ) {
			echo "<p>Invalid login</p>";
		}
		else {
			$_SESSION['username'] = $user;
			$_SESSION['type'] = $type;
			
			if ($_SESSION['type'] == "admin") {
				header("Location: users.php");				
			}
			
			if ($_SESSION['type'] == "student") {
				header("Location: difficulty.php");
			}
		}
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Login</title>
		<link href="game.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<h1>Welcome to the Change Game</h1>
		<p>To log in, please enter your username and password.<br/>Please talk to Cynthia if you lose your password.</p>
		<img src="images/hermit.png">
		<form method="post">
			<p>Username: <input type="text" name="username"></p>
			<p>Password: <input type="password" name="password"></p>
			<p><input type="submit" value="Log In"/></p>
		</form>
		<a href="credits.php">Credits</a>
	</body>
</html>