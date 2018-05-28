<?php include("includes/header.php");
include("includes/checkLogin.php");

?>


	<!--setting message div and deleting message after show-->
	<?php 
	if(isset($_SESSION["success_message"])){?>
		<div><?php echo $_SESSION["success_message"]?></div>
		<?php unset($_SESSION["success_message"]);
	}
	if(isset($_SESSION["error_message"])){?>
		<div><?php echo $_SESSION["error_message"]?></div>
		<?php unset($_SESSION["error_message"]);
	}?>
	<?php 
	//form display for category add or edit
	if (isset($_GET["action"])){
		if($_GET["action"]=="edit"){
			
			$stmt=$dbh->prepare("SELECT * FROM foodcategory WHERE cat_id= :catID");
			$stmt->bindParam(":catID",$_GET["cat_id"],PDO::PARAM_STR);
			$stmt->execute();
			if($stmt->rowCount()>0){
				$row=$stmt->fetch(PDO::FETCH_OBJ);
			}

		}

	?>
<div class="mainContainer">
		<form method="post" action="submitCategory.php">
			<ul class="formDesign">
				<li>
					<label for="category">Category Name</label>
					<input type ="text" name="category" value="<?php echo $row->category;?>">
				</li>
				<li>
					<label for="status">Status</label>
					<select name="status">
						<option value="1" <?php echo ($row->status==1)?" selected='selected'":""?>>Active</option>
						<option value="2" <?php echo ($row->status==2)?" selected='selected'":""?>>Inactive</option>
					</select>
				</li>
				<li>
					<input type="hidden" name="cat_id" value="<?php echo $_GET["cat_id"]?>">
					<input type="hidden" name="action" value="<?php echo ($_GET["action"]=="edit")?"edit":"add"?>">
					<button name="save" value=1>Save</button>
					<button name="more" value=1> Save &amp Add More</button>
					<input type="button" value="Cancel" onclick="document.location.href='menuCategory.php'">

				</li>
			</ul>

		</form>
</div>
	<?php
	}
	else{
		//list all categories
		$stmt=$dbh->prepare("SELECT * FROM foodcategory");
		$stmt->execute();
		$row=$stmt->fetchAll(PDO::FETCH_OBJ);
	?>


<div class="mainContainer">
			<table class="backTable">
				<tr>
					<th>S.No</th>
					<th>Category Name</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
		<?php
		$sn=1;
		foreach($row as $cat){
			?>		
				<tr>

					<td><?php echo $sn;?></td>
					<td><?php echo $cat->category;?></td>
					<td><?php echo ($cat->status==1)? "Active":	"Inactive";?></td>
					<td><a href="?action=edit&cat_id=<?php echo $cat->cat_id?>">EDIT</a></td>
				</tr>

		<?php
		$sn++;
		}
		?>
	<?php
	}
	?>
			</table>
</div>