<?php 
$lang_filename = "io/import-sql.php";
include "../templates/normal.inc.php";

if($userinfo['is_shared_user'] == 1){unauthorized();}

$starttime = microtimeFloat();

paintHead();
?>
		<center>
			<br />
			<h3><?php print $lang['title']; ?></h3>
			<br />
			<i><?php print $lang['progress']; ?></i>
			<br />
			<?php flush(); $Stats = read_query_file($_FILES['userfile']['tmp_name'],true, $client); ?>
			<br />
			<i><?php print $lang['done']; ?></i>
			<br /><br />
			<table class=Normal width="400">
				<?php if ($Stats[2] != "") {?>
				<tr>
					<td>
					<?php print $Stats[2];?>
					</td>
				</tr>
				<?php } ?>
				<tr>
					<td>
					<i><?php print $lang['summary']; ?></i><?php print $lang['executed queries'].$Stats[0]." ".$lang['error'].$Stats[1] . " " . $lang['time'] . round(microtimeFloat()-$starttime, 2) . $lang['seconds']; ?>
					</td>
				</tr>
			</table>
		</center>
<?php paintFoot(); ?>
