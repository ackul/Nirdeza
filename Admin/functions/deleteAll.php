<?php
$lang_filename = "functions/deleteAll.php";
include "../templates/blank.inc.php";

if(!ssy_operationPermitted("clear", getTable())){unauthorized();}

paintHead();

$table = getTable();

$command = "DELETE FROM `" . $table . "`";
$result_id2 = $client->query ($command);

if(checkForMysqlErrors($client, $command , 1, 0) == 0)
{
	print "<font color=green size=1>". $lang['table cleared'] ."</font>\n";
}

paintFoot();
?>
