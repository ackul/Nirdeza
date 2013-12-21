<?php

function csv_import($data, $table ,  $conID ,$headIsCol, $identifiedBy = '', $cols=false)
{
	global $client;
	$errors = "";
	$numErrors = 0;
	$executedQuerys = 0;
	$query = $client->query("show columns from ". $table);
	
	$insertCols = "";
	$CSVData = csv_readToArray($data);
	
	if($headIsCol == true)
	{
		for($i = 0;isset($CSVData[$i][0]); $i++)
		{
			$cols[$i] = $CSVData[$i][0];
			$CSVData[$i][0] = false;
		}
	}
	else if($cols != false && $headIsCol == false)
	{
			for($i = 0; isset($cols[$i]); $i++)
			{
				if($cols[$i] == "SPACER"){$cols[$i] = "";}
			}
	}
	else if($headIsCol == false && $cols == false)
	{
			for($i = 0; $res = $client->fetch_row($query); $i++)
			{
				$cols[$i] = $res[0];
			}
	}
	
	if($identifiedBy != ""){
		$QueryPart1 = "UPDATE `". $table . "` SET ";
		$QueryPart3 = " WHERE `". $identifiedBy . "` = '";
	}
	else{
		$QueryPart3 = ")";
		$QueryPart4 = "";
	}
	
	$QueryPart2 = "";	
	for($i = ($headIsCol == true)?1:0; isset($CSVData[0][$i]); $i++)
	{		
		for($k = 0; isset($CSVData[$k][$i]); $k++)
		{
			if(isset($CSVData[$k][$i]) && isset($cols[$k]) && $cols[$k] != "")
			{
				if($identifiedBy != $cols[$k])
				{
					if($QueryPart2 != ""){$QueryPart2 .= ", ";}
					if($identifiedBy != ""){
						$QueryPart2 .=  "`".  $cols[$k] . "` = '" . $client->escape_string ($CSVData[$k][$i])  . "'";
					}
					else{
						$QueryPart2 .=  "'" . $client->escape_string ($CSVData[$k][$i])  . "'";
						if($insertCols != ''){$insertCols .= ",";}
						$insertCols .= "`" . $cols[$k] . "`";				
					}
				}
				else
				{
					$QueryPart4 = $CSVData[$k][$i] . "'";
				}
			}
			else if(isset($cols[$k]) && $cols[$k] != "")
			{
				if($QueryPart2 != ""){$QueryPart2 .= ", ";}
				if($identifiedBy != ""){
					$QueryPart2 .=  "`".  $cols[$k] . "` = ''";
				}
				else{
					$QueryPart2 .=  "''";				
				}
			}
		}
		if($QueryPart2 != "")
		{
			if($identifiedBy == ''){
				$QueryPart1 = "INSERT `". $table . "`(". $insertCols .") VALUES(";
				$insertCols = '';
			}
			$FullQuery = $QueryPart1 . $QueryPart2 . $QueryPart3 . $QueryPart4;
			$client->query($FullQuery);
			$executedQuerys++;
			$error = $client->last_errors();
			if($error != ""){$errors .= sqlError($error, $FullQuery); $numErrors++;}
			$QueryPart2 = "";
			$QueryPart4 = "";
		}
	}
	$ret[0] = $errors;
	$ret[1] = $numErrors;
	$ret[2] = $executedQuerys;

	return $ret;
}
function csv_readToArray($filename)
{
	Global $lib_errors,$csv_escapedBy, $csv_limiter,$csv_nextElement, $csv_endLine;
	if(!file_exists ($filename)){errorDie($lib_errors['file not found'],"","../");}
	$handle = fopen ($filename, "r");
	$open = false;
	$lastSign = "";
	
	$x = 0;
	$y = 0;
	
	$buffer = "";
	
	$data = "";
	
	while (!feof($handle))
	{	
		$Sign = fgets($handle, 2);
		
		if($Sign == $csv_limiter ){
			if($lastSign == $csv_escapedBy && $open == false)
			{
				$open = false;
			}
			else if($lastSign != $csv_escapedBy && $open == false)
			{
				$open = true;
			}
			else if($lastSign != $csv_escapedBy && $open == true)
			{
				$open = false;
			}
			$Sign = "";
		}
		if($Sign == $csv_nextElement && $open != true)
		{
			$data[$x][$y] = $buffer;
			$buffer = "";
			$x+=1;
			$Sign = "";
		}
		else if($Sign == $csv_endLine && $open != true)
		{
			$data[$x][$y] = $buffer;
			$buffer = "";
			$Sign = "";
			$y+=1;
			$x=0;
		}
		$buffer .= $Sign;
		$lastSign = $Sign;
	}
	if($buffer != "")
	{
		$data[$x][$y] = $buffer;
	}
	return $data;
}

?>