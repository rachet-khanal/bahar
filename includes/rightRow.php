<div class="rightContainer">
			<div class="rightBox">
				<h3>OUR SPECIAL</h3>
			
				<div class="cycle-slideshow" 
			    data-cycle-fx="scrollHorz" 
			    data-cycle-timeout="4000"
			    data-cycle-slides="> div"
			    data-cycle-speed="1"

			    >

			<?php
					$stmt = $dbh->prepare("SELECT * FROM foodmenu WHERE special= 1 AND status = 1");
					$stmt->execute();
					if($stmt->rowCount()>0)
						{
							$food = $stmt->fetchAll(PDO::FETCH_OBJ);
							foreach ($food as $item) 
							{ 
			?>
					<div style="width:100% " >
						<div><?php echo $item->name; ?> </div>
						<div style="height:200px; overflow:hidden">
							<img src="data:image/jpeg;base64,<?php echo base64_encode($item->picture) ;?>" />
						</div>
						<div style="padding:10px; font-size:.85em; min-height:120px; max-height:120px; overflow:hidden;"> <?php echo $item->description; ?> </div>
						<div> AUD <?php echo $item->price; ?> </div>
						<button onclick="addToCart('cart.php?add=<?php echo $item->food_id ?>');" style="width:80%; margin:10px 20px;" id="" class="addToCart blue_btn_radius">ADD TO CART</button>
					</div>
					

				
			<?php
							}
					}
			?>
				</div>
			</div>
			<div class="rightBox">
				<h3>RESERVATION</h3>
				<form method="GET" action="reservation.php">
					
	                            <input type="text" id="datepicker1" Name="datepicker" placeholder="Pick a date" value="<?php echo $date;?>" style="width:130px"/>
	                            <span style="color:red;"><?php echo $date_err;?></span></br>
								<select class="selectBox" id="hour1" Name="hour" style="background-color:#eeeeee;width:65px">
	                                <option value="">Hour</option>
	                                <option value="8:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "8:00") {echo "selected";} ?>>8:00 </option>
	                                <option value="9:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "9:00") {echo "selected";} ?>>9:00 </option>
	                                <option value="10:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "10:00") {echo "selected";} ?>>10:00 </option>
	                                <option value="11:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "11:00") {echo "selected";} ?>>11:00 </option>
	                                <option value="12:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "12:00") {echo "selected";} ?>>12:00 </option>
	                                <option value="13:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "13:00") {echo "selected";} ?>>13:00 </option>
	                                <option value="14:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "14:00") {echo "selected";} ?>>14:00 </option>
	                                <option value="15:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "15:00") {echo "selected";} ?>>15:00 </option>
	                                <option value="16:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "16:00") {echo "selected";} ?>>16:00 </option>
	                                <option value="17:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "17:00") {echo "selected";} ?>>17:00 </option>
	                                <option value="18:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "18:00") {echo "selected";} ?>>18:00 </option>
	                                <option value="19:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "19:00") {echo "selected";} ?>>19:00 </option>
	                                <option value="20:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "20:00") {echo "selected";} ?>>20:00 </option>
	                                <option value="21:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "21:00") {echo "selected";} ?>>21:00 </option>
	                                <option value="22:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "22:00") {echo "selected";} ?>>22:00 </option>
	                            </select>
								<select id="min1" class="selectBox" Name="min" style="background-color:#eeeeee;width:60px">
	                                <option value="">Min</option>
	                                <option value="00" <?php if(isset($_POST["min"]) && $_POST["min"] == "00") {echo "selected";} ?>>00</option>
	                                <option value="30" <?php if(isset($_POST["min"]) && $_POST["min"] == "30") {echo "selected";} ?>>30</option>
	                            </select>
	                            <button class="blue_btn_radius " type="button" id="reserveBtn" style="width:80%; margin:10px 20px;">Reserve</button>

				</form>
			</div>
			

		</div>