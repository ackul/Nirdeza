function checkForPrimary()
{
	if(document.key.key_type.value == 'PRIMARY')
	{
		document.key.key_name.value = "PRIMARY";
		document.key.key_name.disabled = true;
	}
	else if(document.key.key_name.value == 'PRIMARY')
	{
		document.key.key_name.value = "";
		document.key.key_name.disabled = false;
	}
	else
	{
		document.key.key_name.disabled = false;
	}
}
function addNewCol()
{
	document.getElementById('columns').innerHTML += document.getElementById('new_col').innerHTML;
}