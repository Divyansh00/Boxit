<?php 
session_start();
$server = "localhost";
$username = "root";
$password = "";
$dbname = "Boxitdb";

$conn = new mysqli($server, $username, $password, $dbname) or die("Error Connecting to the server.");
$err_login="";
$err_regform="";
if (isset($_POST["loginbutton"])) {
	$uname = $_POST["username"];
	$upassword = $_POST["password"];

	if ($uname==NULL || $upassword==NULL) {
		$err_login = "Username or Password cannot be blank.";
		header("Location:".$_SERVER['PHP_SELF']);
	}
	
	$sql = "SELECT password FROM LOGIN WHERE username='$uname'";
	$result = $conn->query($sql) or die("Error connecting to the Login table of the database.");

	if ($result->num_rows == 0) {
		$err_login = "No such User found. Please Register first.";

	}else {
		$row = $result->fetch_assoc();
		if($upassword != $row["password"]){
			$err_login = "Invalid Password for the user.";
		}else {
			$_SESSION["uname"] = $uname;
			header("Location:"."homepage.php");
		}
	}

} elseif (isset($_POST["regformsubmit"])) {
	$regname = $_POST["regname"];
	$regemail = $_POST["regemail"];
	$regmobno = $_POST["regmobno"];
	$regaddr = $_POST["regaddr"];
	$regusername = $_POST["regusername"];
	$regpswd = $_POST["regpswd"];
	$regpswdretype = $_POST["regpswdretype"];
	if ($regname==NULL || $regemail==NULL || $regmobno==NULL || $regaddr==NULL || $regusername==NULL || $regpswd==NULL || $regpswdretype==NULL) {
		$err_regform = "No field should be left blank.";
	}


	$sql = "SELECT * FROM USER where username='$regusername'";
	$result = $conn->query($sql) or die("Error connecting to the Registration table of the server.");


	if ($result->num_rows >= 1) {
		$err_regform = "Username already taken. Try a different one. It may be better.";
	}else {
		$sql = "INSERT INTO USER values('$regusername','$regname','$regemail','$regmobno','$regaddr')";
		
		$sql2 = "INSERT INTO LOGIN values('$regusername','$regpswd')";

		if($conn->query($sql) && $conn->query($sql2)){
			$err_regform = "User added successfully. You shall now proceed.";
		} else {
			$err_regform = "Trouble adding you. Working on it.";
		}
	}
}

$conn->close();

?>


<!DOCTYPE html>
<head>
	<title>BoxIt - Login/Register Page</title>
	<link rel="stylesheet" href="../CSS/Login.css">
	<link rel="stylesheet" href="../CSS/footer.css">
</head>
<body id="loginbg">
	<div id="login_bg">
		<div id="topbar">
			<div id="lfloat">
				<a href="homepage.html"> <img src="logo.jpg" alt="LOGO"> </a>
			</div>

			<div id="rfloat" style="float:right;">
				<form action="<?php echo $_SERVER['PHP_SELF'] ?>" id="loginform" method="post">
					<table cellspacing="7px">
						<tr>
							<td><input type="text" name="username" class="logininput" placeholder="Username" required autofocus /></td>
							<td><input type="password" name="password" class="logininput" placeholder="Password" required/></td>
							<td> <input type="submit" value="Log In" id="loginbutton" name="loginbutton"></td>
							<tr>
								<td class="error"><?php echo $err_login; $err_login=""; ?></td>
							</tr>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>


	<div id="bigbox">

		<div class="regform">
			<table id="regtable">
				<form action="<?php echo $_SERVER['PHP_SELF'] ?>" name="regform" method="post">
					<tr>
						<th colspan="2"> <h1> Lookin' for something? </h1> </th>
					</tr>
					<tr>
						<td> <input type="text" name="regname" placeholder="Name" required /> </td>
					</tr>
					<tr>
						<td><input type="email" name="regemail" placeholder="Email" required /></td>
					</tr>
					<tr>
						<td><input type="text" name="regmobno" placeholder="Mobile Number" required /></td>
					</tr>
					<tr>
						<td><input type="text" name="regaddr" placeholder="Permanent Address" required /></td>
					</tr>
					<tr>
						<td> <input type="text" name="regusername" placeholder="Username" required /></td>
					</tr>
					<tr>
						<td><input type="password" name="regpswd" placeholder="Password" required /></td>
					</tr>
					<tr>
						<td><input type="password" name="regpswdretype" placeholder="Retype Password" required /></td>
					</tr>
					<tr>
						<td class="error"><?php echo $err_regform; $err_regform=""; ?></td>
					</tr>
					<tr>
						<td colspan="2" align="center"> <input type="submit" id="regformsubmit" name="regformsubmit" value="Register" /></td>
					</tr>
				</form>
			</table>
		</div>
	</div>
	<?php include 'footer.php'; ?>
</body>
</html>

