<?php
include("includes/db.php");
if(!isset($_SESSION["user_id"]))
{
	header("location: signin.php");
	exit;
}else{
	try{
		$password = md5($_POST["password"]);
		$stmt = $dbh->prepare("UPDATE frontlogin SET
				password = :Password
				WHERE id =".$_SESSION["user_id"]);
		$stmt->bindParam(":Password",$password,PDO::PARAM_STR);
		$stmt->execute();
		$rs=$stmt->fetch(PDO::FETCH_OBJ);
		if($stmt->errorCode()=="00000")
		{
			echo "Technical error. Please try again";
			exit;
		}else{
			echo "<script type='text/javascript'>alert('success');</script>";
			header("location: index.php");
		

		}



	}catch(PDOException $e)
	{
		echo "Error Occurred. Please Try again. The error message was: ".$ex->getMessage();
		exit;
	}
}
?>