<?php
$lang_filename = "functions/editContent.php";

include "../templates/normal.inc.php";

if(!ssy_operationPermitted("edit_contents", getTable())){unauthorized();}

paintHead();

$table = getTable();
$type = (isset($_GET['type']))?$_GET['type']:"insert";
$field_info = $client->fetch_field_properties($table);

if(isset($_POST['send']))
{
	//for update
	$set = "";
	$where = "";
	
	//for insert
	$cols = "";
	$values = "";
	
	foreach($_POST as $key => $value)
	{
		if(substr($key, 0, 6) == "after_")
		{
			$key = substr($key, 6);			
			$key_hex = $key;
			$key = hexString($key);
			$is_null = (isset($_POST[$key_hex . '_is_null']) && $_POST[$key_hex . '_is_null'] == 'true');
			$value = $is_null?"NULL":$value;
			
			if(is_array($value))
			{
				$tmp = "";
				foreach($value as $element)
				{
					if($tmp != ""){$tmp .= ",";}
					$tmp .= $client->escape_string(clearSlashes($element)) ;
				}
				$value = $tmp;
			}
			else
			{
				$value = $client->escape_string(clearSlashes($value)) ;
			}
			
			if($type == 'update')
			{
				$was_value = (isset($_POST['before_' . $key_hex]))?$_POST['before_' . $key_hex]:"";
				$was_null = ($was_value == 'NULL');
				$was_value = $was_null?"NULL":$client->escape_string(hexString(clearSlashes($was_value)));
				
				//Write where part
				if($where != ""){	$where .= "AND ";}
				if($was_null)
				{
					$where .= "`" . $key . "` is NULL ";
				}
				else
				{
					$where .= "`" . $key . "` = '" . $was_value . "' ";
				}
				
				if($set != ""){ $set .= ", ";}
				if($is_null)
				{
					$set .= "`" . $key . "` = NULL ";
				}
				else
				{
					$set .= "`" . $key . "` = '" . $value . "' ";				
				}
			}
			else
			{
				if($cols != "")
				{
					$cols .= ", ";
					$values .= ", ";
				}
				$cols .= "`" . $key . "`";
				$values .= "'" . $value . "'";
			}
		}
	}
	
	if($type == 'update')
	{
		$query = "UPDATE " . $table . " SET " . $set . " WHERE " . $where . " LIMIT 1;";
	}
	else
	{
		$query = "INSERT INTO " . $table . "(" . $cols . ") VALUES(" . $values . ")";
	}
	
	$client->query($query);
	$error = $client->last_errors();
	if($error == "")
	{
		?>
		<script language="javascript">
			window.open("Javascript:rel()", "Hp");
			self.close();
		</script>
		<?php
		paintFoot();
		die();
	}
}
?>
<center>
<br />
<form method=POST action="<?php print $_SERVER['PHP_SELF'].createGetPath(array('type' => $_GET['type'])); ?>">
<input type=hidden name=ID value="<?php print $UnID; ?>"><input type=hidden name=table value="<?php print $table; ?>"><input type="hidden" name="send" value="true">
<?php

$where = "WHERE ";
if($type == "update")
{
	foreach($_POST as $key => $value)
	{
		if(substr($key, 0, 7) == "before_")
		{
			$key = substr($key, 7);
			?>
				<input type=hidden name="before_<?php print $key; ?>" value="<?php print $value; ?>">
			<?php
			
			//Convert from hex back to string
			$key = hexString($key);
			$is_null = ($value == 'NULL')?true:false;
			$value = $is_null?"NULL":$client->escape_string(hexString($value));
			
			//Write where part
			if($where != "WHERE ")
			{
				$where .= "AND ";
			}
			if($is_null)
			{
				$where .= "`" . $key . "` is NULL ";
			}
			else
			{
				$where .= "`" . $key . "` = '" . $value . "' ";
			}
		}
	}
}

$message = ($type == 'insert')?$lang['insert dataset in table']:$lang['edit dataset of table'];

?>
<center>
<table class="Normal">
<tr>
	<th colspan="3"><b><?php printf($message, $table); ?></b></th>
</tr>
<?php
if(isset($error))
{
?>
<tr>
	<td colspan="3"><b>Fehler</b><br><?php print $error; ?></td>
</tr>
<?php
}

if($type == "update")
{
	$client->query("SELECT * FROM " . $table . " " . $where . " LIMIT 1");
	$row = $client->fetch_row();
	$cols = $client->num_fields();
}
else
{
	$cols = sizeof($field_info);
}
for($i = 0; $i < $cols; $i++)
{
	$value		= ($type == "update")?$row[$i]:$field_info[$i][4];
	$colname 	= $field_info[$i][0];
	$colname_e 	= stringHex($colname);
	$is_null	= ($value === NULL)?true:false;
	if(isset($_POST['after_' . $colname_e]))
	{
		$value = $_POST['after_' . $colname_e];
		if(is_array($value))
		{
			$tmp = "";
			foreach($value as $element)
			{
				if($tmp != ""){$tmp .= ",";}
				$tmp .= "'" . $client->escape_string(clearSlashes($element)) . "'";
			}
			$value = $tmp;
		}
		else
		{
			$value = $client->escape_string(clearSlashes($value));
		}
		if(isset($_POST[$colname_e . "_is_null"]) && $_POST[$colname_e . "_is_null"] == 'true')
		{	
			$is_null = true;
		}
		else
		{
			$is_null = false;
		}
	}
	$colltype	= $field_info[$i][1];
	$collength	= $field_info[$i][2];
	$nullable	= $field_info[$i][3];

	?>
		<tr>
			<td >
				<b>&nbsp;&nbsp;<?php print $colname; ?>&nbsp;&nbsp;</b>
			</td>
			<td>		
		<?php
		if(!(strstr ($nullable, "YES") === FALSE))
		{
			?>
				&nbsp;<?php print $lang['null']; ?>&nbsp;<input name="<?php print $colname_e; ?>_is_null" type=checkbox value="true" <?php print ($is_null)?"checked":""; ?>>&nbsp;
			<?php
		}
		?>
				</td>
				<td>
		<?php
		
		if(strstr ($colltype, "SET") !== false)
		{
			?>
					<select name="after_<?php print $colname_e; ?>[]" size=4 multiple style="width:320px;">
						<?php print makeOptions(getEnumsFromField($collength), getSetFromDefault($value)); ?>
					</select>
			<?php
		}
		else if(strstr($colltype, "ENUM") !== false)
		{
			?>
					<select name="after_<?php print $colname_e; ?>" style="width:320px;">
						<?php print  makeOptions(getEnumsFromField($collength), Array($value)); ?>
					</select>
			<?php
		}
		else if(strstr ($colltype, "TEXT") !== FALSE || strstr($field_info[$i][1], "BLOB") !== FALSE)
		{
			?>
					<textarea name="after_<?php print $colname_e; ?>" rows=10 cols=50><?php print htmlspecialchars($value); ?></textarea>
			<?php
		}
		else
		{
			?>
					<input type="text" name="after_<?php print $colname_e; ?>" size=50 value="<?php print htmlspecialchars($value); ?>">
			<?php                
		}
		?>
			</td>
		</tr>
	<?php   
}
?>
<tr>
	<td colspan="3" align="center"><input type="submit" value="<?php print $default_phrases['button send']; ?>">  <input type="reset" value="<?php print $default_phrases['button reset']; ?>"></td>
</tr>
</table>
</form>
</center>
<?php paintFoot(); ?>