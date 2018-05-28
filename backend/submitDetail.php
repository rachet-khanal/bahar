<?php
include("includes/db.php");
try{
	$fname = $_POST["fName"];
	$lname = $_POST["lName"];
	$email = $_POST["emailId"];
	
		$stmt = $dbh->prepare("UPDATE adminlogin SET
			firstName  = :fname,
			lastName  = :lname,
			emailId = :Email
			WHERE adminId =".$_SESSION["admin_id"]);
		
	
	$stmt->bindParam(":fname",$fname,PDO::PARAM_STR);
	$stmt->bindParam(":lname",$lname,PDO::PARAM_STR);
	$stmt->bindParam(":Email",$email,PDO::PARAM_STR);
	
	$stmt->execute();
	
	if($stmt->errorCode()=="00000")
	{
		echo "Details Updated Successfully";
		
		exit;
	}else{
			
				
		echo "Technical error. Please try again ".$stmt->errorCode();
				
				
		}

	
}catch(PDOException $e)
{
	echo "Error Occurred. Please Try again. The error message was: ".$ex->getMessage();
	exit;
}
?>