
<?php



		foreach ($_SESSION as $name => $value) {
			
			
			if($value>0){
					if(substr($name, 0, 6)=='cartB_'){
						$id=substr($name, 6, strlen($name)-6);
						
						$stmt = $dbh->prepare("SELECT * FROM beverage WHERE b_id=".$id);
						$stmt->execute();
						$row = $stmt->fetchAll(PDO::FETCH_OBJ);
							foreach ($row as $rs) {																				
							$subTotalB=$rs->price*$value;
							$numberOfProducts+=$value;						
							echo "<tr><td>".$rs->name."</td><td> AUD ".$rs->price."</td><td>".$value."</td><td> AUD ".$subTotalB."</td>";
							$message.="<br/>".$num.". Beverage Name: ".$rs->name."<br/>Item price: $".$rs->price."<br/>Quantity: ".$value ;
							?>
							<td><img src="data:image/jpeg;base64,<?php echo base64_encode($rs->picture)?>" height=100px/></td>
							<td>
								<?php $addB= "cart.php?addB=".$rs->b_id;
									  $remB="cart.php?removeB=".$rs->b_id;
									  $delB="cart.php?deleteB=".$rs->b_id;
								 //"popLink" . $numberOfProducts ."v".$rs->food_id 
								?>
								<button class="cartButton" onclick="popLink('<?php echo $addB?>');" href='' ><img src="assets/add.png"/></button>
								<button  class="cartButton" type="button" onclick="popLink('<?php echo $remB?>');" href='' value="Remove"><img src="assets/remove.png"/> </button>
								<button  class="cartButton" type="button" onclick="popLink('<?php echo $delB?>');" href='' value="Delete" ><img src="assets/del.png"/>  </button>
							</td></tr>
							<?php
							}
					}
					
					$totalB+=$subTotalB;
					
			} 
		}