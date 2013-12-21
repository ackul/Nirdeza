<?php
$lang_filename = "functions/editKey.php";
include "../templates/normal.inc.php";

if(!ssy_operationPermitted("edit_columns", getTable())){unauthorized();}

$table = getTable();
$key_types = array('PRIMARY', 'INDEX', 'UNIQUE', 'FULLTEXT');

if(isset($_POST['mode']))
{
	$old_key_name = $client->escape_string($_POST['old_key_name']);
	$key_name = $client->escape_string((isset($_POST['key_name']))?$_POST['key_name']:'PRIMARY');
	$key_type = in_array($_POST['key_type'], $key_types)?$_POST['key_type']:'INDEX'; //Check for faked types
	$col_names = $_POST['col_names'];
	$key_length = $_POST['length'];
	$fields = "";
	foreach($col_names as $key => $col)
	{
		if($col != "//none")
		{
			$length = ($key_length[$key] != "")?("(" . $key_length[$key] . ")"):"";
			$fields = ($fields!="")?($fields.', `'.$col.'`' . $length ):('`' . $col . '`' . $length);
		}
	}


	paintHead();
	?>
	<center>
		<table class="Normal" width="350">
			<tr>
				<th><?php print $lang['errors']; ?></th>			
			</tr>
			<tr>
				<td>
	<?php
	$error = 0;
		
	if($key_type == 'PRIMARY')
	{
		$update_key_type = "PRIMARY KEY";
	}
	else
	{
		$update_key_type = $key_type . " `" . $key_name . "`";
	}

	if($_POST['mode'] == 'edit')
	{
		if($old_key_name == 'PRIMARY'){
			setNoAutoIncrement($table);
			$drop = "PRIMARY KEY";
		}
		else
		{
			$drop = "INDEX `" . $old_key_name . "`";
		}
		$query2 = "ALTER TABLE `" . $table ."` DROP " . $drop .", ADD " . $update_key_type .  "(" . $fields. ")";
		$client->query($query2);
		if(checkForMysqlErrors($client, $query2, 2, 0) != 0){$error = 1; print "<br />";}
	}
	else
	{
		$query = "ALTER TABLE `" . $table . "` ADD " . $update_key_type . "(" . $fields. ")";
		$client->query($query);
		if(checkForMysqlErrors($client, $query, 2, 0) != 0){$error = 1;}
	}
	if($error == 0){
	?>
		<script language="javascript">
		window.open("javascript:rel()", "Hp");
		self.close();
		</script>
	<?php
	}
	?>
				</td>
			</tr>
		</table>
	</center>
	<?php
	paintFoot();
	die();
}
if(isset($_GET['key']))
{
	//edit key
	$mode = 'edit';
	$key_name = hexString($_GET['key']);
	$headline = "<b>" . sprintf($lang['edit key'], "</b><i>".$key_name."</i><b>", "</b><i>".$table."</i><b>") . "</b>";
	$keys = getKeys($table);
	$col_names = $keys[$key_name]['cols'];
	$key_length = $keys[$key_name]['length'];
	$key_type = $keys[$key_name]['type'];			
}
else
{
	//insert new key
	$mode = 'insert';
	$headline = "<b>" . sprintf($lang['insert key'], "</b><i>".$table."</i><b>") . "</b>";
	$col_names = array("//none");
	$key_length = array("");
	$key_type = "INDEX";
	$key_name = "";
}


//Get columns
$columns = getColumns($table);
$column_names = array();
$displayed_column_names = array();
$i = 1;
foreach($columns as $name => $tmp)
{
	$column_names[$i] = $tmp['name'];
	$displayed_column_names[$i] = $tmp['name']. " - " . $tmp['real type'];
	$i++;
}
$column_names[0] = "//none";
$displayed_column_names[0] = "";

paintHead();
?>
<script language="javascript" src="../scripts/editKey.js">
</script>
<center>
<?php print $headline; ?>
<br /><br />
<form name="key" method="post">
<input type="hidden" name="mode" value="<?php print $mode; ?>">
<input type="hidden" name="old_key_name" value="<?php print $key_name;?>">
<table class="Normal" width="350">
	<tr>
		<th colspan="2"><?php print $lang['settings']; ?></th>
	</tr>
	<tr>
		<td width="150"><b><?php print $lang['key name']; ?></b></td>
		<td><input type="text" name="key_name" value="<?php print $key_name; ?>" style="width:200px;" onKeyUp="checkForPrimary()"></td>
	</tr>
	<tr>
		<td><b><?php print $lang['key type']; ?></b></td>
		<td>
			<select name="key_type" style="width:200px;" onChange="checkForPrimary()">
				<?php print makeOptions($key_types, array($key_type)); ?>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<table class="Normal" width="100%">
				<tr>
					<th><?php print $lang['col']; ?></th>
					<th><?php print $lang['length']; ?></th>
				</tr>
			</table>
			<?php
			foreach($col_names as $key => $value)
			{
			?>
			<table class="Normal" width="100%">
				<tr>
					<td>
						<select name="col_names[]" style="width:200">
							<?php print makeOptions($displayed_column_names, array($value), $column_names); ?>
						</select>
						</td>
					<td>
						<input type="text" name="length[]" value="<?php print $key_length[$key]; ?>" style="width:100">
					</td>
				</tr>				
			</table>
			<?php
			}
			?>
			<div id="columns">
				
			</div>
			<div id="new_col" style="visibility:hidden;position:absolute;top:-1000;left:-1000">
				<table class="Normal" width="100%">
					<tr>
						<td>
							<select name="col_names[]" style="width:200">
								<?php print makeOptions($displayed_column_names, array("//none"), $column_names); ?>
							</select>
							</td>
						<td>
							<input type="text" name="length[]" value="" style="width:100">
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="button" onClick="addNewCol()" value="<?php print $lang['insert new col']; ?>"></td>
	</tr>
	<tr>
		<td align="center" colspan="2"><input type="submit" name="send" value="<?php print $default_phrases['button send']; ?>"><input type="reset" name="reset" style="margin-left:25px;" value="<?php print $default_phrases['button reset']; ?>"></td>
	</tr>
</table>
<script>
	checkForPrimary();
</script>
</form>
</center>
<?php paintFoot(); ?>