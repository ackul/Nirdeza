<?php
$dontLogUser = true;
$dontLoadPassword = true;
$lang_filename = "install/create_tables.php";
include "../templates/normal.inc.php";

if(!isset($_POST['accept_license']) || $_POST['accept_license'] == 'false')
{
	redirect("license.php");
}
$username = isset($_POST['username'])?$_POST['username']:'';
$password = isset($_POST['username'])?$_POST['password']:'';
$server =  isset($_POST['username'])?$_POST['server']:'localhost';
$database =  isset($_POST['username'])?$_POST['database']:'mysql-admin';
$create_database = isset($_POST['create database'])?$_POST['create database']:'checked';
$disable_new_input = '';
$error = '';
$info = '';
$connection_ready = false;
$ready = false;

if(isset($_POST['check_connection']))
{
	$infos = checkUserConnection(array($username, $password, $server, $database));
	if($infos[0] == 1)
	{
		$error = $infos[1];
	}
	else if($infos[0] == 2)
	{
		if($create_database != 'checked')
		{
			$error = $infos[1];
		}
		else
		{
			 $conn_id = mysql_connect($server, $username, $password);
			 if(!mysql_query('CREATE DATABASE `' . $database . '`'))
			 {
			 	$error = $lang['error'] . mysql_error();
			 }
			 else
			 {
			 	$info = $lang['created database'] . '<br/>';
			 	$connection_ready = true;
			 }
			 mysql_close($conn_id);
			 
		}
	}
	else
	{
		$connection_ready = true;
	}
}
if($connection_ready)
{	
	$sql = new xSQL($sql_library, $server, $username, $password, $database);
	$sql->set_errorlevel(xsql_dont_show_errors);
	$infos = read_query_file("mysql-admin.sql", false,  $sql);
	
	if($infos[1] != 0)
	{
		$error = $infos[2];
	}
	else
	{
		$info .= $lang['connection ready'] . '<br/>';
		$info .= $lang['created tables'];
		$disable_new_input = 'disabled';
		$ready = true;
	}
}


paintHead();
?>
<center>
<form action="<?php print $ready?'write_config.php':'create_tables.php'; ?>" method="post">
<input type="hidden" name="accept_license" value="true">
<?php if($ready) { ?>
	<input type="hidden" name="username" value="<?php print $username; ?>">
	<input type="hidden" name="password" value="<?php print $password; ?>">
	<input type="hidden" name="server" value="<?php print $server; ?>">
	<input type="hidden" name="database" value="<?php print $database; ?>">
<?php } ?>
<table width="600" class="normal">
	<tr>
		<th height="20"><?php print $lang['installation step']; ?></th>
	</tr>
	<tr>
		<td>
					<p align="justify" style="padding: 10px;"><?php print $lang['info text']; ?></p>
		</td>
	</tr>
	<tr>
		<td align="center"><br>
					<table class="normal" width="350" >
						<tr>
							<th colspan="2"><?php print $lang['connection settings']; ?></th>
						</tr>
						<tr>
							<td width="50%" style="padding: 10px;"><?php print $lang['username'] ;?></td>
							<td width="50%"><input type="text" name="username" size="25" value="<?php print $username; ?>" <?php print $disable_new_input; ?>></td>
						</tr>
						<tr>
							<td width="50%" style="padding: 10px;"><?php print $lang['password'] ;?></td>
							<td width="50%"><input type="password" name="password" size="25" value="<?php print $password; ?>" <?php print $disable_new_input; ?>></td>
						</tr>
						<tr>
							<td width="50%" style="padding: 10px;"><?php print $lang['server'] ;?></td>
							<td width="50%"><input type="text" name="server" size="25" value="<?php print $server; ?>" <?php print $disable_new_input; ?>></td>
						</tr>
						<tr>
							<td width="50%" style="padding: 10px;"><?php print $lang['database'] ;?></td>
							<td width="50%"><input type="text" name="database" size="25" value="<?php print $database; ?>" <?php print $disable_new_input; ?>></td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 10px;">
							<input type="checkbox" name="create_database" value="checked" <?php print $create_database; ?> <?php print $disable_new_input; ?>> <?php print $lang['create database if not exists']; ?></td>
						</tr>
						<tr>
							<td colspan="2"><p style="padding: 10px;"><?php print $lang['overwrite info']; ?></p></td>
						</tr>
						<?php if($error != ''){ ?>
						<tr>
							<td colspan="2"><p style="padding: 10px;color:red"><?php print $error ; ?></p></td>
						</tr>
						<?php } ?>
						<?php if($info != ''){ ?>
						<tr>
							<td colspan="2"><p style="padding: 10px;color:green"><?php print $info ; ?></p></td>
						</tr>
						<?php } ?>
					</table><br>
		</td>
	</tr>
	<tr>
		<td align="center"><input type="submit" name="check_connection" value="<?php print $lang['check connection']; ?>" <?php print $disable_new_input; ?>><input type="submit" name="send" value="<?php print $lang['go on']; ?>" <?php print ($ready)?'':'disabled'; ?>></td>
	</tr>
</table>
</form>
</center>
<?php
paintFoot();
?>