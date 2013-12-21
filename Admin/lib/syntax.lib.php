<?php 
function syntax($Query)
{
	global $sql_color_normal , $sql_color_comment ,$sql_color_values ,$sql_color_fields,$sql_color_sql_comment;
	$SubID = 0;
	$open1 = false;
	$open2 = false;
	$open3 = false;
	$comment = false;
	$comment2 = false;
	$QueryBuffer = "";
	$LastSign = "";
		
	//Einzelne Querys bearbeiten
	for($i = 0; $i <= strlen($Query); $i ++)
	{
		$QueryBuffer .= htmlspecialchars ( substr ($Query, $i, 1));
		
		if($LastSign == "\\")
		{
		}
		else if (substr ($Query, $i, 1) == "\"" && !$open2 && !$open3)
		{
			if($open1 == true){$open1 = false; $QueryBuffer = substr($QueryBuffer, 0, strlen ($QueryBuffer) -6). "</font>" . substr($QueryBuffer, strlen ($QueryBuffer) -6, 6);}
			else{$open1 = true; $QueryBuffer .= "<font color=".$sql_color_values.">";}
		}
		else if (substr ($Query, $i, 1) == "'" && !$open1 && !$open3)
		{
			if($open2 == true){$open2 = false; $QueryBuffer = substr($QueryBuffer, 0, strlen ($QueryBuffer) -1). "</font>" . substr($QueryBuffer, strlen ($QueryBuffer) -1, 1);}
			else{$open2 = true; $QueryBuffer .= "<font color=".$sql_color_values.">";}
		}
		else if (substr ($Query, $i, 1) == "`" && !$open2 && !$open1)
		{
			if($open3 == true){$open3 = false; $QueryBuffer = substr($QueryBuffer, 0, strlen ($QueryBuffer) -1). "</font>" . substr($QueryBuffer, strlen ($QueryBuffer) -1, 1);}
			else{$open3 = true; $QueryBuffer .= "<font color=".$sql_color_fields.">";}
		}
		
		if(substr ($Query, $i, 1) == ";" && !$open1 && !$open2 && !$open3)
		{
			$SubID ++;
		}
		$LastSign = substr ($Query, $i, 1);
	}
	
	//Kommentare bearbeiten
	$Query = "\n" . $QueryBuffer . "\n";
	$Query = highlightKeywords($Query);
	$Query = highlightArea($Query, array("\n--", "\r--"), array("\n", "\r"), $sql_color_comment, true);
	$Query = highlightArea($Query, array("\n#", "\r#"), array("\n", "\r"), $sql_color_comment, true);
	$Query = highlightArea($Query, array("/*"), array("*/"), $sql_color_sql_comment, false);
	$Query = trim($Query);
	$Query = "<font color=". $sql_color_normal .">". nl2br ($Query). "</font>";
	
	return $Query;
}
function highlightArea($string, $startSigns, $endSigns, $color, $exclude_first_sign = false)
{
	$stringBuffer = "";
	$string = " " .$string;
	while(checkIfIn($string, $startSigns))
	{
		$Pos1 = getFirstPosition($string, $startSigns, 0, false);
		if(!isValue($stringBuffer . $string, $Pos1))
		{
			if($exclude_first_sign){$Pos1++;}
			$Pos2 = getFirstPosition($string, $endSigns, $Pos1+1, true);
			if(!$exclude_first_sign){$Pos2++;}
			$stringBuffer .= substr ($string, 0, $Pos1) . "<font color=$color>". strip_tags(substr ($string, $Pos1, $Pos2-$Pos1-1)) ."</font>";
			$string =  substr ($string , $Pos2-1);
		}
		else
		{
			$stringBuffer .= substr($string, 0 , $Pos1+1);
			$string = substr($string, $Pos1+1);
		} 
	}
	$stringBuffer .= $string;
	return $stringBuffer;
}
function isValue($string, $position)
{
	global $sql_values, $sql_escape_char;
	$substr = substr($string, 0, $position);
	foreach($sql_values as $limiter)
	{
		if((substr_count($substr, $limiter)-substr_count($substr, $sql_escape_char.$limiter))%2 != 0)
		{
			return true;
		}
	}
	return false;
}
function highlightKeywords($string)
{
	global $sql_keywords, $sql_color_keyword;
	foreach($sql_keywords as $keyword)
	{
		$tmp_string = "";
		$keyword .= " ";
		$key_length = strlen($keyword);
		$i = 0;
		while(true)
		{
			$startpos = strpos(strtoupper($string), $keyword, $i);
			if($startpos === FALSE)
			{
				break;
			}
			else if(!isValue($string, $startpos))
			{
				$tmp_string .= substr($string, $i, $startpos - $i) . "<font color=" . $sql_color_keyword . ">" . substr($string, $startpos, $key_length)  . "</font>"; 
			}
			else
			{
				$tmp_string .= substr($string, $i, ($startpos - $i)+$key_length);
			}
			$i = $startpos+$key_length;
		}
		$tmp_string .= substr($string, $i);
		$string = $tmp_string;
	}
	return $string;
}
function checkIfIn($string, $values)
{
	for($i = 0; isset($values[$i]); $i++)
	{
		if(substr_count ($string, $values[$i]) > 0){return true;}
	}
	return false;
}
function getFirstPosition($string, $values, $offset, $addValueLenght)
{
	$pos = strlen($string);
	for($i = 0; isset($values[$i]); $i++)
	{
		$tmppos = strpos($string, $values[$i], $offset);
		if($tmppos !== false)
		{
			if($addValueLenght == true){$tmppos += strlen($values[$i]);}
			if($tmppos < $pos){$pos = $tmppos;}
		}
	}
	return $pos;
}
?>
