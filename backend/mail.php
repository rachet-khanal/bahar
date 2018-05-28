<?php
include_once("includes/db.php");
include_once("includes/checkLogin.php");
?>

<?php

if($_POST["subject"]!=null){


		$stmt=$dbh->prepare("SELECT email from frontlogin");
		$stmt->execute();
		$row=$stmt->fetchAll(PDO::FETCH_OBJ);
		if($stmt->errorCode()!="00000")	{
								echo "Error: ".$stmt->errorCode();
								}

			try{
			extract($_POST);
			if($email==null){
				$email="baharrestaurant1@gmail.com";
			}
			if($subject==null){
				$subject="Contact Form Message";
			}
			foreach($row as $cEmail){
				$mail=mail($cEmail->email,$subject, $message, "FROM:".$email."\r\nContent-Type: text/html;charset=ISO-8859-1\r\n\r\n");
			}
			
		    if($mail){echo "success";}else{echo "Sorry error occured please try again.";}
			}catch(PDOException $e)
			{
				echo "Error Occurred. Please Try again. The error message was: ".$ex->getMessage();
				exit;
			}
}else{
	include("includes/header.php");
	?>
	<script type="text/javascript">

	function submitMail(){
		//alert(1);
		var subject=$("#subject").val();
		var message=$("textarea#message").val();
		//alert(subject);alert(message);
		$.ajax({
		      method: "POST",
		      url: "mail.php",
		      data:{subject:subject, message:message},
		    success :function(responseText){
		        $(".error").html(responseText);
		        //document.location.href="mail.php";		      
		    }
		    });
		    
		}
	
	</script>
	<div class="mainContainer">
		<h2>Mail Clients for Offers and News</h2>
		<div class="error"></div>
		<ul class="formDesign">
		<li>	<input type="text" id="subject" placeholder="Subject" required name="subject"/></li>
		<li>	<textarea id="message" placeholder="Type Message Here" row="45" required col="50"/></textarea></li>
		<li>	<button onclick="submitMail(); return false;">Submit</button></li>
		</ul>
	</div>
<?php
}


?>