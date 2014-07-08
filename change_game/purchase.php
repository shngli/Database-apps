<?php
	require_once("db.php");
	session_start();
	if (isset($_SESSION['username'])) {
	}
	else {
		header("Location: login.php");
	}
	
	$username = $_SESSION['username'];
	$finduser = "SELECT id FROM user WHERE username = '$username'";
	$getuser = mysql_query($finduser);
	$userrow = mysql_fetch_row($getuser);
	$userid = $userrow[0];
	
	$level = $_SESSION['difficulty'];
	$findlevel = "SELECT id FROM level WHERE level = '$level'";
	$getlevel = mysql_query($findlevel);
	$levelrow = mysql_fetch_row($getlevel);
	$levelid = $levelrow[0];
	
	$item = $_REQUEST['name'];
	$finditem = "SELECT id FROM item WHERE name = '$item'";
	$getitem = mysql_query($finditem);
	$itemrow = mysql_fetch_row($getitem);
	$itemid = $itemrow[0];
	
	$scenarioid = $_SESSION['scenarioid'];

	$name = $_SESSION['items'][$item]['displayname'];
	$price = $_SESSION['items'][$item]['price'];
	$purse = $_SESSION['pursestring'];
	$string_purse = number_format($purse,2);
	$string_price = number_format($price,2);
	
	if ($_SERVER['HTTP_REFERER'] == $_SESSION['storeurl']) {
		$timecall = microtime((true));
		$_SESSION['timecall'] = $timecall;
	}
	
	if (isset($_REQUEST['penny']) && isset($_REQUEST['nickel']) && isset($_REQUEST['dime']) && isset($_REQUEST['quarter']) && isset($_REQUEST['one_dollar']) && isset($_REQUEST['five_dollar'])) {
		$total_float = ($_REQUEST['penny'] * .01) + ($_REQUEST['nickel'] * .05) + ($_REQUEST['dime'] * .1) + ($_REQUEST['quarter'] * .25) + ($_REQUEST['one_dollar']) + ($_REQUEST['five_dollar'] * 5);
		$total_amount = number_format($total_float,2);
		$change = $string_purse - $string_price;
		$string_change = number_format($change,2);

		$timestart = $_SESSION['timecall'];
		$timeend = microtime((true));
		$totaltime = $timeend - $timestart;
		
		if ($total_amount == $string_change) {
			$_SESSION['pursestring'] = $string_change;
			$_SESSION['inventory'][] = $item;
			
			$attemptid = "INSERT INTO attempt (user_id, level_id, item_id, successful, time, scenario_id) VALUES ($userid, $levelid, $itemid, 'succeeded', $totaltime, $scenarioid)";
			mysql_query($attemptid);
			header("Location: store.php");
		}
		
		else {
			$attemptid = "INSERT INTO attempt (user_id, level_id, item_id, successful, time, scenario_id) VALUES ($userid, $levelid, $itemid, 'failed', $totaltime, $scenarioid)";
			mysql_query($attemptid);
			echo "That isn't quite right. Would you like to try again?";
		}
	}
	
	if (isset($_REQUEST['return'])) {
		$attemptid = "INSERT INTO attempt (user_id, level_id, item_id, successful, time, scenario_id) VALUES ($userid, $levelid, $itemid, 'stopped', $totaltime, $scenarioid)";
		mysql_query($attemptid);
		header("Location: store.php");
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Purchase</title>
		<link href="game.css" rel="stylesheet" type="text/css" />
	</head>
	<body class="cave">
		<p>
			You currently have $<?php echo $string_purse ?>.<br/>
			This <?php echo $name; ?> costs $<?php echo $string_price; ?>.<br/>
			How much change do I owe you?
		</p>
		<br/>
		<img src="images/hermit.png" class="hermit">
		
		<form method="post">
			<table>
				<tr>
					<td><a href="javascript:add('five_dollar')"><img src="images/money/five_dollar.jpg"></a></td>
					<td><b>$5</b>: <input type="text" name="five_dollar" id="five_dollar" value="0"></td>
					<td><a href="javascript:add('one_dollar')"><img src="images/money/one_dollar.jpg"></a></td>
					<td><b>$1</b>: <input type="text" name="one_dollar" id="one_dollar" value="0"></td>
				</tr>
				<tr>
					<td><a href="javascript:add('quarter')"><img src="images/money/quarter.png"></a></td>
					<td><b>$0.25</b>: <input type="text" name="quarter" id="quarter" value="0"></td>
					<td><a href="javascript:add('dime')"><img src="images/money/dime.png"></a></td>
					<td><b>$0.10</b>: <input type="text" name="dime" id="dime" value="0"></td>
				</tr>
				<tr>
					<td><a href="javascript:add('nickel')"><img src="images/money/nickel.png"></a></td>
					<td><b>$0.05</b>: <input type="text" name="nickel" id="nickel" value="0"></td>
					<td><a href="javascript:add('penny')"><img src="images/money/penny.png"></a></td>
					<td><b>$0.01</b>: <input type="text" name="penny" id="penny" value="0"></td>
				</tr>
			</table>
			<input type="submit" style="display: none" id="formSubmit" />
			<input type="button" id="submitButton" onclick="javascript:submitForm()" value="Submit" />
			<input type="reset" value="Reset" />
			<input type="submit" name="return" value="Return" />
		</form>
		<p>
			Count out change by clicking on the bills and coins above, or entering numbers into the textboxes.<br/>
			Be careful: Reset will clear away your current work. Return will take you back to the previous page.
		<script language="javascript">
			function add(arg) {
				document.getElementById(arg).value++;
			}
			function submitForm() {
				document.getElementById('formSubmit').click();
			}
		</script>
	</body>
</html>