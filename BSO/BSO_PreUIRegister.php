<?php
session_start();
require("..//DAL//dbconnect.php");

// Retreive all categories of user 
	$query = "Select * from usercategory";
	$result = mysql_query($query);

	while ($row = mysql_fetch_assoc($result))
	{
		$categoryId = $row["usercategoryid"];
		$Description = $row["description"];
		$options.="<OPTION VALUE=\"$categoryId\">".$Description;
	}
	if (!$result) {
  		die('Invalid query: ' . mysql_error());
	}
//	include '..//UI//UIRegister.php';\

$_SESSION['options'] = $options; 
header( "Location: ../UI/UIRegister.php") ;
?>