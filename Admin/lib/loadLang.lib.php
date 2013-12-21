<?php
$user_lang = isset($_COOKIE['lng'])?$_COOKIE['lng']:selectLanguage();

loadLanguageFile($user_lang);
loadCharset();

function loadLanguageFile($lngN)
{
	global $language, $default_phrases, $lib_errors, $default_charset, $default_language,$lang,$lang_filename;
	$lngN = htmlspecialchars($lngN);
	$include_file = "./languages/$lngN.lng.php";
	if(is_file($include_file)){include($include_file);}
	else if(is_file('.'.$include_file)){include('.'.$include_file);}
	else{
		if($lngN == $default_language)
		{
			die("Unable to load default language file");
		}
		else
		{
			setcookie("lng",$default_language, time()+36000);
			loadLanguageFile($default_language);
		}
	}
	$lang = (isset($lang_filename))?(isset($language[$lang_filename])?$language[$lang_filename]:null):null;
}

function loadCharset($chrs = false)
{
	global $charset, $default_charset, $lang;
	if($chrs != false){$charset = $chrs;}
	else if(isset($_COOKIE['charset'])){$charset = $_COOKIE['charset'];}
	else{$charset = $default_charset;}
	
	if(extension_loaded('mbstring') && $charset != $default_charset && $lang != false)
	{
		$keys = array_keys($lang);
		for($i = 0; isset($keys[$i]) && isset($lang[$keys[$i]]); $i++)
		{
			if(is_array($lang[$keys[$i]]))
			{
				foreach($lang[$keys[$i]] as $vkey => $vvalue)
				{
					$lang[$keys[$i]][$vkey] = mb_convert_encoding($vvalue, $charset, $default_charset);
				}
			}
			else
			{
				$lang[$keys[$i]] = mb_convert_encoding($lang[$keys[$i]], $charset, $default_charset);
			}
		}
	}
}
function selectLanguage()
{
	global $lang_config, $default_language;
	$language = $default_language;
	for($i = 0; isset($lang_config[$i]); $i++)
	{
		if($lang_config[$i][3] == substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2)){$language = $lang_config[$i][1];}
	}
	return $language;
}
?>