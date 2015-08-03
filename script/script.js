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

function jam() { 
	var jam = new Date();
	var j=jam.getHours()+"";
	var m=jam.getMinutes()+"";
	var s=jam.getSeconds()+"";
	document.getElementById("jam").innerHTML = "<font color=white style='position:absolute'><small>"+(j.length==1?"0"+j:j)+":"+(m.length==1?"0"+m:m)+":"+(s.length==1?"0"+s:s)+"</small></font>"; 
}
setInterval("jam()",1000);