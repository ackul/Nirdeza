<?php
//------------------------------------------------ xSQL Library ----------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
//---------------------------- Entwickelt von Bernhard Wörndl-Aichriedler (BWA) 2006  ------------------------------
//---------------------------- Dieses Library wurde dient als Brücke zwischen Postgre ------------------------------
//---------------------------- und MySQL Datenbanken.                                 ------------------------------
//------------------------------------------------------------------------------------------------------------------
//----------------------------     (c) Copyright 2006 Bernhard Wörndl-Aichriedler     ------------------------------
//------------------------------------------------------------------------------------------------------------------
//----------------------------                   Lizenz xSQL-Library                  ------------------------------                                         
//--- Dieses Programm ist freie Software. Sie können es unter den Bedingungen der GNU General Public License,    ---
//--- wie von der Free Software Foundation veröffentlicht, weitergeben und/oder modifizieren, entweder gemäß     ---
//--- Version 2 der Lizenz oder (nach Ihrer Option) jeder späteren Version.                                      ---
//---                                                                                                            ---
//--- Die Veröffentlichung dieses Programms erfolgt in der Hoffnung, daß es Ihnen von Nutzen sein wird,          ---
//--- aber OHNE IRGENDEINE GARANTIE, sogar ohne die implizite Garantie der MARKTREIFE oder der                   ---
//--- VERWENDBARKEIT FÜR EINEN BESTIMMTEN ZWECK. Details finden Sie in der GNU General Public License.           ---
//---                                                                                                            ---
//--- Sie sollten ein Exemplar der GNU General Public License zusammen mit diesem Programm erhalten haben.       ---
//--- Falls nicht, schreiben Sie an die                                                                          ---
//--- Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110, USA.                        ---
//------------------------------------------------------------------------------------------------------------------

define('xsql_default_mode', 'mysql_auto');
define('xsql_mysql', 'mysql');
define('xsql_mysqli', 'mysqli');
define('xsql_psql', 'psql');
define('xsql_mysql_auto', 'mysql_auto');
define('xsql_dont_show_errors', 0);
define('xsql_show_errors', 1);
define('xsql_die_on_error', 2);
define('xsql_custom_errors', 3);
define('xsql_both', 0);
define('xsql_assoc', 1);
define('xsql_numeric', 2);

class xsql
{
	//----------------------------------------------- private variables -----------------------------------------------
	
	var $sql_mode = xsql_default_mode;
	var $error_level = xsql_dont_show_errors;
	var $username = "";
	var $database = "";
	var $server = "";
	var $error_msg = "";
	var $id = false;
	var $include_dir = "./";
	var $last_result_id = false;
	var $comments = array(array(array("\n--", "\r--"), array("\n", "\r")), array(array("\n#", "\r#"), array("\n", "\r")));
	var $mysql_comments = array(array("/*", "*/"));
	var $values = array(array("'", "\\"), array("\"","\\"));
	var $query_seperator = ";";
	var $error_handler = "";
	
	//-------------------------------------------------- constructor -------------------------------------------------
	//$type			sql type, ca be
	//				xsql_mysql	for mysql (PHP 3,4,5)
	//				xsql_mysqli	for mysql (PHP 5)
	//				xsql_psql	for pgsql
	//$server		address of the server
	//$username		username
	//$password		password
	//$database		database
	//$port			sql server port
	function xsql($type = xsql_default_mode, $server = false, $username = false, $password = false, $database = false, $port = false){$this->connect($server, $username, $password, $database, $port, $type);}
	
	//------------------------------------------------ public methods -----------------------------------------------
	
	//Returns the number of dataset affected by UPDATE, DELETE or INSERT querys
	//$result_id	id of the query - if not entered last query id is used
	function affected_rows($result_id = false){		$this->check_conncetion_status();
		$result_id = ($result_id)?$result_id:$this->last_result_id;
		$result = false;
		switch ($this->sql_mode){
			case xsql_mysql:{
				$result = @mysql_affected_rows($this->id);
				$this->handle_error();
				break;
			}
			case xsql_mysqli:{
				$result = @mysqli_affected_rows($this->id);
				$this->handle_error();
				break;
			}
			case xsql_psql:{
				$result = @pg_affected_rows($result_id);
				$this->handle_error();
				break;
			}
			default:{
				$this->internal_error(__Line__, __File__);
			}
		}
		return $result;
	}
	
	//Returns the charset of the client
	function get_charset(){
		$this->check_conncetion_status();
		$charset = "";	
		switch ($this->sql_mode){
			case xsql_mysql:{
				$charset = @mysql_client_encoding($this->id);
				break;
			}
			case xsql_mysqli:{
				$charset = @mysqli_character_set_name($this->id);
				break;
			}
			case xsql_psql:{
				$charset = @pg_client_encoding($this->id);
				break;
			}
			default:{
				$this->internal_error(__Line__, __File__);
			}
		}
		return $charset;
	}
	
	//Returns one line of the query result
	//$result_id	id of the query - if not entered last query id is used
	//$type			return type, can be
	//				xsql_both - for a numeric and associative array (default mode)
	//				xsql_assoc - for a associative array
	//				xsql_numeric - for a numeric array
	function fetch_row($result_id = false, $type = xsql_numeric){
		$this->check_conncetion_status();
		$result_id = ($result_id)?$result_id:$this->last_result_id;
		$result = false;
		$fetch_type = 0;
		switch ($this->sql_mode){
			case xsql_mysql:{
				switch ($type){
					case xsql_both: $fetch_type = MYSQL_BOTH; break;
					case xsql_assoc: $fetch_type = MYSQL_ASSOC; break;
					case xsql_numeric: $fetch_type = MYSQL_NUM; break; 
				}
				$result = @mysql_fetch_array($result_id, $fetch_type);
				$this->handle_error();
				break;
			}
			case xsql_mysqli:{
				switch ($type){
					case xsql_both: $fetch_type = MYSQLI_BOTH; break;
					case xsql_assoc: $fetch_type = MYSQLI_ASSOC; break;
					case xsql_numeric: $fetch_type = MYSQLI_NUM; break; 
				}
				$result = @mysqli_fetch_array($result_id, $fetch_type);
				$this->handle_error();
				break;
			}
			case xsql_psql:{
				switch ($type){
					case xsql_both: $fetch_type = PGSQL_BOTH; break;
					case xsql_assoc: $fetch_type = PGSQL_ASSOC; break;
					case xsql_numeric: $fetch_type = PGSQL_NUM; break; 
				}
				$result = @pg_fetch_array($result_id, null, $fetch_type);
				$this->handle_error();
				break;
			}
			default:{
				$this->internal_error(__Line__, __File__);
			}
		}
		return $result;
	}
	
	//Returns the number of rows returned by a query
	//only mysql and mysqli
	function num_rows($result_id = false)
	{
		$this->check_conncetion_status();
		$result_id = ($result_id)?$result_id:$this->last_result_id;
		switch ($this->sql_mode){
			case xsql_mysql:{
				return mysql_num_rows($result_id);
			}
			case xsql_mysqli:{
				return mysqli_num_rows($result_id);
			}
			default:{
				$this->internal_error(__Line__, __File__);
			}
		}
	}
	
	//Returns the number of fields returned by a query
	//only mysql and mysqli
	function num_fields($result_id = false)
	{
		$this->check_conncetion_status();
		$result_id = ($result_id)?$result_id:$this->last_result_id;
		
		switch ($this->sql_mode){
			case xsql_mysql:{
				return mysql_num_fields($result_id);
			}
			case xsql_mysqli:{
				return mysqli_num_fields($result_id);
			}
			default:{
				$this->internal_error(__Line__, __File__);
			}
		}
	}
	
	//Returns the field properties
	//only mysql and mysqli
	function fetch_field($result_id = false, $no)
	{
		$this->check_conncetion_status();
		$result_id = ($result_id)?$result_id:$this->last_result_id;
		
		switch ($this->sql_mode){
			case xsql_mysql:{
				return mysql_fetch_field($result_id, $no);
			}
			case xsql_mysqli:{
				return mysqli_fetch_field_direct($result_id, $no);
			}
		}
	}
	
	//Returns a 2 dimensional array with the query results
	//Same as fetch_row, but returns all rows in a multidimensonal array, not only the first line
	function fetch_all($result_id = false, $type = xsql_numeric){
		$result = array();
		for($i = 0; ($tmp = $this->fetch_row($result_id, $type)); $i++){
			$result[$i] = $tmp;
		} return $result;
	}
	
	//Returns the first value
	function fetch_first($result_id = false){
		$tmp = $this->fetch_row($result_id);
		return $tmp[0];
	}
	
	function fetch_all_first($result_id = false){
		while($tmp[] = $this->fetch_first($result_id)){}
		unset($tmp[sizeof($tmp)-1]);
		return $tmp;
	}
	
	//Returns the last errors
	function last_errors(){
		$tmp = $this->error_msg;
		$this->error_msg = "";
		return $tmp;
	}
	
	//Returns an array with all tables in current database
	function list_tables(){
		$this->check_conncetion_status();
		$result = false;
		switch ($this->sql_mode){
			case xsql_mysql:{}
			case xsql_mysqli:{
				$result_id = $this->query("SHOW TABLES");
				for($i = 0; ($res = $this->fetch_row($result_id, xsql_numeric)); $i ++)
				{
					$result[$i] = $res[0];
				}
				break;
			}
			case xsql_psql:{
				$result_id = $this->query("SELECT relname FROM pg_stat_user_tables");
				for($i = 0; ($res = $this->fetch_row($result_id, xsql_numeric)); $i ++)
				{
					$result[$i] = $res[0];
				}
				break;
			}
		}
		return $result;
	}
	
	//Retruns an array with all available databases on the server
	function list_databases(){
		$this->check_conncetion_status();
		$result = false;
		switch ($this->sql_mode){
			case xsql_mysql:{}
			case xsql_mysqli:{
				$result_id = $this->query("SHOW DATABASES");
				$result = $this->fetch_all_first($result_id, xsql_numeric);
				break;
			}
			case xsql_psql:{
				$result_id = $this->query("SELECT datname FROM pg_database");
				$result = $this->fetch_all_first($result_id, xsql_numeric);
				break;
			}
		}
		return $result;
	}
	
	//Executes a sql query and retruns the query id
	function query($query)
	{
		$this->check_conncetion_status();
		$result_id = null;
		switch ($this->sql_mode){
			case xsql_mysql:{
				$result_id = @mysql_query($query,$this->id);
				$this->handle_error($query);
				break;
			}
			case xsql_mysqli:{
				$result_id = @mysqli_query($this->id, $query);
				$this->handle_error($query);
				break;
			}
			case xsql_psql:{
				$result_id = @pg_query($this->id, $query);
				$this->handle_error($query);
				break;
			}
			default:{
				$this->internal_error(__Line__, __File__);
			}
		}
		$this->last_result_id = $result_id;
		return $result_id;
	}
	
	//In dev, don't use
	function queries($query_array){
		foreach ($query_array as $tmp)
		{
			$this->query($tmp);
		}
	}
	
	//Sets the error level
	//$level	error level, can be
	//			xsql_dont_show_errors - safes the error message, but don`t display a message (default)
	//			xsql_show_errors - print out all errors
	//			xsql_die_on_error - print out the error and dies
	function set_errorlevel($level){
		$this->error_level = $level;
	}
	
	function set_errorhandler($handler){
		$this->error_level = xsql_custom_errors;
		$this->error_handler = $handler;
	}
	
	//Close the connection to the server
	function close(){
		switch ($this->sql_mode){
			case xsql_mysql:{
				@mysql_close($this->id);
				break;
			}
			case xsql_mysqli:{
				@mysqli_close($this->id);
				break;
			}
			case xsql_psql:{
				@pg_close($this->id);
				break;
			}
			default:{
				$this->internal_error(__Line__, __File__);
			}
		}
		$this->id = false;
	}
	
	function select_database($database){
		switch ($this->sql_mode){
			case xsql_mysql:{
				@mysql_select_db($database ,$this->id);
				if(mysql_errno($this->id)){$this->error(mysql_error($this->id));}
				break;
			}
			case xsql_mysqli:{
				@mysqli_select_db($this->id, $database);
				if(mysqli_errno($this->id)){$this->error(mysqli_error($this->id));}
				break;
			}
			case xsql_psql:{
				$this->error("Not able to change database in psql mode.");
				break;
			}
			default:{
				$this->internal_error(__Line__, __File__);
			}
		}
		
	}
	
	
	//Returns the current connection id
	function get_connection_id(){
		return $this->id;
	}
	
	//Returns the server version
	function get_server_version(){
		$version = false;
		$this->check_conncetion_status();
		switch ($this->sql_mode){
			case xsql_mysql:{
				$version = @mysql_get_server_info ($this->id);
				break;
			}
			case xsql_mysqli:{
				$version = @mysqli_get_server_info ($this->id);
				break;
			}
			case xsql_psql:{
				$version = @pg_parameter_status($this->id, "server_version");
				break;
			}
			default:{
				$this->internal_error(__Line__, __File__);
			}
		}
		return $version;
	}
	
	
	//Returns the client version
	//only mysql and mysqli
	function get_client_version(){
		$version = false;
		$this->check_conncetion_status();
		switch ($this->sql_mode){
			case xsql_mysql:{
				$version = @mysql_get_client_info ();
				break;
			}
			case xsql_mysqli:{
				$version = @mysqli_get_client_info ();
				break;
			}
			default:{
				$this->internal_error(__Line__, __File__);
			}
		}
		return $version;
	}
		
	//Returns the protocol version
	//only mysql and mysqli
	function get_protocol_version(){
		$version = false;
		$this->check_conncetion_status();
		switch ($this->sql_mode){
			case xsql_mysql:{
				$version = @mysql_get_proto_info ($this->id);
				break;
			}
			case xsql_mysqli:{
				$version = @mysqli_get_proto_info ($this->id);
				break;
			}
			default:{
				$this->internal_error(__Line__, __File__);
			}
		}
		return $version;
	}
	
	//Returns the connection type
	//only mysql and mysqli
	function get_connection_type(){
		$version = false;
		$this->check_conncetion_status();
		switch ($this->sql_mode){
			case xsql_mysql:{
				$version = @mysql_get_host_info ($this->id);
				break;
			}
			case xsql_mysqli:{
				$version = @mysqli_get_host_info ($this->id);
				break;
			}
			default:{
				$this->internal_error(__Line__, __File__);
			}
		}
		return $version;
	}
	
	//Returns the sql mode
	function get_sql_mode(){
		return $this->sql_mode;
	}
	
	//Returns all queries out of a dump string
	//$filename		query string
	function seperate_queries($filestring){
		$filestring = "\n".$filestring."\n";
		$filestring = $this->delete_sql_comment($filestring);
		$queries = $this->explode_queries($filestring);
		return $queries;
	}
	
	//Returns the queries out of a dumpfile
	//$filename		path to importfile	
	function import_query_file($filename){
		if(!file_exists ($filename) || !is_readable($filename)){error("File not found or nor readable");}
		$handle = fopen ($filename, "r");
		$file_contents = "";
		while(!feof($handle)){$file_contents .= fgets($handle, filesize($filename));}
		$queries = $this->seperate_queries($file_contents);
		return $queries;
	}
	
	//Returns a escaped string
	//$string 		string to escape
	function escape_string($string){
		switch ($this->sql_mode){
			case xsql_mysql:{
				$var = mysql_escape_string($string);
				break;
			}
			case xsql_mysqli:{
				$var = mysqli_escape_string($this->id, $string);
				break;
			}
			case xsql_psql:{
				$var = pg_escape_string($string);
				break;
			}
			default:{
				$this->internal_error(__Line__, __File__);
			}
		}
		return $var;
	}
	
//!!//Don't use
	function fetch_field_properties($tablename)
	{
		$result = array();		
		switch ($this->sql_mode){
			case xsql_mysql:{
			}
			case xsql_mysqli:{
				$query = "DESCRIBE ". $tablename;
				$query_id = $this->query($query);
				for($i = 0; ($res = $this->fetch_row($query_id, xsql_numeric)); $i ++)
				{
					$result[$i][0] = $res[0];
					if(substr_count($res[1], "(") != 0)
					{
						$result[$i][1] = strtoupper(substr( $res[1], 0, strpos($res[1], "(") ) );
						$result[$i][2]= substr($res[1], strpos($res[1], "(") + 1, strpos($res[1], ")") - strpos($res[1], "(") - 1);
					}
					else
					{
						$result[$i][1] = strtoupper($res[1]);
						$result[$i][2] = "";
					}
					$result[$i][3] = $res[2];
					$result[$i][4] = $res[4];
				}
				break;
			}
			case xsql_psql:{
				$query = "SELECT column_name AS Field, udt_name AS Type, character_maximum_length AS Lenght, is_nullable AS Null, column_default AS Default FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '". $tablename ."' AND TABLE_CATALOG = '".$this->database."'";
				$query_id = $this->query($query);
				for($i = 0; ($res = $this->fetch_row($query_id, xsql_numeric)); $i ++)
				{
					$res[1] = strtoupper($res[1]);
					if(is_numeric(substr($res[1], strlen($res[1])-1))){$res[1] = substr($res[1],0, strlen($res[1])-1);}
					$result[$i] = $res;
				}
				break;
			}
			default:{
				$this->internal_error(__Line__, __File__);
			}
		}
		return $result;
	}
	
	
	//------------------------------------------------ private methods ----------------------------------------------
	
	function get_elements_of($string, $query_seperator, $query_escape_char){return (substr_count($string, $query_seperator) - substr_count($string, $query_escape_char.$query_seperator));}
	function get_first_pos($string, $elements, $offset = 0){
			$pos = strlen($string)+1;
		for($i = 0; isset($elements[$i]); $i++)
		{
			$tmp_pos = strpos($string, $elements[$i],$offset);
			if($tmp_pos !== false && $tmp_pos < $pos)
			{
				$pos = $tmp_pos;
			}
		}
		if($pos >= strlen($string)){$pos = -1;}
		return $pos;
	}	
	function delete_mysql_comment($string)
	{
		for($i = 0;isset($this->mysql_comments[$i][0]);$i++)
		{
			$offset = 0;
			while(true)
			{
				$position_start = $this->get_first_pos($string, $this->mysql_comments[$i][0], $offset);
				if($position_start == -1){break;}
				if(!$this->is_val(substr($string,0,$position_start)))
				{
					$position_end = $this->get_first_pos($string, $this->mysql_comments[$i][1], $position_start+2);		
					if($position_end == -1){break;}
					$string = substr($string,0,$position_start).substr($string,$position_end+2);
				}
				else
				{
					flush();
					$offset = $position_start+2;
				}
			}
		}
		return $string;
	}
	function is_val($string)
	{
		$is_value = false;
		for($i = 0;isset($this->values[$i][0]);$i++)
		{
			if($this->get_elements_of($string,$this->values[$i][0],$this->values[$i][1])%2 != 0)
			{
				$is_value = true;
			}
		}
		return $is_value;
	}
	function explode_queries($string){
		$offset = 0;
		$pos = 0;
		$k = 0;
		$queries = array();
		while(($pos = strpos($string,$this->query_seperator, $offset)) !== false)
		{
			$tmp_str = substr($string,0,$pos);
			if(!$this->is_val($tmp_str))
			{
				if($this->sql_mode == xsql_psql){$tmp_str = $this->delete_mysql_comment($tmp_str);}
				$tmp_str = trim($tmp_str, "\r\n");
				if($tmp_str != "")
				{
					$queries[$k] = trim($tmp_str, "\r\n");
					$k++;
				}				
				$string = substr($string, $pos+1);
				$offset = 0; 
			}
			else
			{
				$offset = $pos+1;
			}
		}
		return $queries;
	}
	
	function delete_sql_comment($string){
		for($i = 0;isset($this->comments[$i][0][0]);$i++)
		{
			while(true)
			{
				$position_start = $this->get_first_pos($string, $this->comments[$i][0], 0);
				if($position_start == -1){break;}
				$position_end = $this->get_first_pos($string, $this->comments[$i][1], $position_start+1);		
				if($position_end == -1){break;}
				$string = substr($string,0,$position_start).substr($string,$position_end, strlen($string));
			}
		}
		return $string;
	}
	
	function set_type($type){
		if($type == xsql_mysql_auto && extension_loaded('mysqli'))
		{
			$type = xsql_mysqli;
		}
		else
		{
			$type = xsql_mysql;
		}
	
		if($type == xsql_mysql && !extension_loaded('mysql')){$this->internal_error(__Line__, __File__, "Unable to set sql mode to mysql, extension not loaded");}
		else if($type == xsql_mysqli && !extension_loaded('mysqli')){$this->internal_error(__Line__, __File__, "Unable to set sql mode to mysqli, extension not loaded");}
		else if($type == xsql_psql && !extension_loaded('pgsql')){$this->internal_error(__Line__, __File__, "Unable to set sql mode to pgsql, extension not loaded");}
		else if($type != xsql_mysql && $type != xsql_mysqli  && $type != xsql_psql){$this->internal_error(__Line__, __File__, "Unknown sql type");}
		$this->sql_mode = $type;
	}
	
	function connect($server, $username, $password ,$database , $port, $type){
		$this->set_type($type);
		$this->username = $username;
		$this->database = $database;
		$this->server = $server;  
		switch ($this->sql_mode){		
			case xsql_mysql:{
				set_error_handler("mysql_error_handler");
				$this->id = @mysql_connect($server.($port?":" .$port:""), $username, $password, true);
				if(!$this->id){
					if(mysql_errno())
					{
						$this->error(mysql_error());
					}
					else
					{
						global $mysql_last_connection_error;
						$this->error($mysql_last_connection_error);
					}
				}
				else
				{
					if($database && $database != "")
					{
						$this->select_database($database);
						if(mysql_errno($this->id)){$this->error(mysql_error($this->id));}
					}
					
				}
				restore_error_handler();
				break;
			}
			case xsql_mysqli:{
				$this->id = @mysqli_connect($server.($port?":".$port:""), $username, $password);
				if(!$this->id){
					if(mysqli_connect_errno())
					{
						$this->error(mysqli_connect_error());
					}
					else
					{
						$this->error("Unable to connect to server");
					}
				}
				else
				{
					if($database)
					{
						$this->select_database($database);
						if(mysqli_errno($this->id)){$this->error(mysqli_error($this->id));}
					}
					
				}		
				break;
			}
			case xsql_psql:{
				$connection_string  = $server?("host=".$server ." "):"";
				$connection_string .= $server?("user=".$username ." "):"";
				$connection_string .= $server?("password=".$password ." "):"";
				$connection_string .= $server?("dbname=". $database ." "):"";
				$connection_string .= $server?("port=".$port ." "):"";
				$this->id = @pg_connect($connection_string);
				if(!$this->id){$this->error("Unable to connect to Server");}
				break;
			}
			case 0:{
				die("Error");
			}
		}
	}
	
	function handle_error($query = false){
		switch ($this->sql_mode){
			case xsql_mysql:{
				if(@mysql_errno($this->id)){$this->error(mysql_error($this->id),$query);}
				break;
			}
			case xsql_mysqli:{
				if(@mysqli_errno($this->id)){$this->error(mysqli_error($this->id),$query);}
				break;
			}
			case xsql_psql:{
				if(($error = @pg_last_error($this->id))){$this->error($error,$query);}
				break;
			}
			default:{
				$this->internal_error(__Line__, __File__);
			}
		}
	}
	
	function error($msg = false, $query = false){
		if($msg != false)
		{
			$this->error_msg .= ($this->error_msg != "")?"\n<br>":"";
			$this->error_msg .= $msg;
			switch ($this->error_level)
			{
				case xsql_dont_show_errors:{
					break;
				}
				case xsql_show_errors:{
					print "\n".$msg;
					break;
				}
				case xsql_die_on_error:{
					$this->sql_exception($msg, "", $query);
					break;
				}
				case xsql_custom_errors:{
					$error_handler = $this->error_handler;
					$error_handler(0,$msg);
				}
				default:{
					$this->internal_error(__Line__, __File__);
				}
			}
		}
		else
		{
			return $this->last_errors();
		}
	}
	
	function internal_error($line, $file, $msg = false){die(($msg?("xsql libary: ".$msg ):"xsql libary: internal error"). " on line ". $line . " in file " . $file);}
	
	function sql_exception($message, $type, $query=false){
		if($query){
			die ("Error in query:<br>\n".
				$query."<br>\n".
				"Error: <br>\n". 
				$message);
		}
		else{
			die ($type . "<br>\n".
				"Got message: <br>\n". 
				$message);
		}
	}
	
	function check_conncetion_status(){if(!$this->id){$this->error("Connection is closed");}}
	function extension($ext_name){
		$dir = $this->extract_dir(__File__);
		$ext_file = $dir."/".$ext_name.".lib.php";
		if(!is_file($ext_file))
		{
			$this->internal_error(__Line__, __File__, "Unable to load file \"" . $ext_name ."\"");
		}
		return $ext_file;
	}
	function extract_dir($str){
		$str = str_replace("\\", "/", $str);
		$parts = explode("/", $str);
		$dir = "";
		$depth = 0;
		for($depth = 0; isset($parts[$depth+1]); $depth++)
		{
			$dir .= ($depth > 0)?"/".$parts[$depth]:$parts[$depth];
		}
		return $dir;
	}
}

$mysql_last_connection_error = "";
function mysql_error_handler($errno, $errmsg, $blabla, $bla)
{
	global $mysql_last_connection_error;
	$msg = explode(":", $errmsg, 2);
	$mysql_last_connection_error = $msg[1];
}
?>