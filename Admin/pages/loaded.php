<?php
$lang_filename = "pages/loaded.php";
$dontLogUser = true;
include "../templates/normal.inc.php";
paintHead();
?>
<center>
<br />
<br />
<font size=4><?php print $lang['connected']; ?></font>
<br />
<font size=2><?php print $lang['choose table in left menu']; ?></font>
</center>
<?php paintFoot(); ?>