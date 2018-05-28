 <?php include("includes/header.php");?>
<script>
  $(function() {
    $( "#tabs" ).tabs();
    $( ".controlgroup" ).controlgroup();

    
  });

 
 
  



  </script>

	
			<div class="leftContainer">
				
			
			
											
											<div class="row">
												<?php 
													

												  	$stmt = $dbh->prepare("SELECT * FROM beverage WHERE status = 1");
													$stmt->execute();
													if($stmt->rowCount()>0)
															{
															$beverage = $stmt->fetchAll(PDO::FETCH_OBJ);
															foreach ($beverage as $item) { 
													?>
																	<div class="foodContainer">
																	<div class="foodHover">

																			<img src="data:image/jpeg;base64,<?php echo base64_encode($item->picture) ?>" />
																			
																		</div>
																		<div  style="float:left; width:100%; padding:10px;">
																			<div style=" padding:5px; margin:0; line-height:1em; min-width:60%;">
																					<h3 style="color: #824328; line-height:0.5em;"><?php echo $item->name?></h3>
																					<p class="foodDesc">
																					<?php echo $item->description ?>
																				    </p>
																			</div>
																		</div>
																			<div style="width:120px; margin:0 auto;">
																					<p>AUD <?php echo $item->price ?></p>
																					<a href='cart.php?addB=<?php echo $item->b_id ?>'  id="" class="addToCart blue_btn_radius">Buy</a>			
																			</div>
																			
																		</div>
																	
																	
																	<?php } }?>
											</div>	
				
			</div>
			<?php include("includes/rightRow.php");?>

	
<?php include("includes/footer.php");?>