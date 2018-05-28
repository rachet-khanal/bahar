<!DOCTYPE html>

<html>
<head>
	<title> Bahar  Afghan & Persian Cuisine</title>
	<meta charst="utf-8"/>
	<meta name="description" content=" Bahar resturant, one of the well reputed restaurant in Merrylands Sydney. We specialise in serving Afghan Cuisine and Persian Cuisine"/>
	<meta name="robot" content="index,follow"/>
	<meta name="keywords" content="Afghan cuisine, Persian cuisine, kebabs, merrylands, sydney, restaurant, Afghan food"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" type="text/css" href="includes/styles.css">
	<link rel="stylesheet" type="text/css" href="includes/normalize.css">
	<link rel="stylesheet" type="text/css" href="includes/fancybox.css">
	<link rel="stylesheet" type="text/css" href="includes/lightbox.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/redmond/jquery-ui.css">
	<link href="https://fonts.googleapis.com/css?family=Merienda+One" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet"> 
	
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  	<script src="includes/malsup.js"></script>
	<script src="includes/malsup-center.js"></script>
	<script src="includes/lightbox.js"></script>
	<script src="includes/dialogBox.js"></script>
	<script src="includes/addToCart.js"></script>
  <!--<script src="http://malsup.github.io/jquery.cycle2.js"></script>-->

	


</head>
<?php
include("includes/db.php");
?>

<body>

<script type="text/javascript">
$(document).ready(function () {
	 $( "#datepicker1" ).datepicker( {minDate:0});
});
</script>

	<div class="body">
	
	 <div class="hfBackground"> 
	 <div class="width">	
		<header class="header">
		
			<div class="headWrapper">	
					<div style="cursor: pointer;" onclick="window.location='index.php';" class="brandName"></div>
					<!--
					<img src="assets/logo300x100.png" style="width:auto;">
				</picture>-->
				<nav class="navigator">
					<ul class= "social">
						
						<li><a href="cart.php" class="dialogOpen"><img src="assets/cart.png" width=25px height=20px/></a></li>
						<li><a href="https://www.facebook.com/baharsydneyrestaurant/"><img src="assets/facebook.png" width=25px height=20px/></a></li>
						<li><a href="https://www.twitter.com/baharrestaurant"><img src="assets/twitter.png" width=25px height=20px/></a></li>
						<li><a href="https://www.instagram.com/bahar__restaurant/"><img src="assets/insta.png" width=25px height=20px/></a></li>
						<li><a style=" color:white;" class="dialogOpen">
						<?php
							if(!isset($_SESSION["user_id"]))
							{
								echo'<li><a href="signin.php" style=" " class="dialogOpen">SIGN IN</a></li>';
							}
							else{
								echo '<li class="dropDown">
										<a href="accountDetail.php" style=" ">'.$_SESSION["fullName"].'</a>
										<ul>
											<li><a href="accountDetail.php" style=" "> Account Details</a></li>
											<li><a href="signout.php" style=" "> Sign Out</a></li>
										</ul>
										</li>';
							}
							?>
							</a></li>
						
					</ul>

					<ul class="navPannel">
						<li><a href="menu.php"> Menu</a></li>
						<li><a href="beverage.php"> Beverage</a></li>
						<li><a href="about-us.php"> About US</a></li>
						<li><a href="gallery.php"> Gallery</a></li>
					</ul>

					
				</nav>
			</div>
		
		</header>
		</div>
		<div class="headerTop"><div class="width">
			<div class="easyNav">
				<div> Call 02-8677-7335 or Make </div> 
				<div>
					<a href="menu.php" class="blue_btn_radius" style="max-width:120px; margin-right:10px;"> Online Order</a>
					<button id="reserveBtn2" class="blue_btn_radius" style="max-width:100px;">Reservation</button>
				</div>
			</div></div>
		</div>
		</div>
		<div id="dialog"></div>
		
		<?php $self= basename($_SERVER["SCRIPT_FILENAME"], '.php');
			if($self!="menu" && $self!="beverage"){
		;?>
		<script type="text/javascript">
			$(".slideshow").cycle();
		</script>

				<div class="slideshow" 
				    data-cycle-fx="scrollHorz"
				    data-cycle-auto-height="6:2"
				    data-cycle-timeout="4000"	
				    data-cycle-center-horz="true"
				    data-cycle-center-vert="true"
				    data-cycle-speed="1000"

				 
				    >  <!-- style="height:380px;"-->
				   
				    <img src="uploads/1.jpg" >
				    <img src="uploads/2.jpg" >
				    <img src="uploads/3.jpg" >
				     <img src="uploads/4.jpg" >
				     	
				    
				    <div class="cycle-pager"></div>
				</div>
			<?php }
			?>
		<div class="presentation">
	  <div class="mainContainer">
	  	<div class="containerHead"></div>
		<div class="subBody row" > 
		<div class="successBox"></div>
