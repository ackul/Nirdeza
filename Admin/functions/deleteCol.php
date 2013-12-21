<?php
$lang_filename = "functions/deleteCol.php";
include "../templates/blank.inc.php";

if(!ssy_operationPermitted("edit_columns", getTable())){unauthorized();}

paintHead();

$table = $_GET['Table'];
$col = hexString($_GET['col']);

$tag = "ALTER TABLE `". $table ."` DROP `". $col ."`";
$result = $client->query($tag);

if(checkForMysqlErrors($client, $tag, 1, 0) == 0)
{
	print "<font color=\"green\" size=1>". $lang['col deleted'] ."</font>";
	$color = "green";
}

?>
<script language="javascript">
window.open("javascript:rel()", "Hp");
</script>
<?php paintFoot(); ?>