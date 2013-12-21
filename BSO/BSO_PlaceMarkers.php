<?php
session_start();
require("../DAL/dbinfo.php");


// Opens a connection to a MySQL server
$connection=mysql_connect ("localhost", $username, $password);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

// Set the active MySQL database
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}
//echo $_REQUEST['coordinates'];
//echo $_REQUEST['name'];
//echo $_REQUEST['address'];
//echo $_REQUEST['type'];
//echo $_REQUEST['latlng'];
//echo $_REQUEST['length'];



//Insert new row with user data
//$query = "INSERT INTO markers (name, address, lat, lng, type) VALUES ('$_REQUEST['name']','$_REQUEST['address']','$_REQUEST['lat']','$_REQUEST['lng']','$_REQUEST['type']')";
$query = "INSERT INTO track (geometry, name, address, type) VALUES ('$_REQUEST[coordinates]','$_REQUEST[name]','$_REQUEST[address]','$_REQUEST[type]')";
$result = mysql_query($query);

//if (!$result) {
 // die('Invalid query: ' . mysql_error());
//}
header( "Location: ../UI/UIMap.php") ;
?>
