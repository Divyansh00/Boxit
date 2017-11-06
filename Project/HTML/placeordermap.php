<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>World Map</title>
	<script src="../JS/placeordermap.js"></script>
	<link rel="stylesheet" href="../CSS/placeordermap.css">
	<link rel="stylesheet" href="../CSS/topbar.css">
	<link rel="stylesheet" href="../CSS/footer.css">
	<?php include 'session.php'; ?>
	<?php 
		$err_msg="";

		if (isset($_POST['cityset'])) {
			$fromcity = $_POST['fromcity'];
			$tocity = $_POST['tocity'];
			$err_flag = 0;
			if ($fromcity == "" || $tocity == "") {
				$err_msg = "Blank cities";
				$err_flag = 1;
			}
			if ($fromcity == $tocity) {
				$err_msg = "You can't ship within same city.";
				$err_flag = 1;
			}

			$conn = new mysqli("localhost", "root", "", "Boxitdb") or die("Error connecting to the database");
			$sql = "SELECT islandlocked FROM CITY where name='$fromcity' OR name='$tocity'";
			$result = $conn->query($sql) or die("Error getting data");
			
			if ($result->num_rows == 0) {
				$err_msg = "Nope.";
				$err_flag = 1;				
			}
			else {
				while ($row = $result->fetch_assoc()) {
					if ($_SESSION['ordermethod'] == "ship" && $row['islandlocked'] == 1){
						$err_msg = "One of the following cites is landlocked";
						$err_flag = 1;
					}
				}
			}
			$conn->close();
			if ($err_flag == 0) {
				$_SESSION['fromcity'] = $fromcity;
				$_SESSION['tocity'] = $tocity;
				header("Location:placeorderform.php");
			}

		}

	 ?>

</head>
<body id="placeordermapbody">
	<?php include 'topbar.php'; ?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<table id="citydata" width=100%>
			<tr>
				<td><input type="text" name="fromcity" id="fromcity" readonly placeholder="From city"></td>
				<td><input type="text" name="tocity" id="tocity" readonly placeholder="To city"></td>
				<td><input type="submit" name="cityset" id="cityset" value="Proceed"></td>
				<td><input type="reset" value="Reset" onclick="reset();"></td>
			</tr>
			<tr>
				<td colspan="2"><?php echo $err_msg; $err_msg=""; ?></td>
			</tr>
		</table>
	</form>
	<div id="mapbox">
	<img src="../images/worldmap.jpg" alt="World Map" usemap="worldmap" />
	<map name="worldmap">
		<area id="Mumbai" shape="rect" onclick="exec(id);"  coords="919,419,928,425" />
		<area id="Calcutta" shape="rect" onclick="exec(id);"  coords="971,412,980,421" />
		<area id="Karachi" shape="rect" onclick="exec(id);"  coords="897,395,905,403" />
		<area id="Delhi" shape="rect" onclick="exec(id);"  coords="932,379,940,384" />
		<area id="Riyadh" shape="rect" onclick="exec(id);"  coords="825,402,833,410" />
		<area id="Istanbul" shape="rect" onclick="exec(id);"  coords="768,341,776,347" />
		<area id="Cairo" shape="rect" onclick="exec(id);"  coords="773,380,783,389" />
		<area id="Bangkok" shape="rect" onclick="exec(id);"  coords="1009,437,1020,446" />
		<area id="Singapore" shape="rect" onclick="exec(id);"  coords="1023,480,1032,488" />
		<area id="Jakarta" shape="rect" onclick="exec(id);"  coords="1039,513,1048,522" />
		<area id="Sydney" shape="rect" onclick="exec(id);"  coords="1175,613,1184,622" />
		<area id="Guangzhou" shape="rect" onclick="exec(id);"  coords="1056,406,1066,414" />
		<area id="Shanghai" shape="rect" onclick="exec(id);"  coords="1082,383,1090,390" />
		<area id="Tokyo" shape="rect" onclick="exec(id);"  coords="1139,360,1149,367" />
		<area id="Seoul" shape="rect" onclick="exec(id);"  coords="1108,353,1116,362" />
		<area id="Beijing" shape="rect" onclick="exec(id);"  coords="1074,324,1085,335" />
		<area id="Moscow" shape="rect" onclick="exec(id);"  coords="798,256,809,267" />
		<area id="Berlin" shape="rect" onclick="exec(id);"  coords="706,277,715,286" />
		<area id="Rome" shape="rect" onclick="exec(id);"  coords="716,332,726,339" />
		<area id="Lagos" shape="rect" onclick="exec(id);"  coords="684,465,692,475" />
		<area id="Casablanca" shape="rect" onclick="exec(id);"  coords="636,375,644,384" />
		<area id="Paris" shape="rect" onclick="exec(id);"  coords="671,301,682,311" />
		<area id="London" shape="rect" onclick="exec(id);"  coords="660,275,670,286" />
		<area id="Buenos Aires" shape="rect" onclick="exec(id);"  coords="468,613,477,621" />
		<area id="Sao Paulo" shape="rect" onclick="exec(id);"  coords="517,570,527,579" />
		<area id="Rio de Janeiro" shape="rect" onclick="exec(id);"  coords="528,556,539,566" />
		<area id="Lima" shape="rect" onclick="exec(id);"  coords="404,525,414,534" />
		<area id="Bogota" shape="rect" onclick="exec(id);"  coords="412,468,423,477" />
		<area id="Mexico City" shape="rect" onclick="exec(id);"  coords="329,419,340,426" />
		<area id="Los Angeles" shape="rect" onclick="exec(id);"  coords="256,359,268,368" />
		<area id="Chicago" shape="rect" onclick="exec(id);"  coords="364,328,376,339" />
		<area id="New York" shape="rect" onclick="exec(id);"  coords="416,338,426,345" />
		<area id="Toronto" shape="rect" onclick="exec(id);"  coords="403,314,412,321" />
		<area id="Cape Town" shape="rect" onclick="exec(id);"  coords="732,606,740,613" />
		<area id="Durban" shape="rect" onclick="exec(id);"  coords="776,590,785,596" />
		<area id="Anchorage" shape="rect" onclick="exec(id);"  coords="164,212,173,222" />
		<area id="Churchill" shape="rect" onclick="exec(id);"  coords="348,233,359,246" />
	</map>
	</div>
	<?php include 'footer.php'; ?>
</body>
</html>