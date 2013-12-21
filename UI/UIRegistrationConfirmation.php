<?php
session_start();
$rFirstName = $_SESSION['c_Name'];
$rUserName = $_SESSION['c_UserName'];
echo "UserName:".$rUserName;
echo $_SESSION["CurrentUser"];
include 'UIHeader.php';
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>

    <table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td></td>
			<td></td>
		
			<td><p style="color: #076BA7; font-size: 15px; right:100px "><b>
						Thank You!</b></p></td>
		</tr>
				<tr>
			<td></td>
			<td></td>
		
			<td><p style="color: #076BA7; font-size: 15px; right:100px "><b>
						</b></p></td>
		</tr>
	</table>
	

<form name="test" action="../BSO/BSO_RegisterUser.php" method="post"/> 
<table border="0" cellpadding="0" cellspacing="0" style="left: 100px; width: 28%; position: relative; top: 70px ;">
	<tr>
		<td style="width: 100%; left: 0px" >
		<p style="color: #076BA7;font-size: 12px;margin-left:0x;width : 100%"> Your Name </p></td>
		<td width="50%"> </td>
		<td> 
			<?php  
				echo $rFirstName;
				
			?> 
		</td>
		<td></td>
	</tr>
	<tr>
	    <td > 
		<p style="color: #076BA7;font-size: 12px;margin-left:0x; width:50%"> User Name </p></td>
		<td> </td>
		<td width="50%"> 
			<?php  
				echo $rUserName;
			?> 
		</td>
		<td></td>
</tr>
			<tr>

			<td><p style="width:50% color: #076BA7; font-size: 15px; right:100px "><b>
						Please relogin</b></p> </td>
			<td></td>
		</tr>
</table>

</form>
</html>

<?php
include 'UIFooter.php';
?>