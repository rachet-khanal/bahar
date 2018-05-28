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
	//form display for beverage add or edit
	if (isset($_GET["action"])){
		if($_GET["action"]=="edit"){
			
			$stmt=$dbh->prepare("SELECT * FROM beverage WHERE b_id= :catID");
			$stmt->bindParam(":catID",$_GET["b_id"],PDO::PARAM_STR);
			$stmt->execute();
			if($stmt->rowCount()>0){
				$row=$stmt->fetch(PDO::FETCH_OBJ);
			}

		}

	?>
<div class="mainContainer">
		<form method="post" enctype="multipart/form-data" action="submitBeverage.php">
			<ul class="formDesign">
				<li>
					<label for="beverage">Beverage Name</label>
					<input type ="text" name="beverage" value="<?php echo $row->name;?>">
				</li>
				<li>
					<label for="status">Status</label>
					<select name="status">
						<option value="1" <?php echo ($row->status==1)?" selected='selected'":""?>>Active</option>
						<option value="2" <?php echo ($row->status==2)?" selected='selected'":""?>>Inactive</option>
					</select>
				</li>
				<li>
					<label for="Pice">Price</label>
					<input type ="text" name="price" value="<?php echo $row->price;?>">
				</li>
				<li>
					<label for="desc">Description</label>
					<textarea id="desc" size="45" rows="6" cols="40" class="input_style br5" name="desc"><?php echo $row->description?></textarea>
				</li>
				 
				<li>
					<label for="pic">Picture</label>
					
						<input type="file" name="pic" value="<?php $row->picture;?>">
				</li>
				<li>
					<input type="hidden" name="b_id" value="<?php echo $_GET["b_id"]?>">
					<input type="hidden" name="action" value="<?php echo ($_GET["action"]=="edit")?"edit":"add"?>">
					<button name="save" value=1>Save</button>
					<button name="more" value=1> Save &amp Add More</button>
					<input type="button" value="Cancel" onclick="document.location.href='beverage.php'">

				</li>
			</ul>

		</form>
</div>
	<?php
	}
	else{
		//list all categories
		$stmt=$dbh->prepare("SELECT * FROM beverage");
		$stmt->execute();
		$row=$stmt->fetchAll(PDO::FETCH_OBJ);
	?>


<div class="mainContainer">
			<table class="backTable">
				<tr>
					<th>S.No</th>
					<th>Beverage Name</th>
					<th>Description</th>
					<th>Price</th>
					<th>Status</th>
					<th>Picture</th>
					<th>Action</th>
				</tr>
		<?php
		$sn=1;
		foreach($row as $cat){
			?>		
				<tr>

					<td><?php echo $sn;?></td>
					<td><?php echo $cat->name;?></td>
					<td><?php echo $cat->description;?></td>
					<td><?php echo $cat->price;?></td>
					<td><img src="data:image/jpeg;base64,<?php echo base64_encode($cat->picture) ?>" width=100 height=100/></td>
					<td><?php echo ($cat->status==1)? "Active":	"Inactive";?></td>
					<td><a href="?action=edit&b_id=<?php echo $cat->b_id?>">EDIT</a></td>
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