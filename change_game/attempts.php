<?php
	require_once("db.php");
	session_start();

	if (isset($_SESSION['username']['admin'])) {
	}
	
	else {
		header("Location: login.php");
	}

	$id = $_GET['id'];
	$scenario = $_GET['scenario'];
	
	if (isset($_POST['cancel'])) {
		header("Location: scenarios.php?id=$id");
		return;
	}

	$finduser = "SELECT id, name FROM user WHERE id = '$id'";
	$getuser = mysql_query($finduser);
	$userrow = mysql_fetch_row($getuser);
	$user = $userrow[1];

	echo "<p>Attempts by $user </p>";
	echo '<table border="1">';
		echo "<tr>";
			echo "<td>";
				echo "<b>Id</b>";
			echo "</td>";
			echo "<td>";
				echo "<b>Item</b>";
			echo "</td>";
			echo "<td>";
				echo "<b>Level</b>";
			echo "</td>";
			echo "<td>";
				echo "<b>Successful?</b>";
			echo "</td>";
			echo "<td>";
				echo "<b>Time</b>";
			echo "</td>";
			echo "</tr>";
	$findattempts = "SELECT attempt.id, item.displayname, level.level, attempt.successful, attempt.time FROM attempt JOIN item JOIN level ON attempt.item_id=item.id AND attempt.level_id=level.id WHERE attempt.user_id='$id' AND attempt.scenario_id='$scenario'";
	$result = mysql_query($findattempts);
	$resultrows = mysql_num_rows($result);
	
	if ($resultrows == 0) {
		echo "No attempts made.";
	}

	else {
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
					echo(htmlentities($row[3]));
				echo "</td>";
				echo "<td>";
					echo(htmlentities($row[4]));
				echo "</td>";
				echo "</tr>";
		}
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