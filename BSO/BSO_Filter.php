<?php
session_start();
require("../DAL/dbconnect.php");

$WHERE;
$Added;
 
if($_POST['chkbox1'] == "on")
{
	$Added = true;
	$WHERE = $WHERE . ' type = ' . '"bar"';
}

if($_POST['chkbox0'] == "on")
{
	if($Added)
	$WHERE =  $WHERE.' or ';
	
	$Added = true;
	$WHERE = $WHERE . ' type = ' . '"restaurant"';
}

$_SESSION['filter'] =$WHERE;

$polyline = false;
$concat = false;
if($_POST['pchkbox1'] == "on")
{
	$concat=true;
	$polyline = 'type = ' . '"Area Advice"';
}
if($_POST['pchkbox0'] == "on")
{
	if($concat)
	$polyline =  $polyline.' or ';
	
	$concat=true;
	$polyline = $polyline. ' type = ' . '"Route Advice"';
}

$_SESSION['polyline'] =$polyline;

//header( 'Location: ../BSO/BSO_GenXML.php' ) ;
header( 'Location: ../UI/UIMap.php' ) ;
?>
