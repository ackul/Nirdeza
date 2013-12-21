<?php
$dontLogUser = true;
$dontLoadPassword = true;
$lang_filename = "install/write_config.php";
include "../templates/normal.inc.php";
paintHead();

if(!isset($_POST['accept_license']) || $_POST['accept_license'] == 'false')
{
	redirect("license.php");
}

$config_file = '../PASS.php';
$error = false;
$ready = false;
$config_wrong = false;

$username = isset($_POST['username'])?$_POST['username']:'';
$password = isset($_POST['username'])?$_POST['password']:'';
$server =  isset($_POST['username'])?$_POST['server']:'';
$database =  isset($_POST['username'])?$_POST['database']:'';

$config_file_content = '<?php
// Connection settings
$RMUSER = "'.$username.'"; //username for mysql server
$RMPASS = "'.$password.'"; //password for mysql server
$RMSERVER = "'.$server.'"; //server address
$RMDATABASE = "'.$database.'"; //database name
?>';


if(isset($_POST['write_config']))
{
	if(is_writeable($config_file))
	{
		$file = fopen ($config_file, "w");
		fwrite($file, $config_file_content);
		fclose($file);
		$ready = true;
	}
	else
	{
		$error = true;
	}
}
else if(isset($_POST['check_config']))
{
	@include_once "../PASS.php";
	if($RMUSER == $username && $RMPASS == $password && $RMSERVER == $server && $RMDATABASE == $database)
	{
		$ready = true;
	}
	else
	{
		$error = true;
		$config_wrong = true;
	}	
}
?>
<center>
<form action="<?php print $ready?'delete_files.php':'write_config.php'; ?>"  method="post">
<input type="hidden" name="accept_license" value="true">
<input type="hidden" name="username" value="<?php print $username; ?>">
<input type="hidden" name="password" value="<?php print $password; ?>">
<input type="hidden" name="server" value="<?php print $server; ?>">
<input type="hidden" name="database" value="<?php print $database; ?>">
<table width="600" class="normal">
	<tr>
		<th height="20"><?php print $lang['installation step']; ?></th>
	</tr>
	<tr>
		<td>
					<p align="justify" style="padding: 10px;"><?php print $lang['info text']; ?></p>
		</td>
	</tr>
	<?php if($error) { ?>
	<tr>
		<td>
			<p align="justify" style="padding: 10px;"><?php print $lang['unable to write config'] ; ?></p>
			<p align="center"><textarea rows="7" cols="80" name="license" readonly><?php print $config_file_content;?></textarea>
			<br>
			<?php if(!$ready) { ?>
			<input type="submit" name="check_config" value="<?php print $lang['check config']; ?>">
			<?php } ?>
			<?php if($config_wrong) { ?>
			<br><br>
			<font color="red"><?php print $lang['config file wrong']; ?></font>
			<br><br>
			<?php } ?>
			</p>
		</td>
	</tr>
	<?php } ?>
	<?php if($ready) { ?>
	<tr>
		<td>
			<p style="padding: 10px;color:green"><?php print $lang['wrote config'] ; ?></p>
		</td>
	</tr>
	<?php } ?>
	<tr>
		<td align="center" height="50">
			<input type="submit" name="write_config" value="<?php print $lang['write config']; ?>" <?php print !$ready?'':'disabled'; ?>>
		</td>
	</tr>
	<tr>
		<td align="center"><input type="submit" name="send" value="<?php print $lang['go on']; ?>" <?php print $ready?'':'disabled'; ?>></td>
	</tr>
</table>
</form>
</center>
<?php
paintFoot();
?>