<?php
include("includes/header.php");
//include("includes/db.php");
include("includes/checkLogin.php");

//echo"here";
//echo $_SESSION["admin_id"] ;
include("includes/cartDiagram.php");
?>
<div class="mainContainer">

    <div id="chart_div">Loading Diagram..</div>
    <div>
		<?php 
			$stmt=$dbh->prepare("SELECT * FROM adminlogin");
			$stmt->execute();
			$total=$stmt->rowCount();
			echo "Total Admins:".$total;
		?>
	
	</div>
	<div>
		<?php 
			$stmt=$dbh->prepare("SELECT * FROM frontlogin");
			$stmt->execute();
			$total=$stmt->rowCount();
			echo "Total Users:".$total;
		?>
	
	</div>
</div>

