<?php
include("includes/db.php");
if(isset($_GET['food_id'])) {
 
$imgData =addslashes(file_get_contents($_FILES['foodPic']['tmp_name']));
$sql =$dbh->prepare("UPDATE foodmenu SET picture= '$imgData' WHERE food_id=".$_GET['food_id']."");

$sql->execute();

}else{
	$sql =$dbh->prepare("INSERT INTO foodmenu SET picture= '$imgData' WHERE food_id=".$_GET['food_id']."");

$sql->execute();
}
?>
<body>
	arr
<form method="post"  action="viewImage.php?food_id=1" enctype="multipart/form-data">
	<input type="file" name="foodPic">
	<button type="submit"> Upload Image </button>
</form>
</body>