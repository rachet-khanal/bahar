<script type="text/javascript">

$(document).on('click', '#submit-login', function(){
	var emailId = $("#emailId").val();
	var password = $("#password").val();
	//call ajax to verify login
	$.ajax({
			method: "POST",
			url: "submitSignin.php",
			data: { emailId: emailId, password: password },
		success :function(responseText){
			if(responseText=="success"){
				$(".error").html("success");
				document.location.href="index.php";
			}else{
				$(".error").html(responseText);
			}
			
		}
		});
		
});

$(document).off('click', '#submit-forgot').on('click', '#submit-forgot', function(e){
		
	var emailId = $("#emailId").val();

	//call ajax to verify login
	$.ajax({
			method: "POST",
			url: "submitPassword.php",
			data: { emailId: emailId },
		success :function(responseText){
			if(responseText=="success"){
				$(".error").html("success");
				document.location.href="index.php";
			}else{
				$(".error").html(responseText);
			}
			
		}
		});
		
});

$(document).off('click', '#submit-reg').on('click', '#submit-reg', function(e){

	var fName = $("#fName").val();
	var lName = $("#lName").val();
	var phoneNumber = $("#phoneNumber").val();
	var password = $("#password").val();
	var emailId = $("#emailId").val();

	//call ajax to verify login
	$.ajax({
			method: "POST",
			url: "submitReg.php",
			data: { emailId: emailId, fName:fName, lName:lName,phoneNumber:phoneNumber,password:password },
		success :function(responseText){
			if(responseText=="success"){
				$(".error").html("success");
				document.location.href="index.php";
			}else{
				$(".error").html(responseText);
			}
			
		}
		});
		return false;
});

$(document).on('click', '#popLink', function(e){
	e.preventDefault();
        $("#dialog").html("");
        $("#dialog").dialog("open");
        $("#dialog").load(this.href, null, function () {
        $(this).dialog("option", "title", $(this).find('h1').text());
        $(this).find('h1').remove();
        });
});


</script>

<div class="popUp_container" >
<div class="error "> </div>
 <?php 
 
   if (isset($_GET['action'])) {
   if($_GET["action"]=="forget_password"){

?>

	<form method="post"  name= "forget_password" action="submitPassword.php">
		<h1>Forgot Password Form</h1>
		<div>
			<input type="email" required="required" placeholder="Email ID" id="emailId" name="emailId" />
			<input type="button" id="submit-forgot" value="Log in" name="submit" />
		</div>
	
	</form>
	



<?php } elseif ($_GET["action"]=="register") {

?>
	

	<form >
			<h1>Registration Form</h1>
			<div>
				 <label for="fName">First Name</label> <input type="text" placeholder="First Name" required id="fName" name="fName" />
			</div>
			<div>
				<label for="lName">Last Name</label> <input type="text" placeholder="Last Name" required id="lName" name="lName" />
			</div>
			<div>
				<label for="emailId">Email ID</label> <input type="email" placeholder="Email ID" required id="emailId" name="emailId" />
			</div>
			<div>
				<label for="phoneNumber">Phone Number</label> <input type="text" placeholder="Phone Number" required id="phoneNumber" name="phoneNumber"/>
			</div>
			<div>
				<label for="password">Password</label> <input type="password" placeholder="Password" required id="password" name="password"/>
			</div>
			<div>
				<label for="rePassword">Retype Password</label> <input type="password" placeholder="Password" required id="rePassword" name="rePassword"/>
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


							

						var password = document.getElementById("password")
						  , rePassword = document.getElementById("rePassword");

						function validatePassword(){
						  if(password.value != rePassword.value) {
						    rePassword.setCustomValidity("Passwords Don't Match");
						  } else {
						    rePassword.setCustomValidity('');
						  }
						}
						number.onchange = validateNumber;
						password.onchange = validatePassword;
						rePassword.onkeyup = validatePassword;
				</script>
			</div>
			
			<div>
				<input type="submit" id="submit-reg" value="Submit" />
			</div>
			<div class="error"> </div>
		</form>

<?php }}else{?>

	
		<form method="post"  name="login" action="submitSignin.php">
			<h1>Login Form</h1>
			<div>
				<input type="email" placeholder="Email ID" required="required" id="emailId" name="emailId" />
			</div>
			<div>
				<input type="password" placeholder="Password" required="" id="password" name="password"/>
			</div>
			<div>
				<input type="button" id="submit-login" value="Log in" name="submit" /></br>
				<a  id="popLink" href="signin.php?action=forget_password">Lost your password?</a>
				<a  id="popLink" href="signin.php?action=register">Register</a>
			</div>
		</form>

<?php } ?>
</div>