var last_container = null;
var last_image = null;

function menudown(container, image)
{
	if(last_container != null && last_container != container && document.getElementById(last_container).style.position != "absolute")
	{
		var container_id = last_container;
		var image_name = last_image;
		last_container = null;
		last_image = null;
		menudown(container_id, image_name);
	}	

	down (image);
	if(document.getElementById(container).style.position == "absolute")
	{
		document.getElementById(container).style.position = "static";
		document.getElementById(container).style.visibility = "visible";
	}
	else
	{
		document.getElementById(container).style.position = "absolute";
		document.getElementById(container).style.visibility = "hidden";
	}
	last_container = container;
	last_image = image;
}

function down(pic)
{
	pict = new Image();
	pict.src = "img/open.gif";
	pict2 = new Image();
	pict2.src = "img/close.gif";
	if(document.images[pic].src == pict.src){document.images[pic].src = pict2.src;}
	else{document.images[pic].src = pict.src;}
}