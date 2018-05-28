<?php

include("includes/header.php");

if(!isset($_SESSION["admin_id"]))
{
	header("location: signin.php");
	exit;
}else{

						$stmt = $dbh->prepare("SELECT * FROM adminlogin WHERE adminId=".$_SESSION["admin_id"]);
									$stmt->execute();
									$row = $stmt->fetchAll(PDO::FETCH_OBJ);
									foreach ($row as $rs){
										$name=$rs->firstName." ".$rs->lastName;
										$fName=$rs->firstName;
										$lName=$rs->lastName;
										$email=$rs->emailId;
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
						<form method="post"   action="submitDetail.php">
							<ul class="formDesign">
								<li>
									 <label for="fName">First Name</label> <input type="text" placeholder="First Name" value="<?php echo $fName ?>" required="" id="fName" name="fName" />
								</li>
								<li>
									 <label for="lName">Last Name</label> <input type="text" placeholder="First Name" value="<?php echo $lName ?>" required="" id="lName" name="lName" />
								</li>
								<li>
									<label for="emailId">Email ID</label> <input type="email" placeholder="Email ID" value="<?php echo $email ?>" required="" id="emailId" name="emailId" />
								</li>
											
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
									
									<tr><td>Admin Name</td>
										<td><?php echo $name;?></td>
										
									</tr>
									<tr><td>Email ID</td>
										<td><?php echo $email;?></td>

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
