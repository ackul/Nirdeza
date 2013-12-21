<?php
session_start();
//$options = $_SESSION['options'];
$_SESSION['ActiveTitle']="ADDADVICE"; 
$options = $_SESSION['options'];
include 'UIHeader.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
  <head> 
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/> 
    <title>Google Maps JavaScript API Example: Editable Polylines</title> 
    <script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=ABQIAAAA8laxXUrtQBlbFEmCrLPLrxS6De0WAb7eTmmFyEwZ9fFZGvsEaRQdEtov_zwx0w3ZkHBTAOKNUZqhIw"
      type="text/javascript"></script> 
   <style type="text/css"> 
body {
  font-family: Arial, sans serif;
  font-size: 11px;
}
#hand_b {
  width:31px;
  height:31px;
  background-image: url(http://google.com/mapfiles/ms/t/Bsu.png);
}
#hand_b.selected {
  background-image: url(http://google.com/mapfiles/ms/t/Bsd.png);
}
 
#placemark_b {
  width:31px;
  height:31px;
  background-image: url(http://google.com/mapfiles/ms/t/Bmu.png);
}
#placemark_b.selected {
  background-image: url(http://google.com/mapfiles/ms/t/Bmd.png);
}
 
#line_b {
  width:31px;
  height:31px;
  background-image: url(http://google.com/mapfiles/ms/t/Blu.png);
}
#line_b.selected {
  background-image: url(http://google.com/mapfiles/ms/t/Bld.png);
}
 
#shape_b {
  width:31px;
  height:31px;
  background-image: url(http://google.com/mapfiles/ms/t/Bpu.png);
}
#shape_b.selected {
  background-image: url(http://google.com/mapfiles/ms/t/Bpd.png);
}
</style> 
    <script type="text/javascript"> 
//<![CDATA[
var COLORS = [["red", "#ff0000"], ["orange", "#ff8800"], ["green","#008000"],
              ["blue", "#000080"], ["purple", "#800080"]];
var options = {};
var lineCounter_ = 0;
var shapeCounter_ = 0;
var markerCounter_ = 0;
var colorIndex_ = 0;
var featureTable_;
var map;
var i=0;
var latlng = [];
 
function select(buttonId) {
  document.getElementById("hand_b").className="unselected";
  document.getElementById("shape_b").className="unselected";
  document.getElementById("line_b").className="unselected";
  document.getElementById("placemark_b").className="unselected";
  document.getElementById(buttonId).className="selected";
}
 
function stopEditing() {
  select("hand_b");
}
 
function getColor(named) {
  return COLORS[(colorIndex_++) % COLORS.length][named ? 0 : 1];
}
 
function getIcon(color) {
  var icon = new GIcon();
  icon.image = "http://google.com/mapfiles/ms/micons/" + color + ".png";
  icon.iconSize = new GSize(32, 32);
  icon.iconAnchor = new GPoint(15, 32);
  return icon;
}
 
function startShape() {
  select("shape_b");
  var color = getColor(false);
  var polygon = new GPolygon([], color, 2, 0.7, color, 0.2);
  startDrawing(polygon, "Shape " + (++shapeCounter_), function() {
    var cell = this;
    var area = polygon.getArea();
    cell.innerHTML = (Math.round(area / 10000) / 100) + "km<sup>2</sup>";
  }, color);
  
}
 
function startLine() {
  select("line_b");
  var color = getColor(false);
  var line = new GPolyline([], color);
  startDrawing(line, "Line " + (++lineCounter_), function() {
    var cell = this;
    var len = line.getLength();
    cell.innerHTML = (Math.round(len / 10) / 100) + "km";
  }, color);
}
 
function addFeatureEntry(name, color) {
  currentRow_ = document.createElement("tr");
  var colorCell = document.createElement("td");
  currentRow_.appendChild(colorCell);
  colorCell.style.backgroundColor = color;
  colorCell.style.width = "1em";
  var nameCell = document.createElement("td");
  currentRow_.appendChild(nameCell);
  nameCell.innerHTML = name;
  var descriptionCell = document.createElement("td");
  currentRow_.appendChild(descriptionCell);
  featureTable_.appendChild(currentRow_);
  return {desc: descriptionCell, color: colorCell};
}
 var poly;
function startDrawing(poly, name, onUpdate, color) {
  map.addOverlay(poly);
  poly.enableDrawing(options);
  poly.enableEditing({onEvent: "mouseover"});
  poly.disableEditing({onEvent: "mouseout"});
  GEvent.addListener(poly, "endline", function() {
    select("hand_b");
    var cells = addFeatureEntry(name, color);
    GEvent.bind(poly, "lineupdated", cells.desc, onUpdate);
    GEvent.addListener(poly, "click", function(point, poly) {
	i=0;
	latlng = new Array();
	var html = "<table>" +
	             "<tr><td>Name:</td> <td><input type='text' id='name'/> </td> </tr>" +
	             "<tr><td>Address:</td> <td><input type='text' id='address'/></td> </tr>" +
	             "<tr><td>Type:</td> <td><select id='type'>" + 
				 "<option value='Area Advice'>Area Advice</option>" +
	             "<option value='Route Advice'>Route Advice</option>" +
	             "<option value='bar'>Bar</option>" +
	             "<option value='restaurant'>Restaurant</option>" +
	             "</select> </td></tr>" +
	             "<tr><td></td><td><input type='button' value='Save & Close' onclick='savePoly()'/></td></tr>";
	 map.openInfoWindowHtml(point, html);
	 for (i = 0; i < this.getVertexCount(); i++){
	 latlng[i] = this.getVertex(i); }
    });
  });
}
function savePoly(){
      var name = escape(document.getElementById("name").value);
      var address = escape(document.getElementById("address").value);
      var type = document.getElementById("type").value;
      var length = latlng.length;
      var coordinates = "LINESTRING (";
      for (var j=0; j< (latlng.length); j++){
      	 coordinates = coordinates+(latlng[j].lng());
      	 coordinates = coordinates+" ";
      	 coordinates = coordinates+(latlng[j].lat());
      	 if(j < ((latlng.length)-1) ){
      	 coordinates = coordinates+",";}
      }
      coordinates = coordinates+")";
      alert(coordinates);
  var url = "../BSO/BSO_PlaceMarkers.php?name=" + name + "&address=" + address +
                "&type=" + type+ "&length=" +length+ "&latlng=" +latlng+ "&coordinates=" +coordinates ;
      map.closeInfoWindow();
      window.location = url  
} 
 
function placeMarker() {
	  select("placemark_b");
        GEvent.addListener(map, "click", function(overlay, latlng) {
          if (latlng) {
            marker = new GMarker(latlng, {draggable:true});
            GEvent.addListener(marker, "click", function() {
              var html = "<table>" +
                         "<tr><td>Name:</td> <td><input type='text' id='name'/> </td> </tr>" +
                         "<tr><td>Address:</td> <td><input type='text' id='address'/></td> </tr>" +
                         "<tr><td>Type:</td> <td><select id='type'>" +
                         "<?$options?>"+
                         "</select> </td></tr>" +
                         "<tr><td></td><td><input type='button' value='Save & Close' onclick='saveData()'/></td></tr>";

              marker.openInfoWindow(html);
            });
            map.addOverlay(marker);
          }
        });
}
 
    function saveData() {
      var name = escape(document.getElementById("name").value);
      var address = escape(document.getElementById("address").value);
      var type = document.getElementById("type").value;
      var latlng = marker.getLatLng();
      var lat = latlng.lat();
      var lng = latlng.lng();
      alert ('the following data will be saved ' + name +address +type +lat +lng);
      var url = "../BSO/BSO_AddAdvice.php?name=" + name + "&address=" + address +
                "&type=" + type + "&lat=" + lat + "&lng=" + lng;
      marker.closeInfoWindow();
      window.location = url          
    }
 
 
function initialize() {
  if (GBrowserIsCompatible()) {
    map = new GMap2(document.getElementById("map"));
    map.setCenter(new GLatLng(59.648316,16.611328, 16.6113884,59.6475085), 5);
    map.addControl(new GLargeMapControl());
    map.addControl(new GMapTypeControl());
    map.clearOverlays();
    featureTable_ = document.getElementById("featuretbody");
    select("hand_b");
    
  }
}


//]]>
    </script> 
  </head> 
<body onload="initialize()" onunload="GUnload"> 
 
<table><tr style="vertical-align:top"> 
  <td style="width:15em"> 
 
<table><tr> 
<td><div id="hand_b"
	 onclick="stopEditing()"/></td> 
<td><div id="placemark_b"
	 onclick="placeMarker()"/></td> 
<td><div id="line_b"
	 onclick="startLine()"/></td> 
<td><div id="shape_b"
	onclick="startShape()"/></td> 
</tr></table> 
 
    <input type="hidden" id="featuredetails" rows=2> 
    </input> 

     <table id ="featuretable"> 
     <tbody id="featuretbody"></tbody> 
    </table> 
  </td> 
  <td> 
    <!-- The frame used to measure the screen size --> 
    <div id="frame"></div> 
    <div id="map" style="width: 700px; height: 650px"></div> 
  </td> 
</tr></table> 
</body> 
</html> 


<?php
include 'UIFooter.php';
?>
