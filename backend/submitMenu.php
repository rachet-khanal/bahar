<?php
include("includes/db.php");
include("includes/checkLogin.php");
try{
extract($_POST);
$imgData =addslashes(file_get_contents($_FILES['foodPic']['tmp_name']));
//add and edit records
if($food_id!=0){
	if($imgData==""){
		$stmt=$dbh->prepare("UPDATE foodmenu SET
		name= :foodName,
		cat_id= :cat,
		type_id= :type,
		status = :food_status,
		special=:Special,
		price= :Price,
		description= :des
		WHERE food_id = :food_id
		");
	}else{
		$stmt=$dbh->prepare("UPDATE foodmenu SET
		name= :foodName,
		cat_id= :cat,
		type_id= :type,
		status = :food_status,
		special=:Special,
		price= :Price,
		description= :des,
		picture='$imgData' 
		WHERE food_id = :food_id
		");
	}
	
}else{
	$stmt=$dbh->prepare("INSERT INTO foodmenu SET
		name=:foodName,
		cat_id= :cat,
		type_id= :type,
		status = :food_status,
		special=:Special,
		price=:Price,
		description=:des,
		picture='$imgData' 
		");
	
}

if($action!="edit")
	{
		$stmt->bindParam(":foodName",$foodName,PDO::PARAM_STR);
	}else{
		$stmt->bindParam(":food_id",$food_id,PDO::PARAM_STR);
	}
//if($action=="edit"){
//	$stmt->bindParam(":cat_id",$cat_id,PDO::PARAM_STR);
//}
$stmt->bindParam(":foodName",$foodName,PDO::PARAM_STR);
$stmt->bindParam(":cat", $foodCat, PDO::PARAM_STR);
$stmt->bindParam(":type",$type_name, PDO::PARAM_STR);
$stmt->bindParam(":food_status",$status,PDO::PARAM_STR);
$stmt->bindParam(":Special",$special,PDO::PARAM_STR);
$stmt->bindParam(":Price",$foodPrice,PDO::PARAM_STR);
$stmt->bindParam(":des",$foodDesc,PDO::PARAM_STR);
$stmt->execute();

if($stmt->errorCode()=="0000"){
		$_SESSION["success_message"] = "Record Inserted successfully";
		if($more==1)
		{
			header("location: menuHandle.php?action=add");
		}else{
			header("location: menuHandle.php");
		}
		exit;
	}else{
		$_SESSION["error_message"] = "Error in saving records".$stmt->errorCode();
		header("location: menuHandle.php");
		exit;
	}



}catch(PDOException $e){
	$_SESSION["error_message"] = "Something went wrong!";
	exit;
}

?>
