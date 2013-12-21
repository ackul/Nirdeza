<?php
session_start();
$ResolutionOptions = $_SESSION['ResolutionOptions'];
echo $ResolutionOptions;
$_SESSION['ActiveTitle']="ADD ADVICE TYPE";
include 'UIHeader.php';
?>


<html>
 <body>
    <form action="../BSO/BSO_AdviceType.php" method="Post">
      <table style="table-layout:fixed" width= 100%>
					<tr> 
						<td width="20%"></td> 
						<td> 
         				<i style ="color: #076BA7; font-size:18px"><b> Add New Advice Type Here!</p> 
						<br /> 						
					</tr> 
	</table>
	
	<table width = 100%>		
      
      
        <tr>
        <tr>
            <td style="width: 100px">
            </td>
            <td style="width: 100px">
                Advice Name</td>
            <td style="width: 100px">
                <input id="txAdviceName" name="AdviceName" type="text" /></td>
        </tr>
        <tr>
            <td style="width: 100px; height: 26px">
            </td>
            <td style="width: 100px; height: 26px;">
                Resolution</td>
            <td style="width: 100px; height: 26px;">
                <input id="Resolution" name="Resolution" type="text" /></td>
        </tr>
        <tr>
            <td style="width: 100px">
            </td>
            <td style="width: 100px">
                Field 1</td>
            <td style="width: 100px">
                <input id="Field1" name="Field1" type="text" onClick="return txtField1_onclick()" /></td>
        </tr>
        <tr>
            <td style="width: 100px">
            </td>
            <td style="width: 100px">
                Field 2</td>
            <td style="width: 100px">
                <input id="Field2" name="Field2" type="text" /></td>
        </tr>
        <tr>
            <td style="width: 100px">
            </td>
            <td style="width: 100px">
                Field 3</td>
            <td style="width: 100px">
                <input id="Field3"  name="Field3" type="text" /></td>
        </tr>
        <tr>
            <td style="width: 100px">
            </td>
            <td style="width: 100px">
                Field 4</td>
            <td style="width: 100px">
                <input id="Field4" name="Field4" type="text" /></td>
        </tr>
      </table>
      <!-- sample table grid with 3 columns and 4 rows that are presented by default -->
      <table id="tblGrid"  style=" color: #076BA7; table-layout:fixed">
		  <td width="30%"></td>
          <td width="30%"></td>
          <td width="30%"></td>

      </table>      
      <hr size="5" align="left" width="100%" color="#FF0000">
      <input type="Submit" value="Save"  />
    </form>
   <table style="width: 492px; height: 202px">
        <tr style="color: #076BA7; width: 100px; height: 30px">
            <td >
            </td>
            <td>
                <b>Input Types </b> </td>
               
            <td style="width: 100px; height: 30px">
            </td>
            <td style="width: 110px; height: 30px">
               <b>Resolution Levels</b> </td>
        </tr>
        <tr>
            <td style="width: 100px">
            </td>
            <td style="width: 100px">
    <table border="1" id="tblTypes"  style="width: 110px">
        <tr>
            <td style="width: 100px">
                Type</td>
            <td style="width: 100px">
                ID</td>
        </tr>
        <tr>
            <td style="width: 100px">
                Intiger</td>
            <td style="width: 100px">
                1</td>
        </tr>
        <tr>
            <td style="width: 100px; height: 5px">
                Text</td>
            <td style="width: 100px; height: 5px">
                2</td>
        </tr>
        <tr>
            <td style="width: 100px; height: 21px;">
                Image</td>
            <td style="width: 100px; height: 21px;">
                3</td>
        </tr>
        <tr>
            <td style="width: 100px; height: 21px">
                Boolean</td>
            <td style="width: 100px; height: 21px">
                4</td>
        </tr>
        <tr>
            <td style="width: 100px; height: 21px">
                Video</td>
            <td style="width: 100px; height: 21px">
                5</td>
        </tr>
    </table>          
            <td style="width: 100px">
            </td>
            <td style="width: 100px">
                <table border="1">
                    <tr>
                        <td style="width: 100px">
                            Level</td>
                        <td style="width: 100px">
                            ID</td>
                    </tr>
                    <tr>
                        <td style="width: 100px">
                            All</td>
                        <td style="width: 100px">
                            1</td>
                    </tr>
                    <tr>
                        <td style="width: 100px">
                            Country</td>
                        <td style="width: 100px">
                            2</td>
                    </tr>
                    <tr>
                        <td style="width: 100px">
                            City</td>
                        <td style="width: 100px">
                            3</td>
                    </tr>
                    <tr>
                        <td style="width: 100px">
                            Street</td>
                        <td style="width: 100px">
                            4</td>
                    </tr>
                    <tr>
                        <td style="width: 100px">
                            House</td>
                        <td style="width: 100px">
                            5</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="width: 100px">
            </td>
            <td style="width: 100px">
            </td>
            <td style="width: 100px">
            </td>
            <td style="width: 100px">
            </td>
        </tr>
    </table> 
   </body>
</html>

<?php
include 'UIFooter.php';
?>
