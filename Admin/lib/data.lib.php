<?php

function data_getElement($element, $data)
{
	$elementKey = stringHex($element);
	
	$data = "\n" . $data . "\n";
	$searchKey = "\n" . $elementKey;
	
	$subjects = "";
	for($i = 0; $i < (strlen($data)-strlen($elementKey)-1); $i++)
	{
		if(substr($data, $i, strlen($searchKey)) == $searchKey)
		{
			$pos = $i + strlen($searchKey)+1;
			$pos2 = strpos($data,":", $pos);
			$pos3 = strpos($data,"\n", $pos2);
			
			$subjects[substr($data,$pos, $pos2-$pos)] = hexString(substr($data, $pos2+1, $pos3-$pos2-1));
		}
	}
	return $subjects;
}
function data_getSubelement($element, $subelement, $data)
{
	$elements = explode("\n", $data);
	$element = stringHex($element);
	$length = strlen($element);
	for($i = 0; isset($elements[$i]); $i++)
	{
		if(substr($elements[$i],0,$length) == $element)
		{
			$pos1 = strpos($elements[$i],"-");
			$pos2 = strpos($elements[$i],":");
			if(substr($elements[$i], $pos1+1, $pos2-$pos1-1) == $subelement)
			{
				return hexString(substr($elements[$i], $pos2+1, strlen($elements[$i])-$pos2-2));
			}
		}
	}
	return false;
}
function data_setElement($element, $subelement, $value, $data)
{
	$elementKey = stringHex($element);
	$data = "\n" . $data . "\n";
	$add = true;
	
	$searchKey = "\n" . $elementKey;
	
	for($i = 0; $i < (strlen($data)-strlen($elementKey)-1); $i++)
	{
		if(substr($data, $i, strlen($searchKey)) == $searchKey)
		{
			$pos = $i + strlen($searchKey)+1;
			$pos2 = strpos($data,":", $pos);
			$pos3 = strpos($data,"\n", $pos2);
			
			if(substr($data,$pos, $pos2-$pos) == $subelement)
			{
				$add = false;
				$data = substr($data, 0, $pos2+1) . stringHex($value) . substr($data, $pos3);
			}
		}
	}
	$data = substr($data, 1, strlen($data)-2);
	if($add)
	{
		$data .= stringHex($element)."-".$subelement.":". stringHex($value) . "\n";
	}
	return $data;
	
}
function data_getAllElements($data)
{
	$data = "\n" . $data . "\n";
	
	$subjects = "";
	for($i = 0; $i < strlen($data); $i++)
	{
		if(substr($data, $i, 1) == "\n")
		{
			$pos = strpos($data, "-", $i);
			if($pos !== false)
			{
				$pos += 1;
				$pos2 = strpos($data,":", $pos);
				$pos3 = strpos($data,"\n", $pos2);
				$subjects[hexString(substr($data,$i+1, $pos-$i-2))][substr($data,$pos, $pos2-$pos)] = hexString(substr($data, $pos2+1, $pos3-$pos2-2));
			}
		}
	}
	return $subjects;
}
function data_listElements($data)
{
	$data = "\n" . $data . "\n";
	
	$subjects = "";
	$z = 0;
	for($i = 0; $i < strlen($data); $i++)
	{
		if(substr($data, $i, 1) == "\n")
		{
			$pos = strpos($data, "-", $i);
			if($pos !== false)
			{
				$pos += 1;
				$subjects[$z] = hexString(substr($data,$i+1, $pos-$i-2));
				$z++;
			}
		}
	}
	return $subjects;
}
?>