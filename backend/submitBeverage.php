<?php
include("includes/db.php");
include("includes/checkLogin.php");
try{
extract($_POST);
$imgData =addslashes(file_get_contents($_FILES['pic']['tmp_name']));

//add and edit records
if($b_id!=0){
	if($imgData===""){
	$stmt=$dbh->prepare("UPDATE beverage SET
		name= :bName,
		status = :b_status,
		price= :Price,
		description= :des
		WHERE b_id = :b_id
		");
	}else{
	$stmt=$dbh->prepare("UPDATE beverage SET
		name= :bName,
		status = :b_status,
		price= :Price,
		description= :des,
		picture='$imgData'
		WHERE b_id = :b_id
		");
	}
}else{
	$stmt=$dbh->prepare("INSERT INTO beverage SET
		name=:bName,
		status = :b_status,
		price=:Price,
		description=:des,
		picture='$imgData' 
		");
	
}

if($action!="edit")
	{
		$stmt->bindParam(":bName",$beverage,PDO::PARAM_STR);
	}else{
		$stmt->bindParam(":b_id",$b_id,PDO::PARAM_STR);
	}
//if($action=="edit"){
//	$stmt->bindParam(":cat_id",$cat_id,PDO::PARAM_STR);
//}
$stmt->bindParam(":bName",$beverage,PDO::PARAM_STR);
$stmt->bindParam(":b_status",$status,PDO::PARAM_STR);
$stmt->bindParam(":Price",$price,PDO::PARAM_STR);
$stmt->bindParam(":des",$desc,PDO::PARAM_STR);
echo $foodDesc;
$stmt->execute();

if($stmt->errorCode()=="0000"){
		$_SESSION["success_message"] = "Record Inserted successfully";
		if($more==1)
		{
			header("location: beverage.php?action=add");
		}else{
			header("location: beverage.php");
		}
		exit;
	}else{
		$_SESSION["error_message"] = "Error in saving records".$stmt->errorCode();
		header("location: beverage.php");
		exit;
	}



}catch(PDOException $e){
	$_SESSION["error_message"] = "Something went wrong!";
	exit;
}

?>
