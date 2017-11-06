<html>
<head>
	<title>Tracking your Orders</title>
	<link rel="stylesheet" href="../CSS/topbar.css">
	<link rel="stylesheet" href="../CSS/footer.css">
	<?php include 'session.php'; ?>
</head>
<body>
	<?php include 'topbar.php'; ?>
	<?php  
	
		$b = $_SESSION['orderid'];
		$conn = new mysqli("localhost", "root", "", "Boxitdb") or die("Error connecting to database");
		$sql = "SELECT fromcity,tocity FROM ORDERADDR WHERE orderid='$b'";
		$result = $conn->query($sql) or die("Error connecting to the Order table.");
		$row = $result->fetch_assoc();
		
		$sql = "SELECT pickupdt,method FROM ORDERTB WHERE orderid='$b'";
		$result1 = $conn->query($sql) or die("Error connecting to the Order table.");
		$row1 = $result1->fetch_assoc();

		$fromcity = $row['fromcity'];
		$tocity = $row['tocity'];
		
		$sql = "SELECT xcoord, ycoord FROM CITY WHERE name='$fromcity'";
		$fromcitycoord = ($conn->query($sql))->fetch_assoc();

		$sql = "SELECT xcoord, ycoord FROM CITY WHERE name='$tocity'";
		$tocitycoord = ($conn->query($sql))->fetch_assoc();
		$sql2 = "SELECT TIME_TO_SEC(TIMEDIFF(NOW(),pickupdt)) as diff FROM ORDERTB WHERE orderid=$b";
		$row2 = ($conn->query($sql2))->fetch_assoc();


		$sql="SELECT zone,north FROM CITY WHERE name='$fromcity'";
		$from_zone_north=($conn->query($sql))->fetch_assoc();

		$sql="SELECT zone,north FROM CITY WHERE name='$tocity'";
		$to_zone_north=($conn->query($sql))->fetch_assoc();


	?>	
	<form style="display: none;">
		<input type="text" readonly name="fromcityx" id="fromcityx" value="<?php echo $fromcitycoord['xcoord'];?>">
		<input type="text" readonly name="fromcityy" id="fromcityy" value="<?php echo $fromcitycoord['ycoord'];?>">
		<input type="text" readonly name="tocityx" id="tocityx" value="<?php echo $tocitycoord['xcoord'];?>">
		<input type="text" readonly name="tocityy" id="tocityy" value="<?php echo $tocitycoord['ycoord'];?>">
		<input type="text" readonly name="method" id="method" value="<?php echo $row1['method'];?>">
		<input type="text" readonly name="diff" id="diff" value="<?php echo $row2['diff'];?>">
		<input type="text" readonly name="fzone" id="fzone" value="<?php echo $from_zone_north['zone']?>">
		<input type="text" readonly name="tzone" id="tzone" value="<?php echo $to_zone_north['zone']?>">
		<input type="text" readonly name="fnorth" id="fnorth" value="<?php echo $from_zone_north['north']?>">
		<input type="text" readonly name="tnorth" id="tnorth" value="<?php echo $to_zone_north['north']?>">
	</form>


	<script>
		var fromcityx = document.getElementById('fromcityx').value;
		var fromcityy = document.getElementById('fromcityy').value;
		var tocityx = document.getElementById('tocityx').value;
		var tocityy = document.getElementById('tocityy').value;
		var	method = document.getElementById('method').value;
		var	diff = document.getElementById('diff').value;
		var fzone=document.getElementById('fzone').value;
		var tzone=document.getElementById('tzone').value;
		var fnorth=document.getElementById('fnorth').value;
		var tnorth=document.getElementById('tnorth').value;	
		var fposition =[parseFloat(fromcityx),parseFloat(fromcityy)];
	    var tposition=[parseFloat(tocityx),parseFloat(tocityy)];
		var pos=[[fposition[0],fposition[1]]];




	if(method=="air")
	{
		pos[2]=[tposition[0],tposition[1]];
		var plane_total=3*86400;
		if (diff < 0){
			window.alert("Shipping has not been initiated.");
		}
		if (diff<plane_total)
		{
			var m = diff/plane_total;
			window.alert("Your order will be delivered in approximately "+parseInt((plane_total-diff)/3600) +" hrs");
		}
		else
		{
			m=1;
			alert("Your order is already delivered.");
		}
		var n = 1-m;
		var x=(m*parseFloat(tposition[0])+n*parseFloat(fposition[0]));
		var y=(m*parseFloat(tposition[1])+n*parseFloat(fposition[1]));
		pos[1]=[x,y];

		
		document.write("<div><img src='../images/worldmap.jpg' alt='The World Map' style='position: absolute;left: 0 px;top:0 px' >");
		document.write("<img src='../images/plane.png' width='20px' style='position: relative;left:"+pos[1][0]+";top:"+pos[1][1]+";'>");
		document.write("</div>");


	}

/*	else if (method=="ship")
	{
		if (tzone>=fzone)
		{
			var i;
			if(fnorth==0 && tnorth==0)
			{
				

									document.write("<div><img src='../images/worldmap.jpg' alt='The World Map' style='position: absolute;left: 0 px;top:0 px' >");
					document.write("<img src='../images/plane.jpeg' width='20px' style='position: relative;left:"+pos[1][0]+";top:"+pos[1][1]+";'>");
					document.write("</div>");
				}
			}
			else if(fnorth==0 && tnorth==1)
			{

			}
			else if(fnorth==1 && tnorth==0)
			{

			}
			else
			{

			}
		}
	}
*/
	if(method=="ship")
	{
		pos[2]=[tposition[0],tposition[1]];
		var ship_total=30*86400;
		if (diff < 0){
			window.alert("Shipping has not been initiated.");
		}
		if (diff<ship_total)
		{
			var m =ship_total-diff;
			window.alert("Your order will be delivered in approximately "+parseInt(m/3600) +" hrs");
		}else{
			alert("Your order is already delivered.");
		}
		
		document.write("<div><img src='../images/worldmap.jpg' alt='The World Map' style='position: absolute;left: 0 px;top:0 px' >");
		document.write("<img src='../images/plane.jpeg' width='20px' style='position: relative;left:"+pos[0][0]+";top:"+pos[0][1]+";'>");
		document.write("<img src='../images/plane.jpeg' width='20px' style='position: relative;left:"+pos[2][0]+";top:"+pos[2][1]+";'>");
		document.write("</div>");

	
	}
	</script>
	<?php include 'footer.php'; ?>
</body>
</html>