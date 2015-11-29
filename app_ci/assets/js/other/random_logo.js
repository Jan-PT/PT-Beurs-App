window.onload = function(){
	var rand = Math.floor((Math.random() * 9) + 1); 
	var src1 = "assets/images/logo/pt-logo-signed-";
	var src2 = ".png";
	var srcAll =  src1.concat(rand.toString(), src2);
	
	//var logo = document.getElementById(logo);
	//logo.src = srcAll;
	
	document.getElementById("logo").src =  srcAll;		
}