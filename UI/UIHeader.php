<?php

session_start();

require("..//DAL//dbconnect.php");
include("..//BSO//BSO_PreHeader.php");
$user = $_SESSION['CurrentUser'];
 ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
  <head>
    <title>PATH</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
  </head>
  <body leftmargin="0" topmargin="0" marginheight="0"
    marginwidth="0"
	bgcolor="#ffffff">
	<div id="map-wrapper">
    <table border="0" cellspacing="0" cellpadding="0" width="100%"
      height="100%">
      <tr valign="top" >
        <td width="50%" background="images/bg.gif">
          <img src="images/px1.gif"
			width="1" height="1" alt="" border="0", />
        </td>
        <td valign="bottom" background="images/bg_left.gif">
          <img
			src="images/bg_left.gif" alt="" width="17" height="16" border="0" />
        </td>
        <td>
          <table border="0" cellpadding="0" cellspacing="0" width="1200"
            height="107">
            <tr valign="bottom">
              <td>
                <img src="images/logo.png" width="183" height="107" alt=""
              border="0" />
              </td>
              <td width="1100" background="images/fon_top.png">
                <table border="0" cellpadding="0" cellspacing="0" background="">
                  <tr valign="bottom">
                  <td>
                    <!-- but -->
                      <?
                       if($_SESSION['ActiveTitle']=="HOME")
                       { 
                      ?> 	
                       	<table border="0" cellpadding="0" cellspacing="0">
                        <tr valign="bottom">
                         
                          <td>
                            <img src="images/b_left_a.gif" alt="" width="10" height="30"
                          border="0" />
                          </td>
                          <td background="images/b_fon_a.gif">
                            <p class="menu01">
                              <a href="../UI/Main.php">HOME</a>
                            </p>
                          </td>
                          <td>
                            <img src="images/b_right_a.gif" alt="" width="10" height="30"
                          border="0" />
                          </td>
                        </tr>
                      </table>
                      <?
                       }
                      else{
                      ?>	
                      <table border="0" cellpadding="0" cellspacing="0">
                        <tr valign="bottom">
                         
                          <td>
                            <img src="images/b_left.png" alt="" width="10" height="30"
                          border="0" />
                          </td>
                          <td background="images/b_fon.png">
                            <p class="menu01">
                              <a href="../UI/Main.php">HOME</a>
                            </p>
                          </td>
                          <td>
                            <img src="images/b_right.png" alt="" width="10" height="30"
                          border="0" />
                          </td>
                        </tr>
                      </table>
                      <?
                      }
                      ?>
                     
                      <!-- /but -->
                    </td>
                     
                    <td>
                    <?
                       if($_SESSION['ActiveTitle']=="MAP")
                       { 
                      ?>
                      <!-- but -->
                      <table border="0" cellpadding="0" cellspacing="0">
                        <tr valign="bottom">
                          <td>
                            <img src="images/b_left_a.gif" alt="" width="10" height="30"
                          border="0" />
                          </td>
                          <td background="images/b_fon_a.gif">
                            <p class="menu01">
                              <a href="../UI/UIMap.php">SEARCH</a>
                            </p>
                          </td>
                          <td>
                            <img src="images/b_right_a.gif" alt="" width="10" height="30"
                          border="0" />
                          </td>
                        </tr>
                      </table>
                      <? 
                       }
                       else 
                       {
                      ?>
                        <table border="0" cellpadding="0" cellspacing="0">
                        <tr valign="bottom">
                          <td>
                            <img src="images/b_left.png" alt="" width="10" height="30"
                          border="0" />
                          </td>
                          <td background="images/b_fon.png">
                            <p class="menu01">
                              <a href="../UI/UIMap.php">SEARCH</a>
                            </p>
                          </td>
                          <td>
                            <img src="images/b_right.png" alt="" width="10" height="30"
                          border="0" />
                          </td>
                        </tr>
                      </table>
                      <?
                      } 
                      ?> 
                      <!-- /but -->
                    </td>
                     <td>
                    <?
                       if($_SESSION['ActiveTitle']=="REGISTER")
                       { 
                      ?>
                      <!-- but -->
                      <table border="0" cellpadding="0" cellspacing="0">
                        <tr valign="bottom">
                          <td>
                            <img src="images/b_left_a.gif" alt="" width="10" height="30"
                          border="0" />
                          </td>
                          <td background="images/b_fon_a.gif">
                            <p class="menu01">
                              <a href="../BSO/BSO_PreUIRegister.php">REGISTER</a>
                            </p>
                          </td>
                          <td>
                            <img src="images/b_right_a.gif" alt="" width="10" height="30"
                          border="0" />
                          </td>
                        </tr>
                      </table>
                      <? 
                       }
                       else 
                       {
                      ?>
                        <table border="0" cellpadding="0" cellspacing="0">
                        <tr valign="bottom">
                          <td>
                            <img src="images/b_left.png" alt="" width="10" height="30"
                          border="0" />
                          </td>
                          <td background="images/b_fon.png">
                            <p class="menu01">
                              <a href="../BSO/BSO_PreUIRegister.php">REGISTER</a>
                            </p>
                          </td>
                          <td>
                            <img src="images/b_right.png" alt="" width="10" height="30"
                          border="0" />
                          </td>
                        </tr>
                      </table>
                      <?
                      } 
                      ?> 
                      <!-- /but -->
                    </td>
                     <td>
                    <?
                       if($_SESSION['ActiveTitle']=="ADDADVICE")
                       { 
                      ?>
                      <!-- but -->
                      <table border="0" cellpadding="0" cellspacing="0">
                        <tr valign="bottom">
                          <td>
                            <img src="images/b_left_a.gif" alt="" width="10" height="30"
                          border="0" />
                          </td>
                          <td background="images/b_fon_a.gif">
                            <p class="menu01">
                              <a href="../BSO/BSO_PreAddAdvice.php">ADD ADVICE</a>
                            </p>
                          </td>
                          <td>
                            <img src="images/b_right_a.gif" alt="" width="10" height="30"
                          border="0" />
                          </td>
                        </tr>
                      </table>
                      <? 
                       }
                       else 
                       {
                      ?>
                        <table border="0" cellpadding="0" cellspacing="0">
                        <tr valign="bottom">
                          <td>
                            <img src="images/b_left.png" alt="" width="10" height="30"
                          border="0" />
                          </td>
                          <td background="images/b_fon.png">
                            <p class="menu01">
                              <a href="../UI/UIAddAdvice.php">ADD ADVICE</a>
                            </p>
                          </td>
                          <td>
                            <img src="images/b_right.png" alt="" width="10" height="30"
                          border="0" />
                          </td>
                        </tr>
                      </table>
                      <?
                      } 
                      ?> 
                      <!-- /but -->
                    </td>
                    
                    
                    <td>
                      <!-- but -->
                      <?
                       if($_SESSION['ActiveTitle']=="AddAdviceType")
                       { 
                    ?>
                      <table border="0" cellpadding="0" cellspacing="0">
                        <tr valign="bottom">
                          <td>
                            <img src="images/b_left_a.gif" alt="" width="10" height="30"
                          border="0" />
                          </td>
                          <td background="images/b_fon_a.gif">
                            <p class="menu01">
                              <a href="UIAddAdviceType.php">ADD ADVICE TYPE</a>
                            </p>
                          </td>
                          <td>
                            <img src="images/b_right_a.gif" alt="" width="10" height="30"
                          border="0" />
                          </td>
                        </tr>
                      </table>
                      <?
                       }
                       else 
                       {
                      ?>
                        <table border="0" cellpadding="0" cellspacing="0">
                        <tr valign="bottom">
                          <td>
                            <img src="images/b_left.png" alt="" width="10" height="30"
                          border="0" />
                          </td>
                          <td background="images/b_fon.png">
                            <p class="menu01">
                              <a href="UIAddAdviceType.php">ADD ADVICE TYPE</a>
                            </p>
                          </td>
                          <td>
                            <img src="images/b_right.png" alt="" width="10" height="30"
                          border="0" />
                          </td>
                        </tr>
                       </table>
                       <?
                       	 }
                       ?>
                      <!-- /but -->
                    </td>
                    <td>
                      <!-- but -->
                    <?
                       if($_SESSION['ActiveTitle']=="CONTACT")
                       { 
                    ?>  
                      <table border="0" cellpadding="0" cellspacing="0">
                        <tr valign="bottom">
                          <td>
                            <img src="images/b_left_a.gif" alt="" width="10" height="30"
                          border="0" />
                          </td>
                          <td background="images/b_fon_a.gif">
                            <p class="menu01">
                              <a href="contact.php">CONTACT</a>
                            </p>
                          </td>
                          <td>
                            <img src="images/b_right_a.gif" alt="" width="10" height="30"
                          border="0" />
                          </td>
                        </tr>
                      </table>
                      <?
                       }
                       else 
                       {
                      ?>
                       	<table border="0" cellpadding="0" cellspacing="0">
                        <tr valign="bottom">
                          <td>
                            <img src="images/b_left.png" alt="" width="10" height="30"
                          border="0" />
                          </td>
                          <td background="images/b_fon.png">
                            <p class="menu01">
                              <a href="contact.php">CONTACT</a>
                            </p>
                          </td>
                          <td>
                            <img src="images/b_right.png" alt="" width="10" height="30"
                          border="0" />
                          </td>
                        </tr>
                      </table>
                      <?
                       	}
                      ?>
                      <!-- /but -->
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
          <table border="0" cellpadding="0" cellspacing="0" width="780"
    height="107">
            <tr valign="top">
              <td bgcolor="#D0E0ED">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                    <td bgcolor="#076BA7">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td>
                            <img src="images/text_1.gif" width="183" height="50" />
                          </td>
                        </tr>
                      </table>

                    </td>
                  </tr>
                </table>
<!--                <div align="center">
                  <img src="images/mdh.jpg" width="183"
height="124" alt="" border="0" />
                </div>-->
                <div align="center">
                  <img src="images/title01.png" width="183"
height="35" alt="" border="0" />
                </div>

                <form action="../BSO/BSO_Login.php" method="post">
                  <nobr>
                    <div style="padding-top: 10px; padding-left: 0px;">
                      <table>
                        <?php
				if($user)
				{
					?>
                        <tr>
                          <td width="10%">
                            <span class="right">
                              Welcome:
                              <?php echo $user; ?>
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2" align="center">
                            <input type="submit" name="LogOut" value="Log Out" />
                          </td>
                        </tr>
                        <?php
				}
				else
				{
				 	?>
                        <tr>
                          <td width="10%";style="font-size: 9pt; font-family: 'Times New Roman';" >
                            <span class="right">UserName</span>
                          </td>
                          <td>
                            <input type="Text" name="UserName" value="" size="8" />
                          </td>
                        </tr>
                        <tr>
                          <td style="font-size: 9pt; font-family: 'Times New Roman';">
                            <span class="right">Password</span>
                          </td>
                          <td>
                            <input type="password" name="Password" value=""
                          size="8" />
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2" align="center">
                            <input type="submit" name="login" value="Login" />
                          </td>
                        </tr>
                        <?php
				}
				?>
                      </table>
                    </div>
                  </nobr>
                </form>
 <img src="images/grp.png"
					width="183" height="36" alt="" border="0" />
         <?	     
         $result= $_SESSION['Groups'];
         $num=mysql_numrows($result);
	      $i=0; 
         for ($i =0; $i< $num;$i++)
         { 
           $fieldname=mysql_result($result,$i,"description");
        
         ?>
          <input type="checkbox", name="chkbox" /> <? echo $fieldname; ?></br>
         <? 
         } 
         ?>
	<form name="CategoryFilter" action = "../BSO/BSO_Filter.php" method="post">
     <img src="images/categ.jpg" width="183" height="36" alt="" border="0" />    </br> 
         <?	     
         $result= $_SESSION['Groups2'];
         $num=mysql_numrows($result);
	      $i=0; 
         for ($i =0; $i< $num;$i++)
         { 
           $fieldname=mysql_result($result,$i,"type");
        
         ?>
          <input type="checkbox", name="chkbox<?echo $i;?>" /> <? echo $fieldname; ?></br>
         <? 
         } 
         ?>
         <?	     
         $result3= $_SESSION['Groups3'];
         $num=mysql_numrows($result3);
         mysql_close();
	      $i=0; 
         for ($i =0; $i< $num;$i++)
         { 
           $fieldname=mysql_result($result3,$i,"type");
        
         ?>
          <input type="checkbox", name="pchkbox<?echo $i;?>" /> <? echo $fieldname; ?></br>
         <? 
         } 
         ?>
                    &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;<input type="Submit" Value="Filter"/>
      </form>


      <form action="" method="post">
                  <img src="images/title02.png"
					width="183" height="36" alt="" border="0" />

                </form>
                 <form action="UIMap.php" onSubmit="setDirections(this.from.value, this.to.value, this.locale.value); return false"> 
 
  <table>
  	<tr>
  		<th align="left"; style="font-size: 9pt; font-family: 'Times New Roman';" >From</th>
  		<td>
  			<input type="text" size="12" id="fromAddress" name="from"
		 	value=""/>
		</td>
		<td>
			<input type="Image" src="images/b_go.gif"
  			width="22" height="28" alt="" border="0" align="middle">
		</td>
   </tr>
   
   <tr>
	<th align="left";style="font-size: 9pt; font-family: 'Times New Roman'; ">&nbsp;&nbsp;To</th> 
	   		<td align="right"><input type="text" size="12" id="toAddress" name="to"
	     		value="" />
	     	</td>
	     	
	     	<td>
			<input type="Image" src="images/b_go.gif"
  			width="22" height="28" alt="" border="0" align="middle">
			</td>
  	</tr> 
 
   <tr>
   	<th style="font-size: 9pt; font-family: 'Times New Roman';">Lang&nbsp;&nbsp;&nbsp;</th>
   	<td colspan="3"><select id="locale" name="locale"> 
    	<option value="en" selected>English</option> 
    	<option value="fr">French</option> 
		<option value="de">German</option> 
    	<option value="ja">Japanese</option> 
    	<option value="es">Spanish</option> 
    	</select> 
    </td>
	</tr>
	</table> 
	<table> 
    <tr>
    	<td align="right">
    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	<input name="submit" type="submit" value="Get Direction" />
    	</td> 
   	</tr>
   </table>
 
                 </form> 
  </td>
              <td rowspan="2">
                <div align="center">
                  <img src="images/top01.gif" width="1020"
height="24" alt="" border="0" />
                </div>