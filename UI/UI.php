
<?php
include 'UIHeader.php';
?>
<html>
	<head>
		<title>Add Advice Tempates</title>
		<script language="javascript">
		
			//add a new row to the table
			function addRow()
			{
				
				//add a row to the rows collection and get a reference to the newly added row
				var newRow = document.all("tblGrid").insertRow();
				//add 3 cells (<td>) to the new row and set the innerHTML to contain text boxes
				
				var oCell = newRow.insertCell();
				oCell.innerHTML = "<input type='text' name='Field'>";		
				
				
				oCell = newRow.insertCell();
				oCell.innerHTML = "<input type='text' name='Type'> "
				
				oCell = newRow.insertCell();
				oCell.innerHTML = "<input type='button' value='Delete' onclick='removeRow(this);'/>";			
			}
			
			//deletes the specified row from the table
			function removeRow(src)
			{
				/* src refers to the input button that was clicked.	
				   to get a reference to the containing <tr> element,
				   get the parent of the parent (in this case case <tr>)
				*/			
				var oRow = src.parentElement.parentElement;		
				
				//once the row reference is obtained, delete it passing in its rowIndex			
				document.all("tblGrid").deleteRow(oRow.rowIndex);		
			}
		
		</script>
	</head>
	
	<body>
	<form action="#" method="Post">
		<hr>
		<!-- sample table grid with 3 columns and 4 rows that are presented by default -->
		<table id="tblGrid"  style="table-layout:fixed">
			<tr>
				<td width="150px"></td>
				<td width="150px">Name</td>
				<td width="150px">Type</td>
				
			</tr>
		</table>
		<hr>
		<input type="button" value="Add Row" onclick="addRow();" />
		<input type="Submit" value="Save "  />
		</form>
	</body>
</html>

<?php
include 'UIFooter.php';
?>