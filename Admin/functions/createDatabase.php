<?php
$lang_filename = "functions/createDatabase.php";
include "../templates/normal.inc.php";

if($userinfo['is_shared_user']){unauthorized();}


if((isset($_POST['database_name']) && !isset($_POST['send'])) || !isset($_POST['database_name']) )
{
	$database_name = (isset($_POST['database_name']))?htmlspecialchars($_POST['database_name']):"";
	
	$selected_charset = (isset($_POST['charset']))?$_POST['charset']:$database_default_charset;
	$selected_collation = (isset($_POST['collation']))?$_POST['collation']:$database_default_collation;
	
	if(substr($selected_collation, 0, strlen($selected_charset)) != $selected_charset)
	{
		$selected_collation = "";
	}

	//Get Charset
	$client->query("SHOW CHARSET");
	$charset = $client->fetch_all_first();
	
	//Charset successfully loaded
	if(isset($charset[0]))
	{
		$charset[] = '';
	}
	//Loading failed, falling to defaults
	else
	{
		$charset = $database_default_charsets;
	}
	
	//Get Collation
	$client->query("SHOW COLLATION LIKE '" . $selected_charset . "%'");
	$collation = $client->fetch_all_first();
	
	//Loading failed, falling to defaults
	if(!isset($collation[0]))
	{
		$collation = $database_default_collations;
	}
	$collation[] = '';
}
else if(isset($_POST['database_name']) && $_POST['database_name'] != "")
{
	$database = $_POST['database_name'];
	$collation = "";
	if(isset($_POST['collation']) && $_POST['collation'] != "")
	{
		$collation = "COLLATE " . $_POST['collation'];
	}
	if(isset($_POST['charset']) && $_POST['charset'] != "")
	{
		$collation = "CHARACTER SET " . $_POST['charset'];
	}
	
	$client->query("CREATE DATABASE " . $database . " " . $collation);
	$error = $client->last_errors();
	
	if($error == "")
	{
		paintHead();
		?>
		<script>
			window.open('../left.php<?php print createGetPath(array('Database' => $database, 'all_databases' => 'true', 'tables' => 'true')); ?>', 'left');
			window.open('../pages/blank.php', 'Hp');
		</script>
		<?php
		paintFoot();
		die();
	}
}



paintHead();
?>
<center>
<br />
<br />
<form action="<?php print $_SERVER['PHP_SELF'].createGetPath(); ?>"  method="post">
<table width="400" class="Normal">
<tr >
    <th colspan="2" align="center"><?php print $lang['create new database']; ?></th>
  </tr>
  <?php if(isset($error)){ ?>
  <tr>
  	<td colspan=2>
		<?php print $error; ?>
	</td>
  </tr>
  <?php } ?>
  <tr>
    <td width="50%" > <?php print $lang['database name']; ?></td>
    <td width="50%" align="center"><input name="database_name" size="20" type="text" style="width:200px;" value="<?php print $database_name; ?>"></td>
  </tr>
  <tr>
    <td width="50%"> <?php print $lang['charset']; ?></td>
    <td width="50%" align="center">
		<select name="charset" style="width:200px; " onChange="document.forms[0].submit();">
			<?php
				print makeOptions($charset, array($selected_charset));
			?>
		</select>
	</td>
  </tr>
  <tr>
    <td width="50%"> <?php print $lang['collation']; ?></td>
    <td width="50%" align="center">
		<select name="collation" style="width:200px; ">
			<?php
				print makeOptions($collation, array($selected_collation));
			?>
		</select>
	</td>
  </tr>
   <tr>
    <td  colspan="2" align="center">
    <input type="submit" name="send" value="<?php print $default_phrases['button send']; ?>">
    <input type="reset"  value="<?php print $default_phrases['button reset']; ?>"></td>
  </tr>
</table>
<br />
</center>
<?php paintFoot(); ?>

