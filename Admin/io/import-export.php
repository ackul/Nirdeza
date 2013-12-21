<?php
$lang_filename = "io/import-export.php";
include "../templates/normal.inc.php";

if(!ssy_operationPermitted("export", getTable())){unauthorized();}

if(isset($_GET['Table'])){$table = $_GET['Table'];}
paintHead();
?>
		<center>
			<br />
			<h3><?php print $lang['import export options']; ?></h3>
			<?php
				include "export-sql-options.php";
				
				if($userinfo['is_shared_user'] == 0)
				{
					include "import-sql-load.php";
				}
				if(isset($_GET['Table']))
				{
					include "export-csv-options.php";
					include "import-csv-load.php";
				}
			?>
			<br />
		</center>
<?php paintFoot(); ?>