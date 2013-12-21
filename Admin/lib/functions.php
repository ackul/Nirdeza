<?php
function conv($str)
{
	return hexString($str);
}
function stringHex ($s) {
  $r = "0x";
  $hexes = array ("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f");
  for ($i=0; $i<strlen($s); $i++) {$r .= ($hexes [(ord($s{$i}) >> 4)] . $hexes [(ord($s{$i}) & 0xf)]);}
  return $r;
}
function hexString($str)
{
	$i = 2;
	$endstr = "";
	while($i < strlen($str))
	{
		$endstr .= chr(hexdec(substr($str ,$i , 2)));
		$i+=2;
	}
	return $endstr;
}
function decrypt($value, $key)
{
	while (strlen($key) < 24){$key .= "e";}
	if(strlen($key) > 24){$key = substr($key, 0, 24);}
	$ciphertext = conv($value);
	$recovered_message = des ($key, $ciphertext, 0, 0, null);
	return $recovered_message;
}
function encrypt($value, $key)
{
	while (strlen($key) < 24){$key .= "e";}
	if(strlen($key) > 24){$key = substr($key, 0, 24);}
	$crypt_message = des ($key, $value, 1 , 0 , null);
	return stringHex($crypt_message);
}

function makePath()
{
	$items = array('ID', 'Table', 'DB');
	$path = "";
	$isFirst = 0;
	for($i=0 ; isset($items[$i]); $i++)
	{
		
		if(isset($_GET[$items[$i]]))
		{
			if($isFirst == 1){$path .= "&";}
			$path .= $items[$i]. "=" . $_GET[$items[$i]];
			$isFirst = 1;
		}
		
	}
	return $path;
}
function clearSlashes($buffer)
{
	if (get_magic_quotes_gpc())
	{
		$buffer = stripslashes ($buffer); 
	}
	return $buffer;
}
function getEnumsFromField($type)
{
	$enums = $type;
	//$enums = substr($type, strpos($type, "(") + 1, strpos($type, ")") - strpos($type, "(") - 1);
	$res = advancedExplode($enums, ',' , Array('\'') , Array('\\', '\''));
	$res[count($res)] = '';
	return $res;
		
}
function getSetFromDefault($type)
{
	//print "\"" . $type . "\"";
	$res = 	advancedExplode($type, ',' , Array('\'') , Array('\\', '\''));
	//print_r($res);
	return $res;
}

function advancedExplode($data, $elementSeperator, $seperator, $escapeChars)
{
	$data_lenght = strlen($data);
	$escapeChars = array_flip($escapeChars);
	$seperator = array_flip($seperator);
	$element = 0;
	$lastChar = '';
	$open = false;
	$buffer = '';
	$result = Array();
	for($i = 0; $i < $data_lenght; $i++)
	{
		$char = substr($data, $i, 1);
		if(array_key_exists($char, $seperator) && !array_key_exists($lastChar, $escapeChars))
		{
			$open = ($open)?false:true;
		}
		else if($char == $elementSeperator && !$open)
		{
			$result[$element] = $buffer;
			$buffer = '';
			$element++;
		}
		else
		{
			$buffer .= $char;
		}
		$lastChar = $char;
	}
	if($buffer != '')
	{
		$result[$element] = $buffer;
	}
	return $result;
}
function makeOptions($data, $selectedItem = array(false), $values = false)
{
	$result = '';
	foreach($data as $i => $tmp)
	{
		$dataString = htmlspecialchars($data[$i]);
		$result .= "\n<option value=\"";
		$result .= ($values!=false)?$values[$i]:$dataString;
		$result .= "\"";
		$result .= (($values==false && in_array($data[$i], $selectedItem, true)) || in_array($values[$i], $selectedItem, true))?" selected":"";
		$result	.= ">$dataString</option>";
	}
	return $result;
}
function loadVars($names)
{
	for($i = 0; isset($names[$i]); $i++)
	{
		$varname = $names[$i];
		if(isset($_GET[$varname]) || isset($_POST[$varname]))
		{
			
			global $$varname;
			$$varname = (isset($_GET[$varname]))?$_GET[$varname]:$_POST[$varname];
		}
	}
	
}
function dontCache()
{
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
}
function extractDir($str)
{
	$parts = explode("/", $str);
	$dir = "";
	$depth = 0;
	for($depth = 0; isset($parts[$depth+1]); $depth++)
	{
		$dir .= "/".$parts[$depth];
	}
	return array($dir, $depth);
}
function pathToBasedir($filename)
{
	$options = extractDir($filename);
	$path = "";
	for($i = 0; $i < $options[1]; $i++)
	{
		$path .= "../";
	}
	if($path == ""){$path = "./";}
	return $path;
}
function microtimeFloat()
{
   list($usec, $sec) = explode(" ", microtime());
   return ((float)$usec + (float)$sec);
}

function getTable()
{
	//Check for modifed table names in GET and POST
	if(isset($_POST['table']) && isset($_GET['Table']) && $_GET['Table'] != $_POST['table'])
	{
		accessViolation();
	}
	//Load table name of current table
	$tableName = "";
	if(isset($_POST['table'])){$tableName = $_POST['table'];}
	else if(isset($_GET['Table'])){$tableName = $_GET['Table'];} 
	return $tableName;
}
function redirect($toPage)
{
	dontCache();
	die("<html><head><meta http-equiv=\"refresh\" content=\"0; URL=$toPage\"></head><body onLoad=\"javascript:self.open('$toPage', '_self');\"></body></html>");
}
function createGetPath($table = false, $arguments = array())
{
	global $userinfo;
	if(is_array($table))
	{
		$arguments = $table;
	}
	else if($table == true)
	{
		$arguments['Table'] = getTable();
	}
	/*if(!isset($arguments['Database']))
	{
		$arguments['Database'] = $userinfo['database'];
	}*/
	$path = "?ID=" . $userinfo['unid'];

	foreach($arguments as $key => $value)
	{
		$path .= "&" . $key . "=" . urlencode($value);
	}
	return $path;
}

?>