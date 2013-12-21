<?php  

require("../DAL/dbconnect.php"); 

// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("advices");
$parnode = $dom->appendChild($node); 


// Select all the rows in the advice table

$query = "SELECT * FROM advice WHERE 1";
$result = mysql_query($query);
if (!$result) {  
  die('Invalid query: ' . mysql_error());
} 

header("Content-type: text/xml"); 

// Iterate through the rows, adding XML nodes for each

while ($row = @mysql_fetch_assoc($result)){  
  // ADD TO XML DOCUMENT NODE  
  $node = $dom->createElement("advice");  
  $newnode = $parnode->appendChild($node);   
  $newnode->setAttribute("name",$row['Name']);
  // $newnode->setAttribute("address", $row['address']); need to add to database  
  $newnode->setAttribute("lat", $row['Latitude']);  
  $newnode->setAttribute("lng", $row['Longitude']);  
  // $newnode->setAttribute("type", $row['Type']); at present do not care about type
  $newnode->setAttribute("date", $row['Date']);
} 

echo $dom->saveXML();

?>
