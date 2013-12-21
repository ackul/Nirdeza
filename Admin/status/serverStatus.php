<?php 
$lang_filename = "status/serverStatus.php";
include "../templates/normal.inc.php";

//Check if operation is permitted
if(!ssy_operationPermitted("stats", "")){unauthorized();}

paintHead();

?>

<br />
	<center>
	<br /><b><?php print $lang['server information']; ?></b>
	<br /><br />
	<table border="0" cellspacing="1" class="Normal" width="600">
		<tr>
		<th width="300">&nbsp;<?php print $lang['name']; ?>&nbsp;</th>
		<th width="300">&nbsp;<?php print $lang['value']; ?>&nbsp;</th>
	</tr>
	<?php
	$result = $client->query("SHOW STATUS");
while ($row = $client->fetch_row($result)){
?>
		<tr>
		<td>&nbsp;<?php print($row[0]); ?>&nbsp;</td>
		<td align="right">&nbsp;<?php print($row[1]); ?>&nbsp;</td>
		</tr>
	<?php
}
	?>
	</table>
	<br /><b><?php print $lang['variables']; ?></b>
	<br /><br />
	<table border="0" cellspacing="1" class="Normal" width="600">
		<tr>
		<th width="300">&nbsp;<?php print $lang['name']; ?>&nbsp;</th>
		<th width="300">&nbsp;<?php print $lang['value']; ?>&nbsp;</th>
	</tr>
	<?php
//Get Variables
$result = $client->query("SHOW VARIABLES");
while ($row = $client->fetch_row($result)){
?>
		<tr>
		<td>&nbsp;<?php print($row[0]); ?>&nbsp;</td>
		<td align="right">&nbsp;<?php print($row[1]); ?>&nbsp;</td>
		</tr>
	<?php
}
	?>
	</table>
	</center>
<?php paintFoot(); ?>