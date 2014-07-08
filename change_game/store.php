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

	function currenturl() {
		$pageURL = 'http';
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
	
	$_SESSION['storeurl'] = currenturl();
	
	$shoppinglist = $_SESSION['shoppinglist'];
	$inventory = $_SESSION['inventory'];
	
	$victory_check = array_diff($shoppinglist, $inventory);
	if ($victory_check == array()) {
		header("Location: success.php");
	}
	
	echo '<h1 class="storeitemtext">Items Needed:';
	foreach ($_SESSION['shoppinglist'] as $item){
		$image = $_SESSION['items'][$item]['name'];
		echo '<img src="images/items/'.$image.'.png" class="storeitem">';
	}
	echo "</h1>";
	echo "<br/><br/>";
	
	echo '<h1 class="storeitemtext">Inventory:';
	foreach ($_SESSION['inventory'] as $item){
		$image = $_SESSION['items'][$item]['name'];
		echo '<img src="images/items/'.$image.'.png" class="storeitem">';
	}
	echo "</h1>";
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Store</title>
		<link href="game.css" rel="stylesheet" type="text/css" />
	</head>
	<body class="cave">
		<p class="purse">You have $<?php echo $_SESSION['pursestring']; ?> left.</p>
			<p>
				<p class="instructions"><br/><br/><br/>
										"Items Needed" shows the items you<br/>
										need to purchase. "Inventory" shows<br/>
										the items you currently have. To buy<br/>
										an item, just click on it to the right. You<br/>
										can hover over an item to see its price.</p>
				<a href="purchase.php?name=gold_egg"><img src="images/items/gold_egg.png" title=<?php echo "$".$_SESSION['items']['gold_egg']['price']?>></a>
				<a href="purchase.php?name=dragon_potion"><img src="images/items/dragon_potion.png" title=<?php echo "$".$_SESSION['items']['dragon_potion']['price']?>></a>
				<a href="purchase.php?name=black_mushroom"><img src="images/items/black_mushroom.png" title=<?php echo "$".$_SESSION['items']['black_mushroom']['price']?>></a>
				<a href="purchase.php?name=star_sand"><img src="images/items/star_sand.png" title=<?php echo "$".$_SESSION['items']['star_sand']['price']?>></a><br/>
				<img src ="images/woodpanel.png" class="shelf">
			</p>
			<p>
				<a href="purchase.php?name=crystal_egg"><img src="images/items/crystal_egg.png" title=<?php echo "$".$_SESSION['items']['crystal_egg']['price']?>></a>
				<a href="purchase.php?name=bat_potion"><img src="images/items/bat_potion.png" title=<?php echo "$".$_SESSION['items']['bat_potion']['price']?>></a>
				<a href="purchase.php?name=leafy_mushroom"><img src="images/items/leafy_mushroom.png" title=<?php echo "$".$_SESSION['items']['leafy_mushroom']['price']?>></a>
				<a href="purchase.php?name=fairy_sand"><img src="images/items/fairy_sand.png" title=<?php echo "$".$_SESSION['items']['fairy_sand']['price']?>></a><br/>
				<img src ="images/woodpanel.png" class="shelf">
			</p>
			<p>
				<a href="purchase.php?name=vortex_egg"><img src="images/items/vortex_egg.png" title=<?php echo "$".$_SESSION['items']['vortex_egg']['price']?>></a>
				<a href="purchase.php?name=fox_potion"><img src="images/items/fox_potion.png" title=<?php echo "$".$_SESSION['items']['fox_potion']['price']?>></a>
				<a href="purchase.php?name=tree_mushroom"><img src="images/items/tree_mushroom.png" title=<?php echo "$".$_SESSION['items']['tree_mushroom']['price']?>></a>
				<a href="purchase.php?name=gryphon_sand"><img src="images/items/gryphon_sand.png" title=<?php echo "$".$_SESSION['items']['gryphon_sand']['price']?>></a><br/>
				<img src ="images/woodpanel.png" class="shelf">
			</p>
			<form>
				<p><input type="submit" name="logout" value="Logout"></p>
			</form>
	</body>
</html>