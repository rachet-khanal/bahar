<?php include("includes/header.php");?>


<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCyUJphDHBPfAP7EvHb5uSw46_fFDrnaTI&callback=initialize"></script>


	<script>
	var myCenter=new google.maps.LatLng(-33.836703,150.9872513);

	function initialize()
	{
	var mapProp = {
	  center:myCenter,
	  zoom:15,
	  mapTypeId:google.maps.MapTypeId.ROADMAP
	  };

	var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

	var marker=new google.maps.Marker({
	  position:myCenter,
	  });

	marker.setMap(map);
	}

	google.maps.event.addDomListener(window, 'load', initialize);
	</script>
<!-- end google map control-->


<script type="text/javascript">


$(document).ready(function(){
	  $("#mail").button().click(function(){
	  	 	var name=$("#contactName").val();;
	  	 	var email=$("#contactEmail").val();
	  	 	var message="Name: "+name+"</br>"+$("#contactMessage").val();

              $.ajax({ 
              	url : "mail.php",
              data : {email:email,message:message},
              type : "POST",
              	beforeSend :function(){
              	$(".loader").show();
              	var name = $("#name").val();;
                  var email = $("#email").val();
                   var message = $("#message").val();
                 if(name == "" || email == ""|| message == ""){
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
        alert("Mail sent");     
	  });
	  
    });
</script>




		<div class="row" style="padding:20px; ">
			<div style="width:49%; padding-right:1px;">
				<p>CONTACT:</p>
				<p>PHONE NUMBER - (02)-8677-7335</p>
				<p>ADDRESS - 194 Merrylands Road, Mettylands, NSW</p>
				<p>EMAIL - baharrestaurant1@gmail.com</p>
				<p> Contact us trough the phone number or submit the form below.</p>
			</div>
				
			<img src="uploads/bahar3.gif" alt="about us" height=250px style="width:50%">
			 <div class="map" style="width:50%" height=250px>
	  		  <div id="googleMap" style="height:250px;"></div>
 			</div>
			<div  style="width:49%; padding-right:1px;" id="contact">
	        	<form id="contactForm" action="mail.php" method="post" >
	        		<ul class="formDesign">
			            <li class="row">
			                <label for="contactName">Name</label>
			                <input type="text" name="contactName" id="contactName" value="" placeholder="Name"/>
			                <label for="contactEmail">Email</label>
			                <input type="email" name="contactEmail" id="contactEmail" placeholder="example@example.com"/>
			            </li>
			            
			            <li>
							<label for="contactMessage">Message</label>
			                <textarea rows="8" cols="50" name="contactMessage" id="contactMessage" value="Message" placeholder="Enter your message"></textarea>
			            </li>
			            <li>
			                <input type="button" id="mail" name="Submit" value="Submit"/>
			            </li>
		        	</ul>
	            </form>
	        </div>
	    </div>
			
	
<?php include("includes/footer.php");?>
