<?PHP 

function errorDie($Headmessage, $NormalMessage, $Path = "")
{	
	Global $lib_errors,$error_color;
	dontCache();
	$lang['title'] = $lib_errors['error']. " ". $Headmessage;
	paintHead();
	?>
		<center>
		<br />
		<br />
		<font color=<?php print $error_color; ?> size=3><b>
		<?php print $Headmessage; ?>
		</b>
		<br />
		<font size=2><?php print $NormalMessage; ?></font>
		</font>
		</center>
	<?PHP
	paintFoot();
	die("");
}
function error($Headmessage, $NormalMessage)
{
	?>
	<center>
	<br />
	<font color=red size=2><b>
	<?php print $Headmessage; ?>
	</b>
	<br />
	<font size=2><?php print $NormalMessage; ?></font>
	</font>
	</center>
	<?PHP
}
function errorAlertDie($NormalMessage, $Path)
{
	Global $lib_errors, $default_phrases;
	dontCache();
	$lang['title'] = $lib_errors['error'];
	paintHead();
	?>
		<script language="javascript">
		alert("<?php print $NormalMessage; ?>");
		</script>
	<?PHP
	paintFoot();
	die("");
}
function errorAlert($NormalMessage)
{
	?>
	<script language="javascript">
	alert("<?php print $NormalMessage; ?>");
	</script>
	<?PHP
}
function checkForMysqlErrors($sql, $queryString, $fontSize, $checkRows = true)
{
	Global $lib_errors, $default_phrases,$error_color;
	
	$error = $sql->last_errors();
	
	if($checkRows && $sql->affected_rows() == 0)
	{
		print ($lib_errors['error, no rows affected']);
		return 1;
	}
	else if ($error != "")
	{
		print( $default_phrases['error'] ."<br><font color=".$error_color.">\"".$error. "\"</font> ". $lib_errors['while executing query'] ."<br />". syntax($queryString));
		return 2;
	}
	else
	{
		return 0;
	}
}
function returnMysqlErrors($sql, $queryString, $fontSize, $checkRows = true)
{
	Global $lib_errors, $default_phrases,$error_color;
	$error = $sql->last_errors();
	if($checkRows && $sql->affected_rows($conId) == 0)
	{
		return ($lib_errors['error, no rows affected']);
	}
	else if ($error != "")
	{
		return( $default_phrases['error'] ."<br><font color=".$error_color.">\"".$error. "\"</font> ". $lib_errors['while executing query'] ."<br />". syntax($queryString));
	}
	else
	{
		return "";
	}
}
function restricted($dir = "")
{
	Global $lib_errors;
	errorDie($lib_errors['no permission'], "", $dir);
}
function sqlError($errorMessage, $query)
{
	Global $lib_errors,$error_color;
	return "<br />\n" .$lib_errors['error']. "\n<br />\n<font color=".$error_color."<i>".htmlspecialchars ($errorMessage)."</i></font>\n<br />\n". $lib_errors['in query']. "\n <br /><code>". syntax ($query) ."</code><br />\n";
}
function unauthorized()
{
	Global $lib_errors, $UsID;
	ssy_deleteUser($UsID);
	errorDie($lib_errors['unauthorized access'],$lib_errors['log on new']);
}
function accessViolation()
{
	Global $lib_errors;
	errorDie($lib_errors['bad access violation'], "");
}
function sessionExpired()
{
	Global $lib_errors;
	setcookie("UID", "", time()-3600);
	errorDie($lib_errors['session expired'], $lib_errors['log on new']);
}
function loginError($message = true)
{
	Global $lib_errors;
	setcookie("UID", "", time()-3600);
	errorDie ("<script>window.open(\"javascript:rel()\", \"Hp\");</script>". $lib_errors['loginerror'] , $message?$lib_errors['wrong username or password']:"");
}
function incompleteUserdata()
{
	Global $lib_errors;
	setcookie("UID", "", time()-3600);
	errorDie($lib_errors['incomplete form'], "");
}
function errorMessage($Str)
{
	Global $lib_errors,$error_color;
	die ("<center><br /><br /><font color=".$error_color.">$Str</font><br /><br /><a href=\"javascript:history.back()\">".$lib_errors['back']."</a></center>");
}
?>