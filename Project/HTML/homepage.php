<?php 
	include 'session.php';
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home Page</title>
	<link rel="stylesheet" type="text/css" href="../CSS/homepage.css">
	<link rel="stylesheet" type="text/css" href="../CSS/topbar.css">
</head>
<body id="homepagebody">
	<div id="topbardiv">
		<div id="topbar">
			<div class="topitems" id="logout"><a href="logout.php">Logout</a></div>
			<div class="topitems" id="logas">Logged in as: <?php echo $_SESSION["uname"]; ?></div>
		</div>
	</div>

	<p id="complogo"><img src="../images/Boxit.jpg" class="center"></p>
	<table class="center table">
		<tr>
			<td><a href="placeorder.php"><img src="../images/PlaceOrder.jpg"></a></td>
			<td><a href="myorder.php"><img src="../images/Myorder.jpg"></a></td>
			<td><a href="myaccount.php"><img src="../images/myaccount.png"></a></td>
		</tr>
		<tr>
			<td><a href="helpdesk.php" target="_blank"><img src="../images/FAQ.jpg"></a></td>
			<td><a href="contactpage.php" target="_blank"><img src="../images/contactus.jpg"></a></td>
			<td><a href="aboutuspage.php"  target="_blank"><img src="../images/aboutus.jpg"></a></td>
		</tr>
	</table>
</body>
</html>