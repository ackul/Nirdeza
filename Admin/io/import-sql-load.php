<form name="mysql_import" action="import-sql.php?ID=<?php print $_GET['ID'];?>" method="post" enctype="multipart/form-data">
<table class="Normal" width=500>
<tr align="center">
	<th align="center"><b><?php print $lang['sql file import']; ?></b></th>
</tr>
<tr align="center">
	<td><input type="file" name="userfile"></td>
</tr>
<tr>
	<td align="center">
	<input type=Submit value="<?php print $lang['import']; ?>"></td>
</tr>
</table>
</form>
