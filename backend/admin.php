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
	}
	if(isset($_SERVER["QUERY_STRING"])){
		 echo $_SERVER["QUERY_STRING"]="";
	}
	

	//form display for category add or edit
	if (isset($_GET["action"])){
		if($_GET["action"]=="edit"){
			
			$stmt=$dbh->prepare("SELECT * FROM adminlogin WHERE adminId= :adminID");
			$stmt->bindParam(":adminID",$_GET["adminId"],PDO::PARAM_STR);
			$stmt->execute();
			if($stmt->rowCount()>0){
				$row=$stmt->fetch(PDO::FETCH_OBJ);
			}

		}

	?>
<div class="mainContainer">
		<form method="post" enctype="multipart/form-data" action="submitAdmin.php">
			<ul class="formDesign">
				<li>
					<label for="firstName">First Name</label>
					<input type ="text" name="firstName" value="<?php echo $row->firstName;?>">
				</li>
				<li>
					<label for="lastname">Last Name</label>
					<input type ="text" name="lastName" value="<?php echo $row->lastName;?>">
				</li>
				<li>
					<label for="userName">User Name</label>
					<input type ="text" name="userName" value="<?php echo $row->userName;?>">
				</li>
				<li>
					<label for="level">Admin Level</label>
						<select name="level">
                    	<option value="">Select Admin Level</option>
                    	<?php
							for($i=1;$i<3;$i++)
		                      {
		                        $selected= ($row->adminLevel==$i)?"selected='selected'":"";
		                       echo "<option  value='".$i."' $selected>".$i."</option>";
		                      }
					?>
						</select>
				</li>
				<li>
					<label for="emailID">Email ID</label>
					<input type ="text" name="emailID" value="<?php echo $row->emailId;?>">
				</li>
				<li>
					<label for="status">Status</label>
					<select name="status">
						<option value="1" <?php echo ($row->status==1)?" selected='selected'":""?>>Active</option>
						<option value="2" <?php echo ($row->status==2)?" selected='selected'":""?>>Inactive</option>
					</select>
				</li>
				
				 
				<li>
					<label for="adminPic">Picture</label>
					
						<input type="file" name="adminPic">
				</li>

				<li>
					<input type="hidden" name="adminId" value="<?php echo $_GET["adminId"]?>">
					<input type="hidden" name="action" value="<?php echo ($_GET["action"]=="edit")?"edit":"add"?>">
					<button name="save" value=1>Save</button>
					<button name="more" value=1> Save &amp Add More</button>
					<input type="button" value="Cancel" onclick="document.location.href='admin.php'">
				</li>
				
			</ul>

		</form>
</div>
	<?php
	}
	else{
	
		//list all admin
			
		$stmt=$dbh->prepare("SELECT * FROM adminlogin");
		$stmt->execute();
		$row=$stmt->fetchAll(PDO::FETCH_OBJ);
	?>


<div class="mainContainer">
			<table class="backTable">
				<tr>
					<th>S.No</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>User Name</th>
					<th>Admin Level</th>
					<th>Email ID</th>
					<th>Status</th>
					<th>Picture</th>
					<th>Action</th>
				</tr>
		<?php
		$sn=$start_from+1;
		foreach($row as $admin){
			?>		
				<tr>

					<td><?php echo $sn;?></td>
					<td><?php echo $admin->firstName;?></td>
					<td><?php echo $admin->lastName;?></td>
					<td><?php echo $admin->userName;?></td>
					<td><?php echo $admin->adminLevel;?></td>
					<td><?php echo $admin->emailId;?></td>
					<td><?php echo ($admin->status==1)? "Active":	"Inactive";?></td>
					<td><img src="data:image/jpeg;base64,<?php echo base64_encode($admin->picture) ?>" width=100 height=100/></td>
					<td><a href="?action=edit&adminId=<?php echo $admin->adminId?>">EDIT</a></td>
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