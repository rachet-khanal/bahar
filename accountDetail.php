<?php

include("includes/header.php");

if(!isset($_SESSION["user_id"]))
{
	header("location: signin.php");
	exit;
}else{

						$stmt = $dbh->prepare("SELECT * FROM frontlogin WHERE id=".$_SESSION["user_id"]);
									$stmt->execute();
									$row = $stmt->fetchAll(PDO::FETCH_OBJ);
									foreach ($row as $rs){
										$name=$rs->fullName;
										$email=$rs->email;
										$phone=$rs->phoneNumber;
									}
									?>

		<?php
			if (isset($_GET['action'])) {
			   if($_GET["action"]=="passwordChange"){?>
			   			
			   			<div class="mainContainer" style=" min-height: 330px; ">
						<form method="post"  action="passwordChange.php">
							<ul class="formDesign" >
								<h1>Change Password</h1>
										<li>	

											<label for="password">Password</label> <input type="password" placeholder="Password" required="" id="password" name="password"/>
										</li>
										<li>
											<label for="rePassword">Retype Password</label> <input type="password" placeholder="Password" required="" id="rePassword" name="rePassword"/>
											<script type="text/javascript">
													var password = document.getElementById("password")
													  , rePassword = document.getElementById("rePassword");

													function validatePassword(){
													  if(password.value != rePassword.value) {
													    rePassword.setCustomValidity("Passwords Don't Match");
													  } else {
													    rePassword.setCustomValidity('');
													  }
													}

													password.onchange = validatePassword;
													rePassword.onkeyup = validatePassword;
											</script>
										</li>
										<div class="error"></div>
										<li>
											<input type="submit" value="Submit" />
										</li>
								</ul>
						</div>
						
						

			<?php
			   }else{
			   		?>
					
					<div style=" min-height: 330px; ">
						<form method="post"  enctype="multipart/form-data"  action="submitDetail.php">
							<ul class="formDesign">
								<li>
									 <label for="fName">Name</label> <input type="text" placeholder="First Name" value="<?php echo $name ?>" required="" id="fName" name="fName" />
								</li>
								<li>
									<label for="emailId">Email ID</label> <input type="email" placeholder="Email ID" value="<?php echo $email ?>" required="" id="emailId" name="emailId" />
								</li>
								<li>
									<label for="phoneNumber">Phone Number</label> <input type="text" placeholder="Phone Number" value="<?php echo $phone ?>" required="" id="phoneNumber" name="phoneNumber"/>
								</li>
								<li>
									<label for="picture">Picture</label> <input type="file" name="picture">
								</li>
								
									<script type="text/javascript">
											var number = document.getElementById("phoneNumber");
											
											function validateNumber(){
												if(isNaN(number.value)){
													number.setCustomValidity("Only numbers accepted in Phone");
												 }else{
													 number.setCustomValidity('');
												 }
												if((number.value).length < 10){
													number.setCustomValidity("10 digits required.");
												 }
												 else if((number.value).length > 10){
													 number.setCustomValidity("Only 10 digits allowed.");
												 }
											}


											number.onchange = validateNumber;

									</script>
								
								
								<li>
									<input type="submit" value="Submit" />
								</li>
							
							</ul>
						</div>
								
			   <?php } 
				



			}else{
			?>


					<div class="mainContainer" style=" min-height: 330px; ">
					<div class="box" style="width:100%;">
					<div style="width:100%; text-align:center; font-size:1.5em; ">Account Details</div>
					<table >
									
									<tr><td>Customer Name</td>
										<td><?php echo $name;?></td>
										
									</tr>
									<tr><td>Email ID</td>
										<td><?php echo $email;?></td>

									</tr>
									<tr> <td>Phone Number</td>
										<td><?php echo $phone;?></td>
									</tr>
									<tr>
										<td>Profile Picture</td>
										<td><img style="width:145px;height:70px;" src="data:image/jpeg;base64,<?php echo base64_encode($rs->picture) ?>" /></td>
									</tr>
					</table>
					<div style="width:100%" style="">

					 <a href="accountDetail.php?action=details">Change Account Details</a>
					 <a href="accountDetail.php?action=passwordChange">Change Account Password</a>
					 <a href="signout.php">Sign Out</a>

					</div>				
				</div>	
				</div>	
			
			

			<?php 
}
?>
	
			<?php
}
include("includes/footer.php");
			?>
