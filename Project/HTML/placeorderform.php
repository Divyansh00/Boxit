<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>BOXiT - Place Order</title>
	<script src="/JS/placeorder.js"></script>
	<link rel="stylesheet" href="../CSS/placeorderform.css">
	<link rel="stylesheet" href="../CSS/topbar.css">
	<link rel="stylesheet" href="../CSS/footer.css">
	<?php 
	include 'session.php';

	$fromcity = $_SESSION['fromcity'];
	$tocity = $_SESSION['tocity'];

	$conn = new mysqli("localhost", "root", "", "Boxitdb") or die("Error connecting to database");
	$sql = "SELECT country FROM CITY WHERE name='$fromcity'";
	$r1 = ($conn->query($sql));
	$row = $r1->fetch_assoc();
	$fromcountry = $row['country'];

	$sql = "SELECT country FROM CITY WHERE name='$tocity'";
	$r2 = ($conn->query($sql));
	$row = $r2->fetch_assoc();
	$tocountry = $row['country'];



	if (isset($_POST['submit'])) {

		$orderid;
		$sql = "SELECT MAX(orderid) as orderid FROM ORDERTB";
		$result = $conn->query($sql);
		if ($result->num_rows == 0) {
			$orderid = 1;
		}else {
			$row = $result->fetch_assoc();
			$orderid = $row['orderid'] + 1;
		}

		$custname = $_SESSION['uname'];
		$pickupdt = $_POST['pickupdate'];
		$content = $_POST['content'];
		$weight = $_POST['weight'];
		$quantity = $_POST['quantity'];
		$method = $_SESSION['ordermethod'];

		$fname = $_POST['fname'];
		$fmobno = $_POST['fmobno'];
		$femail = $_POST['femailid'];
		$faddr = $_POST['faddress'];
		$fromlandmark = $_POST['flandmark'];
		$frompincode = $_POST['fpincode'];

		$tname = $_POST['tname'];
		$tmobno = $_POST['tmobno'];
		$temail = $_POST['temailid'];
		$taddr = $_POST['taddress'];
		$tolandmark = $_POST['tlandmark'];
		$topincode = $_POST['tpincode'];

		$sqlins2 = "INSERT INTO ORDERADDR(orderid, fromname,frommobno,fromemail,fromaddr,fromlandmark,fromcity,frompincode,toname,tomobno,toemail,toaddr,tolandmark,tocity,topincode) VALUES($orderid, '$fname', $fmobno, '$femail', '$faddr', '$fromlandmark', '$fromcity', $frompincode, '$tname', $tmobno, '$temail', '$taddr', '$tolandmark', '$tocity', $topincode)";

		$sqlins1 = "INSERT INTO ORDERTB(orderid, custname, pickupdt, content, weight, quantity, method) VALUES($orderid,'$custname', '$pickupdt', '$content', $weight, $quantity, '$method')";



		if ($conn->query($sqlins1) && $conn->query($sqlins2)) {
		// if ($conn->query($sqlins)) {
			echo "Order placed successfully";
			sleep(3);
			header("Location:homepage.php");
		} else{
			echo "Error Inserting the values into the table. ".$conn->error;
		}

	}
	$conn->close();
	?>

</head>
<body id="placeorderformbody">
	<?php include 'topbar.php'; ?>
	<form name="orderform" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
		<h3 id="heading"> Schedule A Pickup</h3>
		<div class="wrapper">
			<fieldset id="fromtablebox">
				<table id="fromtable">
					<legend><b>From:</b></legend>
					<tr>
						<td>Name:</td>
						<td><input type="text" name="fname" required="required" /></td>
					</tr>
					<tr>
						<td>Mobile No.:</td>
						<td><input type="text" name="fmobno" required="required"  /></td>
					</tr>
					<tr>
						<td>Email ID :</td>
						<td><input type="text" name="femailid" width="32" required="required"  /></td>
					</tr>
					<tr>
						<td>Address :</td>
						<td><textarea rows="5" cols="25" name="faddress" maxlength="150" required="required" ></textarea></td>
					</tr>
					<tr>
						<td>Landmark :</td>
						<td><input type="text" name="flandmark" required="required"  /></td>
					</tr>
					<tr>
						<td>City :</td>
						<td><input type="text" name="fcity" required="required" value="<?php echo $fromcity; ?>" readonly /></td>
					</tr>
					<tr>
						<td>Country :</td>
						<td><input type="text" name="fcountry" required="required" value="<?php echo $fromcountry; ?>" readonly  /></td>
					</tr>
					<tr>
						<td>Pincode</td>
						<td><input type="text" name="fpincode" maxlength="6" minlength="6" required="required" /></td>
					</tr>
				</table>
			</fieldset>

			<fieldset id="totablebox">
				<table id="totable">

					<legend><b>To:</b></legend>
					<tr>
						<td>Name:</td>
						<td><input type="text" name="tname" required="required"  /></td>
					</tr>
					<tr>
						<td>Mobile No.:</td>
						<td><input type="text" name="tmobno" required="required" /></td>
					</tr>
					<tr>
						<td>Email ID :</td>
						<td><input type="text" name="temailid" required="required" /></td>
					</tr>
					<tr>
						<td>Address :</td>
						<td><textarea rows="5" cols="25" name="taddress" maxlength="150" required="required" ></textarea></td>
					</tr>
					<tr>
						<td>Landmark :</td>
						<td><input type="text" name="tlandmark" required="required" /></td>
					</tr>
					<tr>
						<td>City :</td>
						<td><input type="text" name="tcity" required="required" value="<?php echo $tocity; ?>" readonly /></td>
					</tr>
					<tr>
						<td>Country :</td>
						<td><input type="text" name="tcountry" required="required" value="<?php echo $tocountry; ?>" readonly /></td>
					</tr>
					<tr>
						<td>Pincode</td>
						<td><input type="text" name="tpincode" maxlength="6" minlength="6" required="required" /></td>
					</tr>
				</table>
			</fieldset>

			<fieldset id="pkgdetailsbox">
				<legend><b>Package &amp; Shipment Details:</b></legend>
				<table id="pkgdetails">
					<tr>
						<td>Pickup Date &amp; Time:</td>
						<td><input type="datetime-local" name="pickupdate" placeholder="dd-mm-yyyy" size="10px" required="required" /></td>
						<td>Content:</td>
						<td><input type="text" name="content" size="16px" required="required" /></td>
					</tr>
					<tr>
						<td>Weight</td>
						<td><input type="text" name="weight" size="10px" required="required"  /> Kg <!--max 50kg as per FAQ--></td>
						<td>Quantity</td>
						<td><input type="text" name="quantity" size="16px" required="required" /></td>
					</tr>
					<tr>
						<td colspan="6" align="center"><input type="submit" name="submit" value="Submit"  onclick="validate(this.form)" />
							<input type="reset" name="reset"/></td>
						</tr>
					</table>
				</fieldset>
			</div>
		</form>

		<?php include 'footer.php'; ?>
	</body>
	</html>
