<html>
<head>
	<title>Place Order</title>
	<link rel="stylesheet" href="../CSS/placeorder.css">
	<link rel="stylesheet" href="../CSS/topbar.css">
	<link rel="stylesheet" href="../CSS/footer.css">
	<?php 
		// session_start();
		include 'session.php';

		if (isset($_POST["airimg"])) {
			$_SESSION["ordermethod"] = "air";
			header("Location:placeordermap.php");
		}elseif (isset($_POST["shipimg"])) {
			$_SESSION["ordermethod"] = "ship";
			header("Location:placeordermap.php");
		}
	 ?>
</head>
<body id="placeorderbody">
	<?php include 'topbar.php'; ?>
	
	<div id="bigbox">
		<div id="choiceline">Choose a method to 'Box' your item.</div>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<div id="airbox"><input type="submit" name="airimg" id="airimg" value=""></div>
			<div id="shipbox"><input type="submit" name="shipimg" id="shipimg" value=""></div>
		</form>
	</div>

	<?php include 'footer.php'; ?>
</body>
</html>