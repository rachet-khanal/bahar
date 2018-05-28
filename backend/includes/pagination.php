<?php
include("db.php");

//PHP CODE
function pagination($records_per_page,$url="?",$total_records)
{
 	
 	$page = $_GET["page"];
 
 	$total_pages = ceil($total_records/$records_per_page);
 	$ret ="";
 	/*$ret = "<form method='POST' action='$formaction' id='frmPagination'> ";
 	foreach($_POST as $key=>$value)
 	{
 		$ret .="<input type='hidden' name='".$key."' value='".$value."' />";
 	}*/

 	$ret .="<ul class='pagination'>";

 	
 	if($page>1)
 	{
 		if($page>2){
 		$ret .="<li><a href='".$url."page=1'>First</a></li>";
 	}
 		$prevpage = $page-1;
 		$ret .="<li><a href='".$url."page=".$prevpage."'>Previous</a></li>";
 	}

 	
 	for($i=1;$i<=$total_pages;$i++)
 	{
 		$active = "";
 		if($_GET["page"]==$i)
 		{
 			$ret .="<li><a href='javascript:void(0)' class='current'>".$i."</a></li>";
 		}else{
 			$ret .="<li><a href='".$url."page=".$i."'>".$i."</a></li>";
 		}
 	}
 
 	if($page<$total_pages)
 	{
 		$nextpage = $page+1;
 		$ret .="<li><a href='".$url."page=".$nextpage."'>Next</a></li>";
 	$ret .="<li><a href='".$url."page=".$total_pages."'>Last</a></li>";
 	}
 	$ret .="</ul>";
 	if($total_pages<$perpage) $ret="";
 	return $ret;
}
?>