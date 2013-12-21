<?php
session_start();
$options = $_SESSION['options'];
$_SESSION['ActiveTitle']="REGISTER";
include 'UIHeader.php';
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>

    <table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor=#E6E6FA>
		<tr>
			<td></td>
			<td></td>
		
			<td><p style="color: #076BA7; font-size: 15px; right:100px "><b>
						Create your Profile</b></p></td>
		</tr>
	</table>
	

<form name="test" action="../BSO/BSO_RegisterUser.php" method="post" bgcolor=#E6E6FA/>                                                                
<table border="0" cellpadding="0" cellspacing="0" style="left: 100px; width: 28%; position: relative; top: 70px ;" bgcolor=#E6E6FA>
	<tr>
		<td style="width: 100%; left: 0px" >
		<p style="color: #076BA7;font-size: 12px;margin-left:0x;width : 100%"> First Name </p></td>
		<td><input type="text" name="firstname" align="centre"></td>
		<td></td>
	</tr>
	<tr>
	    <td style="width: 1000px; left: 0px"> 
		<p style="color: #076BA7;font-size: 12px;margin-left:0x; width:100%"> Last Name </p></td>
		<td><input type="text" name="lastname" align="centre",  ></td>
		<td></td>
	</tr>
	<tr>
	    <td style="width: 250px">	
		<p style="color: #076BA7;font-size: 12px;margin-left:0x"> UserName </p></td>
		<td><input type="text" name="username" align="centre";></td>
		<td></td>
	</tr>
	
	<tr>
	    <td style="width: 250px">
		<p style="color: #076BA7;font-size: 12px;margin-left:0x"> Password </p></td>
		<td><input type="password" name="password" align="centre" style="width: 147px";></td>
		<td></td>
	</tr>
	<tr>
	    <td style="width: 250px"> 
		<p style="color: #076BA7;font-size: 12px;margin-left:0x"> Category </p></td>
		<td>
            <select id="category" style="width: 147px">
                <option selected="selected" VALUE=0>Choose <?=$options?> </option> 
            </select>
        </td>
		<td></td>
	</tr>
	
	<tr>
	    <td style="width: 196px"></td>
	    <td><input id="btn" type="Submit" value="Submit" size="100%"></td>
		<td></td>
	</tr>
	
	
</table>

</form>
</html>

<?php
include 'UIFooter.php';
?>