<?php
//Load shared components
include_once 'shared.inc.php';

//Set logo path
$logo_path = "../img/mysql-admin.gif";
$fox_path = "../img/Fox.gif";

//Paint HTML head and set charset
function paintHead()
{
	Global $lang,$basedir,$template_dir,$charset, $version, $logo_path,$fox_path;
	header('Content-Type: text/html; charset='. $charset);
	$dir_to_template_files = $basedir."templates/". $template_dir;
	include_once $basedir."templates/". $template_dir. "top/head.inc.php";
}

//Paint Foot
function paintFoot()
{
	Global $lang,$basedir,$template_dir,$charset, $version;
	include_once $basedir."templates/". $template_dir. "top/foot.inc.php";
}

?>