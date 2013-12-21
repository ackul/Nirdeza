<?php
$lang_filename = "functions/deleteDatabase.php";
include "../templates/blank.inc.php";

if($userinfo['is_shared_user']){unauthorized();}

paintHead();

$command = "DROP DATABASE `" . $client->database . "`";
$client->query ($command);

if(checkForMysqlErrors($client, $command , 1, 0) == 0)
{
?>
	<script>
			window.open('../left.php<?php print createGetPath(array('Database' => "", 'all_databases' => 'true', 'tables' => 'false')); ?>', 'left');
	</script>
<?php
}
paintFoot();
?>
