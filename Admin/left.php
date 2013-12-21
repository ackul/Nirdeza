<?php

//Generate float microtime --> PHP 5 mocrotime(true)
list($usec, $sec) = explode(" ", microtime());
$stime = ((float)$usec + (float)$sec);

//Don't check if access to table is granted
$dontCheckTable = true;

//Default includes an variables
$lang_filename = "left.php";
include "./templates/normal.inc.php";

$all_databases 	= ((isset($_GET['all_databases']) && $_GET['all_databases'] == "true") || $userinfo['database'] == "") && !$userinfo['is_shared_user'];
$is_table		= ($all_databases)?((isset($_GET['tables']) && $_GET['tables'] == 'true')?true:false):true; 

//Paint screen
paintHead();

if(!$userinfo['is_shared_user'] && $userinfo['database'] == "" && $all_databases && $is_table)
{
	if(isset($_GET['Database']) && $_GET['Database'] != "")
	{
		$userinfo['database'] = $_GET['Database'];
	}
	else if(isset($_POST['Database']) && $_POST['Database'] != "")
	{
		$userinfo['database'] = $_POST['Database'];
	}
	$client->select_database($userinfo['database']);
	ssy_changeDatabase($userinfo['database']);
}
else if(!$userinfo['is_shared_user'] && $userinfo['database'] != "" && $all_databases && !$is_table)
{
	?>
	<script>
				window.open('pages/blank.php', 'Hp');
	</script>
	<?php
	ssy_changeDatabase("");
}
else if(!$userinfo['is_shared_user'] && $userinfo['database'] == "" && $all_databases && !$is_table)
{
?>
	<script>
				window.open('pages/loaded.php', 'Hp');
	</script>
<?php
}

$all_datab = $all_databases?"true":"false";
$is_table_o = $is_table?"true":"false";

?>
<style type="text/css">
	BODY
	{
		margin:0px;
	}
</style>

<?php
if(!$is_table)
{
	?>
	<script>
	<!--
	function rel()
	{
		window.open("<?php print $_SERVER['PHP_SELF'].createGetPath(array('all_databases' => $all_datab, 'tables' => $is_table_o)); ?>", 'left');
	}
	-->
	</script>
	<span style="font-size:10px; text-align:right;width:95%; display:block; padding-top:10px; padding-bottom:10px;"><a href=logout.php<?php print createGetPath(); ?>><?php print $lang['log out']; ?></a></span>
	<table class="left" width="208" cellpadding="0" cellspacing="0">
		<tr>
			<th><?php print $lang['databases']; ?></th>
		</tr>
	<?php
		$databases = $client->list_databases();
		foreach($databases as $database)
		{
	?>
		<tr>
			<td>
					<span style="cursor:pointer" onClick="window.open('<?php print $_SERVER['PHP_SELF'].createGetPath(array('Database' => $database, 'all_databases' => 'true', 'tables' => 'true')); ?>', 'left')"><img style="margin-top:-1px; margin-bottom:-2px;" src=img/db.gif> <?php print $database;?></span>
			</td>
		</tr>
	<?php
		}
	?>
	<tr>
		<td>
			<img src="img/tree_small.gif" style="margin:-2px;"/><a href="functions/createDatabase.php<?php print createGetPath(array('Database' => $database)); ?>" target=Hp><?php print $lang['create database']; ?></a>
			<br />			
			<img src="img/tree_small.gif" style="margin:-2px;"/><a href="status/status.php<?php print createGetPath(array('Database' => $database)); ?>" target=Hp><?php print $lang['status']; ?></a>
			<br />
			<img src="img/tree_small_end.gif" style="margin:-2px;"/><a href="status/serverStatus.php<?php print createGetPath(array('Database' => $database)); ?>" target=Hp><?php print $lang['server status']; ?></a>
		</td>
	</tr>
	</table>
	<?php
}
else
{
	?>
	<script src="scripts/left.js"></script>
	<script language=javascript>
	<!--
	function delTab(Tab)
	{
		if(confirm("<?php print $lang['really delete table']; ?>"))
		{
			window.open("functions/delTab.php<?php print createGetPath(); ?>&Table="+Tab, "outputpane")
		}
	}
	
	function clearTab(Tab)
	{
		if(confirm("<?php print $lang['really clear table']; ?>"))
		{
			window.open("functions/deleteAll.php<?php print createGetPath(); ?>&Table="+Tab, "outputpane");
		}
	}
	
	function deleteDatabase()
	{
		if(confirm("<?php print $lang['really delete database']; ?>"))
		{
			window.open("functions/deleteDatabase.php<?php print createGetPath(); ?>", "outputpane");
		}
	}
	
	function query()
	{
		window.open("query/query.php<?php print createGetPath(); ?>", "_blank" , "width=700,height=600,status=no,toolbar=no,menubar=no,scrollbars=yes,dependent=yes,resizable=yes");
	}
	function rel()
	{
		window.open("<?php print $_SERVER['PHP_SELF'].createGetPath(array('all_databases' => $all_datab, 'tables' => $is_table_o)); ?>", 'left');
	}
	
	-->
	</script>
	<table style="font-size:10px;width:200px; margin-top:5px; margin-bottom:5px;">
		<tr>
			<td width="50%">
			<?php
				if($all_databases)
				{
			?>
				<a href="<?php print $_SERVER['PHP_SELF'].createGetPath(array('Database' => '', 'all_databases' => 'true', 'tables' => 'false')); ?>"><?php print $lang['database overview']; ?></a>
			<?php
				}
				else
				{
			?>
					&nbsp;
			<?php
				}
			?>		
			</td>
			<td align="right" width="50%"><a href=logout.php<?php print createGetPath(); ?>><?php print $lang['log out']; ?></a></td>
		</tr>
	</table>
	<?php
		$database = $userinfo['database'];
		$id = 1;
		$img = 0;
	?>
		<table class="left" width="208" cellpadding="0" cellspacing="0" >
		<tr>
			<th><?php print(htmlspecialchars ($database)); ?></th>
		</tr>
	<?php
		//Auflistung der Tabellenstruktur
		//List tables
		$client->query("SHOW TABLES");
		
		//Generate table list
		while ($row1 = $client->fetch_row())
		{
			//If permitted -> show table
			if(ssy_operationPermitted("access", $row1[0]))
			{
				$name = $row1[0];	
				$txt1 = htmlspecialchars ($row1[0]);
				?>
				<tr>
					<td nowrap>
					<img style="margin-top:-1px; margin-bottom:-2px;" src=img/close.gif width=9 name="p<?php print $img;?>" style="cursor:pointer" onclick='menudown("con<?php print $id;?>", "p<?php print $img;?>");'>
					<a href='javascript:menudown("con<?php print $id;?>", "p<?php print $img;?>");' id="Men<?php print $id;?>"><?php print $txt1;?></a>
					<div id="con<?php print $id;?>" style="position:absolute;left:0;top:0;visibility:hidden;">
					<img src="img/tree.gif" style="margin:-2px;"/><a href="tableData.php<?php print createGetPath(false, array('Table' => $row1[0], 'Database' => $database)); ?>" target=Hp ><?php print $lang['overview']; ?></a>
				<?php
				if(ssy_operationPermitted("show_columns", $row1[0]))
				{
				?>	
					<br />
					<img src="img/tree.gif" style="margin:-2px; "/><a href="tableStructure.php<?php print createGetPath(false, array('Table' => $row1[0], 'Database' => $database)); ?>" target=Hp ><?php print $lang['cols']; ?></a>
				<?php
				}
				if(ssy_operationPermitted("delete", $row1[0]))
				{
					?>
					<br />
					<img src="img/tree.gif" style="margin:-2px; "/><a href='javascript:delTab("<?php print $name;?>")' ><?php print $lang['delete table']; ?></a>
					<?php
				}
				if(ssy_operationPermitted("clear", $row1[0]))
				{
					?>
					<br />
					<img src="img/tree.gif" style="margin:-2px; "/><a href='javascript:clearTab("<?php print $name;?>")' ><?php print $lang['clear table']; ?></a>
					<?php
				}
				if($userinfo['is_shared_user']!=1)
				{
				?>
					<br />
					<img src="img/tree.gif" style="margin:-2px; "/><a href="functions/tableOperations.php<?php print createGetPath(array('Table' => $name, 'Database' => $database)); ?>" target="Hp"><?php print $lang['table operations']; ?></a>
				<?php
				}
				if(ssy_operationPermitted("export", $row1[0]))
				{
				?>
					<br />
					<img src="img/tree.gif" style="margin:-2px;"/><a href="io/import-export.php<?php print createGetPath(array('Table' => $name, 'Database' => $database)); ?>" target="Hp"><?php print $lang['import,export']; ?></a>
				<?php
				}
				?>
							</div>
					</td>
				</tr>
				<?php
				$id++;
				$img++;
			}
		}
		?>
			<tr>
				<td>
		<?php
		//Only allowd for normal users
		if($userinfo['is_shared_user'] == 0)
		{
			?>
			<img src="img/tree_small.gif" style="margin:-2px;"/><a href="functions/newTable.php<?php print createGetPath(array('Database' => $database)); ?>" target=Hp><?php print $lang['add table']; ?></a>
			<br />
			<img src="img/tree_small.gif" style="margin:-2px;"/><a href="javascript:query();" target="_self"><?php print $lang['sql query']; ?></a>
			<br />
			<?php
			if($all_databases)
			{
			?>
			<img src="img/tree_small.gif" style="margin:-2px;"/><a href="javascript:deleteDatabase();" target="_self"><?php print $lang['delete database']; ?></a>
			<br />
			<?php
			}
		}
		//Check for permission
		if(ssy_operationPermitted("export", ""))
		{
		?>
			<img src="img/tree_small.gif" style="margin:-2px;"/><a href="io/import-export.php<?php print createGetPath(array('Database' => $database)); ?>" target=Hp><?php print $lang['import,export']; ?></a>
			<br />
		<?php
		}
		if(ssy_operationPermitted("stats", ""))
		{
		?>
			<img src="img/tree_small.gif" style="margin:-2px;"/><a href="status/status.php<?php print createGetPath(array('Database' => $database)); ?>" target=Hp><?php print $lang['status']; ?></a>
			<br />
			<img src="img/tree_small_end.gif" style="margin:-2px;"/><a href="status/serverStatus.php<?php print createGetPath(array('Database' => $database)); ?>" target=Hp><?php print $lang['server status']; ?></a>
			
		<?php
		}
		
	?>
			</td>
		</tr>
	</table>
	<?php
}
?>

<p align="left" class="left"><a href="javascript:rel()"><b><font size="1"><?php print $default_phrases['reload']; ?></font></b></a>
&nbsp;
<p class="left">
<iframe name="outputpane" width="195" height="50" src="blank.php" marginwidth="1" frameborder="0" scrolling="auto">
</iframe>
</p>
<?php paintFoot(); ?>