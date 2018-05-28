<?php
include("includes/db.php");

$emailId = $_POST["emailId"];
$password = md5($_POST["password"]);

try{
	$stmt = $dbh->prepare("SELECT * FROM adminlogin WHERE emailId=:EmailID AND password=:Password");
	$stmt->bindParam(":EmailID",$emailId,PDO::PARAM_STR);
	$stmt->bindParam(":Password",$password,PDO::PARAM_STR);
	$stmt->execute();
	
	if($stmt->rowCount()>0)
	{
		$row = $stmt->fetch();
		//$_SESSION["fullName"] = $row["fullName"];
		$_SESSION["admin_id"] = $row["adminId"];
		$_SESSION["email"] = $row["emailId"];
		$_SESSION["admin_name"] = $row["firstName"]." ".$row["lastName"];
		echo "success";

		
		//header("Location: index.php");
		exit;
	}else{
		 
		 echo'Invalid username and/or password'.$_POST["emailId"];
		exit;
	}
}catch(PDOException $ex)
{
	echo "Error Occurred. Please Try again. The error message was: ".$ex->getMessage();
}
?>