<!DOCTYPE html>

<html>
<head>
	<title> Bahar  Admin Pannel</title>
	<meta charst="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" type="text/css" href="includes/styles.css">
	<link rel="stylesheet" type="text/css" href="includes/normalize.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>
<?php
include("includes/db.php");
?>

<body class="body">


		<header class="header">
		<div class="mainContainer">
				
				<!--
				<img src="assets/logo300x100.png" style="width:auto;">
			</picture>-->
			<nav class="navigator">
				<div style="cursor: pointer;" onclick="window.location='index.php';" class="brandName"></div>
				 <ul id="menu">
				    <li><a href="index.php"> Dashboard </a></li>
				    <li><a href="menuHandle.php"> Menu </a>
				      <ul>
				        <li><a href="menuHandle.php"> List Menu </a></li>
				        <li><a href="menuHandle.php?action=add"> Add A Item </a></li>
				      </ul>
				    </li>
				    <li><a href="menuCategory.php"> Category </a>
				      <ul>
				        <li><a href="menuCategory.php"> List Menu </a></li>
				        <li><a href="menuCategory.php?action=add"> Add A Item </a></li>
				      </ul>
				    </li>
				    <li><a href="beverage.php"> Beverage </a>
				      <ul>
				        <li><a href="beverage.php"> List Beverage </a></li>
				        <li><a href="beverage.php?action=add"> Add A Item </a></li>
				      </ul>
				    </li>
				     <li><a href="mail.php"> Mail </a></li>
				     <?php
				     if ($_SESSION["admin_id"]!=null){
				     	echo "<li><a href='accountDetail.php'>";
				     	echo $_SESSION["admin_name"];
				     	echo '</a><ul>
				        <li><a href="signout.php"> Sign out </a></li>';
				     	echo "</ul></li>";
				     }
				     ?>
				  </ul>
			</nav>
		
		</div>
		</header>