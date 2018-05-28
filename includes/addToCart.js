$(document).on('click', '.addToCart', function(e){
			
					e.preventDefault();
						$.ajax({
							url:this.href,
							success: function(){
								$(".successBox").html("Successfully added to cart.");
								$(".successBox").fadeIn('slow', function(){
									$(this).delay(2000).fadeOut('slow');
								});

							    
							      
							        $("#dialog").html("");
							        $("#dialog").dialog("open");
							        $("#dialog").load("cart.php", null, function () {
							        $(this).dialog("option", "title", $(this).find('h1').text());
							        $(this).find('h1').remove();
							      
							        });
							        
							   
							}
							
							});
					
					
			});

function addToCart(url){
	var u=url;
$.ajax({
							url:u,
							success: function(){
								$(".successBox").html("Successfully added to cart.");
								$(".successBox").fadeIn('slow', function(){
									$(this).delay(2000).fadeOut('slow');
								});

							}
							});
}