<?php
$sql_dump_line_seperator = "\r\n";
$sql_dump_query_seperator = ";";

function sql_dump($client, $table = false, $create_database = true, $create_table = true, $dump_contents = true)
{
	global $sql_dump_line_seperator,$sql_dump_query_seperator ;
	$starttime = microtimeFloat();
	if($table == false)
	{
		$result_id = $client->query("SHOW TABLES");
		for($i = 0; ($tmp = $client->fetch_row($result_id)); $i++)
		{
			$tables[$i] = $tmp[0];
		}
	}
	else
	{
		$tables[0] = $table;
	}
	
	$dump =  "# Created by MySQL-Admin (www.mysql-admin.org)".$sql_dump_line_seperator;
	$dump .= "# Created on the " . date("d.m.y") . " at " . date("H:i:s") . $sql_dump_line_seperator.$sql_dump_line_seperator;
	if($create_database)
	{
		$db_name = sql_db_name($client);
		$dump .= "#Create database " . $db_name . $sql_dump_line_seperator;
		$dump .= "CREATE DATABASE " . $db_name . $sql_dump_query_seperator .$sql_dump_line_seperator;
		$dump .= "USE " . $db_name . $sql_dump_query_seperator .$sql_dump_line_seperator .$sql_dump_line_seperator;
		
	}
	
	for($i = 0; isset($tables[$i]); $i++)
	{
		if($create_table)
		{
			$dump .= "#Dumping table structure of ". $tables[$i] .$sql_dump_line_seperator;
			$dump .= sql_dump_table_structure($client, $tables[$i]) . $sql_dump_query_seperator .$sql_dump_line_seperator .$sql_dump_line_seperator;
		}
		if($dump_contents)
		{
			$dump .= "#Dumping data of table " . $tables[$i].$sql_dump_line_seperator;
			$dump .= sql_dump_table_contents($client, $tables[$i]).$sql_dump_line_seperator.$sql_dump_line_seperator;	
		}	
		
	}
	$dump .= "#Generated in " . round(microtimeFloat()-$starttime, 2) . " sec."; 
	return $dump;
}

function sql_dump_table_structure($client, $table)
{
	$query_id = $client->query("SHOW CREATE TABLE `". $client->escape_string($table) ."`");
	$result = $client->fetch_row($query_id);
	return $result[1];
}
function sql_dump_table_contents($client, $table)
{
	global $sql_dump_line_seperator,$sql_dump_query_seperator;
	
	//loadin cols
	$cols = sql_get_cols($client, $table);
	$is_numeric = sql_get_numeric_cols($client, $table);
	
	//Dumping data
	$query_id = $client->query("SELECT * FROM `". $client->escape_string($table) ."`");
	$result = "";
	for ($i = 0; ($query_result = $client->fetch_row($query_id)); $i ++)
	{
		$result .= "INSERT INTO `" . $client->escape_string($table) ."`(" . $cols . ") VALUES(";
		for($k = 0; $k < $client->num_fields($query_id); $k++)
		{
			if($k != 0)
			{
				$result .= ", ";
			}
			if($query_result[$k] === NULL)
			{
				$result .= "null";
			}
			else if($is_numeric[$k])
			{
				$result .= "" . $client->escape_string($query_result[$k]) . "";
			}
			else
			{
				$result .= "'" . $client->escape_string($query_result[$k]) . "'";
			}
		}
		$result .= ")".$sql_dump_query_seperator.$sql_dump_line_seperator;
	}
	return $result;
}
function sql_get_cols($client, $table)
{
	$query_id = $client->query("DESCRIBE `" . $table . "`");
	for($i = 0; $tmp = $client->fetch_row($query_id);  $i++)
	{
		if($i == 0){$result = "";}
		else($result .= ", ");
		$result .= "`". $tmp[0] . "`";
	}
	return $result;
}
function sql_get_numeric_cols($client, $table)
{
	global $numeric_types;
	$query_id = $client->query("SELECT * FROM `" . $table . "` LIMIT 1");
	$result = array();
	for($i = 0; $tmp = $client->fetch_row($query_id);  $i++)
	{
		for($k = 0; $k < $client->num_fields($query_id); $k++)
		{
			$tmp = $client->fetch_field($query_id, $k);
			$result[$k] = in_array(strtoupper($tmp->type), $numeric_types)?1:0;
		}
	}
	return $result;
}

function sql_db_name($client) {
   $result = $client->query("SELECT DATABASE()");
   return $client->fetch_first();
}

?>