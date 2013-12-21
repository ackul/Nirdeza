<?php
$lang_filename = "index.php";
$dontLogUser = true;
include "./templates/normal.inc.php";

$Userdata = array($RMUSER, $RMPASS, $RMSERVER, $RMDATABASE);
$connection_status = checkUserConnection($Userdata);
if($connection_status[0] != 0 && is_file('./install/index.php'))
{
	redirect("install/");
}
else if($connection_status[0] == 0 && is_file("./install/update.php"))
{
	redirect("install/update.php");
}
else if($connection_status[0] != 0 && !is_file('./install/index.php'))
{
	errorDie($default_phrases['error'], $language['index.php']['upload file and reinstall']);
}
else if(is_file('./install/index.php'))
{
	errorDie($default_phrases['error'],$lang['please delete the install file']);
}
header('Content-Type: text/html; charset='. $charset);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
	<title>MySQL-Admin <?php print $version ?></title>
	<link rel="SHORTCUT ICON" href="favicon.ico">
</head>
<frameset rows="141,24,*" frameborder="0" framespacing="0" border="0">>
<frame src="pages/top.php" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" name="Top" noresize>
<frame src="men.php" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" name="Menl" noresize>
<frameset cols="227,*" frameborder="0" framespacing="0" border="0">>
<frame src="noMen.php" name="left" frameborder="0"  scrolling="auto" noresize>
<frame src="startpage.php" name="Hp" frameborder="0" noresize>
</frameset>
</frameset><noframes></noframes>
</html>