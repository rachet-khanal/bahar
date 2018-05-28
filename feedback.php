<?php include("includes/header.php");?>


	<script type="text/javascript">


	$(document).ready(function(){
		  $("#feedbackSubmit").click(function(){
		  	 		
	              $.ajax({ 
	              	url : "submitFeedback.php",
	              data : $("#feedbackForm").serialize(),
	              type : "POST",
	              	beforeSend :function(){
	              	$(".loader").show();
	              	var name = $("#name").val();;
	                  var email = $("#email").val();
	                   var feedback = $("#feedback").val();
	                 if(name == "" || email == ""|| feedback == ""){
	                    $(".error").html("Please fill in every field.").show();
	                   $(".error").addClass('ui-state-error');
	                    $(".loader").hide();
	                    return false;
	                  }else{            
	                    return true;
	        
	                  }
	              },
	                     success :function(responseText){
	                $(".loader").hide();
	                if(responseText == "success"){
	                  $(".error").html(responseText),show();
	                }else{
	                  $(".error").html(responseText);
	                  $(".error").show();

	                }
	              }
	            });
	             
		  });
		  
	    });
	</script>





	
	<div class="leftContainer" >
				<div class="loader" style="margin:8% 5%;"></div>
		    <div>
		    	<div class="error"></div>
		        <div>
		        	<form id="feedbackForm" action="submitFeedback.php" method="post" >
		        		<ul class="formDesign">
			            <li class="name">
			                <label for="name">Name</label>
			                <input type="text" name="name" id="name" value="" placeholder="Name"/>
			            </li>
			            <li class="email">
			                <label for="email">Email</label>
			                <input type="text" name="email" id="email" placeholder="example@example.com"/>
			            </li>
			            <label for="feedback">Enter Your Feedback:</label>
			            <li class="feedback">

			                <textarea rows="8" cols="50" name="feedback" id="feedback" value="feedback" placeholder="Enter your feedback"></textarea>
			            </li>
			            <li>
			                <input type="button" id="feedbackSubmit" name="Submit" value="Submit"/>
			            </li>
			            <ul>
		            </form>
		        </div>
		    </div>

		 
		</div>
	<?php include("includes/rightRow.php");?>

	<?php include("includes/footer.php");?>