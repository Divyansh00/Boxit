<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Orders</title>
	<head>
		<?php include'session.php' ?>
		<link rel="stylesheet" href="../CSS/topbar.css">
		<link rel="stylesheet" href="../CSS/footer.css">
		<link rel="stylesheet" href="../CSS/myordermyaccount.css">
	</head>
</head>
<body id="myorderbody">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<?php
	include'topbar.php';
	$err='';
	
	if (isset($_POST['track'])) {
		if(isset($_POST["selorderid"]))
		{
		$_SESSION['orderid'] = $_POST["selorderid"];
		header("Location:trackorder.php");
		}
		else{
			$err="Please select an order";
		}			
	}
	if (isset($_POST['cancel'])) {
		if(isset($_POST["selorderid"]))
		{
		$_SESSION['orderid'] = $_POST["selorderid"];
		header("Location:cancelorder.php");
		}
		else{
			$err="Please select an order";
		}		
			
	}

	$server = "localhost";
	$username = "root";
	$password = "";
	$dbname = "Boxitdb";
	$a=$_SESSION['uname'];
	
	
	$conn = new mysqli($server, $username, $password, $dbname) or die("Error Connecting to the server.");

	$q = "SELECT orderid,pickupdt FROM ORDERTB WHERE custname = '$a'";
	$result=$conn->query($q) or die("Error connecting to the Order table of database");
	if($result->num_rows == 0){
		$err = "No Orders have been placed by you";
	}
	else{
		echo("<table border='1px' id='ordertable'><tr><th>Selected Order</th><th>Order Id</th><th>Pickup Date</th><th>From</th><th>To</th></tr>");
		while($row = $result->fetch_assoc())
		{	
			$b=$row['orderid'];
			$q1="SELECT fromcity,tocity FROM ORDERADDR WHERE orderid='$b'";
			$result1=$conn->query($q1) or die('Error connecting to the Orderaddr table of the database.');
			$row1=$result1->fetch_assoc();
			echo "<tr>";
			echo "<td> <input type='radio' name='selorderid' value='$b' /> </td>";
			echo "<td>".$row['orderid']."</td>";
			echo "<td>".$row['pickupdt']."</td>";
			echo "<td>".$row1['fromcity']."</td>";
			echo "<td>".$row1['tocity']."</td>";
			echo"</tr>";
		}
		echo "<tr>";	
		echo "<td colspan='2'> <input type='submit' value='Track' name='track'> </td>";
		echo "<td colspan='2'> <input type='submit' value='Cancel' name='cancel'> </td>";
		echo "</tr>";
		echo("</table>");
	}

	$conn->close();
	?>
	</form>
	<div id="error" ><?php echo($err); $err='';?></div>
	<?php include "footer.php" ?>
</body>
</html>
