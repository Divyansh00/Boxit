<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cancellation</title>
	<link rel="stylesheet" href="../CSS/topbar.css">
	<link rel="stylesheet" href="../CSS/footer.css">
	<link rel="stylesheet" href="../CSS/addons.css">
<?php 
	$msg = "";
	include 'session.php';
	$orderid = $_SESSION['orderid'];
	$conn = new mysqli("localhost","root","","Boxitdb") or die('Error connecting to DB.');
	$q = "SELECT pickupdt FROM ORDERTB WHERE orderid='$orderid'";
	$result = $conn->query($q) or die("Erro cancelling order.");
	$row = $result->fetch_assoc();
	// echo "Lol";
	$q1 = "SELECT NOW() as NOW";
	$result1 = $conn->query($q1);
	$row1 = $result1->fetch_assoc();
	if($row1['NOW'] > $row['pickupdt']){
		$msg = "Sorry Shipping has been initiated cannot cancel.";
	}
	else{
		$q2 = "DELETE FROM ORDERTB WHERE orderid='$orderid'";
		$q3 = "DELETE FROM ORDERADDR WHERE orderid='$orderid'";
		$conn->query($q3);
		$conn->query($q2);
		$msg = "Cancellation successful.";
		sleep(5);
		header("Location:homepage.php");
	}
	$conn->close();
 ?>
</head>
<body id="cancelbody">
	<?php include'topbar.php'; ?>
	<div id="message"><?php echo "$msg"; ?></div>
</body>
</html>