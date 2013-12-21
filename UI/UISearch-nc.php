<?php
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

    function load() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
        map.addControl(new GSmallMapControl());
        map.addControl(new GMapTypeControl());
        map.setCenter(new GLatLng(47.614495, -122.341861), 13);
	map.enableScrollWheelZoom();

        GDownloadUrl("../BSO/BSO_GenXML-nc.php", function(data) {
          var xml = GXml.parse(data);
          var advices = xml.documentElement.getElementsByTagName("advice");
          for (var i = 0; i < advices.length; i++) {
            var name = advices[i].getAttribute("name");
            var point = new GLatLng(parseFloat(advices[i].getAttribute("lat")),
                                    parseFloat(advices[i].getAttribute("lng")));
            var marker = createMarker(point, name, "", "");
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
  <table width="500" height ="500" border="1" cellpadding="0" cellspacing="0" class="frame" id="Table_01">
	  <tr>	  
	  	<td style="width: 10px" height="30" >
	  	<b>Static Information</b>	  	 	  	
	  	</td>
	  	<td style="width: 10px" >
	  	<b>Advice Properties</b>
	  	</td>	  	
	  	<td style="width: 10px" >
	  	<b>  Enter Search Data</b>
	  	<input type="text"/>
	  	<input type="submit" class="submit button" name="Search" value="Search" />
	  	</td>  	
	  </tr>
	  <tr>
	     <td>
		   
	  	</td>
	  	<td style="width: 100px" >
	  	 <?php
		echo "<table border=\"1\" align=\"center\">";
		echo "<tr><th>Feature</th>";
		echo "<th>Value</th></tr>";
		for ( $counter = 10; $counter <= 100; $counter += 10) {
			echo "<tr><td>";
			echo $counter;
			echo "</td><td>";
			echo $counter;
			echo "</td></tr>";
		}
		echo "</table>";
		 ?>
	  	</td>
	  	<td style="width: 100px" >
	  	<div id="map" style="width: 400px; height: 400px"></div>
	  	</td>  	
	  </tr>
	  
	   <tr>
	  	<td style="width: 100px" >
	  	<?php
	  	echo "<input type=\"checkbox\" name=\"Courses[]\" value=\"$rows[Crskey]\">\r\n";
	  	echo"CheckBox Creation";
	  	 ?>	  	
	  	</td>
	  	<td style="width: 100px" >
	  	</td>
	  	<td style="width: 100px" >
	  	<?php
		$values = array('one'=>'Disabled', 'two'=>'Weachaired', 'advert'=>'Advertisement', 'news'=>'News');
		$html_elements = array('before'=>'<span>', 'after'=>'</span><br />', 'label'=>'<label for="test"><b>Some label</b></label><br />');
		
		function dynamic_radio_group($formelement, $values, $html, $def_value = '') {
		    $radio_group = '<div>'."\n";
		    $radio_group .= (!empty($html['label'])) ? $html['label']."\n" : '';
		    
		    if (isset($_REQUEST[$formelement])) {
		        $curr_val = stripslashes($_REQUEST[$formelement]);
		    } elseif (isset($def_value) && !isset($_REQUEST[$formelement])) {
		        $curr_val = $def_value;
		    } else {
		        $curr_val = "";
		    }
		    foreach ($values as $key => $val) {
		        $radio_group .= $html['before']."\n";
		        $radio_group .= '<input name="'.$formelement.'" type="radio" value="'.$key.'"';
		        $radio_group .= ($curr_val == $key) ? ' checked="checked" />' : ' />';
		        $radio_group .= ' '.$val."\n".$html['after']."\n";
		    }
		    $radio_group .= '</div>'."\n";
		    return $radio_group;      
		}
		// place this code between the form tags:
		// notice 'advert' could be a database value too
		echo dynamic_radio_group('test', $values, $html_elements, 'advert');
		?>
	  	</td>  	
	  </tr>
    
  </table> 
  
  </body>
</html>

<?php 
include ('UIFooter.php')
?>
