		function really()
		{
			Check = confirm(question);
			if(Check == false)
			{
				return false;
			}
			else
			{
				return true;
			}
		}
		function rel()
		{
			document.forms["vars"].action = action;
			document.forms["vars"].submit();
		}
		function updateDS(name)
		{
			if(update(name))
			{
				document.forms["form"+name].action = "functions/editContent.php?type=update";
				document.forms["form"+name].target = "update"+name;
				document.forms["form"+name].submit();
			}
		}
		function deleteDS(name)
		{
			if(really())
			{
				document.forms["form"+name].action = "functions/delete.php";
				document.forms["form"+name].target = "outputpane";
				document.forms["form"+name].submit();
			}
		}
		function print_page()
		{
			window.open("about:blank",  "print", "status=no,toolbar=no,menubar=no,scrollbars=yes,dependent=yes, height=600, width=700, top="+ (screen.height/2 - 300)+",left="+ (screen.width/2 - 350));
			document.forms["vars"].action = "io/print.php";
			document.forms["vars"].target = "print";
			document.forms["vars"].submit();
			document.forms["vars"].target = "_self";
		}
		function update(ID)
		 {
			window.open("about:blank",  "update"+ID, "width=600,height=600,status=no,toolbar=no,menubar=no,scrollbars=yes,dependent=yes,top="+ (screen.height/2 - 300)+",left="+ (screen.width/2 - 250));
			return true;
		 }
		function insert()
		 {
			window.open(insertAction,  "_blank", "width=600,height=600,status=no,toolbar=no,menubar=no,scrollbars=yes,dependent=yes,top="+ (screen.height/2 - 300)+",left="+ (screen.width/2 - 250));
		 }
		 function setSite(siteNo)
		 {
		 	document.forms["vars"].action = action + "&site=" + siteNo;
			document.forms["vars"].submit();
		 }
		 function setExport()
		 {
		 	document.forms["vars"].action = action + "&showExport=" + sExport;
			document.forms["vars"].submit();
		 }
		 function setTable()
		 {
		 	document.forms["vars"].action = action + "&showTable=" + sTable;
			document.forms["vars"].submit();
		 }
		 function setSort(col, mode)
		 {
			document.forms["vars"].action = action + "&orderBy=" + col + "&orderType="+mode+"&orderMode=extended";
			document.forms["vars"].submit();
			
		 }