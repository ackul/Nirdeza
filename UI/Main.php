<?php
session_start();
//$options = $_SESSION['options'];
$_SESSION['ActiveTitle']="HOME";
include 'UIHeader.php';
?>

<html>


				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td width="7%"></td>
					  <td width="93%">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/title.png">
						</td>
				  </tr>
				</table>
				<div><img src="images/hr01.gif" width="1000"
					height="11" alt="" border="0" /></div>
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr valign="top">
						<td width="45%">
						<p class="right"><br />
						&nbsp;&nbsp; 
						
						<p style ="font-size:15px" align="justify" > 
The project Nirdeza (English Transliteration of Nirdesh: in Sanskrit) is an intelligent route planning system that allows community input. Imagine planning a trip in an unfamiliar city, and having the advice of those who live in the city at your disposal.</p> <p style="color:#0099FF;font-size:15px">We believe that the individuals who live and travel in a city can be a fountain of useful information, so they can use their knowledge to help others. </p><p style ="font-size:15px" align="justify" > Considering this we have deployed that knowledge and extended the capability of maps.
						</p>
		      		</td>
						<td><br><br><img src="images/static_map.gif" width="500" height="500" alt="Map Image"
							border="0" /></td>
						<td>
						<p class="right">	</td>
					</tr>
					<tr>
					<td> </td> 
					<td>
					  
					<td>					</tr>
				</table>
</html>

<?php
include 'UIFooter.php';
?>
