<?php 
function seperateQuerys($Query, $client = false)
{
	Global $lib_errors;
	$SubID = 0;
	$open1 = false;
	$open2 = false;
	$open3 = false;
	$comment = false;
	$comment2 = false;
	$QueryBuffer = "";
	$LastSign = "";
	$Errors = 0;
	$ErrorMessages = "";
	$queryid = 0;
	
	if($client == false)
	{
		global $client;
	}
	
	$Query =  clearComments($Query);
	
	//Einzelne Querys ermitteln und ausführen
	for($i = 0; $i <= strlen($Query); $i ++)
	{
		if($LastSign == "\\")
		{
		}
		else if (substr ($Query, $i, 1) == "\"" && !$open2 && !$open3)
		{
			if($open1 == true){$open1 = false;}
			else{$open1 = true;}
		}
		else if (substr ($Query, $i, 1) == "'" && !$open1 && !$open3)
		{
			if($open2 == true){$open2 = false;}
			else{$open2 = true;}
		}
		else if (substr ($Query, $i, 1) == "`" && !$open2 && !$open1)
		{
			if($open3 == true){$open3 = false;}
			else{$open3 = true;}
		}
		
		$QueryBuffer .= substr ($Query, $i, 1);
		
		if(substr ($Query, $i, 1) == ";" && !$open1 && !$open2 && !$open3)
		{
			$queryid = $client->query($QueryBuffer);
			if($client->error() != "")
			{
				$Errors ++;
				$ErrorMessages .= sqlError($client->last_errors(), $QueryBuffer);
			}
			$SubID ++;
			$QueryBuffer = "";
		}
		$LastSign = substr ($Query, $i, 1);
	}
	
	if($SubID == 0)
	{
		$queryid = $client->query($QueryBuffer);
		
		if(($error = $client->last_errors()) != "")
		{
			$Errors ++;
			$ErrorMessages .= sqlError($error, $QueryBuffer);
		}
		$SubID ++;
		$QueryBuffer = "";
	}
	
	$Stat[0] = $SubID;
	$Stat[1] = $Errors;
	$Stat[2] = $ErrorMessages;
	$Stat[3] = $queryid;
	return $Stat;
}
function clearComments($QueryBuffer)
{
	//Kommentare löschen
	$Query = "\n" . $QueryBuffer . "\n";
	$QueryBuffer = "";
	$Pos = 0;
	while(substr_count ($Query, "\n--") != 0)
	{
		$Pos = strpos($Query, "\n--");
		if(strpos($Query, "\n", $Pos+1) < strpos($Query, "\r", $Pos+1)){$Pos2 = strpos($Query, "\n", $Pos+1);}
		else{$Pos2 = strpos($Query, "\r", $Pos+1);}
		if($Pos2 == false)
		{
			$Pos2 = strlen ($Query);
		}
		$QueryBuffer .= substr ($Query, 0, $Pos);
		$Query = substr ($Query , $Pos2 , strlen($Query) - $Pos2);
	}
	$QueryBuffer .= $Query;
	$Query = $QueryBuffer;
	$QueryBuffer = "";
	$Pos = 0;
	while(substr_count ($Query, "\n#") != 0)
	{
		$Pos = strpos($Query, "\n#");
		if(strpos($Query, "\n", $Pos+1) < strpos($Query, "\r", $Pos+1)){$Pos2 = strpos($Query, "\n", $Pos+1);}
		else{$Pos2 = strpos($Query, "\r", $Pos+1);}
		if($Pos2 == false)
		{
			$Pos2 = strlen ($Query);
		}
		$QueryBuffer .= substr ($Query, 0, $Pos);
		$Query = substr ($Query , $Pos2 , strlen($Query) - $Pos2);
	}
	$QueryBuffer .= $Query;
	return $QueryBuffer;
}

function read_query_file($Filename,$showProgress = false,  $client = false)
{
	$SubID = 0;
	$open1 = false;
	$open2 = false;
	$open3 = false;
	$comment = false;
	$comment2 = false;
	$QueryBuffer = "";
	$LastSign = "";
	$Errors = 0;
	$ErrorMessages = "";
	$queryid = 0;
	
	if($client == false)
	{
		global $client;
	}
	
	if(!file_exists ($Filename)){errorDie($lib_errors['file not found'],"","../");}
	$handle = fopen ($Filename, "r");
	
	$prozent2 = filesize($Filename)/10;
	$i=0;
	
	
	//Einzelne Querys ermitteln und ausführen
	while (!feof($handle))
	{
		$i++;
		if($showProgress && $i>=$prozent2)
		{
			$i = 0;
			print "<img src=\"../img/progress.gif\">";
			flush();
		}
		$Sign = fgets($handle, 2);
		if($LastSign == "\\")
		{
		}
		else if ($Sign == "\"" && !$open2 && !$open3)
		{
			if($open1 == true){$open1 = false;}
			else{$open1 = true;}
		}
		else if ($Sign == "'" && !$open1 && !$open3 )
		{
			if($open2 == true){$open2 = false;}
			else{$open2 = true;}
		}
		else if ($Sign == "`" && !$open2 && !$open1 )
		{
			if($open3 == true){$open3 = false;}
			else{$open3 = true;}
		}
		else if ($Sign == '-' && $LastSign == "\n")
		{
			$comment = true;
			$QueryBuffer = substr($QueryBuffer, 0 , strlen($QueryBuffer) - 2);
		}
		
		if(!$comment)
		{
			$QueryBuffer .= $Sign;
		}
		if($comment && $Sign == "\n")
		{
			$comment = false;
		}
		
		if($Sign == ";" && !$open1 && !$open2 && !$open3 && !$comment)
		{
			$queryid = $client->query($QueryBuffer);
			$errors = $client->last_errors();
			if($errors != "")
			{
				$Errors ++;
				$ErrorMessages .= sqlError($errors, $QueryBuffer);
			}
			$SubID ++;
			$QueryBuffer = "";
		}
		$LastSign = $Sign;
	}
	
	if($SubID == 0)
	{
		$queryid = $client->query($QueryBuffer);
		if(($error = $client->last_errors()) != "")
		{
			$Errors ++;
			$ErrorMessages .= sqlError($error(), $QueryBuffer);
		}
		$SubID ++;
		$QueryBuffer = "";
	}
	fclose ($handle); 
	
	$Stat[0] = $SubID;
	$Stat[1] = $Errors;
	$Stat[2] = $ErrorMessages;
	$Stat[3] = $queryid;
	return $Stat;
}
?>
