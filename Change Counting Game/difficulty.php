<?php
	require_once("db.php");
	session_start();
	if (isset($_SESSION['username'])) {
	}
	else {
		header("Location: login.php");
	}

	if ( isset($_REQUEST['difficulty'])) {
		$level = mysql_real_escape_string($_REQUEST['difficulty']);
		$findlevel = "SELECT level,startingpurse,itemsnumber,id FROM level WHERE level = '$level'";
		$getlevel = mysql_query($findlevel);
		$levelrow = mysql_fetch_row($getlevel);
		$difficulty = $levelrow[0];
		$purse = $levelrow[1];
		$pursestring = number_format($purse,2);
		$itemsnumber = $levelrow[2];
		$levelid = $levelrow[3];
		
		$finditems = "SELECT item.name, item.displayname, price.price FROM price JOIN item JOIN level ON price.item_id=item.id AND price.level_id=level.id WHERE level='$difficulty'";
		$getitems = mysql_query($finditems);
		
		$allitems = array();
		
		while ($itemsrow = mysql_fetch_row($getitems)) {
			$item = array();
			$item['name'] = $itemsrow[0];
			$item['displayname'] = $itemsrow[1];
			$item['price'] = $itemsrow[2];
			$allitems[$item['name']] = $item;
		}
		
		mt_srand(microtime());
		$shoppinglist = array_rand($allitems, $itemsnumber);
		
		$inventory = array();
				
		$_SESSION['difficulty'] = $difficulty;
		$_SESSION['pursestring'] = $purse;
		$_SESSION['itemsnumber'] = $itemsnumber;
		$_SESSION['items'] = $allitems;
		$_SESSION['shoppinglist'] = $shoppinglist;
		$_SESSION['inventory'] = $inventory;
	
		$username = $_SESSION['username'];
		$finduser = "SELECT id FROM user WHERE username = '$username'";
		$getuser = mysql_query($finduser);
		$userrow = mysql_fetch_row($getuser);
		$userid = $userrow[0];
		$scenarioid = "INSERT INTO scenario (user_id, level_id) VALUES ($userid, $levelid)";
		mysql_query($scenarioid);
		$_SESSION['scenarioid'] = mysql_insert_id();
	
		header("Location: store.php");
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Difficulty</title>
		<link href="game.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<h1>Please select a difficulty level</h1>
		<form method="post">
			<input type="hidden" name="difficulty" id="difficultyField" />
			<input type="submit" id="formSubmit" style="display:none" />
			<p><input type="submit" class="button" onclick="javascript: selectDifficulty('easy')" value="Easy"></p>
			<p><input type="submit" class="button" onclick="javascript: selectDifficulty('medium')" value="Medium"></p>
			<p><input type="submit" class="button" onclick="javascript: selectDifficulty('hard')" value="Hard"></p>
		</form>
		
		<script type="text/javascript">
			function selectDifficulty(difficulty) {
				document.getElementById('difficultyField').value = difficulty;
				document.getElementById('formSubmit').click();
			}
		</script>
	</body>
</html>