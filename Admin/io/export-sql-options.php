<form method="POST" action="export-sql.php<?php print createGetPath(true); ?>">
<table width="500" class="Normal">
	<tr>
		<th align="center"><b><?php print $lang['sql export']; ?></b></th>
	</tr>
	<tr>
		<td>&nbsp;<?php print $lang['export settings']; ?></td>
	</tr>
	<tr>
		<td align="left">
			<input type="radio" name="dumping_routine" value="msadump" checked ><?php print $lang['mysql-admin dump']; ?><br />
			<input type="radio" name="dumping_routine" value="mysqldump" <?php if(ini_get('safe_mode')){print "disabled";} ?>><?php print $lang['mysqldump']; ?>
		</td>
	</tr>
	<tr>
		<td align="left">
			&nbsp;<input type="checkbox" name="noDB" value="ON" checked> <?php print $lang['no create database']; ?><br />
			&nbsp;<input type="checkbox" name="noTAB" value="ON"> <?php print $lang['no create table']; ?><br />
			&nbsp;<input type="checkbox" name="noCONT" value="ON"> <?php print $lang['no contents']; ?>
		</td>
	</tr>
	<tr>
		<td align="left">&nbsp;<input type="radio" value="Show" checked name="output"> <?php print $lang['show']; ?><br />
&nbsp;<input type="radio" name="output" value="Download"> <?php print $lang['download']; ?><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php print $lang['filename']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="Filename" size="25" value="<?php print $userinfo['database']; if(isset($_GET['Table'])){print "_".$_GET['Table'];}?>.sql">
		</td>
	</tr>
	<tr>
		<td align="center"><input type="submit" value="<?php print $lang['go on']; ?>"></td>
	</tr>
</table>
</form>