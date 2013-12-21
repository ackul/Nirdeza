<?php
$lang_filename = "logout.php";
$dontLogUser = true;
include "./templates/normal.inc.php";
ssy_deleteUser($_GET['ID']);
paintHead();
?>
<script>open("startpage.php","Hp");</script>
<?php paintFoot(); ?>