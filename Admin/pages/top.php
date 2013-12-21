<?php
$lang_filename = "pages/top.php";
include "../templates/top.inc.php";

paintHead();
?>
<?php if($fox_path != ""){?><img border="0" src="<?php print $fox_path;?>" height="127" style="position : absolute;top : 5; left : 30;">
<?php } if($logo_path != ""){ ?>
<center><img border="0" src="<?php print  $logo_path; ?>"></center>
<?php
}
paintFoot();
?>