<?php
$starttime = microtime();

$lang_filename = "io/print.php";
include "../templates/normal.inc.php";

loadVars(array('ID', 'Table', 'DB', 'site', 'maxlength', 'orderMode', 'orderType', 'orderBy', 'showTable', 'to',  'from', 'show', 'showExport', 'chosen'));

//Einstellungen laden
$safeItems = array('site', 'maxlength', 'orderMode', 'orderType', 'orderBy', 'showTable', 'to', 'from', 'show', 'showExport');
$settings = data_getElement($Table, $userinfo['data']);
for($i = 0; isset($safeItems[$i]); $i++)
{
	if(!isset($$safeItems[$i]) && $safeItems[$i] != "" && isset($settings[$safeItems[$i]]))
	{
		$$safeItems[$i] = $settings[$safeItems[$i]];
	}
}

//Übergebene Werte einlesen, wenn vorhanden
$maxlength = (isset($maxlength) && $maxlength!=0)?$maxlength:30;
$site = (isset($site))?$site:1;


//Funktionen zum Erzeugen eines String für die Übergabe in einem Formular
function makeGETWithoutItem($Item , $Array)
{
	$items = array('ID', 'Table', 'DB', 'site', 'maxlength', 'orderMode', 'orderType', 'orderBy', 'showTable', 'to',  'from', 'show', 'showExport');
	$arrays = array('chosen');
	if($Array == 0){$Array = Array();}
	if($Item == 0){$Item = Array();}
	$Array = array_flip($Array);
	$Item = array_flip($Item);
	$path = "";
	for($i=0 ; isset($items[$i]); $i++)
	{
		$name = $items[$i];
		global $$name;	
		if(isset($$name) && !isset($Item[$i]))
		{
			$path .= "<input type=hidden name=\"". $name. "\" value=\"" . $$name. "\">";
		}
		
	}
	for($i=0 ; isset($arrays[$i]); $i++)
	{
		$name = $arrays[$i];
		global $$name;
		if(isset($$name) && !isset($Array[$i]))
		{
			$var = $$name;
			for($k = 0; isset($var[$k]); $k++)
			{
			$path .= "<input type=hidden name=\"". $name. "[]\" value=\"" . $var[$k]. "\">";
			}
		}
		
	}
	return $path;
}

//Sortiereinstellungen laden
$Order = "";
if(isset($orderMode ) && $orderMode  != "normal")
{
  	$Order .= "ORDER BY '" . $orderBy  . "' ";
  	if(isset($orderType ) && $orderType  == "DESC")
	{
		$Order .= "DESC ";
	}
	else
	{
		$Order .= "ASC ";
	}
}

//Ermitteln der gewählten Spalten und Array flippen
if(isset($chosen))
{
	$values = array_flip($chosen);
}

//Spalten abfragen
$query = "show columns from ". $Table;
$queryID = $client->query($query);
$selectedCols = '';
$selectedCols2 = '';

if(isset($chosen))
{
	for($i = 0; isset($chosen[$i]); $i++)
	{
		if($i != 0){$columns .= ",";}
		else{$columns = "";}
		$columns .= "`". $chosen[$i] . "`";
	}
}
else
{
	$columns = "*";
}

//Spalten abfragen und Options erzeugen
for($i = 0; $res = $client->fetch_row($queryID); $i++)
{
   	$selectedCols .= "<option value=\"". $res[0] ."\" ";
   	$selectedCols .= ((isset($values) && array_key_exists($res[0] , $values)) ||!isset($values))?"selected":"";
   	$selectedCols .= ">". $res[0] ."</option>";
	$selectedCols2 .= "<option value=\"". $res[0] ."\" ";
   	$selectedCols2 .= (isset($orderBy) && $orderBy == $res[0])?"selected":"";
   	$selectedCols2 .= ">". $res[0] ."</option>";
}

//Anzahl der Datensätze abfragen
$tag1 = 'SELECT COUNT(*) as `Lines` from '. $Table;
$result_id = $client->query ($tag1);
$contents = $client->fetch_row($result_id);
$contents = $contents[0];

//Seitenanzahl ermitteln
$sites = intval($contents / $maxlength);
if (($contents%$maxlength) != 0){$sites ++;}
if($site > $sites){$site = $sites;}
if($site <= 0){$site = 1;}


//Grenzen für das Hauptquery
if(isset($from) && isset($to) && isset($show) && $show  == "fromTo")
{
	$fromTo = " ".$from.", ".($to-$from). " ";
	$selectionMode = 'fromTo';	
}
else
{
	$fromTo = ($site - 1)*$maxlength .",". $maxlength;
	$selectionMode = 'site';
}

//Hauptquery aufbauen
$tag2 = "SELECT $columns FROM ". $Table . " " . $Order ." LIMIT ". $fromTo . "";
$result_id2 = $client->query ($tag2);
?>
<html>
	<head>
		<title><?php print $lang['title']; ?></title>
	</head>
	<body onLoad="print();" style="font-size:10pt;">
	<center>
	<b><?php print $lang['table']; ?> '<i><?php print $Table; ?></i>'</b><br><br>
	<?php
	if($result_id2 != null)
	{
	?>
	<table border="1" bordercolor="#000000" style="border-collapse:collapse;font-size:10pt;">
		<tr>
		<?php
	
    	for ($i = 0; $i < $client->num_fields($result_id2); $i++) 
	{
		$meta = $client->fetch_field($result_id2, $i);
		$rowname = htmlspecialchars ($meta->name);
		?>
		<th nowrap>&nbsp;&nbsp;<?php print $rowname; ?>&nbsp;</th>
		<?php
	 }
	?>
		</tr>
	<?php
			$zahl = 0;
			while (($row = $client->fetch_row ($result_id2)) )
			{
					  ?>
		<tr>
		<?php
				for($i = 0; $i < sizeof($row); $i++)
				{
					if(sizeof($row[$i]) == 0){$row[$i] = 'NULL';}
					else if($row[$i] == NULL){$row[$i] = '';}
					$vari = stringHex($row[$i]);
					print ("		<td>&nbsp;");
					print (htmlspecialchars ($row[$i]));
					print ("&nbsp;</td>\n");
				}
				$zahl++;
					?>
			</tr>
			<?php
			}
			?>
					
	</table>
	<?php
	}
	else
	{
		print "<br /><i>" . $lang['no datasets found'] . "</i><br />";
	}
	?>
	</center>
	</body>
</html>