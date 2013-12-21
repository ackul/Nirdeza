<?php
session_start();
require("../DAL/dbconnect.php");
$_SESSION['c_Name'] = $_REQUEST["firstname"];
$_SESSION['c_UserName'] = $_REQUEST["username"];

// Insert user data into user table 
	$query = "INSERT INTO User (UserTypeID, CategoryID, FirstName, LastName, UserName, Password) VALUES ('3','$_POST[categoryId]','$_POST[firstname]','$_POST[lastname]','$_POST[username]','$_POST[password]')";
	$result = mysql_query($query);
header( "Location: ../UI/UIRegistrationConfirmation.php") ;
?>
