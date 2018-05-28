<?php
include("includes/checkLogin.php");
include("includes/db.php");

try{
extract($_POST);

//add and edit records
if($cat_id!=0){
	$stmt=$dbh->prepare("UPDATE foodCategory SET
		category= :cat,
		status = :cat_status
		WHERE cat_id = :cat_id
		");
}else{
	$stmt=$dbh->prepare("INSERT INTO foodCategory SET
		category= :cat,
		status = :cat_status
		");
	

}

if($action!="edit")
	{
		$stmt->bindParam(":cat",$category,PDO::PARAM_STR);
	}else{
		$stmt->bindParam(":cat_id",$cat_id,PDO::PARAM_STR);
	}
//if($action=="edit"){
//	$stmt->bindParam(":cat_id",$cat_id,PDO::PARAM_STR);
//}

$stmt->bindParam(":cat", $category, PDO::PARAM_STR);
$stmt->bindParam(":cat_status",$status, PDO::PARAM_STR);

$stmt->execute();

if($stmt->errorCode()=="0000"){
		$_SESSION["success_message"] = "Record Inserted successfully";
		if($more==1)
		{
			header("location: menuCategory.php?action=add");
		}else{
			header("location: menuCategory.php");
		}
		exit;
	}else{
		$_SESSION["error_message"] = "Error in saving records".$stmt->errorCode();
		header("location: menuCategory.php");
		exit;
	}

}catch(PDOException $e){
	$_SESSION["error_message"] = "Something went wrong!";
	exit;
}

?>
