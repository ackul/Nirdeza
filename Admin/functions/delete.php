<?php
$_GET['ID'] = $_POST['ID'];
$_GET['table'] = $_POST['table'];
$lang_filename = "functions/delete.php";
include "../templates/blank.inc.php";

if(!ssy_operationPermitted("edit_contents", getTable())){unauthorized();}

paintHead();

$table = getTable();

$where = "WHERE ";

foreach($_POST as $key => $value)
{
	if(substr($key, 0, 7) == "before_")
	{
		$key = substr($key, 7);
		
		//Convert from hex back to string
		$key = hexString($key);
		$is_null = ($value == 'NULL')?true:false;
		if(!$is_null)
		{
			$value = $client->escape_string(hexString ($value));
		}
		
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

print "<font size=1>";
$query = "DELETE FROM " . $table . " " . $where . " LIMIT 1;";
$client->query ($query);

if(checkForMysqlErrors($client, $query , 1) == 0)
{
?>
	<font color=green><?php print $lang['dataset deleted']; ?></font>
	<script>window.open("Javascript:rel()", "Hp");</script>
<?php
}
paintFoot();
?>
