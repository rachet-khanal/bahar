<?php

try{
	extract($_POST);
	if($email==null){
		$email="baharrestaurant1@gmail.com";
	}
	if($subject==null){
		$subject="Contact Form Message";
	}
	$mail=mail("rachet.khanal@gmail.com",$subject, $message, "FROM:".$email."\r\nContent-Type: text/html;charset=ISO-8859-1\r\n\r\n");
    if($mail){echo "success";}else{echo "Sorry error occured please try again.";}
}catch(PDOException $e)
{
	echo "Error Occurred. Please Try again. The error message was: ".$ex->getMessage();
	exit;
}

?>