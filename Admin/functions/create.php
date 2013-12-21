<?php
$lang_filename = "functions/create.php";
include "../templates/normal.inc.php";

$time = $_POST['times'];
$options = makeOptions($global_types, array($default_col_type));

if($userinfo['is_shared_user']){unauthorized();}

paintHead();
?>
	<script language="javascript">
		function create()
		 {
			window.open("about:blank", "create", "width=500,height=300,status=no,toolbar=no,menubar=no,scrollbars=yes,dependent=yes");
			return true;
		 }
	</script>
<center>
<br />
<br />
<form method="POST" action="doCreate.php<?php print createGetPath(); ?>" target="create" onSubmit="return create()">
<input type=hidden name=TabNa value=<?php $na = $_POST['tabn']; print htmlspecialchars ($na);?>><input type=hidden name=tabs value=<?php print "$time"?>>
<table class="Normal">
   <tr>
      <th colspan="11" nowrap align="center">
      <p align="center"><?php print $lang['cols of table']; ?> <i><?php print htmlspecialchars ($na);?></i></th>
    </tr>
    <tr>
   
      <td align="center"><?php print $lang['col no']; ?></font></td>
      <td align="center"><?php print $lang['col name']; ?></font></td>
      <td align="center"><?php print $lang['type']; ?></font></td>
      <td align="center"><?php print $lang['length']; ?></font></td>
      <td align="center"><?php print $lang['default value']; ?></font></td>
      <td align="center"><?php print $lang['primary key']; ?></font> </td>
      <td align="center"><?php print $lang['unique']; ?></font> </td>
      <td align="center"><?php print $lang['index']; ?></font></td>
      <td align="center"><?php print $lang['nothing']; ?></font></td>
      <td align="center"><?php print $lang['not null']; ?></font></td>
      <td align="center"><?php print $lang['auto increment']; ?></font></td>
    </tr>
	<?php 
	
	$zl = 1;
	while ($zl <= $time)
	{
	?>
    <tr>
      <td  nowrap align="center" width="100"><?php print $default_phrases['col'] . " " . $zl; ?></td>
      <td  nowrap align="center" width="100">
      <input type="text" name="SN<?php print "$zl"; ?>" size="13"></td>
      <td nowrap align="center" width="100">
	  <select size="1" name="Type<?php print "$zl"; ?>">
		<?php print $options; ?>
      </select>
	  </td>
      <td nowrap align="center" ><input type="text" name="Length<?php print "$zl"; ?>" size="15"></td>
      <td nowrap align="center" ><input type="text" name="NW<?php print "$zl"; ?>" size="13"></td>
      <td nowrap align="center" ><input type="radio" value="Primary Key" name="add<?php print "$zl"; ?>"></td>
      <td nowrap align="center" ><input type="radio" value="Unique ID" name="add<?php print "$zl"; ?>"></td>
      <td nowrap align="center" ><input type="radio" value="Index"  name="add<?php print "$zl"; ?>"></td>
      <td nowrap align="center" ><input type="radio" value="Nix" checked name="add<?php print "$zl"; ?>"></td>
      <td nowrap align="center" >
      <input type="checkbox" name="nnull<?php print "$zl"; ?>" value="ON" checked></td>
      <td nowrap align="center"><input type="checkbox" name="AI<?php print "$zl"; ?>" value="ON" cheked></td>

    </tr>
	<?php 
	$zl++;
	}
	
	?>
	    </tr>
     <tr>
   
      <td align="center" colspan="11">
      <input type="submit" value="<?php print $lang['create table']; ?>"></td>
    </tr>

  </form>
</table>
<br />
<?php print $lang['notice']; ?>
<br />
</center>
<?php paintFoot(); ?>