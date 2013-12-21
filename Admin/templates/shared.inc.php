<?php
//include library
include_once "lib.php";

//calculate absolute basedir
$dir = extractDir($lang_filename);
$basedir = pathToBasedir($lang_filename);

//load new design
if(isset($_GET['design']) && array_key_exists($_GET['design'], $templates)){$template_dir = $_GET['design'];}

//force the brower not to cache contents
dontCache();

//aquire connection to mainserver
connect_to_mainserver();


//Loads the design, set template directories
function loadDesign($templ = false)
{
	global $template_dir, $templates, $reloadAll;
	if($templ != false && array_key_exists($templ, $templates)){
		if($template_dir != $templ){$reloadAll = true;}
		$template_dir = $templ;
	}
	else if(isset($_COOKIE['design']) && array_key_exists($_COOKIE['design'], $templates)){$template_dir = $_COOKIE['design'];}
	setcookie("design",$template_dir, time()+36000, "/", false);
	$template_dir .= "/";
}

if (ini_get('register_globals'))
{
	$types = array($_FILES, $_COOKIE, $_POST, $_GET);
	foreach($types as $type_names => $type_var)
	{
		foreach($type_var as $var_key => $var_value)
		{
			   unset($GLOBALS[$var_key]);
		}
	}
}

loadDesign();


//If logged, connect to user's server and load variables
if(isset($start_user) && !isset($dontLogUser))
{
	//Get user's session variables
	$Userdata = ssy_getUserInfos((isset($dontCheckTable)?false:true));
	
	$UnID = $userinfo['unid'];
	
	//open connection
	connect_to_server($userinfo['name'], $userinfo['password'] , $userinfo['server'], $userinfo['database']);
}


?>