<?php

//Diese Funktion meldet einen Benutzer am System an
//Register a new session for the user
function ssy_logUser($Username, $Password, $Server, $Database, $StayLogged, $SessionTimeout, $IpBlocker, $CookieBlocker, $UserType)
{
	global $server;

	//Alle Angaben auf Korrekheit überprüfen
	//Check if all values are correct
	if($Username == "")
	{
		incompleteUserdata();
	}
	if( ($StayLogged != 0 && $StayLogged != 1) || ($IpBlocker != 0 && $IpBlocker != 1) || ($CookieBlocker != 0 && $CookieBlocker != 1) || ($UserType != "sql" && $UserType != "st") ||  $SessionTimeout < 0)
	{
		loginError(false);
	}


	//Alle Daten laden und in die Variablen speichern
	//Load all values in variables
	
	//Auf Session Timeout überprüfen
	//Session timeout
	if( $StayLogged == 1 ){$use_time = 1; $Time = mktime() + $_POST['time'] * 60;}
	else{$use_time = 0;$Time = mktime() + 3600000;}

	//IP Speichern
	//Save IP
	$IP = $_SERVER['REMOTE_ADDR'];

	//UniqID für Sitzung erzeugen
	//Create Unique ID
	$UnID = uniqid("");
	
	//Wenn User ein Benutzer an gemeinsam Benutzer Datenbank ist, Benutzerdaten laden und überschreiben 
	//If users wants to logon on a shared used database --> load user setting and overwrite variables
	if($UserType != "sql")
	{
		$Info = ssy_getUserConnectionInfos($Username, $Password);
		$Username = $Info[0];
		$Password = $Info[1];
		$Server = $Info[2];
		$Database = $Info[3];
		$toTab = $Info[4];
		$Status = 1;
	}
	else
	{
		$toTab = "";
		$Status = 0;
	}

	//Daten in der Kontendatenbank speichern
	//Save session data
	$tag = "INSERT INTO sql_iden(UniqueID, Server, Password, User, `Database`, Timestamp, NoTimeout, IpLock, IP, Cookies, Data, Status) values(\"$UnID\", \"$Server\", \"$Password\", \"$Username\",\"$Database\", $Time,  $use_time, $IpBlocker, \"$IP\", $CookieBlocker, \"$toTab\", $Status)";
	execute_query ($tag, $server);

	//Cookie setzen
	//Set session cookie
	if($CookieBlocker == 1)
	{
		setcookie("UID", $UnID);
	}

	return $UnID;
}

//Unregister a session -> Log off
function ssy_deleteUser($UnID)
{
	global $server;
	//ID vom Server löschen
	//Delete session
	execute_query("delete from sql_iden where UniqueID = '". $UnID ."'", $server);
	
	//Cookie löschen
	//Delete session cookie
	setcookie("UID", "", mktime() - 3600);
}

//Load user variables of the runnig session
function ssy_getUserinfos($checkTable = true)
{
	global $server, $userinfo;
	
	//Check if both session ID`s (if set) are equal and set them into the $UsID variable
	if(isset($_POST['ID']) && isset($_GET['ID']) && $_GET['ID'] != $_POST['ID'])
	{
		setcookie("UID", "", time()-3600);
		accessViolation();
	}
	if(isset($_POST['ID']))
	{
		$UsID = $_POST['ID'];
	}
	else if(isset($_GET['ID']))
	{
		$UsID = $_GET['ID'];
	}
	else
	{
		unauthorized();
	}
	
	//Escape for use in SQL query
	$UsID = $server->escape_string($UsID);
	
	//Load session variables
	$tag = "SELECT Server, Password, User, `Database`, Timestamp, Status, Data, Cookies, IpLock, Ip, NoTimeout FROM sql_iden WHERE UniqueID='$UsID'";
	$result = $server->query ($tag);

	//Load sql results into variables
	$ro = $server->fetch_row($result, xsql_assoc);
	
	$userinfo = array();
	$userinfo['server'] = $ro['Server'];
	$userinfo['password'] = $ro['Password'];
	$userinfo['name'] = $ro['User'];
	$userinfo['database'] = $ro['Database'];
	$userinfo['is_shared_user'] = 0;
	$userinfo['data'] = $ro['Data'];

	//List table permission of shared database users
	$listedTables = data_listElements($userinfo['data']);
	//$userinfo['data'] = data_getAllElements($userinfo['data']);
		
	//If shared database user
	if($ro['Status'])
	{
		$userinfo['is_shared_user'] = 1;
		
		//If table check is enables
		if($checkTable)
		{			
			//Load table name of current table
			$tableName = getTable();
			
			//If users is not permitted to access this table --> log user off
			if(ssy_operationPermitted("access", $tableName) == false)
			{
				ssy_deleteUser($UsID);
				unauthorized();
			}
		}
	
	}

	
	$error = 0;
	
	//Check if cookie ID is equal with session ID
	if($ro['Cookies']==1 && (!isset($_COOKIE['UID']) || ($_COOKIE['UID'] != $UsID)))
	{
		$error = 1;
	}
	//Check if the rigth ip is used
	if($ro['IpLock']==1 && ($ro['Ip'] != $_SERVER['REMOTE_ADDR']))
	{
		$error = 1;
	}
	//Check if session expired
	if($ro['NoTimeout'] && mktime() >= $ro['Timestamp'])
	{
		ssy_deleteUser($UsID);
		sessionExpired();
	}
	//If an error occured --> log off
	if($error)
	{
		ssy_deleteUser($UsID);
		unauthorized();
	}

	//cleanup
	ssy_cleanup();

	//Return session variables
	$userinfo['password'] = decrypt($userinfo['password'], $userinfo['name']); 
	dontCache();
	
	$userinfo['unid'] = $UsID;
}

//Diese Funktion wandelt das temporäre übertragene Passwort in ein Standart verschlüsseltes Passwort um
//This function converts a with the temporary key encrypted password to a normal encrypted password
function ssy_edTemppassword($Username, $Password, $tmpkey)
{
	global $server;

	//Load encryption key
	$result2 = $server->query("SELECT value FROM sql_keys WHERE `key` = '" . $tmpkey .  "'");
	$key2 = $server->fetch_row($result2);
	$keyS = $key2[0];

	//Decrypt password with the tempkey encrypt it with the username
	$Password = decrypt($Password, $keyS);
	$Password = encrypt($Password, $Username);
	execute_query ("DELETE FROM sql_keys WHERE `key` = '" . $_POST['key'] .  "'", $server);
	return $Password;
}


//Creates a temporary key pair
function ssy_createTempKeys()
{
	global $server;

	//Generate keys
	$tmp_id1 = uniqid("");
	$tmp_id2 = uniqid("");
	
	//Connect to mainserver an insert the key pair in table
	$tag = "INSERT INTO sql_keys(`key`, value, timestamp) VALUES('$tmp_id1', '$tmp_id2', " . mktime() . ")";
	execute_query($tag, $server);
	
	//Return keys
	$back[0] = $tmp_id1;
	$back[1] = $tmp_id2;
	
	ssy_cleanup();

	return $back;
}

//Delete all sessions older one day
function ssy_cleanup()
{
	global $server;
	execute_query("DELETE FROM sql_iden WHERE timestamp < " . (mktime()-(60*60*24)),$server);
	execute_query("DELETE FROM sql_keys WHERE timestamp < " . (mktime()-(60*60*24)),$server);
}

//Load usersettings for shared database users
function ssy_getUserConnectionInfos($User, $Pw)
{
	global $server;
	//Abfragen der Benutzertabllen
	//Load usersettings
	$User = $server->escape_string($User);
	$command = "SELECT `toUser`, `Tables`, `Password` from sql_user where Admin=0 and Name='$User' limit 1;";
	$result = $server->query ($command);

	//Write results into variables
	$UserINF = $server->fetch_row($result);
	$toUser = $UserINF[0];
	$tableData =  $UserINF[1];
	$zah = 0;

	//Check password to be correct
	if($Pw != $UserINF[2])
	{
		setcookie("UID", "", time()-3600);
		$tim = time();
		loginError();
	}
	
	//Load connection settings of shared database admin
	$command2 = "select * from sql_user where ID = '$toUser' and admin=1;";
	$result2 = $server->query ($command2);
	$UserINF = $server->fetch_row($result2, xsql_assoc); 
	$Datab = $UserINF['Database'];
	$Host = $UserINF['Server'];
	$User = $UserINF['Name'];
	$Pw = $UserINF['Password'];

	//Return connection variables
	$Info[0] = $User;
	$Info[1] = $Pw;
	$Info[2] = $Host;
	$Info[3] = $Datab;
	$Info[4] = $tableData;
	return $Info;
}

function ssy_changeDatabase($database)
{
	global $server;
	
	//Check for correct ID`s and load it
	if(isset($_POST['ID']) && isset($_GET['ID'])&& $_GET['ID'] != $_POST['ID'])
	{
		setcookie("UID", "", time()-3600);
		accessViolation();
	}
	if(isset($_POST['ID']))
	{
		$unID = $_POST['ID'];
	}
	else if(isset($_GET['ID']))
	{
		$unID = $_GET['ID'];
	}
	else
	{
		setcookie("UID", "", time()-3600);
	}
	
	$query = "UPDATE `sql_iden` SET `Database` = '" . $server->escape_string($database) . "' WHERE UniqueID = '" . $unID . "'";
	execute_query($query, $server);
}


//Save session settings, like sort options, selected sites,...
function ssy_safeUserSettings($data)
{
	global $server;
	
	//Check for correct ID`s and load it
	if(isset($_POST['ID']) && isset($_GET['ID'])&& $_GET['ID'] != $_POST['ID'])
	{
		setcookie("UID", "", time()-3600);
		accessViolation();
	}
	if(isset($_POST['ID']))
	{
		$unID = $_POST['ID'];
	}
	else if(isset($_GET['ID']))
	{
		$unID = $_GET['ID'];
	}
	else
	{
		setcookie("UID", "", time()-3600);
	}
	
	//Update session settings
	$query = "UPDATE `sql_iden` SET `Data` = '". $data ."' WHERE `UniqueID` = '". $unID . "'";
	execute_query($query, $server);
}

//Check if user of a shared database is permitted to access
function ssy_operationPermitted($value, $table)
{
	//Load global variables
	global $userinfo;
	
	//All grants for normal users
	if(!$userinfo['is_shared_user']){return true;}
	else
	{
		//If permitted return true
		if(data_getSubelement($table, $value, $userinfo['data']) == '1'){return true;}
		else{return false;}
	}
}

?>