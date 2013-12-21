<?php
$lang_filename = "functions/doCreate.php";
include "../templates/normal.inc.php";

if($userinfo['is_shared_user']){unauthorized();}

paintHead();
?>
<center>
<table class="Normal" width="400">
<tr>
	<th><?php print $lang['summary']; ?></th>
</tr>
<tr>
<td>
<?php
$once = true;
$bu = $_POST['TabNa'];
$command = "CREATE TABLE `$bu`(";
$zah = 1;
$unique = ""; 
$un = true;
$primary = ""; 
$pri = true;
$index = ""; 
$ind = true;

while($zah <= $_POST['tabs'])
{
	$bus1 = "SN$zah";
	$bus2 = "Type$zah";
	$bus3 = "NW$zah";
	$bus4 = "add$zah";
	$bus5 = "nnull$zah";
	$bus6 = "AI$zah";
	$bus7 = "Length$zah";
	$name = $_POST[$bus1];
	
	if ($name != null)
	{
			$type = $_POST[$bus2];
			$length = "";
			if($_POST[$bus7] != "")
			{
				$buffer = $_POST[$bus7];
				$buffer = clearSlashes($buffer);
				$lenght = "($buffer)";
				$buffer = "";
			}
			else{$lenght = "";}
		$default = "";
		if($_POST[$bus3] != "")
		{
			$buffer1 = $_POST[$bus3];
			$default = "DEFAULT '$buffer1'";
			$buffer1 = "";
		}
		if($_POST[$bus4] == "Primary Key")
		{
			if ($pri == true)
			{
				$primary = "`$name`";
				$pri = false;
			}
			else
			{
				$primary = "$primary , `$name`";
			}
		}
		else if($_POST[$bus4] == "Unique ID")
		{
			if ($un == true)
			{
				$unique  = "`$name`";
				$un = false;
			}
			else
			{
				$unique = "$unique ,`$name`";
			}
		}
		else if($_POST[$bus4] == "Index")
		{
			if ($ind == true)
			{
				$index = "`$name`";
				$ind = false;
			}
			else
			{
				$index = "$index , `$name`";
			}
		}
		$not_null = ""; 
		if(isset($_POST[$bus5]) && $_POST[$bus5] == "ON")
		{
			$not_null = "NOT NULL";
		}
		$auto_increment = "";
		if(isset($_POST[$bus6]) &&  $_POST[$bus6] == "ON")
		{
			$auto_increment = "AUTO_INCREMENT";
		}
		
		if($once == true)
		{
			$command = "$command`$name` $type$lenght $default $not_null $auto_increment";
			$once = false;
		}
		else 
		{
			$command = "$command, `$name` $type$lenght $default $not_null $auto_increment";
		}
		$zah++;
	}
	else
	{
		$zah++;
	} 
}
$privar = "";
if($primary != "")
{
$privar = ", PRIMARY KEY ($primary)";
}
$unvar = "";
if($unique != "")
{
$unvar = ", UNIQUE ($unique)";
}
$invar = "";
if($index != "")
{
$invar = ", INDEX ( $index )";
}

$command = "$command$invar$privar$unvar);"; 

$result_id2 = $client->query ($command);
$ID = $_GET['ID'];
$error = $client->last_errors();
if ($error != "")
		{
			$command = htmlspecialchars ($command);   
			print ("<b>". $default_phrases['error'] ."</b>\n<br />$error\n<br /><b>" . $lang['in query'] ."</b>\n<br />". syntax($command));
		}
else
{
?>
<script>
	window.open("javascript:rel()", "left"); 
	window.open("../tableData.php<?php print createGetPath(array('Table' => $bu)); ?>", "Hp");
	self.close();
</script>
<?php
}
?>
</td>
</tr>
</table>
</center>
<?php paintFoot(); ?>
