$(function() {
  $("#nav_layerlist").click(function() {
      $("#sidebar").toggle();
      $("#accordion").accordion("option", { active: 0 });
      updateSize();
  });
  
  $("#btn-hide").click(function() {
      $("#sidebar").hide();
      updateSize();
  });
  
  $('#calBtn').click(function(){
	  $('#dialog1').modal('show')
  });
  
  $('#cancelBtn').click(function(){
	  $('#dialog1').modal('hide')
  });
  /*
  $("#download_all").click(function() {

    
    var getdata="getdata"    
    $.ajax({
      url:"download.php",
      type: 'POST',
      data:{"getdata":getdata},  
      success: function() {       
          console.log("Connected to DB and downloaded data.");
        },
      error: function(){
          console.log('ajax error');
        }
    });
  });
  */
  /*
  $('#chooseBtn').click(function(){
					var month=$('#month').val();
					var day=$('#day').val();
					var time=$('#time').val();

					<?
						require"getGeojson.php"
					?>
					
					
					
					
					});
				});
	*/			
  $(window).resize(function() {
      updateSize();
  });  
});

updateSize();

function updateSize(){
  $("#container").css("height", $(window).height() - $("nav").height());
  $("#accordion").accordion({        //jQuery UI 
      heightStyle: "fill",
  });
   map.updateSize();
  $("#accordion").accordion("refresh");   
}


/*
// get value from myNavbar
//inputGroupSelect01(weekday),02(time in day),03(month)
var weekday=$('#inputGroupSelect01').val();
var inDay=$('#inputGroupSelect02').val();
var month=$('#inputGroupSelect03').val();

$(function() {

  $("#download_all").click(function() {
    
    $.ajax({
    url: "download.php",
    type: 'POST', 
    //post to download.php query selections

    success: function(result) {
          
          console.log("Connected to DB and downloaded data.");
        },
    error: function(){
          console.log('ajax error');
        }
    
    $.get("download.php");


  });

});

*/


