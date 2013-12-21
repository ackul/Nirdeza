<?php 
$lang_filename = "status/status.php";
include "../templates/normal.inc.php";

//Check if user is allowed to access this area 
if(!ssy_operationPermitted("stats", "")){unauthorized();}

//Get Serverinfo
$client->query("show status");
while($tmp = $client->fetch_row())
{
	$serverinfo[$tmp[0]] = $tmp[1];
}


paintHead();
?>
	<center>
	<table border="0" cellspacing="1" class="Normal" width="600">
	<tr>
		<th colspan="2"><?php print $lang['mysql server status']; ?></th>
	</tr>
	<tr>
		<td><font face="Arial" size="2"><?php print $lang['server']; ?></font></td>
		<td><?php print $userinfo['server'];?></td>
	</tr>
	<tr>
		<td><font face="Arial" size="2"><?php print $lang['connection type']; ?></font></td>
		<td><?php print $client->get_connection_type(); ?></td>
	</tr>
	<tr>
		<td><font face="Arial" size="2"><?php print $lang['server version']; ?></font></td>
		<td><?php print $client->get_server_version(); ?></td>
	</tr>
	<tr>
		<td><font face="Arial" size="2"><?php print $lang['client version']; ?></font></td>
		<td><?php print $client->get_client_version();  ?></td>
	</tr>
	<tr>
		<td><font face="Arial" size="2"><?php print $lang['protocol']; ?></font></td>
		<td><?php print $client->get_protocol_version(); ?></td>
	</tr>
	<tr>
		<td><font face="Arial" size="2"><?php print $lang['server runtime']; ?></font></td>
		<td><?php
		//Get Uptime and convert it to normal time format
		$Stunden = $serverinfo['Uptime']/3600 - ($serverinfo['Uptime']%3600)/3600;
		$Minuten = ($serverinfo['Uptime']-$Stunden*3600)/60 - (($serverinfo['Uptime']-$Stunden*3600)%60)/60;
		$Sekunden = $serverinfo['Uptime'] - $Stunden * 3600 - $Minuten * 60;
		print $Stunden."h ";
		print $Minuten."min ";
		print $Sekunden."sec";
		?></td>
	</tr>
	<tr>
		<td><font face="Arial" size="2"><?php print $lang['threads']; ?></font></td>
		<td><?php print $serverinfo['Threads_running'];?></td>
	</tr>
	<tr>
		<td><font face="Arial" size="2"><?php print $lang['queries']; ?></font></td>
		<td><?php print $serverinfo['Questions'];?></td>
	</tr>
	<tr>
		<td><font face="Arial" size="2"><?php print $lang['connections']; ?></font></td>
		<td><?php print $serverinfo['Connections']; ?></td>
	</tr>
	<tr>
		<td><font face="Arial" size="2"><?php print $lang['slow queries']; ?></font></td>
		<td><?php print $serverinfo['Slow_queries']; ?></td>
	</tr>
	<tr>
		<td><font face="Arial" size="2"><?php print $lang['open files']; ?></font></td>
		<td><?php print $serverinfo['Open_files']; ?></td>
	</tr>
	<tr>
		<td><font face="Arial" size="2"><?php print $lang['open tables']; ?></font></td>
		<td><?php print $serverinfo['Open_tables']; ?></td>
	</tr>
	<tr>
		<td><font face="Arial" size="2"><?php print $lang['queries per secound']; ?>
		</font></td>
		<td><?php print round($serverinfo['Questions'] / $serverinfo['Uptime'], 4);?></td>
	</tr>
	</table>
	<br /><b><font face="Arial" size="2"><?php print $lang['processlist']; ?></font></b>
	<br /><br />
	<table class="Normal">
		<tr>
		<th>&nbsp;<?php print $lang['connection id']; ?>&nbsp;</td>
		<th>&nbsp;<?php print $lang['user']; ?>&nbsp;</td>
		<th>&nbsp;<?php print $lang['server name']; ?>&nbsp;</td>
		<th>&nbsp;<?php print $lang['database']; ?>&nbsp;</td>
		<th>&nbsp;<?php print $lang['command']; ?>&nbsp;</td>
		<th>&nbsp;<?php print $lang['time']; ?>&nbsp;</td>
		<th>&nbsp;<?php print $lang['status']; ?>&nbsp;</td>
		<th>&nbsp;<?php print $lang['info']; ?>&nbsp;</td>
	</tr>
	<?php
	//Get process list an print it
	$result = $client->query("SHOW PROCESSLIST");
while ($row = $client->fetch_row($result)){
?>
		<tr>
		<td>&nbsp;<?php print($row[0]); ?>&nbsp;</td>
		<td>&nbsp;<?php print($row[1]); ?>&nbsp;</td>
		<td>&nbsp;<?php print($row[2]); ?>&nbsp;</td>
		<td>&nbsp;<?php print($row[3]); ?>&nbsp;</td>
		<td>&nbsp;<?php print($row[4]); ?>&nbsp;</td>
		<td>&nbsp;<?php print($row[5]); ?>&nbsp;</td>
		<td>&nbsp;<?php print($row[6]); ?>&nbsp;</td>
		<td>&nbsp;<?php print($row[7]); ?>&nbsp;</td>
	</tr>
	<?php
}
	?>
	</table>
	</center>
<?php paintFoot(); ?>