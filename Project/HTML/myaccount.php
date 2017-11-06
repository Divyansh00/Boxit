<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Account</title>
	<link rel="stylesheet" href="../CSS/topbar.css">
	<link rel="stylesheet" href="../CSS/footer.css">
	<link rel="stylesheet" href="../CSS/myordermyaccount.css">
	<?php 
	include'session.php';
	$a = $_SESSION['uname'];
	$conn = new mysqli("localhost","root","","Boxitdb") or die("Error connecting to DB");
	$q = "SELECT * FROM USER WHERE username='$a'";
	$result = $conn->query("$q") or die("Error executing query");
	$row=$result->fetch_assoc();
	$err="";
	if (isset($_POST['changepass'])){
		$q1="SELECT password FROM LOGIN WHERE username='$a'";
		$cpass = $_POST['cpass'];
		$npass = $_POST['npass'];
		$rpass = $_POST['rpass'];
		if($rpass != $npass)
			$err = "Please retype New password properly";
		$result1=$conn->query($q1) or die("Error getting current password");
		$row1=$result1->fetch_assoc();
		if($cpass==$row1['password']){
			if($err == ""){
				$q2="UPDATE LOGIN SET password= '$npass' WHERE username='$a'";
				$conn->query($q2);
				sleep(2);
				header("Location:homepage.php");
			}
		}
		else{
			$err ="Invalid Current Password";
		}
	}
	$conn->close();
	?>
	<script src="../JS/passwordchange.js" type="text/javascript"></script>
</head>
<body id="myaccountbody">
	<?php
	include'topbar.php';
	echo"<table id='myaccounttable' cellspacing='0'>
	<tr>
	<td>Name</td>
	<td>".$row['name']."</td>
	</tr>
	<tr>
	<td>Username</td>
	<td>".$row['username']."</td>
	</tr>
	<tr>
	<td>Email</td>
	<td>".$row['email']."</td>
	</tr>
	<tr>
	<td>Mobile Number</td>
	<td>".$row['mobno']."</td>
	</tr>
	<tr>
	<td>Permanent Address</td>
	<td>".$row['paddr']."</td>
	</tr>
	</table>";
	?>

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = 'post'>
		<table id="passwordtable" cellpadding="4em" cellspacing="4em">
		<tr>
		<th colspan='2'><h2>Change Password</h2></th>
		</tr>
		<tr>
		<td>Current Password</td>
		<td><input type='password' name='cpass' required></td>
		</tr>
		<tr>
		<td>New Password</td>
		<td><input type='password' name='npass' required onkeyup="check(this.value);"></td>
		<td id='password_strength'></td>
		</tr>
		<tr>
		<td>Retype New Password</td>
		<td><input type='password' name='rpass' required></td>
		</tr>
		<tr>
		<td><?php echo $err; $err=""; ?>	</td>
		</tr>
		<tr>
		<td align="center" colspan='2'><input type='submit' name ='changepass' value='Change'></td>
		</tr>
		</table>
		</form>

		<?php include "footer.php";?>
	</body>
	</html>