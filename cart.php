<?php
include_once("includes/db.php");
?>


<script type="text/javascript">
function popLink(url){
		$("#dialog").html("");
        $("#dialog").dialog("open");
        $("#dialog").load(url, null, function () {
        $(this).dialog("option", "title", $(this).find('h1').text());
        $(this).find('h1').remove();
        });


}


	/**
	$(document).on('click', '#popLink1v40', function(e){
	e.preventDefault();
        $("#dialog").html("");
        $("#dialog").dialog("open");
        $("#dialog").load(this.href, null, function () {
        $(this).dialog("option", "title", $(this).find('h1').text());
        $(this).find('h1').remove();
        });
       
});
**/

</script>
<div class="subBody">
	<h1>CART</h1>
	<div class="content" style="flex-flow:column">
	<?php

		if(!isset($_SESSION["tranID"])){

			$hash= substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 15);
			$mdHash= md5($hash);
			$stmt = $dbh->prepare("INSERT INTO transaction SET hashKey= '".$mdHash."';");
			$stmt->execute();
			if($stmt->errorCode()!="00000")				{
							//echo $stmt->errorCode();
						}
			$last_id = $dbh->lastInsertId();
			$_SESSION["tranID"]= $last_id;
		}


$hash= substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 15);
$mdHash= md5($hash);
//echo $hash;
$stmt = $dbh->prepare("UPDATE transaction SET hashKey= '".$mdHash."'WHERE tranID=".$_SESSION["tranID"]);
			$stmt->execute();

		if(!isset($_SESSION["cartID"])){
						$stmt = $dbh->prepare("INSERT INTO cart SET tranID= '".$_SESSION["tranID"]."';");
						$stmt->execute();
						if($stmt->errorCode()!="00000")				{
										echo $stmt->errorCode();
									}
						$last_id = $dbh->lastInsertId();
						$_SESSION["cartID"]= $last_id;
					}
	

		if(isset($_GET['add'])){
			$_SESSION['cart_'.(int)$_GET['add']]+='1';
			if($_SESSION['cart_'.(int)$_GET['add']]=='1'){
				$stmt = $dbh->prepare("SELECT * FROM foodcart WHERE cartID=".$_SESSION["cartID"]." AND foodID=".(int)$_GET['add']);
				$stmt->execute();
				if($stmt->rowCount()==0){
					$stmt = $dbh->prepare("INSERT INTO foodcart1 SET foodID=".(int)$_GET['add'].", cartID=".$_SESSION["cartID"].", foodQuantity=".$_SESSION['cart_'.(int)$_GET['add']]);
					$stmt->execute();
				}else{
					$stmt = $dbh->prepare("UPDATE foodcart1 SET foodQuantity=".$_SESSION['cart_'.(int)$_GET['add']]." WHERE cartID=".$_SESSION["cartID"]." AND foodID=".(int)$_GET['add']);
					$stmt->execute();
				}
				
			}else{
				$stmt = $dbh->prepare("UPDATE foodcart1 SET foodQuantity=".$_SESSION['cart_'.(int)$_GET['add']]." WHERE cartID=".$_SESSION["cartID"]." AND foodID=".(int)$_GET['add']);
				$stmt->execute();
			}
			//header("Location:cart.php");
		}


		if(isset($_GET['remove'])){
			if($_SESSION['cart_'.(int)$_GET['remove']]<'1'){

			}else{
				$_SESSION['cart_'.(int)$_GET['remove']]-='1';
				$stmt = $dbh->prepare("UPDATE foodcart SET foodQuantity=".$_SESSION['cart_'.(int)$_GET['remove']]." WHERE cartID=".$_SESSION["cartID"]." AND foodID=".(int)$_GET['remove']);
				$stmt->execute();	
			}
			

			//header("Location:cart.php");
		}
		if(isset($_GET['delete'])){
			$_SESSION['cart_'.(int)$_GET['delete']]='0';
			$stmt = $dbh->prepare("UPDATE foodcart SET foodQuantity=".$_SESSION['cart_'.(int)$_GET['delete']]." WHERE cartID=".$_SESSION["cartID"]." AND foodID=".(int)$_GET['delete']);
			$stmt->execute();
			//header("Location:cart.php");
		}
		if(isset($_GET['addB'])){
			$_SESSION['cartB_'.(int)$_GET['addB']]+='1';
		}
		if(isset($_GET['removeB'])){
					if($_SESSION['cartB_'.(int)$_GET['removeB']]<'1'){

					}else{
						$_SESSION['cartB_'.(int)$_GET['removeB']]-='1';
					}
		}
		if(isset($_GET['deleteB'])){
					$_SESSION['cartB_'.(int)$_GET['deleteB']]='0';
		}
		


		//session_destroy();
		echo"<table width=100% style='text-align: center'>
					<tr>
						<th> Item Name </th>
						<th> Rate </th>
						<th> Quantity </th>
						<th> Sub Total </th>
						<th> Image </th>
						<th> Action </th>

					</tr>

				";

		foreach ($_SESSION as $name => $value) {
			
			
			if($value>0){
			
					if(substr($name, 0, 5)=='cart_'){
						$id=substr($name, 5, strlen($name)-5);
						
						$stmt = $dbh->prepare("SELECT * FROM foodMenu WHERE food_id=".$id);
						$stmt->execute();
						$row = $stmt->fetchAll(PDO::FETCH_OBJ);
							foreach ($row as $rs) {																				
							$subTotal=$rs->price*$value;
							$numberOfProducts+=$value;						
							echo "<tr><td>".$rs->name."</td><td> AUD ".$rs->price."</td><td>".$value."</td><td> AUD ".$subTotal."</td>";
							?>
							<td><img src="data:image/jpeg;base64,<?php echo base64_encode($rs->picture)?>" height=100px/></td>
							<td>
								<?php $add= "cart.php?add=".$rs->food_id;
									  $rem="cart.php?remove=".$rs->food_id;
									  $del="cart.php?delete=".$rs->food_id;
								 //"popLink" . $numberOfProducts ."v".$rs->food_id 
								?>
								<button class="cartButton" onclick="popLink('<?php echo $add?>');" href='' ><img src="assets/add.png"/></button>
								<button  class="cartButton" type="button" onclick="popLink('<?php echo $rem?>');" href='' value="Remove"><img src="assets/remove.png"/> </button>
								<button  class="cartButton" type="button" onclick="popLink('<?php echo $del?>');" href='' value="Delete" ><img src="assets/del.png"/>  </button>
							</td></tr>
							<?php
						
							$total+=$subTotal;
							}
					}
					
					
			} 
		}include("beverageCart.php");echo"</table>";
		$total=$total+$totalB;
		if($total==0){
						echo"Your cart is empty";
		}else{
			
						echo "<p>Total: AUD ".$total."</p>";

					$stmt = $dbh->prepare("UPDATE cart SET numberOfProducts=".$numberOfProducts." , totalPrice=".$total." WHERE cartID=".$_SESSION["cartID"]);
					$stmt->execute();
					//print_r($stmt->errorInfo());

						?>
						
						<p id="radio">
								<input type="radio" id="pickUp" name="radio" ><label for="pickUp">Pickup</label>
		   						<input type="radio" id="delivery" name="radio" checked="checked"><label for="delivery">Delivery</label>
						</p>
						<p>Note: Delivery Charge is AUD 10.</p>
						  <script>
							  
							  
							    $( "#radio" ).buttonset();
							    $(document).on('click', '#pickUp', function(){
							    
							    	
							    		//$("#paydelivery").value("0");
							    		$('#paydelivery').attr("value", '0');
							    		$(".phoneForm").hide();
							    });
							    $(document).on('click', '#delivery', function(){
							    	
							    		$('#paydelivery').attr("value", '10');
							    });
							    
							
							  </script>
							  	 	
						<div style="display:flex">
						
						<form style="margin-right:10px; " action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
						<input type="hidden" name="cmd" value="_cart">
						<input type="hidden" name="upload" value="1">
						<input type="hidden" name="business" value="dummyShop@gmail.com">-->
						 <!--paypal add item function-->
						 <?php	
						 $message.="<h3>Food List:</h3>";
						foreach ($_SESSION as $name => $value) {
						if($value>0){
							if(substr($name, 0, 5)=='cart_'){
								$id=substr($name, 5, strlen($name)-5);
								
								$stmt = $dbh->prepare("SELECT * FROM foodMenu WHERE food_id=".$id);
								$stmt->execute();
								$row = $stmt->fetchAll(PDO::FETCH_OBJ);

									foreach ($row as $rs) {
									 	$num++;
						 				echo '<input type="hidden" name="item_number_'.$num.'" value="'.$num.'">';
						 				echo '<input type="hidden" name="item_name_'.$num.'" value="'.$rs->name.'">';
						 				echo '<input type="hidden" name="amount_'.$num.'" value="'.$rs->price.'">';
						 				echo '<input type="hidden" name="quantity_'.$num.'" value="'.$value.'">';
						 				$message.="<br/>".$num.". Item Name: ".$rs->name."<br/>Item price: $".$rs->price."<br/>Quantity: ".$value ;
										
									}
							}
								
						}
						}

				 ?>

				 <!--paypalitem end-->
				
				<input id="paydelivery" type="hidden" name="handling_cart" value="10">
				<input type="hidden" name="currency_code" value="AUD">
				<input type="hidden" name="custom" value="<?php echo $hash;?>" >
				<input type="hidden" name="amount" value="<?php echo $total;?>">
				<input type="hidden" name="no_shipping" value="0">
				<input type="hidden" name="notify_url" value="http://110.32.229.148/bahar/frontend/IPNhandler.php">
				<input id="paypalSubmit" type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but03.gif" width=100px name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
				</form>
				
				<button id="cashPay" class="blue_btn_radius" style="height:50px;" onClick="cashPickup()">Confirm Order</button>
				
				<script type="text/javascript">
					var MH="<html><head></head><body><div>";
					var MF="</div></body></html>";
					var number = document.getElementById("delPhone");
					number.onchange = validateNumber;						
											function validateNumber(){
												if(isNaN(number.value)){
													number.setCustomValidity("Only numbers accepted in Phone");
												 }else{
													 number.setCustomValidity('');
												 }
												if((number.value).length < 10){
													number.setCustomValidity("10 digits required.");
												 }
												 else if((number.value).length > 10){
													 number.setCustomValidity("Only 10 digits allowed.");
												 }
											}
					function cashPickup(){
						var delivery=$("#paydelivery").val();
						//alert(delivery);
						if(delivery>0){
							$(".phoneForm").show();
						}
						else{

							sendMail();
						}
						
					}
					function sendMail(){
						var timestamp = new Date().getUTCMilliseconds() + new Date().getMinutes()+ new Date().getHours();
						var message="<?php echo $message;?>";
						var total=<?php echo $total;?>;
						message+="<br/> Order Number: "+timestamp+"<br/>Total AUD "+total;
						message=MH+message+MF;
						alert("Please note this number for pickup: "+timestamp+"\nAnd pay AUD "+total+" at the counter.");
						$.ajax({ 
              	url : "mail.php",
              data : {message:message,subject:"Order Message- Pickup"},
              type : "POST"
              	
					});
					}
					function sendMailPhone(){
						var timestamp = new Date().getUTCMilliseconds() + new Date().getMinutes()+ new Date().getHours();
						var phone=$("#delPhone").val();
						var address=$("#delAddress").val();
						var total=<?php echo $total;?>;
						var message="<?php echo $message;?>";
						message+="<h3>Order Detail</h3><br/>Phone:"+phone+"<br/>Address:"+address+"<br/> Order Number: "+timestamp+"<br/>Total:"+total;
						message=MH+message+MF;
						alert("Your order number is: "+timestamp);
						$.ajax({ 
              	url : "mail.php",
              data : {message:message,subject:"Order Message- Delivery"},
              type : "POST"
              	
					});
					}
				</script>
			</div>
	<div class="phoneForm" style="display:none;">
		<form>
			<p>Please enter your phone number and address. Also please call us on 02-8677-7335</p>
			<input type="text" name="phone" placeholder="10 digits Phone Number" required id="delPhone"/>
			<input type="text" name="address" placeholder="Delivery Address" required id="delAddress"/>
		</form>
			<button onClick="sendMailPhone()">Submit</button>
	
	</div>
	<?php
	}
	?>
</div>

</div>

