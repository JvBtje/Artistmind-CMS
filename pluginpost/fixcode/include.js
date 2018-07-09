<script language="javascript">
function fixcode(){ 
	if (window.fixcodetabletimer !== undefined) {
		window.fixcodetabletimer=clearTimeout(window.fixcodetabletimer);
		window.fixcodetabletimer = undefined;

	}
	
	if (document.getElementById("content")){
		
		var m= document.getElementById("content").getElementsByTagName('code');	
		for (var i = 0; i<m.length; i++){
			m[i].style.height = m[i].offsetHeight+"px";
			m[i].style.width = "30px";
		}
			window.fixcodetabletimer=setTimeout('fixcode2();',0);
	}

}

function fixcode2(){
	if (document.getElementById("content")){
		var m= document.getElementById("content").getElementsByTagName('table');
		var middel = document.getElementById("Middel")
		var contentdiv = document.getElementById("content")
		
		var m= document.getElementById("content").getElementsByTagName('code');	
		for (var i = 0; i<m.length; i++){
			var different = posX(m[i]) - posX(contentdiv);
			m[i].style.width = (contentdiv.offsetWidth-different-20)+'px';
			m[i].style.height = "";			
		}
	}
}

</script>