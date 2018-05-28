<?php
include("includes/db.php");
try{
	$fname = $_POST["fName"];
	$lname = $_POST["lName"];
	$email = $_POST["emailId"];
	$phoneNumber = $_POST["phoneNumber"];
	$password = md5($_POST["password"]);

	$stmt = $dbh->prepare("SELECT email FROM frontlogin WHERE email=:EmailID");
	$stmt->bindParam(":EmailID",$email,PDO::PARAM_STR);
	$stmt->execute();
	$stmt->fetch(PDO::FETCH_OBJ);
	if($stmt->errorCode()!="00000")
	{
		echo "Technical error. Please try again";
		exit;
	}else{
			if($stmt->rowCount()>0)
			{
				$message= "Email already exists.".$password;
				echo $message;
				//header('Location: signin.php?action=register&message='.$message);
				exit;
			}else{
				$name=$fname." ".$lname;
				
					$stmt = $dbh->prepare("INSERT INTO frontlogin SET 
								fullName  = :Name,
								email = :Email,
								password = :Password,
								phoneNumber=:Phone
								");
							

							$stmt->bindParam(":Name",$name,PDO::PARAM_STR);
							$stmt->bindParam(":Email",$email,PDO::PARAM_STR);
							$stmt->bindParam(":Password",$password,PDO::PARAM_STR);
							$stmt->bindParam(":Phone",$phoneNumber,PDO::PARAM_STR);
							$stmt->execute();
							if($stmt->errorCode()=="00000")
							{
								$message= "Record inserted successfully";
								echo $message;
								
							}else{
								$message= "Error occured. Please try again.";
								echo $message;
								exit;
							}
							

			}

		}

	
}catch(PDOException $e)
{
	echo "Error Occurred. Please Try again. The error message was: ".$ex->getMessage();
	exit;
}
?>