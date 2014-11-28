<?php
	require_once("db.php");
	session_start();
	if (isset($_SESSION['username']['admin'])) {
	}
	else {
		header("Location: login.php");
	}
	
	if (isset($_REQUEST['logout'])) {
		session_destroy();
		header("Location: login.php");
	}
	
	if (isset($_REQUEST['createaccount'])) {
		header("Location: create.php");
	}
	
	if ( isset($_SESSION['error']) ) {
		echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
		unset($_SESSION['error']);
	}
	
	if ( isset($_SESSION['success']) ) {
		echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
		unset($_SESSION['success']);
	}

	echo '<table border="1">';
		echo "<tr>";
			echo "<td>";
				echo "<b>Name</b>";
			echo "</td>";
			echo "<td>";
				echo "<b>Username</b>";
			echo "</td>";
			echo "<td>";
				echo "<b>Type</b>";
			echo "</td>";
			echo "<td>";
				echo "<b>Action</b>";
			echo "</td>";
			echo "</tr>";
	$result = mysql_query("SELECT name, username, type, id FROM user");
	while ( $row = mysql_fetch_row($result) ) {
		echo "<tr>";
			echo "<td>";
				echo(htmlentities($row[0]));
			echo "</td>";
			echo "<td>";
				echo(htmlentities($row[1]));
			echo "</td>";
			echo "<td>";
				echo(htmlentities($row[2]));
			echo "</td>";
			echo "<td>";
				echo '<a href="edit.php?id='.htmlentities($row[3]).'">Edit</a> / ';
				echo '<a href="delete.php?id='.htmlentities($row[3]).'">Delete</a> / ';
				echo '<a href="scenarios.php?id='.htmlentities($row[3]).'">Metrics</a>';
			echo "</td>";
			echo "</tr>";
	}
	echo "</table>";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Users</title>
		<link href="game.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<form method="post">
			<p>
				<input type="submit" name="logout" value="Logout">
				<input type="submit" name="createaccount" value="Create Account">
			</p>
		</form>
	</body>
</html>