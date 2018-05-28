<?php
include("includes/db.php");
$email = $_POST["emailId"];
if($email == ""){
	echo "Email field required.";
	exit;
}else{

try{
	$stmt = $dbh->prepare("SELECT email FROM frontlogin WHERE email=:email");
	$stmt->bindParam(":email",$email,PDO::PARAM_STR);
	$stmt->execute();
	
	$rs=$stmt->fetch(PDO::FETCH_OBJ);
	if($stmt->rowCount()>0){
	
		$length = 10;
		$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
		$newpassword = md5($randomString);
		
		$stmt = $dbh->prepare("UPDATE frontlogin SET password = '$newpassword' WHERE email=:email");
		$stmt->bindParam(":email",$email,PDO::PARAM_STR);
		$stmt->execute();
		//echo $randomString;
		//echo " Your password has been send to '".$rs->email. "'. " ?><div><a href="signin.php" id="popLink" >Click Here to Log In </a></div><?php 
		$mail=mail($email,"Password Reset", "Your new password is:".$randomString, "FROM:baharrestaurant1@gmail.com"."\r\nContent-Type: text/html;charset=ISO-8859-1\r\n\r\n");

	
		
	}else{
		$message = "Error in changing password";
		echo $message;
		//header("location: signin.php?action=forget_password&message=".$message);
		exit;
	}
}catch(PDOException $ex){
	echo "Error Occurred. Please Try again. The error message was: ".$ex->getMessage();
}
}
?>