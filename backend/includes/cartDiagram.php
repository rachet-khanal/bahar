<?php
$stmt=$dbh->prepare("SELECT t.status,c.dateCreated  FROM transaction T INNER JOIN cart C ON t.tranID=c.tranID");
$stmt->execute();
$row=$stmt->fetchAll(PDO::FETCH_OBJ);
//print_r($stmt->errorInfo());
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Cart');
        <?php
        $pNum=0;
        $cNum=0;
        foreach($row as $r){
        	if($r->status=="pending"){
        		$pNum++;
        	}else{
        		$cNum++;
        	}
        }
        	?>
        	
        	
	        data.addRows([
	
	          ['pending', <?php echo $pNum;?>],
	          ['completed', <?php echo $cNum;?>]
	         
	        ]);
	    
	    
        // Set chart options
        var options = {'title':'Cart success diagram',
                       'width':400,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
