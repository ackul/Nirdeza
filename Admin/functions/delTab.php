<?php
$lang_filename = "functions/delTab.php";
include "../templates/blank.inc.php";

if(!ssy_operationPermitted("delete", getTable())){unauthorized();}

paintHead();

$table = getTable();
$command = "DROP TABLE `" . $table . "`";
$client->query ($command);

if(checkForMysqlErrors($client, $command , 1, 0) == 0)
{
?>
	<script>
	window.open("javascript:rel()", "left");
	</script>
<?php
}
paintFoot();
?>
