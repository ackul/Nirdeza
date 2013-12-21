<?php
include_once "xsql.lib.php";
include_once "functions.php";
if(isset($lang_filename)){ 
	include_once pathToBasedir($lang_filename) . "config.php";
	include_once "loadLang.lib.php";
}
include_once "DES.php";
if(!isset($dontLoadPassword))
{
	include_once pathToBasedir($lang_filename) . "PASS.php";
}
include_once "querys.lib.php";
include_once "syntax.lib.php";
include_once "errors.php";
include_once "usersystem.lib.php";
include_once "sql.lib.php";
include_once "data.lib.php";
include_once "csv.lib.php";
include_once "dump.lib.php";

?>