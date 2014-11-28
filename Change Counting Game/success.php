<?php
	require_once("db.php");
	session_start();
	if (isset($_SESSION['username'])) {
	}
	else {
		header("Location: login.php");
	}
	
	if (isset($_REQUEST['logout'])) {
		session_destroy();
		header("Location: login.php");
	}
	if (isset($_REQUEST['playagain'])) {
		$username = $_SESSION['username'];
		$type = $_SESSION['type'];
		session_unset();
		$_SESSION['username'] = $username;
		$_SESSION['type'] = $type;
		header("Location: difficulty.php");
	}
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Success</title>
		<link href="game.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<h1>Congratulations! You win!</h1>
		<img src="images/fireworks.png">
		<form method="post">
			<input type="submit" name="playagain" value="Play Again">
			<input type="submit" name="logout" value="Logout">
		</form>
	</body>
</html>