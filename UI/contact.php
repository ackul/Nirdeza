<?php
session_start();
$options = $_SESSION['options'];
$_SESSION['ActiveTitle']="CONTACT";
include 'UIHeader.php';
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>

    
<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="5%"></td>
			<td width="5%"></td>
		
		  <td width="28%"><p style="color: #076BA7; font-size: 15px; right:100px "><b>
						Achin Kulshrestha <br>
                        Akash Singh <br>
          Dipesh Gupta </b></p></td>
                        			<td width="62%"><p style="color: #076BA7; font-size: 15px; right:100px "><b>
						107011 <br>
                        107041 <br>
          107020 </b></p></td>

		</tr>
	</table>
</html>

<?php
include 'UIFooter.php';
?>