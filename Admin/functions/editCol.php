<?php
$lang_filename = "functions/editCol.php";
include "../templates/normal.inc.php";

if(!ssy_operationPermitted("edit_columns", getTable())){unauthorized();}

$table = getTable();
$mode = (isset($_GET['col']))?'EDIT':'INSERT';
$col = (isset($_GET['col']))?hexString($_GET['col']):"";
$error = "";

if(isset($_POST['length']))
{
	$_POST['length'] = clearSlashes($_POST['length']);
}

if(isset($_POST['sent']))
{
	//Alter table
	$default = ($_POST['default'] != "")?("DEFAULT '" . $client->escape_string($_POST['default']) . "'"):"";
	$length = ($_POST['length'] != "")?("(" . $_POST['length'] . ") "):"";
	$lenght = clearSlashes($length);
	$type = $_POST['type'] . $length . " " . $_POST['attribute'] . " ";
	$null = (isset($_POST['null']))?'NULL ':'NOT NULL ';
	$auto_increment = (isset($_POST['auto_increment']))?'AUTO_INCREMENT ':'';
	$query_part = "`" . $_POST['name'] . "` " . $type . $null . $auto_increment . $default;
	if($_POST['old_col_name'] != "")
	{
		//Edit column
		$query = "ALTER TABLE `" . $table . "` CHANGE `" . $col . "` " . $query_part;
	}
	else
	{
		//Insert new col
		$columns = getColumns($table);
		$last_column = "";
		$column_before = "";
		$first_column = "";
		foreach($columns as $key => $tmp){
			if($first_column == ""){$first_column = $key;}
			if($key == $_POST['position_column']){$column_before = $last_column;} 
			$last_column = $key;
		}
		if($_POST['position_type'] == 'BEFORE')
		{
			if($_POST['position_column'] == $first_column)
			{
				$position_option = 'FIRST';
			}
			else
			{
				$position_option = "AFTER `" . $column_before . "`";
			}
		}
		else
		{
			$position_option = "AFTER `" . $_POST['position_column'] . "`";
		}
		$query = "ALTER TABLE `" . $table . "` ADD " . $query_part . $position_option;
	}
	$client->query($query);
	if(($error=returnMysqlErrors($client, $query, 2, false)) == "")
	{
		paintHead();
		print "<script language=javascript>window.opener.rel();self.close();</script>";
		paintFoot(); 
		die();
	}
	else
	{
		if($mode == 'INSERT')
		{
			$headline = "<b>" . sprintf($lang['insert col'], "</b><i>". $table . "</i><b>")  . "</b>";
			$show_position = true;
			$position_type = $_POST['position_type'];
			$position_column = $_POST['position_column'];
		}
		else
		{
			$headline = "<b>" . sprintf($lang['edit col'], "</b><i>". $col . "</i><b>") . "</b>";
			$show_position = false;
		}
		$length = $_POST['length'];
		$name = $_POST['name'];
		$auto_increment = isset($_POST['auto_increment'])?'checked':'';
		$selected_type = $_POST['type'];
		$default =  $_POST['default'];
		$null_enabled = isset($_POST['null'])?'checked':'';
		$attribute = $_POST['attribute'];
	}
}
else
{
	if($mode == 'INSERT')
	{
		//Insert new column
		$headline = "<b>" . sprintf($lang['insert col'], "</b><i>". $table . "</i><b>")  . "</b>";
		$show_position = true;
		$length = "";
		$name = "";
		$auto_increment = "";
		$selected_type = $default_col_type;
		$default = "";
		$null_enabled = "";
		$attribute = "";
		$position_type = 'AFTER';
		$position_column = false;
	}
	else
	{
		//Edit column
		$headline = "<b>" . sprintf($lang['edit col'], "</b><i>". $col . "</i><b>") . "</b>";
		$show_position = false;
		$columns = getColumns($table);
		$columns_info = $columns[$col];
		$length = $columns_info['length'];
		$name =  $columns_info['name'];
		$auto_increment = ($columns_info['auto increment'])?'checked':'';
		$selected_type = $columns_info['type'];
		$default = $columns_info['default'];
		$null_enabled = ($columns_info['null'])?'checked':'';
		if(!in_array($columns_info['attribute'],$field_attributes)){
			$field_attributes[] = $columns_info['attribute'];
		}
		$attribute = $columns_info['attribute'];
	}
}
paintHead();
?>
		<center>
			<?php print $headline; ?>
			<br />
			<form name="column" method="post">
				<input type="hidden" name="sent" value="true">	
				<input type="hidden" name="old_col_name" value="<?php print $col; ?>">
				<?php if($error != ""){ ?>
				<table class="Normal" width="300">
					<tr>
						<th><?php print $lang['error']; ?></th>
					</tr>
					<tr>
						<td colspan="2"><?php print $error; ?></td>
					</tr>
				</table><br>
				<?php } ?>
				<?php if($show_position)
				{ 
					$columns = getColumns($table);
					$names = array();
					$i = 0;
					foreach($columns as $values)
					{
						$names[$i] = $values['name'];
						$i++;
					}
					$position_column = $names[$i-1];
				?>
					<table class="Normal" width="300">
						<tr>
							<th colspan="2"><?php print $lang['position']; ?></th>
						</tr>
						<tr>
							<td><select name="position_type" style="width:90"><?php print makeOptions($lang['position type'], array($position_type), array('BEFORE', 'AFTER')); ?></select></td>
							<td><select name="position_column" style="width:200"><?php print makeOptions($names, array($position_column)); ?></select></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
						</tr>
					</table>
					<br>
				<?php } ?>
					<table class="Normal" width="300">
					<tr>
						<th colspan=2><?php print $lang['settings']; ?></th>
					</tr>
					<tr>
						<td ><?php print $lang['name']; ?></td>
						<td align="center"><input type="text" name="name" value="<?php print $name; ?>" style="width:200"></td>
					</tr>
					<tr>
						<td><?php print $lang['type']; ?></td>
						<td align="center">
							<select size="1" name="type" style="width:200">
								<?php print makeOptions($global_types, array($selected_type)); ?>
     						</select>
     					</td>
					</tr>
					<tr>
						<td><?php print $lang['length']; ?></td>
						<td align="center">
						<input type="text" name="length" value="<?php print $length; ?>" style="width:200"></td>
					</tr>
					<tr>
						<td><?php print $lang['attribute']; ?></td>
						<td  align="center">
							<select size="1" name="attribute" style="width:200">
								<?php print makeOptions($field_attributes, array($attribute)); ?>
     						</select>
						</td>
					</tr>
					<tr>
						<td><?php print $lang['default value']; ?></td>
						<td align="center"> 
						<input type="text" name="default" value="<?php print $default; ?>"  style="width:200"></td>
					</tr>
					<tr>
						<td><?php print $lang['null']; ?></td>
						<td align="center">
						<input type="checkbox" name="null" value="checked" <?php print $null_enabled; ?>></td>
					</tr>
					</tr>
					<tr>
						<td><?php print $lang['auto increment']; ?></td>
						<td align="center">
						<input type="checkbox" name="auto_increment" value="checked" <?php print $auto_increment; ?>></td>
					</tr>
					<tr>
						<td colspan=2 align="center"><input type="submit" value="<?php print $default_phrases['button send']; ?>" name="send"><input type="reset" style="margin-left:25px; " value="<?php print $default_phrases['button reset']; ?>"></td>
					</tr>
				</table>
		</form>
	</center>
<?php
paintFoot();
?>