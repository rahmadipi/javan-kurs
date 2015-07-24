function fixed(){
	if(pageYOffset>=330){
		document.getElementById("menubar-clone").style.display="block";
		document.getElementById("menubar").style.top="0";
		document.getElementById("menubar").style.left="0";
		document.getElementById("menubar").style.position="fixed";
	}
	else{
		document.getElementById("menubar-clone").style.display="none";
		document.getElementById("menubar").style.position="relative";
	}
}
setInterval("fixed()",50);