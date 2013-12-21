<?php
//Include shared components
include_once 'shared.inc.php';

//set menu color
$menu_color2 = "#B9E3FF";

//Paint HTML head and set charset
function paintHead()
{
	Global $lang,$basedir,$template_dir,$charset, $version, $menu_color2;
	header('Content-Type: text/html; charset='. $charset);
	$dir_to_template_files = $basedir."templates/". $template_dir;
	include_once $basedir."templates/". $template_dir. "menu/head.inc.php";
}

//Paint HTML Foot
function paintFoot()
{
	Global $lang,$basedir,$template_dir,$charset, $version;
	include_once $basedir."templates/". $template_dir. "menu/foot.inc.php";
}

?>