<?php
	if (isset($_POST['return'])) {
		header("Location: login.php");
		return;
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Credits</title>
		<link href="game.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<h1>A Few Acknowledgements</h1>
		<p class="credits">
			The hermit image you will see in various places on
			our website belongs to the Londonderry News, based out of
			New Hampshire. They have graciously granted us
			permission to use this image. Our hermit originally
			appeared in <a href="http://www.londonderrynh.net/2009/09/a-king-lost-in-the-trees/12925">A King Lost in the Trees</a>.
			Thank you, Londonderry News!
		</p>
		<p class="credits">
			Many of the images used by our game come from Neopets
			and are copyrighted by that company. Their copyright
			notice is included in <a href="http://www.neopets.com/terms.phtml" >Section B, Paragraph 1 of their Terms of Service</a>.
		</p>
		<form method="post">
			<p><input type="submit" name="return" value="Return"/></p>
		</form>
	</body>
</html>