
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
	  $('#dialog1').modal('show')
  });
  
  $('#cancelBtn').click(function(){
	  $('#dialog1').modal('hide')
  });
  
  $('#confirmBtn').click(function(){
	  $('#dialog1').modal('hide');
	  $('#dialog2').modal('show')
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







