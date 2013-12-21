<?php
$dontLogUser = true;
$dontLoadPassword = true;
$lang_filename = "install/index.php";
include "../templates/normal.inc.php";

if(isset($_POST['lng']))
{
	setcookie("lng",$_POST['lng'], time()+36000);
	loadLanguageFile($_POST['lng']);
	$user_lang = $_POST['lng'];
}

paintHead();
?>
<script language="javascript">
	function set_language()
	{
		document.forms[0].action = "index.php";
		document.forms[0].submit();
	}
</script>
<center>
<form action="license.php" name="language" method="post">
<table width="600" class="normal">
	<tr>
		<th height="20"><?php print $lang['installation step']; ?></th>
	</tr>
	<tr>
		<td align="center"><img src="../img/mysql-admin.jpg"></td>
	</tr>
	<tr>
		<td align="center">
			<br>
			<?php print $lang['select language']; ?> 
			<select name="lng" onChange="set_language()">
					<?php for($i = 0; isset($lang_config[$i]); $i++)
						{
							?>
							<option value="<?php print $lang_config[$i][1]; ?>" <?php print ($user_lang == $lang_config[$i][1])?"selected":""; ?>><?php print $lang_config[$i][0]; ?></option>
							<?php
						}
					?>
			</select>
			<br><br>
		</td>
	</tr>
	<tr>
		<td>
			<p style="padding: 10px;"><?php print $lang['note'] ; ?></p>
		</td>
	</tr>
	<tr>
		<td align="center"><input type="submit" name="send" value="<?php print $lang['go on']; ?>"></td>
	</tr>
</table>
</form>
</center>
<?php
paintFoot();
?>