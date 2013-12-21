<?php
$lang_filename = "functions/tableOperations.php";
include "../templates/normal.inc.php";

if($userinfo['is_shared_user']){unauthorized();}

paintHead();

$table_name = $_GET['Table'];

$reload_left = false;

if(isset($_POST['type']))
{
	if($_POST['type'] == "rename")
	{
		$client->query("RENAME TABLE ". $_GET['Table'] . " TO ". $client->escape_string($_POST['new_name']));
		$table_name = $_POST['new_name'];
		$_GET['Table'] = $_POST['new_name'];
		$reload_left = true;
	}
	else if($_POST['type'] == "auto_increment")
	{
		$client->query("ALTER TABLE " . $table_name . " AUTO_INCREMENT = " . $client->escape_string($_POST['auto_increment']));
	}
}

?>
<br>
<?php
if($reload_left)
{
?>
<script language="javascript">
	window.open('javascript:rel()', 'left');
</script>
<?php
}
?>
<center>
<h3><?php print $lang['table operations']; ?></h3>
<form action="<?php print createGetPath(true); ?>" method="post">
<table class="Normal" width="300">
	<tr>
		<th><?php print $lang['rename table']; ?></th>
	</tr>
	<tr>
		<td align="center"><i><?php print $table_name; ?></i> <?php print $lang['to']; ?> <input type="text" name="new_name" value="<?php print $table_name; ?>"><input type="hidden" name="type" value="rename"></td>
	</tr>
	<tr>
		<td align="center"><input type='submit' value='<?php print $default_phrases['button send']; ?>'></td>
	</tr>
</table>
</form>
<form action="<?php print createGetPath(true); ?>" method="post">
<table class="Normal" width="300">
	<tr>
		<th><?php print $lang['auto increment value']; ?></th>
	</tr>
	<tr>
		<td align="center"><?php print $lang['set auto increment value to']; ?><input type="text" name="auto_increment" size="5"><input type="hidden" name="type" value="auto_increment"></td>
	</tr>
	<tr>
		<td align="center"><input type='submit' value='<?php print $default_phrases['button send']; ?>'></td>
	</tr>
</table>
</form>
</center>
<?php paintFoot(); ?>