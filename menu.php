<?php include("includes/header.php");?>
<script>
  $(function() {
    $( "#tabs" ).tabs();
    $( ".controlgroup" ).controlgroup();

    
  		
  });
  

  
  </script>

	
			<div class="leftContainer">
				
								<div id="tabs">
									  <ul>
									  	<?php 	
									  	$stmt = $dbh->prepare("SELECT * FROM foodcategory");
										$stmt->execute();
										if($stmt->rowCount()>0)
												{
												$row = $stmt->fetchAll(PDO::FETCH_OBJ);
												foreach ($row as $rs) { 
										?>
											<li><a href="#tabs-<?php echo $rs->cat_id?>"><?php echo $rs->category?></a></li>
									    	 
									  
											<?php } }?>
									  </ul>
									  
									  <?php
												foreach ($row as $rs) {
													?>

												 <div id="tabs-<?php echo $rs->cat_id?>">
												 	<div class="formDesign" style="margin-left:5px;"> 
												 		
													 		<select   id="selectType" style="margin-bottom:30px;" onchange="window.location.href='menu.php?type='+this.value"> 
													 		<option value="0"> All type</option>
													 		<option value="1" <?php if($_GET['type']==1){echo 'selected="selected"';}?> > Vegeterian</option>
													 		<option value="2" <?php if($_GET['type']==2){echo 'selected="selected"';}?> > Non-veg</option>
													 		<option value="3" <?php if($_GET['type']==3){echo 'selected="selected"';}?> > Omni-veg</option>
													
														 	</select>
													</div>
												   	<div class="row">
													<?php 
									if ($_GET['type']<1 || $_GET['type']>3){
									$stmt = $dbh->prepare("SELECT * FROM foodmenu WHERE cat_id=".$rs->cat_id." AND status = 1");
									}
									else{
								  	$stmt = $dbh->prepare("SELECT * FROM foodmenu WHERE cat_id=".$rs->cat_id." AND type_id=".$_GET['type']." AND status = 1");
								    }
									$stmt->execute();
									if($stmt->rowCount()>0)
											{
											$food = $stmt->fetchAll(PDO::FETCH_OBJ);
											foreach ($food as $item) { 
									?>
													<div class="foodContainer">
												
														<img src="data:image/jpeg;base64,<?php echo base64_encode($item->picture) ?>" />
													
														
													
														<div style=" padding:5px; margin:0; line-height:1em; min-width:60%;">
																<h3 style="color: #824328; line-height:0.5em;"><?php echo $item->name?></h3>
																<p class="foodDesc">
																<?php echo $item->description ?>
															    </p>
														</div>
														<div style="width:120px; margin:0 auto;">
																<p>AUD <?php echo $item->price ?></p>
																<a href='cart.php?add=<?php echo $item->food_id ?>'  id="" class="addToCart blue_btn_radius">Buy</a>			
														</div>
											
													</div>
													<?php } }?>
													</div>	
												
									   			</div>

											<?php
											}
											?>
									</div>
				
			</div>
			<?php include("includes/rightRow.php");?>


	

	


<?php include("includes/footer.php");?>