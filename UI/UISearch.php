<?php
session_start();
$_SESSION['ActiveTitle']="FILTER";
include ('UIHeader.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title>Google Maps AJAX + MySQL/PHP Example</title>
<script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAA8laxXUrtQBlbFEmCrLPLrxS6De0WAb7eTmmFyEwZ9fFZGvsEaRQdEtov_zwx0w3ZkHBTAOKNUZqhIw"
type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[

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

function load() {
	if (GBrowserIsCompatible()) {
		var map = new GMap2(document.getElementById("map"));
		map.addControl(new GSmallMapControl());
		map.addControl(new GMapTypeControl());
		map.setCenter(new GLatLng(47.614495, -122.341861), 13);
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
		});

	}
}
function createMarker(point, name, address, type) {
var marker = new GMarker(point, customIcons[type]);
var html = "<b>" + name + "</b> <br/>" + address;
GEvent.addListener(marker, 'click', function() {
marker.openInfoWindowHtml(html);
});
return marker;
}   
//]]>


     
</script>
</head>

  
<body onload="load()" onunload="GUnload()"> 
    
<table width="800" height ="500" border="1" cellpadding="0" cellspacing="0" class="frame" id="Table_01">

<tr>
<td style="width: 100px" >
<div id="map" style="width: 800px; height: 500px"></div>
</td>

</td>
</tr>

</table>
   <form action="../BSO/BSO_Filter.php" method="post"> 
      &nbsp;&nbsp;&nbsp;&nbsp; bar: <input type="checkbox" id="bar" name="chkbox0" /> &nbsp;&nbsp;
      restaurant: <input type="checkbox" id="restaurant" name="chkbox1" /> &nbsp;&nbsp;
      <input type="Submit" Value="Filter"/>
	<br /> 
    </form>
</body>
</html>

<?php
include ('UIFooter.php')
?>
