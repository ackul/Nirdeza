<?php
$starttime = microtime();

$lang_filename = "tableData.php";
include "./templates/normal.inc.php";

$time = time();

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
$site = (isset($site) && $site != 0)?$site:1;


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
$all_columns = getColumns(getTable());
foreach($all_columns as $name => $value)
{
   	$selectedCols .= "<option value=\"". $name ."\" ";
   	$selectedCols .= ((isset($values) && array_key_exists($name, $values)) ||!isset($values))?"selected":"";
   	$selectedCols .= ">". $name ."</option>";
	$selectedCols2 .= "<option value=\"". $name ."\" ";
   	$selectedCols2 .= (isset($orderBy) && $orderBy == $name)?"selected":"";
   	$selectedCols2 .= ">". $name ."</option>";
}

//Anzahl der Datensätze abfragen
$tag1 = 'SELECT COUNT(*) AS `Lines` FROM '. $Table;
$client->query($tag1);
$contents = $client->fetch_row();
$show_values = $contents[0];
$contents = ($contents[0] <= 0)?0:$contents[0];


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
$result_id2 = $client->query($tag2);

paintHead();
flush();
?>
<script language="javascript" type="text/javascript">
<!--
var action = "<?php print $_SERVER['PHP_SELF'].createGetPath(true);?>";
var question = "<?php print $lang['delete ds'];?>"
var sExport = "<?php print (isset($showExport) && $showExport == 1)?0:1; ?>";
var sTable = "<?php print (isset($showTable) && $showTable == 1)?0:1; ?>";
var insertAction = "functions/editContent.php<?php print createGetPath(true, array('type' => 'insert'));?>";
-->
</script>
<script src="scripts/tableData.js" type="text/javascript"></script>
	<center>
	<form method="post" name="vars" action="<?php print $_SERVER['PHP_SELF']; ?>">
		<?php  print makeGETWithoutItem(Array(), Array());?>
	</form>
	<b><?php print $lang['overview over table']; ?></b> <i><?php print $Table; ?></i>
	<br />
	<br />
	  <table class="noBorder" width="330">
	  	<tr>
			<th colspan="4"><b><?php if(!isset($showTable) || $showTable == 0){?><img src="img/down.gif" onClick="setTable();" style="cursor:pointer "> <a href="javascript:setTable()"><?php print $lang['extended overview']; ?></a><?php }else{ ?><img src="img/up.gif" onClick="setTable();" style="cursor:pointer"> <a href="javascript:setTable()"><?php print $lang['extended overview hide']; ?></a><?php }?></b></th>
		</tr>
		<?php if(isset($showTable) && $showTable == 1){ ?>
		<form method="POST" name="order" action="<?php print $_SERVER['PHP_SELF'].createGetPath(true);?>">
		<tr>
		  <td><input type="radio" name="orderMode" value="normal" <?php if(isset ($orderMode)){if($orderMode == "normal"){print "checked";}}else{print "checked";}?>></td>
		  <td><font size="2"><?php print $lang['basic sorting']; ?></font></td>
		  <td><?php print makeGETWithoutItem(Array(4, 5, 6, 7), Array(0)); ?></td>
		  <td>&nbsp; </td>
		</tr>
		<tr>
			<td><input type="radio" name="orderMode" value="extended" <?php if(isset ($orderMode) && $orderMode == "extended"){print "checked";}?>></td>
			<td><font size="2"><?php print $lang['order by']; ?></font></td>
			<td>  
				<select name="orderBy" onchange="document.order.orderMode[1].checked = true">
					<?php  print $selectedCols2; ?>
				</select>
			</td>
			<td>
				<select name="orderType" onchange="document.order.orderMode[1].checked = true">
					<option value="DESC" <?php if(isset ($orderType) && $orderType == "DESC"){print "selected";}?>><?php print $lang['DESC']; ?></option>
					<option value="NDESC" <?php if(isset ($orderType) && $orderType == "NDESC"){print "selected";}?>><?php print $lang['ASC']; ?></option>
				</select>
			</td>
		</tr>
		<tr>
		  <td><input type="radio" name="show" value="normal" <?php if($selectionMode == 'site'){print "checked";} ?>></td>
		  <td><font size="2"><?php print $lang['normal site selection'];  ?></font></td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		</tr>
		<tr>
		  <td></td>
		  <td></td>
		  <td></td>
		  <td></td>
		</tr>
		<tr>
		  <td></td>
		  <td><font size="2"><?php print $lang['max data sets']; ?></font></td>
		  <td>&nbsp;</td>
		  <td><input type="text" name="maxlength" size="3" value="<?php print $maxlength; ?>"></td>
		</tr>
		<tr>
		  	<td><input type="radio" name="show" value="fromTo" <?php if($selectionMode == 'fromTo'){print "checked";} ?>></td>
		  	<td colspan="3">
				<font size="2"><?php print $lang['data sets from']; ?></font>
				<input type="text" name="from" size="3" value="<?php if($selectionMode == 'fromTo'){print $from;}else{print "0";} ?>" onblur="document.order.show[2].checked = true"> <?php print $lang['data sets to']; ?>
				<input type="text" name="to" size="3" value="<?php if($selectionMode == 'fromTo'){print $to;}else{print $contents;} ?>" onblur="document.order.show[2].checked = true">
			</td>
		</tr>
		<tr>
			<td colspan="4" align="center"><font size="2"><?php print $lang['cols']; ?></font></td>
		</tr>
		<tr>
			<td colspan="4" align="center">
			<select size="4" name="chosen[]" style="width:150px;" multiple>
			<?php print $selectedCols; ?>
			</select>
			</td>
		</tr>
			<tr>
			<td colspan="4" align="center">
				<input type="submit" value="<?php print $lang['show']; ?>">
			</td>
		</tr>
		</form>
		<?php } ?>
		</table>
		<table class="noBorder" width="330">
		<tr>
			<th colspan="4"><b>
			<?php if(isset($showExport) && $showExport == 1){?>
			<img src="img/up.gif" onClick="setExport();" style="cursor:pointer "> 
			<a href="javascript:setExport()" target="_self"><?php print $lang['hide export settings']; ?></a>
			<?php }else{?>
			<img src="img/down.gif" onClick="setExport();" style="cursor:pointer ">
			<a href="javascript:setExport()" target="_self"><?php print $lang['export settings']; ?></a><br />
			<?php } ?>
			</b>
			</th>
		</tr>
		<?php if(isset($showExport) && $showExport == 1){?>
		<form name="exportCSV" action="io/export-csv.php<?php print createGetPath(true); ?>" method="post">
		<?php  print makeGETWithoutItem(Array(), Array());?>
		<tr>
			<td colspan="2"><input type="radio" name="exportVars" value="standart" checked></td>
			<td colspan="2"><font size="2"><?php print $lang['export shown data sets']; ?></font></td>
		</tr>
		<tr>
			<td colspan="2"><input type="radio" name="exportVars" value="fromTo"></td>
			<td colspan="2"><font size="2"><?php print $lang['data sets from']; ?>
			<input type="text" name="exportFrom" size="3" value="<?php print "0"; ?>" onblur="document.exportCSV.exportVars[1].checked = true;"> <?php print $lang['data sets to']; ?>
			<input type="text" name="exportTo" size="3" value="<?php print $contents; ?>" onblur="document.exportCSV.exportVars[1].checked = true;"></font></td>
		</tr>
		<tr>
		<td colspan="4"><font size="1">&nbsp;<br />
			<?php print $lang['all settings will be hold']; ?><br />
	&nbsp;</font></td>
		</tr>
		<tr>
			<td colspan="2"><input type="checkbox" name="ColsInHead" value="ON" checked></td>
			<td colspan="2"><font size="2"><?php print $lang['col names in first line']; ?></font></td>
		</tr>
		<tr>
			<td colspan="4" align="center"><input type="submit" value="<?php print $lang['download']; ?>"></td>
		</tr>
		 </form>
		<?php } ?>
		</table>
		<table class="noBorder" width="330">
			<tr>
				<th colspan="4"><img src="img/right.gif" onClick="print_page()" style="cursor:pointer "><a href="javascript:print_page()"><?php print $lang['print']; ?></a></th>
			</tr>
		</table>
	<?php
	if(ssy_operationPermitted("edit_contents", getTable()))
	{
	?>
	<table class="noBorder" width="330">
		<tr>
			<th colspan="4"><img src="img/right.gif" onClick="insert();" style="cursor:pointer "><a href="javascript:insert()"><?php print $lang['insert data set']; ?></a></th>
		</tr>
	</table>
	<?php
	}
	?>
	<?php
	if($show_values != 0)
	{
	?>
	 <?php
		if($selectionMode == 'site')
		  {
		  ?>
	 <form name="Seite">
		<?php print $lang['site']; ?>
			<select name="site" onChange='setSite(document.Seite.site.value)'>
		  <?php
		  for ($i = 1; $i <= $sites; $i++)
		  {
		  ?>
			<option value="<?php print $i; ?>" <?php if($site == $i){print "selected";}?>><?php print $i; ?></option>
			<?php } ?>
		</select>
	 </form>
	<?php 
		}
		else
		{
		print "<br />";
		}
	 ?>	
		  <table class="Normal">
		   <tr>
		<?php
	if(ssy_operationPermitted("edit_contents", getTable()))
	{
	?>
		   <th width="20"></th>
		   <th width="20"></th>
	<?php
	}
    for ($i = 0; $i < $client->num_fields($result_id2); $i++) 
	{
		$meta = $client->fetch_field($result_id2, $i);
		$fieldnames[$i] = $meta->name;
		$rowname = htmlspecialchars ($meta->name);
		if($orderType != "DESC" && $orderBy == $rowname){$btn = "<img src=\"img/up.gif\" onClick=\"javascript:setSort('".$rowname."', 'DESC')\" style=\"cursor:pointer\">";}
		else{$btn = "<img src=\"img/down.gif\" onClick=\"javascript:setSort('".$rowname."', 'ASC')\" style=\"cursor:pointer\">";}
		?>
		<th nowrap>&nbsp;<?php print $btn; ?>&nbsp;<?php print $rowname; ?>&nbsp;</th>
		<?php
	 }
	?>
		</tr>
	<?php
	$zahl = 0;
	while (($row = $client->fetch_row ($result_id2)) )
	{
		?>
		<tr <?php if($zahl%2==1){print "class=\"bgDark\""; }?>>
			<?php
			if(ssy_operationPermitted("edit_contents", getTable()))
			{
			?>
			<td align=center>
				<form action="" name="form<?php print $zahl;?>" target="_blank" method="POST" onSubmit="return false">
				<input type="hidden" name="ID" value="<?php print $UnID;?>">
				<input type="hidden" name="table" value="<?php print $Table; ?>">
				<input type="image" src="img/E.gif" onClick='updateDS("<?php print $zahl;?>")'>
			</td>
			<td align=center>
				<input type="image" src="img/X.gif" onClick='deleteDS("<?php print $zahl;?>")'>
			</td>
			<?php
			}
				for($i = 0; $i < sizeof($row); $i++)
				{
						if($row[$i] === NULL)
						{
							$value = "NULL";
							$row[$i] = "NULL";
						}
						else
						{
							$value = stringHex($row[$i]);
						}
						
						print ("		<td>");
						if(ssy_operationPermitted("edit_contents", getTable()))
						{
							print "<input type=hidden name=\"before_". stringHex($fieldnames[$i]) . "\" value=\"" . $value . "\">";
						}
						if(strlen($row[$i]) > 50)
						{
							print htmlspecialchars (substr($row[$i] , 0 , 50)) ."...";
						}
						else
						{
							print (htmlspecialchars ($row[$i]));
						}
						print ("</td>\n");
				}
				$zahl++;
				if(ssy_operationPermitted("edit_contents", getTable()))
				{
				?>
					</form>
				<?php
				}
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
	<br />
	<a href="javascript:javascript:rel();"><font size=2> <?php print $default_phrases['reload']; ?></font></a><br />
	<br />
	</center>
<?php
paintFoot();

//Einstellungen speichern
for($i = 0; isset($safeItems[$i]); $i++)
{
	if(isset($$safeItems[$i]))
	{
		$userinfo['data'] = data_setElement($Table, $safeItems[$i], $$safeItems[$i], $userinfo['data']);
	}
}
ssy_safeUserSettings($userinfo['data']);
?>
