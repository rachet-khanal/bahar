<?php include("includes/header.php");
include("includes/checkLogin.php");
include("includes/pagination.php");

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
	}
	if(isset($_SERVER["QUERY_STRING"])){
		 echo $_SERVER["QUERY_STRING"]="";
	}
	

	//form display for category add or edit
	if (isset($_GET["action"])){
		if($_GET["action"]=="edit"){
			
			$stmt=$dbh->prepare("SELECT * FROM foodmenu WHERE food_id= :foodID");
			$stmt->bindParam(":foodID",$_GET["food_id"],PDO::PARAM_STR);
			$stmt->execute();
			if($stmt->rowCount()>0){
				$row=$stmt->fetch(PDO::FETCH_OBJ);
			}

		}

	?>
<div class="mainContainer">
		<form method="post" enctype="multipart/form-data" action="submitMenu.php">
			<ul class="formDesign">
				<li>
					<label for="foodName">Food Name</label>
					<input type ="text" name="foodName" value="<?php echo $row->name;?>">
				</li>
				<li>
					<label for="foodType">Food Type</label>
					<?php
							$stmt=$dbh->prepare("SELECT * FROM foodtype");
							$stmt->execute();
							if($stmt->rowCount()>0){
								$type=$stmt->fetchAll(PDO::FETCH_OBJ);
							}?>
						<select name="type_name">
                    	<option value="">Select Food Type</option>
                    	<?php
							foreach($type as $t)
		                      {
		                       
		                        $selected= ($row->type_id==$t->type_id)?"selected='selected'":"";
		                       echo "<option  value='".$t->type_id."' $selected>".$t->type."</option>";
		                      }
					?>
						</select>
				</li>
				<li>
					<label for="foodCat">Food Category</label>
					<?php
							$stmt=$dbh->prepare("SELECT * FROM foodcategory");
							$stmt->execute();
							if($stmt->rowCount()>0){
								$cat=$stmt->fetchAll(PDO::FETCH_OBJ);
							}?>
						<select name="foodCat">
                    	<option value="">Select Food Category</option>
                    	<?php
							foreach($cat as $c)
		                      {
		                       
		                        $selected= ($row->cat_id==$c->cat_id)?"selected='selected'":"";
		                       echo "<option  value='".$c->cat_id."' $selected>".$c->category."</option>";
		                      }
					?>
						</select>
				</li>
				<li>
					<label for="status">Status</label>
					<select name="status">
						<option value="1" <?php echo ($row->status==1)?" selected='selected'":""?>>Active</option>
						<option value="2" <?php echo ($row->status==2)?" selected='selected'":""?>>Inactive</option>
					</select>
				</li>
				<li>
					<label for="special">Special</label>
					<select name="special">
						<option value="1" <?php echo ($row->special==1)?" selected='selected'":""?>>Special</option>
						<option value="2" <?php echo ($row->special!=1)?" selected='selected'":""?>>Normal</option>
					</select>
				</li>
				<li>
					<label for="foodPrice">Price</label>
					<input type ="text" name="foodPrice" value="<?php echo $row->price;?>">
				</li>
				<li>
					<label for="foodDesc">Description</label>
					<textarea id="foodDesc" size="45" rows="6" cols="40"  name="foodDesc"><?php echo $row->description?></textarea>
				</li>
				 
				<li>
					<label for="foodPic">Picture</label>
					
						<input type="file" name="foodPic">
				</li>

				<li>
					<input type="hidden" name="food_id" value="<?php echo $_GET["food_id"]?>">
					<input type="hidden" name="action" value="<?php echo ($_GET["action"]=="edit")?"edit":"add"?>">
					<button name="save" value=1>Save</button>
					<button name="more" value=1> Save &amp Add More</button>
					<input type="button" value="Cancel" onclick="document.location.href='menuHandle.php'">

				</li>
				
			</ul>

		</form>
</div>
	<?php
	}
	else{
		$stmt=$dbh->prepare("SELECT f.*, c.category FROM foodmenu f , foodcategory c WHERE f.cat_id=c.cat_id");
		$stmt->execute();
		$totalrecords=$stmt->rowCount();
		//echo $totalrecords;
  	    //$totalrecords = $totrows->rowCount();
		//list all categories
			if(isset($_GET["page"])){ $page = $_GET["page"]; }else{ $page=1; }
					$perpage=4;
					$start_from = ($page-1) * $perpage;
		$stmt=$dbh->prepare("SELECT f.*, c.category FROM foodmenu f , foodcategory c WHERE f.cat_id=c.cat_id LIMIT $start_from, $perpage ");
		$stmt->execute();
		$row=$stmt->fetchAll(PDO::FETCH_OBJ);
	?>


<div class="mainContainer">
			<table class="backTable">
				<tr>
					<th>S.No</th>
					<th>Food Name</th>
					<th>Type</th>
					<th>Category</th>
					<th>Price</th>
					<th>Description</th>
					<th>Status</th>
					<th>Special</th>
					<th> Picture</th>
					<th>Action</th>
				</tr>
		<?php
		$sn=$start_from+1;
		foreach($row as $food){
			?>		
				<tr>

					<td><?php echo $sn;?></td>
					<td><?php echo $food->name;?></td>
					<td><?php echo $food->category;?></td>
					<td>
					<?php
				

								$stmt=$dbh->prepare("SELECT t.type FROM foodtype t WHERE t.type_id=".$food->type_id." ");
								$stmt->execute();
								$type=$stmt->fetch(PDO::FETCH_OBJ);
								echo $type->type;
					?>
					</td>
					<td><?php echo $food->price;?></td>
					<td><?php echo $food->description;?></td>
					<td><?php echo ($food->status==1)? "Active":	"Inactive";?></td>
					<td><?php echo ($food->special==1)? "Special":	" ";?></td>
					<td><img src="data:image/jpeg;base64,<?php echo base64_encode($food->picture) ?>" width=100 height=100/></td>
					<td><a href="?action=edit&food_id=<?php echo $food->food_id?>">EDIT</a></td>
				</tr>

		<?php
		$sn++;
		}
		?>
	<?php
	}
	?>
			</table>
		<div style="margin-top:20px">
			<?php
			echo $_SERVER["QUERY_STRING"];
			$url = $_SERVER["PHP_SELF"]."?".$_SERVER["QUERY_STRING"];
			
			echo pagination($perpage,$url."&",$totalrecords);
			?>
		</div>
</div>