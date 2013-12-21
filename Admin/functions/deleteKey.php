<?php
$lang_filename = "functions/deleteKey.php";
include "../templates/blank.inc.php";

if(!ssy_operationPermitted("edit_columns", getTable())){unauthorized();}

paintHead();

$table = getTable();
$key = hexString($_GET['key']);

if($key == 'PRIMARY')
{
	setNoAutoIncrement($table);
	$tag = "ALTER TABLE `". $table ."` DROP PRIMARY KEY";
}
else
{
	$tag = "ALTER TABLE `". $table ."` DROP INDEX `". $key ."`";
}
$client->query($tag);

if(checkForMysqlErrors($client, $tag, 1, 0) == 0)
{
	print "<font color=\"green\" size=1>". $lang['key deleted'] ."</font>";
}

?>
<script language="javascript">
window.open("javascript:rel()", "Hp");
</script>
<?php paintFoot(); ?>