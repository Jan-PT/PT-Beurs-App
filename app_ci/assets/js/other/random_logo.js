// Functie die uit de verschillende Planet Talent logo's bij elke refresh één logo gaat selecteren en weergeven op de views
window.onload = function(){
	var rand = Math.floor((Math.random() * 19) + 1); 
	var src1 = "/app_ci/assets/images/logo/pt-logo-signed-";
	var src2 = ".png";
	var srcAll =  src1.concat(rand.toString(), src2);
	document.getElementById("logo").src =  srcAll;		
};


