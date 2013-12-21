<?php
require("../DAL/dbconnect.php");
$query= "select * from Advice ";
$result = mysql_query($query);
$added = false;
$options="";
while( $row = mysql_fetch_assoc($result))
{
	if($added == true)
		$options = $options . " + ";
	$added = true;
	$options = $options .'"< option value='."'";
	$options = $options .$row['name'];
	$options = $options ."'".' > '.$row['name'];
	$options = $options .'< / option>"';
}
$_SESSION['options'] = $options; 
//echo $options;
header( "Location: ../UI/UIAddAdvice.php") ;
?>