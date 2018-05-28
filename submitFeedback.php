<?php
include("includes/db.php");
try{
	extract($_POST);
	
	$stmt = $dbh->prepare("INSERT INTO feedback SET 
		name  = :Name,
		email_id = :Email,
		feedback = :Feedback
		");
	$stmt->bindParam(":Name",$name,PDO::PARAM_STR);
	$stmt->bindParam(":Email",$email,PDO::PARAM_STR);
	$stmt->bindParam(":Feedback",$feedback,PDO::PARAM_STR);
	$stmt->execute();
	if($stmt->errorCode()=="00000")
	{
		echo "Record inserted successfully";
		exit;
	}else{
		echo "Error occured. Please try again.";
		exit;
	}

}catch(PDOException $e)
{
	echo "Error Occurred. Please Try again. The error message was: ".$ex->getMessage();
	exit;
}
?>