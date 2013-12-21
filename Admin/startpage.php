<?php
//Dafault includes and variables
$lang_filename = "startpage.php";
$dontLogUser = true;
include "./templates/normal.inc.php";

$reloadAll = false;
$userLogged = false;
$error_msg = false;

//If form was send
if(isset($_POST['send']))
{
	//User anmelden
	//Register usersession
	$_POST['PW'] = ssy_edTemppassword($_POST['BN'], $_POST['PW'], $_POST['key']);
	$_GET['ID'] = ssy_logUser($_POST['BN'], $_POST['PW'], isset($_POST['HO'])?$_POST['HO']:"", isset($_POST['DB'])?$_POST['DB']:"", (isset ($_POST['use_time']) && $_POST['use_time'] == "ON")?1:0, $_POST['time'] ,(isset ($_POST['IP']) &&$_POST['IP'] == "ON")?1:0, (isset ($_POST['Cookie']) && $_POST['Cookie'] == "ON")?1:0 , $_POST['type']);
	$_COOKIE['UID']  = $_GET['ID'];
	
	//Sprache Zeichensatz und Design setzen
	//Set language and design
	if($template_dir != $_POST['design']."/"){loadDesign($_POST['design']);}
	$lng = substr($_POST['lng'], 0, strlen($_POST['lng'])-1);
	$chrs = substr($_POST['lng'], strlen($_POST['lng'])-1, 1);
	$lngNo = 0;
	for($i = 0; isset($lang_config[$i]); $i++){if($lang_config[$i][1] == $lng){$lngNo = $i;}}
	setcookie("charset",  $lang_config[$lngNo][2][$chrs],time()+36000);
	setcookie("lng",$lng, time()+36000);
	loadLanguageFile($lng);
	loadCharset($lang_config[$lngNo][2][$chrs]);
	
	//Userdaten laden
	//Load Userdata
	ssy_getUserInfos(false);
	$Userdata = array();
	$Userdata[0] = $userinfo['name'];
	$Userdata[1] = $userinfo['password'];	
	$Userdata[2] = $userinfo['server'];
	$Userdata[3] = $userinfo['database'];

	//Check connection to users's sql server
	$conn_check = checkUserConnection($Userdata);
	
	//Generate errormessages
	if($conn_check[0] == 0){$userLogged = true;}
	else if($conn_check[0] == 1){
		$userLogged = false;
		$error_msg = $lang['connection to server failed']. "<br>" . $conn_check[1] ;
	}
	else if($conn_check[0] == 2){
		$userLogged = false;
		$error_msg = $lang['failed to select database']. "<br>" . $conn_check[1];
	}
	//delete session
	if($conn_check[0] > 0){ssy_deleteUser($userinfo['unid']);}
}
//if language was changed
else
{
	if(isset($_POST['lng']))
	{
		$lng = substr($_POST['lng'], 0, strlen($_POST['lng'])-1);
		$chrs = substr($_POST['lng'], strlen($_POST['lng'])-1, 1);
		$lngNo = 0;
		for($i = 0; isset($lang_config[$i]); $i++){if($lang_config[$i][1] == $lng){$lngNo = $i;}}
		loadLanguageFile($lng);
		loadCharset($lang_config[$lngNo][2][$chrs]);
		setcookie("charset",  $lang_config[$lngNo][2][$chrs],time()+36000);
		setcookie("lng",$lng, time()+36000);
		$user_lang = $lng;
		$charset = $lang_config[$lngNo][2][$chrs];
	}
}

//Paint loading screen
if($userLogged)
{
	paintHead();
	?>
	<script language="javascript" type="text/javascript">function rel(){location.reload();}
	<?php if($reloadAll){ ?>
		window.open("javascript:location.reload()", "Menl");
		window.open("javascript:location.reload()", "Top");
	<?php }?>
		window.open("left.php<?php print createGetPath(array('Database' => '')); ?>", "left");
	</script>
	<br /><br />
	<center><font size=2><?php print $lang['acquire network connection']; ?></font></center>
	<?php
	paintFoot();
	die ();
}

//Generate temporary keys
$tmp = ssy_createTempKeys();
$tmp_id1 = $tmp[0];
$tmp_id2 = $tmp[1];

//Paint login screen
paintHead();
?>
<SCRIPT LANGUAGE='javascript' TYPE="text/javascript">var key = "<?php print $tmp_id2; ?>";</SCRIPT>
<SCRIPT LANGUAGE='javascript' SRC='scripts/des.js'></SCRIPT>
<script language='Javascript' src="scripts/startpage.js"></script>
<script language="javascript" type="text/javascript">function rel(){location.reload();}
	<?php if($reloadAll){ ?>
		window.open("javascript:location.reload()", "Menl");
		window.open("javascript:location.reload()", "Top");
		window.open("javascript:location.reload()", "left");
	<?php }?>
</script>
<form method="POST" action="<?php print $_SERVER['PHP_SELF'];?>" name="login_form" onSubmit='return co();'>
  <center>
  <br>
  <br>
  <?php if($error_msg != false){?>
  <table class="Normal" width="400">
  	<tr>
		<th><?php print $lang['connection error']; ?></th>
	</tr>
	<tr>
		<td><font color="<?php print $error_color; ?>"><?php print $error_msg; ?></font></td>
	</tr>
  </table>
  <br>
  <?php } ?>
  <table class="Normal" width="400">
      <tr>
      	<th width="100%" align="center" colspan="2">
	  		<b><?php print $lang['log on to']; ?></b>
		</th>
	  </tr>
	  <?php if($show_shared_user_login == true){ ?>
	  <tr>
	  	<td colspan="2" align="center">
		<table class="Normal" width="350">
			<tr>
				<th><?php print $lang['connectiontype']; ?></th>
			</tr>
			<tr>
				<td>
					<input type="radio" value="sql" checked name="type" onclick="document.login_form.HO.disabled = false;document.login_form.DB.disabled = false;"><font size="2"><?php print $lang['mysql server']; ?></font><br />
					<input type="radio" value="st" name="type" onclick="document.login_form.HO.disabled = true;document.login_form.DB.disabled = true;"><font size="2"><?php print $lang['shared used db']; ?></font></td>
				</td>
			</tr>
		</table>
		</td>
	</tr>
	 <?php } else {?>
	 <input type="hidden" value="sql" name="type">
	 <?php } ?>
    <tr>
      <td width="50%" align="center"><b><font size="2"><?php print $lang['username']; ?></font></b></td>
      <td width="50%"><input type="text" name="BN" size="30"></td>
    </tr>
    <tr>
      <td width="50%" align="center"><b><font size="2"><?php print $lang['password']; ?></font></b></td>
      <td width="50%"><input type="password" name="password" size="30"><input type="hidden" name="PW" value=""></td>
    </tr>
	<?php if((isset($default_server) && ($default_server == false || $default_server == "")) || !isset($default_server)){ ?>
    <tr>
      <td width="50%" align="center"><b>
		<font size="2"><?php print $lang['server address']; ?></font></b></td>
      <td width="50%"><input type="text" name="HO" size="30"></td>
    </tr>
	<?php } 
	else {
	?>
		<input type="hidden" name="HO" value="<?php print $default_server; ?>">
	<?php } ?>
    <tr>
      <td width="50%" align="center"><b>
		<font size="2"><?php print $lang['database']; ?></font></b></td>
      <td width="50%"><input type="text" name="DB" size="30"></td>
    </tr>
    <tr>
      <td width="100%" align="center" colspan="2">
	  	<table class="Normal" width="350">
			<tr>
				<th><?php print $lang['security settings']; ?></th>
			</tr>
			<tr>
				<td> 
				<input type="checkbox" name="save" value="ON" <?php if($remember_values){print "checked";}?>><font size="2"><?php print $lang['remember username, server, db']; ?><br />
				</font>
				<input type="checkbox" name="Cookie" value="ON" <?php if($check_session_cookie){print "checked";}?>><font size="2"><?php print $lang['activate cookies']; ?><br />
				</font>
				<input type="checkbox" name="IP" value="ON" <?php if($ip_lock){print "checked";}?>><font size="2"><?php print $lang['IP blocker']; ?><br />
				</font>
				<input type="checkbox" name="use_time" value="ON" <?php if($session_timeout != false){print "checked";}?>><font size="2"><?php print $lang['session timeout']; ?>&nbsp;
				</font>
				<input type="text" name="time" size="2" value="<?php if($session_timeout != false){print $session_timeout;}else{print "25";}?>"><font size="2">&nbsp; 
				<?php print $lang['minutes']; ?></font>
				</td>
			</tr>
		</table>
		</td>
    </tr>
    <tr>
      <td align="center" colspan="2">
	  <table class="Normal" width="350">
	  	<tr>
			<th colspan="2"><?php print $lang['design and language']; ?></th>
		</tr>
		<tr>
			<td width="50%">		
					<?php print $lang['language']; ?>
			</td>
			<td>
					<select name="lng" style="width:175px" onChange="document.forms[0].submit();">
					<?php for($i = 0; isset($lang_config[$i]); $i++)
						{
							for($k = 0; isset($lang_config[$i][2][$k]); $k++)
							{
								?>
								<option value="<?php print $lang_config[$i][1].$k; ?>" <?php print ($user_lang == $lang_config[$i][1] && $charset == $lang_config[$i][2][$k])?"selected":""; ?>><?php print $lang_config[$i][0] . " - ".$lang_config[$i][2][$k]; ?></option>
								<?php
							}
						}
					?>
					</select>
			</td>
		</tr>
		<tr>
			<td>
					<?php print $lang['design']; ?>
			</td>
			<td>
					<select name="design" style="width:175px">
					<?php
						$tmp =  array_keys($templates);
						for($i = 0; isset($tmp[$i]); $i++)
						{
								?>
								<option value="<?php print $tmp[$i]; ?>" <?php print ($tmp[$i]."/" == $template_dir)?"selected":""; ?>><?php print $templates[$tmp[$i]]; ?></option>
								<?php
						}
					?>
					</select>
				</td>
			</tr>
			</table>
		</td>
    </tr>
	<tr>
		<td align="center" colspan="2" height="30">
			<input type="hidden" name="key" value="<?php print $tmp_id1;?>"><input type="submit" value="<?php print $default_phrases['button send']; ?>" name="send"><input type="reset" value="<?php print $default_phrases['button reset']; ?>">
		</td>
	</tr>
	<tr>
		<td colspan="2" style="padding:10px; padding-left:20px;">
			<?php print $lang['notice for connection']; ?>
		</td>
	</tr>
  </table>
</form>
</center>
<script language="javascript" type="text/javascript">read()</script>
<?php paintFoot(); ?>