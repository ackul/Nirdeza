<?php
$lang_filename = "io/export-sql.php";
include "../templates/normal.inc.php";

if(!ssy_operationPermitted("export", getTable())){unauthorized();}


if($_POST['dumping_routine'] == "mysqldump")
{


	$options = "";
	if($userinfo['server'] != "")
	{
		$options .= ' -h ' . escapeshellarg($userinfo['server']) . '';
	}
	if($userinfo['password'] != "")
	{
		$options .= '--password=' . escapeshellarg($userinfo['password']) . '';
	}
	if(isset($_POST['noDB']) && $_POST['noDB'] == "ON")
	{
		$options .= " --no-create-db";
	}
	if(isset($_POST['noTAB']) && $_POST['noTAB'] == "ON")
	{
		$options .= " --no-create-info";
	}
	if(isset($_POST['noCONT']) && $_POST['noCONT'] == "ON")
	{
		$options .= " --no-data";
	}
	
	if(!isset ($_GET['Table']))
	{
		$options .= " " . escapeshellarg($userinfo['database']);
	}
	else
	{
		$options .= " " . escapeshellarg($userinfo['database']) . " " . escapeshellarg($_GET['Table']);
	}

	$command = 'mysqldump  -u ' . escapeshellarg($userinfo['name']) . ' ' . $options;
}


if($_POST['output'] == "Download")
{
	header("Content-Type: application/octet-stream");
	header("Content-Disposition: attachment; filename=". $_POST['Filename']);
	flush();
	if($_POST['dumping_routine'] == "mysqldump")
	{
		passthru($command, $outp);
		if($outp != 0){print $lang['error'];};
	}
	else
	{
		print sql_dump($client, isset($_GET['Table'])?$_GET['Table']:false, (isset($_POST['noDB']) && $_POST['noDB'] == "ON")?false:true, (isset($_POST['noTAB']) && $_POST['noTAB'] == "ON")?false:true, (isset($_POST['noCONT']) && $_POST['noCONT'] == "ON")?false:true);
	}
}
else
{
paintHead();
?>
		<center>
		<br />
		<table class="Normal">
		<tr>
			<th><?php print $lang['sql export']; ?></th>
		</tr>
		<tr>
			<td>
				<code><?php
					if($_POST['dumping_routine'] == "mysqldump")
					{
						 $outp = `$command`; print nl2br (htmlspecialchars($outp));
						 if($outp != 0){print $lang['error'];};
					}
					else
					{
						print nl2br (htmlspecialchars(sql_dump($client, isset($_GET['Table'])?$_GET['Table']:false, (isset($_POST['noDB']) && $_POST['noDB'] == "ON")?false:true, (isset($_POST['noTAB']) && $_POST['noTAB'] == "ON")?false:true, (isset($_POST['noCONT']) && $_POST['noCONT'] == "ON")?false:true)));
					} 
					?></code>
			</td>
		</tr>
		</table>
		</center>
<?php
paintFoot();
}
?>

