<?php
require("../DAL/dbconnect.php");

// Read Advice
$AdviceName = $_REQUEST['AdviceName'];
$Resolution = $_REQUEST['Resolution'];
$Field1 = $_REQUEST['Field1'];
$Field2 = $_REQUEST['Field2'];
$Field3 = $_REQUEST['Field3'];
$Field4 = $_REQUEST['Field4'];

// Add Advice
$query = "INSERT INTO Advice(Name, ResolutionID) VALUES ('$AdviceName',$Resolution)";
$result = mysql_query($query);
if($result) // Add the rest
{
	$query= "select * from Advice where AdviceID = ( select max(AdviceID) from Advice)";
	$result = mysql_query($query);
	$row = mysql_fetch_assoc($result);
	// Read ID
	$AdviceID = $row["adviceid"];
	
	// Add Field1
	$query = "INSERT INTO AdviceField (AdviceID,Name,InputTypeID) VALUES ($AdviceID,'$Field1',2)";
	$result = mysql_query($query);

	// Add Field2
	$query = "INSERT INTO AdviceField (AdviceID,Name,InputTypeID) VALUES ($AdviceID,'$Field2',2)";
	$result = mysql_query($query);

	// Add Field3
	$query = "INSERT INTO AdviceField (AdviceID,Name,InputTypeID) VALUES ($AdviceID,'$Field3',2)";
	$result = mysql_query($query);

	// Add Field4
	$query = "INSERT INTO AdviceField (AdviceID,Name,InputTypeID) VALUES ($AdviceID,'$Field4',2)";
	$result = mysql_query($query);

	header( "Location: ../UI/UISuccessful.php") ;
}
?>