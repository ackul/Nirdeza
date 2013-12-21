<?php
$start_user = true;

//Include shared components
include_once 'shared.inc.php';

//Paints the head of the HTML page
function paintHead()
{
	//Load globals
	global $lang,$basedir,$template_dir,$charset, $version,$sql_color_normal,$sql_color_comment,$sql_color_sql_comment,$sql_color_values,$sql_color_fields,$lang_filename;
	
	//Set Charset
	header('Content-Type: text/html; charset='. $charset);
	
	//Set template dir to current design and load template
	$dir_to_template_files = $basedir."templates/". $template_dir;
	include_once $dir_to_template_files . "/normal/head.inc.php";
}

//Paints the foot of the HTML page
function paintFoot()
{
	global $lang,$basedir,$template_dir,$charset, $version;
	
	//Load template
	include_once $basedir."templates/". $template_dir. "/normal/foot.inc.php";
}

?>