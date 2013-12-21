<?php
$dontLogUser = true;
$dontLoadPassword = true;
$lang_filename = "install/license.php";
include "../templates/normal.inc.php";
paintHead();
?>
<center>
<form action="create_tables.php" name="license" method="post">
<table width="600" class="normal">
	<tr>
		<th height="20"><?php print $lang['installation step']; ?></th>
	</tr>
	<tr>
		<td align="center">
			<textarea rows="20" cols="80" name="license" readonly><?php include "../license.txt";?></textarea>
			<br>
			<a href="../gpl.txt" target="_blank"><?php print $lang['show gpl']; ?></a>
			<br>
			<table class="noBorder" width="100%">
				<tr>
					<td style="padding-left:50px; border-color:#FFFFFF" onclick="document.license.accept_license[0].checked = true;document.license.send.disabled = false;" style="cursor:pointer"><input type="radio" name="accept_license" value="true"><?php print $lang['accept']; ?></td>
				</tr>
				<tr>
					<td style="padding-left:50px;border-color:#FFFFFF" onclick="document.license.accept_license[1].checked = true;document.license.send.disabled = true;" style="cursor:pointer"><input type="radio" name="accept_license" value="false" checked><?php print $lang['decline']; ?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center"><input type="submit" name="send" value="<?php print $lang['go on']; ?>" disabled></td>
	</tr>
</table>
</form>
</center>
<?php
paintFoot();
?>