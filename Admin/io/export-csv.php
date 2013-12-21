<?php
$lang_filename = "io/export-csv.php";
include "../templates/normal.inc.php";

if(!ssy_operationPermitted("export", getTable())){unauthorized();}

$table = $_GET['Table'];

header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=". $table. ".csv");

if(isset($_POST['exportFrom']) && isset($_POST['exportTo']) && isset($_POST['exportVars']) && $_POST['exportVars'] == "fromTo")
{
  	$fromTo = " LIMIT ".$_POST['exportFrom'].", ".($_POST['exportTo']-$_POST['exportFrom']). " ";
}
else if(isset($_POST['from']) && isset($_POST['to']) && isset($_POST['show']) && $_POST['show'] == "fromTo")
{
  	$fromTo = " LIMIT ".$_POST['from'].", ".($_POST['to']-$_POST['from']). " ";
}
else
{
	if(!isset($_POST['site'])){$_POST['site'] = 0;}
	else{$_POST['site'] = $_POST['site'] - 1;}
	if(!isset($_POST['maxlength'])){$_POST['maxlength'] = 30;}
	$fromTo = " LIMIT ".($_POST['site']*$_POST['maxlength']).", ". $_POST['maxlength'] . " ";
}

$orderBy = "";
if(isset($_POST['orderMode']) && isset($_POST['orderType']) && isset($_POST['orderBy']))
{
	if($_POST['orderMode'] != "normal")
	{
		$orderBy = " ORDER BY `". $_POST['orderBy'] . "` "; 
		$orderBy .= ($_POST['orderType'] == "DESC")?"DESC ":" ";
	} 
}

$colHead = "";
$selectedCols = "";
if(isset($_POST['chosen']))
{
	$cols = $_POST['chosen'];
	for($i = 0; $i < sizeof($cols); $i+=1)
	{
		if($selectedCols == "")
		{
			$selectedCols = " `". $cols[$i] . "`";
			$colHead .= $csv_limiter.$cols[$i].$csv_limiter;
		}
		else
		{
			$selectedCols .= ", `". $cols[$i] . "`";
			$colHead .= $csv_nextElement.$csv_limiter.$cols[$i].$csv_limiter;
		}
	} 
}
else
{
	$selectedCols = "*";
	
	$isFirst = true;
	$cols = $client->query("SHOW COLUMNS FROM `". $table . "`");
	while($result = $client->fetch_row($cols))
	{
		if(!$isFirst){$colHead .= $csv_nextElement;}
		$colHead .= $csv_limiter.$result[0].$csv_limiter;
		$isFirst = false;
	}
}

if(isset($_POST['ColsInHead']) && $_POST['ColsInHead'] == "ON")
{
	print $colHead.$csv_endLine;
}

$query = "SELECT " . $selectedCols . " FROM `". $table . "`". $orderBy . "" . $fromTo;
$queryId = $client->query($query);
print $client->error();

while($row = $client->fetch_row($queryId))
{
	for($i = 0; $i <= sizeof($row); $i++)
	{
		if(isset($row[$i]))
		{
			$row[$i] = str_replace ($csv_limiter, $csv_escapedBy.$csv_limiter, $row[$i]);
			if($i != 0)
			{
				print $csv_nextElement;
			}
			print $csv_limiter . $row[$i] . $csv_limiter;
		}
		else
		{
			if($i != 0)
			{
				print $csv_nextElement;
			}
			print $csv_limiter . $csv_limiter;
		}
	}
	print $csv_endLine;
}
?>