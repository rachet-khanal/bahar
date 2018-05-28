<?php include("includes/header.php");?>



			<div class="leftContainer"  >

				<div class="wNote">
							<h2> Traditional Afghan & Persian Cusine</h2>
							<p> We provide the best taste of Afghan and Persian homes to sydney. With absolute commitment to service and quality. We place our customers first and value thier feedbacks and opinions.</p>
							
							<div style="width:98%;min-width:98%;">
								<form method="get" action="searchResult.php?&page=1" id="frmMainSearch" >
									<input class="inputquery" name="k" placeholder="Search"></input>
									<input  style="display:none;" type="submit"></input>
								</form>
							</div>
							<div class="row">
							<a href="menu.php">EXPLORE OUR RANGE</a>
							<a href="assets/menu.pdf" target="_blank">Download OUR Menu</a>
							</div>
							
				</div>
				<div style="text-align:center; padding:0.6em;">
						
							<h2>Also Find Us On</h2>
						<ul class="exeLink row">
							<li>
								<a href="https://www.menulog.com.au"><img src="assets/exeLink/menulog.png" alt="Menu Log"/> </a>	
							</li>
							<li>
								<a href="https://www.deliveryhero.com.au" ><img src="assets/exeLink/deliveryhero.png" alt="Delivery Hero"/></a>
							</li>
							<li>
							<a href="https://www.groupon.com.au"><img src="assets/exeLink/groupon.png" alt="Group On"/></a>
							</li>
							<li>
							<a href="https://www.zomato.com/sydney/bahar-merrylands/info"><img src="assets/exeLink/zomato_logo.png" alt="Zomato"/></a>
							</li>
						</ul>
						
				</div>

				<div>
					<?php include("testimonies.php");?>
				</div>
			
			</div>
	
			<?php include("includes/rightRow.php");?>



<?php include("includes/footer.php");?>
