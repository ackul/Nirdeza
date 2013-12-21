<?php
$lang_filename = "men.php";
include "./templates/menu.inc.php";
paintHead();
?>
<table width="227" style="position:absolute; top:0; left:0;">
  <tr>
    <td  id="Overview" align="center" bgcolor="<?php print $menu_color2; ?>" height="24">
   		<a target="Hp" href="startpage.php" onclick='window.open("noMen.php", "left")'><b><?php print $lang['server login']; ?></b></a>
	</td>
  </tr>
</table>
<?php
paintFoot();
?>