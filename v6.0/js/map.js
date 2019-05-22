proj4.defs('EPSG:3826', "+title=二度分帶：TWD97 TM2 台灣 +proj=tmerc  +lat_0=0 +lon_0=121 +k=0.9999 +x_0=250000 +y_0=0 +ellps=GRS80 +units=公尺 +no_defs");
proj4.defs('urn:ogc:def:crs:OGC:1.3:CRS:84',  proj4.defs('EPSG:4326'));
proj4.defs('urn:ogc:def:crs:EPSG::3826',      proj4.defs('EPSG:3826'));
ol.proj.proj4.register(proj4);

var init_lat=25.01735792830844;   //25.01735792830844 , 121.5374588887695
var init_lng=121.5374588887695;
var zoom=17;
var user_location=null;
var view = new ol.View({
  center: ol.proj.transform([init_lng, init_lat], 'EPSG:4326', 'EPSG:3857'),
  zoom: zoom,
  minZoom: 16.5,//0,//
  maxZoom: 20,//100,//
  //extent: ol.proj.transformExtent([119.8, 21,122.07, 25.3], 'EPSG:4326', 'EPSG:3857')

 extent: ol.proj.transformExtent([121.533785, 25.014318,121.540285, 25.021718], 'EPSG:4326', 'EPSG:3857')   //緯度：25.021918經度：121.535285
});


var map = new ol.Map({
  layers: [],
  target: 'map',
  view: view,
  interactions: ol.interaction.defaults({ doubleClickZoom: false }),
});

//select feature by alt+click
var selectAltClick = new ol.interaction.Select({
  condition: function(mapBrowserEvent) {
    return ol.events.condition.click(mapBrowserEvent) && ol.events.condition.altKeyOnly(mapBrowserEvent);
  }
});
/*selectAltClick.on('select', function(e) {
  e.selected.forEach(function(feature){
    console.log(feature.getProperties());
  });
});*/
map.addInteraction(selectAltClick);
//delete features
document.addEventListener('keydown', function(evt) {  //use document to handle keybord Event
  if(evt.which==46){     //number of keybord
    selectAltClick.getFeatures().forEach(function(feature){
      selectAltClick.getLayer(feature).getSource().removeFeature(feature);
    });
    selectAltClick.getFeatures().clear();
  }
});

//for Geolocation
/*
var geolocation = new ol.Geolocation({
  tracking: true,
  projection: map.getView().getProjection()
});
geolocation.on('change:position', function() {
  if(user_location==null){
    user_location= geolocation.getPosition();  
    map.getView().setCenter(user_location);
    map.getView().setZoom(14);    
    var q=ol.proj.transform([parseFloat(user_location[0]), parseFloat(user_location[1])],'EPSG:3857','EPSG:4326');
    console.log(user_location,q);
  }  
});/**/

//setting for tile services
var projection = ol.proj.get('EPSG:3857');              //projection
var projectionExtent = projection.getExtent();          //projectionExtent
var size = ol.extent.getWidth(projectionExtent) / 256;  //size
var resolutions = new Array(20);                        //resolutions
var matrixIds = new Array(20);                          //matrixIds
for (var z = 0; z < 20; ++z) {   
    resolutions[z] = size / Math.pow(2, z);
    matrixIds[z] = z;
}



// load json
function loadJsonSourceWithAjax(url){

  var source=new ol.source.Vector({}); 
  var month=$('#month').val();
  var day=$('#day').val();
  var time=$('#time').val();  
  console.log(month,day,time)

  $.ajax({
    url: url, 
    type: 'POST',
    data:{"month":month,"day":day,"time":time}, 
    dataType: "json",

    success: function(geojson){
      console.log(geojson);
      var options={};
      if(
        typeof(geojson.crs                )!='undefined' && 
        typeof(geojson.crs.properties     )!='undefined' && 
        typeof(geojson.crs.properties.name)!='undefined' 
      ){
        options={
          dataProjection: ol.proj.get(geojson.crs.properties.name),    //'EPSG:3826','EPSG:4326'
          featureProjection: ol.proj.get('EPSG:3857'),
        };
      }
      var features = (new ol.format.GeoJSON()).readFeatures(geojson,options);
      source.addFeatures(features);
      console.log(features)
      console.log(features.length);
    }

  });  
  return source;
}



var geojson_object;




var layers = {

    'Google Maps': { 
        'title': 'Google Maps', 
        'type': 'base', 
        'layer': new ol.layer.Tile({ 
            visible:true,
            source: new ol.source.XYZ({
                crossOrigin: 'anonymous',
                url: 'https://mt{0-3}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',
            })
        })
    },
    
    'bike_ntu': {
        'title': 'bike_ntu',
        'type': 'overlay',
        'layer': new ol.layer.Vector({
          visible:false,
          source: geojson_object
      })
    },

    'bike': {
        'title': 'bike',
        'type': 'overlay',
        'layer': new ol.layer.Vector({
          visible:false,
         source: new ol.source.Vector({
                format: new ol.format.GeoJSON(),
                url: './data/bike_ntu.geojson',
            })
         // source:loadJsonSourceWithAjax('./data/bike2.geojson')
        })
    },
    'metroline': {
        'title': '捷運線',
        'type': 'overlay',
        'layer': new ol.layer.Vector({
            visible:true,
            source: new ol.source.Vector({
              format: new ol.format.GeoJSON(),
              url: './data/metroline.geojson',
            })
        })
    }

}
var setLayer=function(key){     //function setLayer(idx)
  for (i = 0; i < Object.keys(layers).length; i++) {
    var tlayer = layers[Object.keys(layers)[i]];
    if (tlayer.type == 'base') 
      layers[Object.keys(layers)[i]].layer.setVisible(Object.keys(layers)[i]==key);    
  }
}

var styles = {
    'metro': [new ol.style.Style({
        image: new ol.style.Circle({
            radius: 5,
            fill: new ol.style.Fill({color: 'black'}),
            stroke: new ol.style.Stroke({
              color: [255,0,0], width: 2
            })
        })
    })],/**/
    'taipei-metro': [new ol.style.Style({
        image: new ol.style.Circle({
            radius: 5,
            fill: new ol.style.Fill({color: 'black'}),
            stroke: new ol.style.Stroke({
              color: [255,0,0], width: 2
            })
        })
    })],
    
    'bike_ntu': [new ol.style.Style({
        image: new ol.style.Icon({
          crossOrigin: 'anonymous',
          src:'https://maps.google.com/mapfiles/ms/icons/red-dot.png'         
        })
    })],
    
    'metroline': [new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: 'rgba(100, 100, 255, 0.9)',
            width: 5,
            lineDash: [4,8]   //line dash pattern [line, space]
        })
    })],
    'county': [new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: 'rgba(100, 100, 200, 0.7)',
            width: 10
        }),
        fill: new ol.style.Fill({
            color: 'rgba(0, 0, 255, 0.3)'
        })
    })]
};

function initLayers() {
  //console.log("layers:",layers[Object.keys(layers)[0]].layer);
  //console.log("layers:",Object.keys(layers)[0].layer);
  for (i = 0; i < Object.keys(layers).length; i++) {
    var tlayer = layers[Object.keys(layers)[i]];
    if (tlayer.type == 'base') {
      $('<div class="radio"><label><input type="radio" class="basecontrol" name="baselayer" id=' + Object.keys(layers)[i] + ' value="' + Object.keys(layers)[i] +'"'+ (i==2?' checked':'')   +' >' + tlayer.title + '</label></div>').appendTo("#baselayerlist");
      //console.log(layers[Object.keys(layers)[i]].title);
      map.addLayer(tlayer.layer);           
    }else if(tlayer.type == 'overlay') {
      $('<div class="checkbox"><label><input type="checkbox" class="overlaycontrol" name="overlayer" value="' + Object.keys(layers)[i] + '">' + tlayer.title + '</label></div>').appendTo("#overlayerlist");
      map.addLayer(tlayer.layer);
      tlayer.layer.setZIndex(10000-i);
      tlayer.layer.setStyle(styleFunction(Object.keys(layers)[i]));
    }
  }
 
}

function styleFunction(stylename) {
  return styles[stylename];
};







initLayers();

function callback(response) {
  geojson_object = response;
  console.log("Returned Geojson")
}


$(function() {
  //baseLayer control
  /*
  console.log(map.getView().calculateExtent(map.getSize()));
  setLayer('Google Maps');
  $("input.basecontrol").change(function() {
    if($(this).is(':checked'))
      setLayer($(this).attr('value'));    
  });
  */
  //overlayLayer control
  /*
  $("input.overlaycontrol").change(function() {
    if($(this).is(':checked')){
      layers[$(this).val()].layer.setVisible(true);
      
      console.log($(this).val());
      if($(this).val()=='bus'){
        layers[$(this).val()].layer.setSource(loadJsonSourceWithAjax("./data/bus.php"));
      }
      //
    }
    else
      layers[$(this).val()].layer.setVisible(false);
  });
  */
  
  $("#chooseBtn").click(function() {

    console.log("Clicked #chooseBtn")
    layers['bike_ntu'].layer.setVisible(true);
    layers['bike_ntu'].layer.setSource(loadJsonSourceWithAjax("./getGeojson.php"));

/* use of ajax
    var month=$('#month').val();
    var day=$('#day').val();
    var time=$('#time').val();  
    console.log(month,day,time)
    
    $.ajax({
      url:"./getGeojson.php",
      type: 'POST',
      data:{"month":month,"day":day,"time":time},  

      success: function(result) {
        console.log(result);
        console.log("success delivered data.");
        },
      error: function(){
          console.log('ajax error');
        }
    });  */ 
    
  });


});
