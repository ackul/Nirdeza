<?php
session_start();
require("../DAL/dbconnect.php");

// Start XML file, create parent node
//
//
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Select all the rows in the markers table

$query = "SELECT * FROM markers WHERE". $_SESSION['filter'];
$result = mysql_query($query);

$query1 = "SELECT * FROM track WHERE ". $_SESSION['polyline'];
$result1 = mysql_query($query1);
//$_SESSION['result1'] =$result1;
if (!$result) {
	die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

while ($row = @mysql_fetch_assoc($result)){
// ADD TO XML DOCUMENT NODE
$node = $dom->createElement("marker");
$newnode = $parnode->appendChild($node);
$newnode->setAttribute("name",$row['name']);
$newnode->setAttribute("address", $row['address']);
$newnode->setAttribute("lat", $row['lat']);
$newnode->setAttribute("lng", $row['lng']);
$newnode->setAttribute("type", $row['type']);
}


	
// Iterate through the rows, adding XML nodes for each

while ($row1 = @mysql_fetch_assoc($result1)){
// ADD TO XML DOCUMENT NODE
//echo $row1['name'];
//echo $row1['address'];
//echo $row1['type'];
//echo str_replace("LINESTRING (","", $row1['geometry']);


$node2 = $dom->createElement("polyline");
$newnode2 = $parnode->appendChild($node2);
$newnode2->setAttribute("name",$row1['name']);
$newnode2->setAttribute("address", $row1['address']);
$newnode2->setAttribute("type", $row1['type']);
	  $geometry = str_replace("LINESTRING (","", $row1['geometry']);
	  $geometry = str_replace(")","",$geometry);
	  $points = explode(",",$geometry);
	  $numpoints = sizeof($points);
	  for ($i = 0; $i <= ($numpoints - 1); $i++) {
	    $coordinates = explode(" ",$points[$i]);
	    $newnode2->setAttribute("cooLat$i", $coordinates[1]);
	    $newnode2->setAttribute("cooLng$i", $coordinates[0]);
	  }
  $newnode2->setAttribute("length", $numpoints);
}


echo $dom->saveXML();
?>