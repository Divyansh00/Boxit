<?php 
// session_start();
// include 'session.php';
if(isset($_POST["logout"])){
	unset($_SESSION["uname"]);
	session_destroy();
	session_unset();
	header("Location:Login.php");
}
?>
<div id="topbardiv">
	<ul id="topbar">
		<li class="topitems"><a href="homepage.php">Home</a></li>
		<li class="topitems"><a href="placeorder.php">Place Order</a></li>
		<li class="topitems"><a href="myorder.php">Manage Orders</a></li>
		<li class="topitems"><a href="myaccount.php">Manage Account</a></li>
		<li class="topitems" id="logout"><a href="logout.php">Logout</a></li>
		<li class="topitems" id="logas">Logged in as: <?php echo $_SESSION["uname"]; ?></li>
	</ul>
</div>	
