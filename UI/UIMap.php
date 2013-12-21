<?php
session_start();
$polyline = $_SESSION['polyline'];
$_SESSION['ActiveTitle']="MAP";
include 'UIHeader.php';


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"  xmlns:v="urn:schemas-microsoft-com:vml"> 
  <head> 
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/> 
    <title>Search Route</title> 
    <script src=" http://maps.google.com/?file=api&amp;v=2.x&amp;key=ABQIAAAA8laxXUrtQBlbFEmCrLPLrxS6De0WAb7eTmmFyEwZ9fFZGvsEaRQdEtov_zwx0w3ZkHBTAOKNUZqhIw"
      type="text/javascript"></script> 
          <script src="http://www.google.com/uds/api?file=uds.js&amp;v=1.0" type="text/javascript"></script> 
    <script src="http://www.google.com/uds/solutions/localsearch/gmlocalsearch.js" type="text/javascript"></script>
      
    <style type="text/css"> 
      body {
        font-family: Verdana, Arial, sans serif;
        font-size: 11px;
        margin: 2px;
      }
      table.directions th {
	background-color:#EEEEEE;
      }
	  
      img {
        color: #000000;
      }
    </style> 
    <script type="text/javascript"> 
 //<![CDATA[
    var map;
    var gdir;
    var geocoder = null;
    var addressMarker;
    
    var iconBlue = new GIcon();
	iconBlue.image = 'http://labs.google.com/ridefinder/images/mm_20_blue.png';
	iconBlue.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
	iconBlue.iconSize = new GSize(12, 20);
	iconBlue.shadowSize = new GSize(22, 20);
	iconBlue.iconAnchor = new GPoint(6, 20);
	iconBlue.infoWindowAnchor = new GPoint(5, 1);
	
	var iconRed = new GIcon();
	iconRed.image = 'http://labs.google.com/ridefinder/images/mm_20_red.png';
	iconRed.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
	iconRed.iconSize = new GSize(12, 20);
	iconRed.shadowSize = new GSize(22, 20);
	iconRed.iconAnchor = new GPoint(6, 20);
	iconRed.infoWindowAnchor = new GPoint(5, 1);
	
	var customIcons = [];
	customIcons["restaurant"] = iconBlue;
	customIcons["bar"] = iconRed;
	var gmarkers = [];
 
    function initialize() {
      if (GBrowserIsCompatible()) {      
        map = new GMap2(document.getElementById("map_canvas"));
        map.addControl(new GLargeMapControl());
		map.addControl(new GMapTypeControl());
        gdir = new GDirections(map, document.getElementById("directions"));
        GEvent.addListener(gdir, "load", onGDirectionsLoad);
        GEvent.addListener(gdir, "error", handleErrors);
        
        setDirections("Vasteras", "Stockholm", "en_US");
        map.setCenter(new GLatLng(59.7547484,17.213832), 5);
		GDownloadUrl("../BSO/BSO_GenXML.php", function(data) {
			var xml = GXml.parse(data);
			var markers = xml.documentElement.getElementsByTagName("marker");
			
			for (var i = 0; i < markers.length; i++) {
				var name = markers[i].getAttribute("name");
				var address = markers[i].getAttribute("address");
				var type = markers[i].getAttribute("type");
				var point = new GLatLng(parseFloat(markers[i].getAttribute("lat")),
				parseFloat(markers[i].getAttribute("lng")));
				var marker = createMarker(point, name, address, type);	
				gmarkers.push(marker); 

				map.addOverlay(marker);			
			}
			
			var xml = GXml.parse(data);
			var polylines = xml.documentElement.getElementsByTagName("polyline");
			for (var i = 0; i < polylines.length; i++) {
			
				var name = polylines[i].getAttribute("name");
				var address = polylines[i].getAttribute("address");
				var type = polylines[i].getAttribute("type");
				var length = polylines[i].getAttribute("length");
				var line="" ;
				var coordinates=[] ;
				//alert('Display ' +polylines.length +name +address +type +length +line);
				//alert('length = ' +length);
				for(var j =0; j< length; j++){
					//alert('im n the loop' +line);
					coordinates[j] = new GLatLng (parseFloat(polylines[i].getAttribute("cooLat"+j)),
					parseFloat(polylines[i].getAttribute("cooLng"+j)));
					//alert(coordinates);
					var temp = "new GLatLng" +coordinates;
					line = line + temp;
					if(j<(length-1)){
						line = line + ", \n"
					}
				}
				//alert(line);
				var polylinex = createLine(coordinates, name, address, type);
				gmarkers.push(polylinex);
				//alert('new GPolyline([' +line +'], \"#ff0000\",5)' );	
				//alert(polylinex.getVertex(1));
				map.addOverlay(polylinex);			
			}
		});
		
      }
    }
    function createLine(coordinates, name, address, type){
    	//alert(coordinates);
		var polylinex = new GPolyline(coordinates,"#ff0000", 5, 2 ) ;
		
		var html = "<b>" + name + "</b> <br/>" + address;
		GEvent.addListener(polylinex, 'click', function(coordinates, polylinex) {
		marker.openInfoWindowHtml(coordinates, html);
		});
    	return polylinex;	
    }
    function createMarker(point, name, address, type) {
		var marker = new GMarker(point, customIcons[type]);
		
		var html = "<b>" + name + "</b> <br/>" + address;
		GEvent.addListener(marker, 'click', function() {
		marker.openInfoWindowHtml(html);
		});
		return marker;
		} 
    function setDirections(fromAddress, toAddress, locale) {
      gdir.load("from: " + fromAddress + " to: " + toAddress,
                { "locale": locale });
    }
 
    function handleErrors(){
	   if (gdir.getStatus().code == G_GEO_UNKNOWN_ADDRESS)
	     alert("No corresponding geographic location could be found for one of the specified addresses. This may be due to the fact that the address is relatively new, or it may be incorrect.\nError code: " + gdir.getStatus().code);
	   else if (gdir.getStatus().code == G_GEO_SERVER_ERROR)
	     alert("A geocoding or directions request could not be successfully processed, yet the exact reason for the failure is not known.\n Error code: " + gdir.getStatus().code);
	   
	   else if (gdir.getStatus().code == G_GEO_MISSING_QUERY)
	     alert("The HTTP q parameter was either missing or had no value. For geocoder requests, this means that an empty address was specified as input. For directions requests, this means that no query was specified in the input.\n Error code: " + gdir.getStatus().code);
 
	//   else if (gdir.getStatus().code == G_UNAVAILABLE_ADDRESS)  <--- Doc bug... this is either not defined, or Doc is wrong
	//     alert("The geocode for the given address or the route for the given directions query cannot be returned due to legal or contractual reasons.\n Error code: " + gdir.getStatus().code);
	     
	   else if (gdir.getStatus().code == G_GEO_BAD_KEY)
	     alert("The given key is either invalid or does not match the domain for which it was given. \n Error code: " + gdir.getStatus().code);
 
	   else if (gdir.getStatus().code == G_GEO_BAD_REQUEST)
	     alert("A directions request could not be successfully parsed.\n Error code: " + gdir.getStatus().code);
	    
	   else alert("An unknown error occurred.");
	   
	}
 
	function onGDirectionsLoad(){ 
      // Use this function to access information about the latest load()
      // results.
 
      // e.g.
      // document.getElementById("getStatus").innerHTML = gdir.getStatus().code;
	  // and yada yada yada...
	}
	//]]>
    </script>
 
  </head> 
  <body onload="initialize()" onsubmit="showLocation() return false;" onunload="GUnload()"> 
  <table width="1000" height ="500" border="0" cellpadding="0" cellspacing="0" class="frame" id="Table_01" bgcolor=#E6E6FA>
	  <tr>	  
	  	<td style="width: 0px" height="0" align="center">
	  		Directions  	 	  	
	  	</td>
	  		  	
	  	<td style="width: 10px" align="center">
	  		Map
	  	</td>  	  	
	  	
	  </tr>
	  <tr>
	 	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
	  </tr>
	  
	  <tr>
		 <td valign="top"><div id="directions" style="width: 350px"></div></td>  
	  
	  	<td style="width: 100px" valign="top">
	  	<div id="map_canvas" style="width: 600px; height: 700px"></div>
	  	</td>
	  	
	 </tr>
	
  </table>  
  </body> 
</html> 


<?php
include 'UIFooter.php';
?>
