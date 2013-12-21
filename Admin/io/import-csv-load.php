<script language="javascript">
	function addItem()
	{
		var allCols = document.csv_import.allCols;
		if(allCols.selectedIndex != -1)
		{
		  var el = document.getElementsByName("sCols[]")[0];
		  var entry = document.createElement("option");
		  var item = allCols.options[allCols.selectedIndex];
		  entry.text = "<?php print $default_phrases['col']; ?> " + (el.length+1) + ": " + item.text;
		  entry.value = item.value;
		  if(item.value!="SPACER"){
		  	allCols.remove(allCols.selectedIndex);
		  }
		  var option = null;
		  if (document.all)
		    option = entry.length;
		  el.add(entry, option);
		}
	}
	function removeItem()
	{
		var allCols = document.getElementsByName("sCols[]")[0];
		if(allCols.selectedIndex != -1)
		{
		  var el = document.csv_import.allCols;
		  var entry = document.createElement("option");
		  var item = allCols.options[allCols.selectedIndex];
		  entry.text = item.value;
		  entry.value = item.value;
		  	allCols.remove(allCols.selectedIndex);
		  var option = null;
		  if (document.all)
		    option = entry.length;
		  if(item.value!="SPACER"){
		  el.add(entry, option);
		  }
		}
	}
	function selectAll()
	{
		var allCols = document.getElementsByName("sCols[]")[0];
		for(var i = 0; i < allCols.length; i++)
		{
			allCols.options[i].selected = true;
		}
	}
</script>
<form name="csv_import" action="import-csv.php?ID=<?php print $_GET['ID'];?>&Table=<?php print $table;?>" method="post" enctype="multipart/form-data" onSubmit="selectAll();">
<table class="Normal" width=500>
<tr align="center">
	<th align="center"><b><?php print $lang['csv file import']; ?></b></th>
</tr>
<tr align="center">
	<td><input type="file" name="userfile"></td>
</tr>
<tr align="center">
	<td>
	<p align="left"><font size="2">&nbsp;<input type="radio" value="ColIsHead" checked name="Cols"><?php print $lang['colname in first line']; ?></font><br />
	<font size="2">&nbsp;<input type="radio" name="Cols" value="Select"><?php print $lang['select cols']; ?></font></td>
</tr>
<tr align="center">
	<td>
	<select size="5" name="sCols[]" style="width:240px;" onclick="removeItem()" multiple>
	</select>
	<select size="5" name="allCols" style="width:240px;" onclick="addItem()">
	<option value="SPACER">[<?php print $lang['skip col']; ?>]</option>
	<?php
		$query = $client->query("show columns from ". $table);
		$options = "";
		while($result = $client->fetch_row($query))
		{	
			$options .= "<option value=\"". htmlspecialchars($result[0]) ."\">". htmlspecialchars($result[0]) ."</option>";
		}
		print $options;
	?>
	</select></td>
</tr>
<tr align="center">
	<td>
	<input type="checkbox" name="update" value="ON"> <font size="2"><?php print $lang['overwrite duplicate entries1']; ?><select name="identifer"><?php print $options; ?></select><?php print $lang['overwrite duplicate entries2']; ?></font></td>
</tr>
<tr>
	<td align="center" width="500">
	<input type=Submit value="<?php print $lang['import']; ?>"></td>
</tr>
</table>
</form>