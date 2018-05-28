<link rel="stylesheet" href="includes/styleSignin.css">
 <script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript">
	
$(document).on('click', '#submit-login', function(e){

	e.preventDefault();	

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

$(document).on('click', '#submit-forgot', function(e){
	e.preventDefault();	
	var emailId = $("#passwordemailId").val();

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

$(document).on('click', '.formToggle a', function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});




</script>

<div class="container">
  <div class="info">
    <h1>Admin Login</h1>
  </div>
  <div class="error "> </div>
</div>

<div class="form">
	 <div class="thumbnail"><img src="assets/logo300x100.png"/></div>
	<form method="post" class="passwordForm" name= "forget_password"action="submitPassword.php">
		<h1>Forgot Password</h1>
		<div>
			<input type="email" required="required" placeholder="Email ID" id="passwordemailId" name="emailId" />
			<input type="button" id="submit-forgot" value="Submit" name="submit" />
		</div>
		<div class="formToggle"><a href="#" >Sign-in</a></div>
	
	
	</form>
	

		<form method="post" class="loginForm" name="login" action="submitSignin.php">
			<h1>Login Form</h1>
			<div>
				<input type="email" placeholder="Email ID" required="required" id="emailId" name="emailId" />
			</div>
			<div>
				<input type="password" placeholder="Password" required="" id="password" name="password"/>
			</div>
			<div>
				<input type="submit" id="submit-login" value="Log in" name="submit" /></br>
				<div class="formToggle"><a href="#">Lost your password?</a></div>
				
			</div>
		</form>
</div>
