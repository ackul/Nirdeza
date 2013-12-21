function editCol(Name)
{
	self.open("functions/editCol.php?"+ path + "&col=" + Name, "_blank", "width=400,height=400,top="+ (screen.height/2 - 200)+",left="+ (screen.width/2 - 150)+",status=no,toolbar=no,menubar=no,scrollbars=yes,dependent=yes");
}
function editKey(Name)
{
	self.open("functions/editKey.php?"+ path + "&key=" + Name, "_blank", "width=400,height=400,top="+ (screen.height/2 - 200)+",left="+ (screen.width/2 - 150)+",status=no,toolbar=no,menubar=no,scrollbars=yes,dependent=yes");
}
function deleteCol(ColName , Name)
{
	if(confirm(delete_col.replace("%s", ColName)))
	{
		window.open("functions/deleteCol.php?"+ path + "&col=" + Name, "outputpane");
	}
}
function deleteKey(keyName , Name)
{
	if(confirm(delete_key.replace("%s", keyName)))
	{
		window.open("functions/deleteKey.php?"+ path + "&key=" + Name, "outputpane");
	}
}
function newCol()
 {
	window.open("functions/editCol.php?"+ path + "",  "_blank", "width=400,height=500,top="+ (screen.height/2 - 250)+",left="+ (screen.width/2 - 150)+",status=no,toolbar=no,menubar=no,scrollbars=yes,dependent=yes");
 }
 function newKey()
 {
	window.open("functions/editKey.php?"+ path + "",  "_blank", "width=400,height=400,top="+ (screen.height/2 - 250)+",left="+ (screen.width/2 - 150)+",status=no,toolbar=no,menubar=no,scrollbars=yes,dependent=yes");
 }
function rel()
{
	location.reload();
}