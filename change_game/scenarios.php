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

	$id = $_GET['id'];
	
	$finduser = "SELECT id, name FROM user WHERE id = '$id'";
	$getuser = mysql_query($finduser);
	$userrow = mysql_fetch_row($getuser);
	$user = $userrow[1];

	echo "<p>Scenarios Played by $user </p>";
	echo '<table border="1">';
		echo "<tr>";
			echo "<td>";
				echo "<b>Id</b>";
			echo "</td>";
			echo "<td>";
				echo "<b>Level</b>";
			echo "</td>";
			echo "<td>";
				echo "<b>Action</b>";
			echo "</td>";
			echo "</tr>";
	$findscenarios = "SELECT scenario.id, level.level FROM scenario JOIN level ON scenario.level_id=level.id WHERE user_id='$id'";
	$result = mysql_query($findscenarios);
	$resultrows = mysql_num_rows($result);
	
	if ($resultrows == 0) {
		echo "No scenarios played.";
	}
	
	while ( $row = mysql_fetch_row($result) ) {
		echo "<tr>";
			echo "<td>";
				echo(htmlentities($row[0]));
			echo "</td>";
			echo "<td>";
				echo(htmlentities($row[1]));
			echo "</td>";
			echo "<td>";
				echo '<a href="attempts.php?id='.$id.'&scenario='.$row[0].'">View</a>';
			echo "</td>";
			echo "</tr>";
	}
	echo "</table>";	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Scenarios</title>
		<link href="game.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<form method="post">
		<p><input type="submit" name="cancel" value="Cancel" /></p>
		</form>
	</body>
</html>