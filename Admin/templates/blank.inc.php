<?php
$start_user = true;

//Include shared components
include_once 'shared.inc.php';

//Paint the head of the HTML page
function paintHead()
{
	Global $lang,$basedir,$template_dir,$charset, $version;
	header('Content-Type: text/html; charset='. $charset);
	$dir_to_template_files = $basedir."templates/". $template_dir;
	include_once $basedir."templates/". $template_dir. "blank/head.inc.php";
}
//Paints the foot of the HTML page
function paintFoot()
{
	Global $lang,$basedir,$template_dir,$charset, $version;
	include_once $basedir."templates/". $template_dir. "blank/foot.inc.php";
}

?>