<?php
if(isset($_GET["action"]))
{
?>
					<div class="mainContainer" >
						<form method="post"  action="submitTestimony.php">
							<ul class="formDesign" >
								<h1>Post Testimonies</h1>
										<li>	
											<label for="testimony">Write Testimony:</label> 
											<textarea id="testimony" size="70" rows="8" cols="55" name="testimony"></textarea>
										</li>
										
										<div class="error"></div>
										<li>
											<input type="submit" value="Submit" />
										</li>
								</ul>
							</form>
						</div>
<?php
}
else{
?>	


<div class="testimony" style=" ">

<h2>TESTIMONIES</h2>
<div class="row" >
<?php			
$reqUri = 'https://maps.googleapis.com/maps/api/place/details/json?placeid=ChIJZQ1JjC29EmsRzc4sN9ovKIk&key=AIzaSyBI1yxONpjVW6z1_THvoqYXb-mZ9prR3M4&review_summary';
$data = file_get_contents($reqUri);
$data = json_decode($data,true);
foreach ( $data['result']['reviews']as $reviews )
 { if($reviews['rating']>4){ ?> 
				
 							<div class="tesBox">
								<div class="personDetail">
									<?php if($reviews["profile_photo_url"]!=null){?>
											<img src="<?php echo $reviews['profile_photo_url'];?>"/>
									<?php } ?>
									
									<h4><?php echo($reviews["author_name"]); ?></h4>
								</div>
									<div class="tesboxDesc">"<?php echo($reviews["text"]); ?>"</div>
						
							</div>
 	
 <?php }} ?>
</div>
	<div>
					<a style="color:white;" class="dialogOpen">
					<?php
						if(!isset($_SESSION["user_id"]))
						{
							echo'<a href="signin.php" style=" " class="dialogOpen">Add Testimony</a>';
						}
						else{
							echo '<a href="testimonies.php?action=add" class="dialogOpen" >Add Testimony</a>	
								  ';
						}
						?>
					
		</div>
				
<?php
}
?>
</div>
