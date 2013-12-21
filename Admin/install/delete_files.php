<?php
$dontLogUser = true;
$dontLoadPassword = true;
$lang_filename = "install/delete_files.php";
include "../templates/normal.inc.php";
paintHead();

if(!isset($_POST['accept_license']) || $_POST['accept_license'] == 'false')
{
	redirect("license.php");
}
if(isset($_POST['delete_files']))
{
		$path = "*";
		foreach(glob($path) as $file)
		{
			if(!@unlink($file))
			{
				$error = true;
				break;
			}
		}
		if(!isset($error)){$ready = true;}
}
?>
<center>
<form action="delete_files.php" method="post">
<input type="hidden" name="accept_license" value="true">
<table width="600" class="normal">
	<tr>
		<th height="20"><?php print $lang['installation step']; ?></th>
	</tr>
	<tr>
		<td align="center">
			<p align="justify" style="padding: 10px;"><?php print $lang['info text']; ?></p>
		</td>
	</tr>
	<?php if(isset($error)) { ?>
		<tr>
			<td align="center">
				<p align="justify" style="padding: 10px;color:red"><?php print $lang['unable to delete install files']; ?></p>
			</td>
		</tr>
	<?php }?>
	<?php if(!isset($ready)) { ?>
	<tr>
		<td align="center" height="50">
			<input type="submit" name="delete_files" value="<?php print $lang['delete installer']; ?>">
		</td>
	</tr>
	<?php }else { ?>
	<tr>
		<td align="center" height="50">
			<p align="justify" style="padding: 10px;color:green"><?php print $lang['installer deleted']; ?></p>
		</td>
	</tr>
	<?php } ?>
	<tr>
		<td align="center"><input type="button" onClick="self.open('../index.php', '_self')" value="<?php print $lang['go on']; ?>"></td>
	</tr>
</table>
</form>
</center>
<?php
paintFoot();
?>