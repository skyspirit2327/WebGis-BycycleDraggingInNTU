
/*
var geojson_object;
function callback(response) {
  geojson_object = response;
  console.log("Returned Geojson")
}


var geojson_object = JSON.parse(geojson_cache)
var pointsSource = new ol.source.GeoJSON({
    'projection': map.getView().getProjection(),
    object: geojson_object
});
*/


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
	  $('#dialog1').modal('show');
  });
  
  $('#cancelBtn').click(function(){
	  $('#dialog1').modal('hide');
  });
  
  $('#confirmBtn').click(function(){

    /* use of ajax*/
    var location=$('#location').val();
    var timeNow=$('#timeNow').val();
    var goTime=$('#goTime').val();  
    console.log(location,timeNow,goTime);
    
    $.ajax({
      url:"./calculate.php",
      type: 'POST',
      data:{"location":location,"timeNow":timeNow,"goTime":goTime},  

      success: function(result) {
        $("#prob").html(result);
        console.log("successfully delivered prob");
        },
      error: function(){
          console.log('ajax error');
        }
    });  


	  $('#dialog1').modal('hide');
	  $('#dialog2').modal('show')
  }); 

  $('#homeBtn').click(function(){
    $('#dialog2').modal('hide');
  }); 
		
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







