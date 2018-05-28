<?php
include("includes/db.php");
include("includes/checkLogin.php");
try{
extract($_POST);
$imgData =addslashes(file_get_contents($_FILES['adminPic']['tmp_name']));
//add and edit records
if($adminId!=0){

	if($imgData==""){
		$stmt=$dbh->prepare("UPDATE adminlogin SET
		firstName= :afirstName,
		lastName= :alastName,
		adminLevel= :aadminlevel,
		userName= :auserName,
		emailId= :aemailId,
		status = :astatus,
		password=password
		WHERE adminId = :adminId
		");
	}else{
		$stmt=$dbh->prepare("UPDATE adminlogin SET
		firstName= :afirstName,
		lastName= :alastName,
		adminLevel= :aadminlevel,
		userName= :auserName,
		emailId= :aemailId,
		status = :astatus,
		password=password,
		picture='$imgData' 
		WHERE adminId = :adminId
		");
	}
	
}else{
	$stmt=$dbh->prepare("INSERT INTO adminlogin SET
		firstName= :afirstName,
		lastName= :alastName,
		adminLevel= :aadminlevel,
		userName= :auserName,
		emailId= :aemailId,
		status = :astatus,
		password= md5('abcd'),
		picture='$imgData'  
		");
	
}

if($action!="edit")
	{
		$stmt->bindParam(":afirstName",$firstName,PDO::PARAM_STR);
	}else{
		$stmt->bindParam(":adminId",$adminId,PDO::PARAM_STR);
	}
//if($action=="edit"){
//	$stmt->bindParam(":cat_id",$cat_id,PDO::PARAM_STR);
//}
$stmt->bindParam(":afirstName",$firstName,PDO::PARAM_STR);
$stmt->bindParam(":alastName", $lastName, PDO::PARAM_STR);
$stmt->bindParam(":aadminlevel",$level, PDO::PARAM_STR);
$stmt->bindParam(":auserName",$userName, PDO::PARAM_STR);
$stmt->bindParam(":astatus",$status,PDO::PARAM_STR);
$stmt->bindParam(":aemailId",$emailID,PDO::PARAM_STR);
$stmt->execute();

if($stmt->errorCode()=="0000"){
		$_SESSION["success_message"] = "Record Inserted successfully";
		if($more==1)
		{
			header("location: admin.php?action=add");
		}else{
			header("location: admin.php");
		}
		exit;
	}else{
		$_SESSION["error_message"] ="Error in saving records".$stmt->errorInfo();
		header("location: admin.php");
		exit;
	}



}catch(PDOException $e){
	$_SESSION["error_message"] = "Something went wrong!";
	exit;
}

?>
