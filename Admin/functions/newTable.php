<?php
$lang_filename = "functions/newTable.php";
include "../templates/normal.inc.php";

if($userinfo['is_shared_user']){unauthorized();}

paintHead();
?>
<center>
<br />
<br />
<form action="create.php<?php print createGetPath(); ?>" target=Hp  method="post">
<table width="330" class="Normal">
<tr >
    <th colspan="2" align="center"><?php print $lang['create new table']; ?></th>
  </tr>
  <tr>
    <td width="50%" > <?php print $lang['tablename']; ?></td>
    <td width="50%" align="center"><input name="tabn" size="20" type="text"></td>
  </tr>
  <tr>
    <td width="50%"> <?php print $lang['no of cols']; ?></td>
    <td width="50%" align="center"><input name="times" size="20" type="text" value="5"></td>
  </tr>
   <tr>
    <td  colspan="2" align="center">
    <input type="submit" value="<?php print $default_phrases['button send']; ?>">
    <input type="reset"  value="<?php print $default_phrases['button reset']; ?>"></td>
  </tr>
</table>
<br />
</center>
<?php paintFoot(); ?>

