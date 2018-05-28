<?php
include("includes/db.php");
try{
	$imgData =addslashes(file_get_contents($_FILES['picture']['tmp_name']));
	$name = $_POST["fName"];
	$email = $_POST["emailId"];
	$phoneNumber = $_POST["phoneNumber"];
	if($imgData==""){
		$stmt = $dbh->prepare("UPDATE frontlogin SET
			fullName  = :fname,
			email = :Email,
			phoneNumber = :pnum
			WHERE id =".$_SESSION["user_id"]);
	}
	else{
		$stmt = $dbh->prepare("UPDATE frontlogin SET
			fullName  = :fname,
			email = :Email,
			phoneNumber = :pnum,
			picture='$imgData' 
			WHERE id =".$_SESSION["user_id"]);

	}
	
	$stmt->bindParam(":fname",$name,PDO::PARAM_STR);
	$stmt->bindParam(":Email",$email,PDO::PARAM_STR);
	$stmt->bindParam(":pnum",$phoneNumber,PDO::PARAM_STR);
	$stmt->execute();
	
	if($stmt->errorCode()=="00000")
	{
		echo "Details Updated Successfully";
		exit;
	}else{
			
				
		echo "Technical error. Please try again";
				
				
		}

	
}catch(PDOException $e)
{
	echo "Error Occurred. Please Try again. The error message was: ".$ex->getMessage();
	exit;
}
?>