<?php
include("includes/db.php");
try{


		if(isset($_SESSION["user_id"])){

			$testimony=$_POST["testimony"];

			$stmt=$dbh->prepare("INSERT INTO testimony(user_id,testimony) VALUES(:user,:test)");
			$stmt->bindParam(":test",$testimony,PDO::PARAM_STR);
			$stmt->bindParam(":user",$_SESSION["user_id"],PDO::PARAM_STR);
			$stmt->execute();
			if($stmt->errorCode()=="00000"){
				echo "Successfully submited the feedback.";
				header("Location: index.php");
			}else{
				echo "Unsuccessful." ;
				print_r($stmt->errorInfo());
			}


		}else{
			echo "here";
		}
}catch(PDOException $ex){
	echo "Technical error";
}
?>
