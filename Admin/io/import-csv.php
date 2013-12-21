<?php
$lang_filename = "io/import-csv.php";
include "../templates/normal.inc.php";
if(!ssy_operationPermitted("export", getTable())){unauthorized();}
paintHead();
$table = $_GET['Table'];
$summary = csv_import($_FILES['userfile']['tmp_name'], $table,$client, (isset ($_POST['Cols']) && $_POST['Cols'] == "Select")?false:true,(isset($_POST['update']) && $_POST['update'] == "ON")?$_POST['identifer']:"", (isset($_POST['sCols']))?$_POST['sCols']:false);
?>
		<center>
			<br />
			<table class="normal">
				<tr>
					<th><?php print $lang['csv import']; ?></th>
				</tr>
				<tr>
					<td align="center"><?php print $lang['summary']; ?></td>
				</tr>
				<?php if($summary[1] != 0)
				{
				?>
				<tr>
					<td><?php print nl2br($summary[0]); ?></td>
				</tr>
				<?php } ?>
				<tr>
					<td><?php print $summary[2]; ?><?php print $lang['executed queries, with errors1']; ?><?php print $summary[1]; ?><?php print $lang['executed queries, with errors2']; ?></td>
				</tr>
			</table>
			<br />
		</center>
<?php paintFoot(); ?>