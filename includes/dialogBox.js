$(document).ready(function () {
    $("#dialog").dialog({
        autoOpen: false,
        modal: true,
      	width: "auto",
        position: { my: "center-220px", at: "top+180", of: window },
        responsive:true,
        clickOut: true,
        open: function(event,ui) {
            $('.ui-widget-overlay').bind('click', function(event,ui) {         
                $('#dialog').dialog('close');
            });
        },
        Cancel: function (event, ui) {
        $("#dialog").dialog("close").remove();

	}
    });


    $(".ui-dialog-title").css({
        "font-size": +16 + "px"
    });


    $(".dialogOpen").on("click", function (e) {
        e.preventDefault();
        $("#dialog").html("");
        $("#dialog").dialog("open");
        $("#dialog").load(this.href, null, function () {
        $(this).dialog("option", "title", $(this).find('h1').text());
        $(this).find('h1').remove();
        
        });
    });



     $("#reserveBtn").on("click", function (e) {
       var url="reservation.php";
       var hour= $("#hour1").val();
       var min= $("#min1").val();
       var datepicker= $("#datepicker1").val();
 
       									$("#dialog").html("");
									        $("#dialog").dialog("open");
									        $("#dialog").load(url, {hour: hour ,min: min,date: datepicker}, function () {
									        $(this).dialog("option", "title", $(this).find('h1').text());
									        $(this).find('h1').remove();
	 										    $( "#datepicker" ).datepicker( {minDate:0});
									        });
    });

    $("#reserveBtn2").on("click", function (e) {
       var url="reservation.php";
       var hour= $("#hour1").val();
       var min= $("#min1").val();
       var datepicker= $("#datepicker1").val();
 
                        $("#dialog").html("");
                          $("#dialog").dialog("open");
                          $("#dialog").load(url, {hour: hour ,min: min,date: datepicker}, function () {
                          $(this).dialog("option", "title", $(this).find('h1').text());
                          $(this).find('h1').remove();
                          $( "#datepicker" ).datepicker( {minDate:0});
                          });
    });
    
});