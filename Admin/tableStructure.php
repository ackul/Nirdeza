<?php
$lang_filename = "tableStructure.php";
include "./templates/normal.inc.php";
if(!ssy_operationPermitted("show_columns", getTable())){unauthorized();}
paintHead();

$table = getTable();
?>
<script language="javascript" type="text/javascript">
	var path = "<?php print makePath();?>";
	var delete_col = "<?php print $lang['delete col']; ?>";
	var delete_key = "<?php print $lang['delete key']; ?>";
</script>
<script language="javascript" type="text/javascript" src="scripts/tableStructure.js">
</script>
<br /> 
<center>
<b><?php print $lang['headline']; ?></b><i><?php print $table;?></i>
<br /><br />
<table class="Normal" width="500">
	<tr>
	<?php
	if(ssy_operationPermitted("edit_columns", getTable()))
	{
	?>
			<th></th>
			<th></th>
	<?php	
	}
	?>
			<th><?php print $lang['col name']; ?></th>
			<th><?php print $lang['type']; ?></th>
			<th><?php print $lang['length']; ?></th>
			<th><?php print $lang['attribute']; ?></th>
			<th><?php print $lang['is null']; ?></th>
			<th><?php print $lang['default val']; ?></th>
			<th><?php print $lang['extra']; ?></th>
	</tr>
<?php
$col_info = getColumns($table);
$i = 0;
foreach($col_info as $key => $info)
 {
 	$r=0;
	?>
		<tr <?php if($i%2==1){print "class=\"bgDark\""; }?>>
	<?php
	if(ssy_operationPermitted("edit_columns", getTable()))
	{
	?>
		<td align="center">
			<input type="image" src="img/E.gif" onClick="editCol('<?php print stringHex($info['name']);?>')" />
		</td>
		<td align="center">
			<input type="image" src="img/X.gif" onClick="deleteCol('<?php print htmlspecialchars ($info['name']);?>', '<?php print stringHex($info['name']);?>')" />
		</td>
	<?php
	}
		 ?>
		<td><?php print $info['name']; ?></td>
		<td><?php print $info['type']; ?></td>
		<td><?php print $info['length']; ?></td>
		<td><?php print $info['attribute']; ?></td>
		<td><?php print $info['null']?$lang['yes']:$lang['no']; ?></td> 
		<td><?php print ($info['default'] === FALSE)?'NULL':$info['default']; ?></td>
		<td><?php print $info['extra']; ?></td>
		</tr>
	    <?php
	$i++;
}
?>
<?php if(ssy_operationPermitted("edit_columns", getTable())){ ?>
		<tr>
			<td colspan="9" style=" padding-left:10px;"><img src="img/new_entry.gif" onClick="newCol();" style="cursor:pointer "><a href="javascript:newCol()"><?php print $lang['add new col']; ?></a></td>
		</tr>
<?php } ?>

</table>
<br />
<br />
<b>Schlüsselübersicht</b>
<br>
<br>
<table class="Normal" width="500">
	<tr>
		<?php
		if(ssy_operationPermitted("edit_columns", getTable()))
		{
		?>
		<th width="20"></th>
		<th width="20"></th>
		<?php
		}
		?>
		<th><?php print $lang['key name']; ?></th>
		<th><?php print $lang['col names']; ?></th>
		<th><?php print $lang['key type']; ?></th>
	</tr>
<?php 
	$keys = getKeys($table);
	$i = 0;
	foreach($keys as $key => $values)
	{
?>
		<tr <?php if($i%2==1){print "class=\"bgDark\""; }?>>
			<?php
			if(ssy_operationPermitted("edit_columns", getTable()))
			{
			?>
			<td align="center" ><input type="image" src="img/E.gif" onClick="editKey('<?php print stringHex($values['name']);?>')" /></td>
			<td align="center"><input type="image" src="img/X.gif" onClick="deleteKey('<?php print htmlspecialchars ($values['name']);?>', '<?php print stringHex($values['name']);?>')" /></td>
			<?php
			}
			?>
			<td valign="top"><?php print $values['name']; ?></td>
			<td valign="top"><?php 
				foreach($values['cols'] as $index => $col_names)
				{
						print $col_names;
						print ($values['length'][$index] != "")?(" - " . $values['length'][$index]):"";
						print "<br />";
				}
			 ?></td>
			<td valign="top"><?php print $values['type']; ?></td>
		</tr>
<?php
		$i++;
	}
?>
<?php if(ssy_operationPermitted("edit_columns", getTable())){ ?>
		<tr>
			<td colspan="6" style=" padding-left:10px;"><img src="img/new_entry.gif" onClick="newKey();" style="cursor:pointer "><a href="javascript:newKey()"><?php print $lang['add new key']; ?></a></td>
		</tr>
<?php } ?>
</table>
<br>
<a href="javascript:rel()"><?php print $default_phrases['reload']; ?></a>
<br />
<br />
</center>
<?php paintFoot(); ?>