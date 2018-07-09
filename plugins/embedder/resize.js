
if (window.embedder !== undefined && window.embedder !== null){

	for (var prop in window.embedder) {
		
		if (window.embedder.hasOwnProperty(prop)) {
			
			var p  = document.getElementById('sliderwidth'+prop);
				//var style = p.currentStyle || window.getComputedStyle(p)			
				thewidth = parseInt(p.clientWidth)
				//alert (p.clientWidth);
			if (thewidth != parseInt(window.embedder[prop].oldwidth)){
				
				window.embedder[prop].oldwidth = thewidth;
				
					
					document.getElementById('embedder'+prop).children[0].style.width= '1%';
					var p  = document.getElementById('sliderwidth'+prop);
					document.getElementById('embedder'+prop).children[0].style.width= '100%';
				//var style = p.currentStyle || window.getComputedStyle(p)			
					thewidth = parseInt(p.clientWidth)
					document.getElementById('embedder'+prop).children[0].style.height= (thewidth*window.embedder[prop].aspectratio)+'px';	

				
			}
		}
	}
	
}
