<?php
session_start();
require("../DAL/dbconnect.php");

//Connect to Database
if(array_key_exists('login',$_POST))
{
	$logged = false;
	$C_UR= $_REQUEST["UserName"];
	$C_P= $_REQUEST["Password"];
	if (!$db_selected) {
		die ('Can\'t use db : ' . mysql_error());
	}
	$query = "SELECT * FROM User where UserName = '".$C_UR."' and Password = '".$C_P."';";
	$result = mysql_query($query);
	if (!$result) {
	}
	else
	{	
		// Iterate through the rows, adding XML nodes for each
		$row = @mysql_fetch_assoc($result);
		if(!$row)
		{
			$_SESSION['CurrentUser'] ="";		
			header( 'Location: ../UI/UILoginError.php' ) ;	
		}
		else
		{
			// Add to Session
			$_SESSION['CurrentUser'] =$C_UR;
			header( 'Location: ../UI/Main.php' ) ;
		}
	}	
}

if(array_key_exists('LogOut',$_POST))
{
	$_SESSION['CurrentUser'] ="";
	header( 'Location: ../UI/Main.php' ) ;
}

if(array_key_exists('login',$_POST))
{
	$logged=false;
	$_SESSION['user']="";
}
?>