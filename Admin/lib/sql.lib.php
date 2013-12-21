<?php
function execute_query($Query, $con_id, $Errors = true)
{
	Global $lib_errors;
	if($con_id == false)
	{
		if($Errors)
		{
			setcookie("UID", "", time()-3600);
			errorDie($lib_errors['connection to mainserver failed'], "", "");
		}
		return "connection failed";
	
	}
	$con_id->query($Query);
	if(($error = $con_id->last_errors()) != "")
	{
		if($Errors)
		{
			setcookie("UID", "", time()-3600);
			errorDie($lib_errors['error while executing query'] ,"");
		}
		return $error;
	}
	return true;
}

function connect_to_server($Username, $Password, $Server, $Database, $Debug = NULL)
{
	Global $lib_errors, $client, $sql_library,$sql_debug_user_connection;
	if($Debug == NULL){$Debug = $sql_debug_user_connection;}
	
	if(!$client)
	{
		$client = new xSQL($sql_library, $Server, $Username, $Password, $Database);
		if($Debug)
		{
			$client->set_errorlevel(xsql_show_errors);
		}
		else
		{
			$client->set_errorlevel(xsql_dont_show_errors);
		}
	}
	return $client;
}

function connect_to_mainserver($Debug = NULL)
{
	Global $lib_errors, $server,$sql_library, $sql_debug_server_connection, $RMDATABASE, $RMSERVER, $RMUSER, $RMPASS;
	if($Debug == NULL){$Debug = $sql_debug_server_connection;}
	
	if(!$server)
	{
		$server = new xSQL($sql_library, $RMSERVER, $RMUSER, $RMPASS, $RMDATABASE);
		if($Debug)
		{
			$server->set_errorlevel(xsql_show_errors);
		}
		else
		{
			$server->set_errorlevel(xsql_die_on_error);
		}
	}
	return $server;
}

function query($query,  $ID = 0, $client = null)
{
	if(!$client){global $client;}
	$result = $client->query($query);
	
	if($ID == 0)
	{
		$endresult = $client->fetch_row ($result);
		return $endresult;
	}
	else
	{
		if ($client->affected_rows() <= 0){return false;}
		else{return true;}
	}
}
function checkUserConnection($Info)
{
	$client = new xSQL(xsql_mysql, $Info[2], $Info[0], $Info[1]);
	
	$error = $client->last_errors();
	if($error != ""){
		return array(1, $error);
	}
	
	if($Info[3] != ""){
		$client->select_database($Info[3]);
		$error = $client->last_errors();
		if($error != ""){
			return array(2, $error);
		}		
	}
		
	return array(0,"");
}
function getKeys($table)
{
	global $client;
	$keys = array();
	$query_id = $client->query("SHOW INDEXES FROM `" . $table . "`");
	while($values = $client->fetch_row($query_id))
	{
		$key_name = $values[2];
		
		$keys[$key_name]['name'] = $key_name;
		if($values[2] == 'PRIMARY'){$keys[$key_name]['type'] = "PRIMARY";}
		else if($values[10] == 'FULLTEXT'){$keys[$key_name]['type'] = "FULLTEXT";}
		else if($values[1] == '0'){$keys[$key_name]['type'] = "UNIQUE";}
		else{$keys[$key_name]['type'] = "INDEX";}
		$keys[$key_name]['cols'][$values[3]] = $values[4];
		$keys[$key_name]['length'][$values[3]] = $values[7];
	}
	return $keys;
}
function getColumns($table)
{
	global $client;
	$fields = array();
	$query_id = $client->query("SHOW COLUMNS FROM `" . $table ."`");
	while($values = $client->fetch_row($query_id))
	{
		$col_name = $values[0];
		$fields[$col_name]['name'] = $col_name;
		$fields[$col_name]['real type'] = $values[1];
		$type = $values[1];
		if(strpos($type, '(') !== FALSE)
		{
			//Column with length or set
			$fields[$col_name]['type'] = strtoupper(substr($type, 0, strpos($type, '(')));
			$fields[$col_name]['length'] = substr($type, (strpos($type, '(')+1), strrpos($type, ')') - (strpos($type, '(')+1));
			if(strpos($type, ' ', strrpos($type, ')'))!==FALSE)
			{
				//with attribute
				$fields[$col_name]['attribute'] = strtoupper(substr($type, strpos($type, ' ', strrpos($type, ')'))+1));
			}
			else
			{
				//without attribute
				$fields[$col_name]['attribute'] = "";
			}
		}
		else if(strpos($type, ' ')!==FALSE)
		{
			//Column without length, but with attribute
			$fields[$col_name]['type'] = strtoupper(substr($type, 0, strpos($type, ' ')));
			$fields[$col_name]['length'] = "";
			$fields[$col_name]['attribute'] = strtoupper(substr($type, strpos($type, ' ')+1));
		}
		else
		{
			//Column without length and attribute
			$fields[$col_name]['type'] = strtoupper($type);
			$fields[$col_name]['length'] = "";
			$fields[$col_name]['attribute'] = "";
		}
		$fields[$col_name]['null'] = ($values[2]=='YES');
		$fields[$col_name]['key'] = $values[3];
		$fields[$col_name]['default'] = $values[4];
		$fields[$col_name]['extra'] = strtoupper($values[5]);
		$fields[$col_name]['auto increment'] = ($fields[$col_name]['extra'] == 'AUTO_INCREMENT');
	}
	return $fields;
}
function setNoAutoIncrement($table)
{
	global $client;
	$fields = getColumns($table);
	foreach($fields as $col)
	{
		$field_info = $col;
		if($field_info['extra'] == 'AUTO_INCREMENT')
		{
			if($field_info['default'] === NULL){$default = " DEFAULT NULL";}
			else{$default = " DEFAULT '" . $field_info['default'] . "'";}
			$query_id = "ALTER TABLE `" . $table . "` CHANGE `" . $field_info['name'] . "` `" . $field_info['name'] . "` " . $field_info['real type'] . " " . $default;
			$client->query($query_id);
			checkForMysqlErrors($client, $query_id, 1, 0);
		}
	}
}
?>