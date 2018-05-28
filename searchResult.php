<?php
include("includes/header.php");
include("includes/pagination.php");
$searchinput=htmlentities($_GET["k"]);
if (isset($_GET["page"])) { $page = $_GET["page"]; } else { $page=1; };
  $perpage=4;
//CALCULATING THE OFFSET FOR QUERY'S LIMIT CLAUSE. IF WE ARE IN FIRST PAGE ane $perpage = 3, $start_from = (1-1)*3 = 0, and so on for different page numbers.
$start_from = ($page-1) * $perpage;

$rawsql = "SELECT *,MATCH(name,description) AGAINST('+".$searchinput."' IN BOOLEAN MODE ) AS relevancy FROM foodmenu WHERE MATCH(name,description) 
	AGAINST('+".$searchinput."' IN BOOLEAN MODE ) order by relevancy DESC, LENGTH(name) ASC ";
$sql = $rawsql." LIMIT $start_from,$perpage";
$stmt = $dbh->prepare($sql);



$stmt->execute();

$f = $stmt->fetchAll(PDO::FETCH_OBJ);

//FIND THE TOTAL NUMBER OF RECORDS, FOR THIS WE USE QUERY WITHOUT LIMIT 
$totrows = $dbh->prepare($rawsql);
$totrows->execute();
$totalrecords = $totrows->rowCount();
?>
    <div class="leftContainer">
    	<div class="results">
        <h2>Search Results</h2>
        <div class="row">
			<?php
			$j=1;
			if($totalrecords<=0){
				echo "No result for this search.". $searchinput;
			}
			
			foreach($f as $res)
			{
				

				$name = $res->name." ";
				
			?>
			<div class="foodContainer">
				<img src="data:image/jpeg;base64,<?php echo base64_encode($res->picture) ?>" />
				<div style=" padding:5px; margin:0; line-height:1em; min-width:60%;">

					<h3 style="color: #824328; line-height:0.5em;"><?php echo $res->name?></h3>
																<p class="foodDesc">
																<?php echo $res->description ?>
															    </p>
				</div>
				<div  style="float:left;  padding:10px;">
					<div style="width:100px; margin:0 auto;">
						<div>

						AUD <?php echo $res->price ?>
						
					</div>
					<a href='cart.php?add=<?php echo $res->food_id ?>'  id="" class="addToCart blue_btn_radius">Buy</a>
					</div>
				</div>
			</div>
            
			<?php
			 $j++;
			}
			?>
           </div> 
       	</div>
       	  <div style="margin-top:20px;">
	<?php
	ini_set("display_errors",1); error_reporting(E_PARSE | E_ERROR | E_WARNING);
	$url = "searchResult.php?k=".$searchinput."&";
	echo pagination($perpage,$url,$totalrecords);
	?>
	</div>
    </div>
  <?php include("includes/rightRow.php");?>
   <?php include("includes/footer.php");?>
   <script type="text/javascript">
   $(function(){
   	$(".result-blocks-plain").click(function(){
   		$(this).find(".result-desc").slideToggle("fast");
   	})
   })
   </script>
