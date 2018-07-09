
if (window.slideshows !== undefined && window.slideshows !== null){
	if (window.slideshows.length > 0) {
	for (var prop in window.slideshows) {
		if (window.slideshows.hasOwnProperty(prop)) {
			var p  = document.getElementById('sliderwidth'+prop);
				//var style = p.currentStyle || window.getComputedStyle(p)			
				thewidth = parseInt(p.clientWidth)
				//alert (p.clientWidth);
			if (thewidth != parseInt(window.slideshows[prop].oldwidth)){
				
				window.slideshows[prop].oldwidth = thewidth;
				if (window.slideshows[prop].theWidth > thewidth){
					document.getElementById('slidercontainer'+prop).style.width= '100%';
					var p  = document.getElementById('sliderwidth'+prop);
				//var style = p.currentStyle || window.getComputedStyle(p)			
				thewidth = parseInt(p.clientWidth)
					document.getElementById('slidercontainer'+prop).style.height= (thewidth*window.slideshows[prop].aspectratio)+'px';
					
					document.getElementById('sliders1'+prop).style.left = thewidth+'px';
					document.getElementById('sliders2'+prop).style.left = thewidth+'px';
					if (parseInt(window.slideshows[prop].theWidth) > parseInt(window.slideshows[prop].theHeight)){
						window.slideshows[prop].quality = thewidth;
					}else{
						 window.slideshows[prop].quality = thewidth*window.slideshows[prop].aspectratio;
					} 
					document.getElementById('nextslide'+prop).style.top = ((thewidth*window.slideshows[prop].aspectratio/2)-25)+'px'
					document.getElementById('nextslide'+prop).style.left = (thewidth-window.slideshows[prop].nextimgwidth)+'px'
					document.getElementById('prevslide'+prop).style.top = ((thewidth*window.slideshows[prop].aspectratio/2)-25)+'px'
				}else{
					//document.getElementById('slidercontainer'+prop).style.width= window.slideshows[prop].theWidth-1+'px';'100%';
					document.getElementById('slidercontainer'+prop).style.width= '100%';
					var p  = document.getElementById('sliderwidth'+prop);
				//var style = p.currentStyle || window.getComputedStyle(p)			
				thewidth = parseInt(p.clientWidth)
					document.getElementById('slidercontainer'+prop).style.height= (thewidth*window.slideshows[prop].aspectratio)+'px';
					document.getElementById('sliders1'+prop).style.left = thewidth+'px';
					document.getElementById('sliders2'+prop).style.left = thewidth+'px';
					if (window.slideshows[prop].theWidth > window.slideshows[prop].theHeight){
						window.slideshows[prop].quality = window.slideshows[prop].theWidth;
					}else{
						window.slideshows[prop].quality = window.slideshows[prop].theHeight;
					}
					document.getElementById('nextslide'+prop).style.top = ((window.slideshows[prop].theHeight/2)-25)+'px'
					document.getElementById('nextslide'+prop).style.left = (window.slideshows[prop].theWidth-document.getElementById('nextslide'+prop).offsetWidth)+'px'
					
					document.getElementById('prevslide'+prop).style.top = ((window.slideshows[prop].theHeight/2)-25)+'px'
				}
				
			curslide = window.slideshows[prop].curslide+1
			if (curslide == window.slideshows[prop].slides.length){
				curslide = 0;
			}	
			
			window.slideshows[prop].timerfade=clearTimeout(window.slideshows[prop].timerfade);
			window.slideshows[prop].thetimer=clearTimeout(window.slideshows[prop].thetimer);
			window.slideshows[prop].thetimer=setTimeout("nextslide('"+prop+"')",3000);
			//alert (window.slideshows[prop].quality);
			if (window.slideshows[prop].imagetop == 0){
				window.slideshows[prop].image2loaded = false;
				//window.slideshows[prop].image1loaded = false;
				//theimage = document.getElementById ("image2slide"+prop);
				//window.slideshows[prop].timerfade=setTimeout("fadeslide2in('"+prop+"')",300);
				//alert (document.getElementById ("image2slide"+prop).src.substring(document.getElementById ("image2slide"+prop).src.length-9, document.getElementById ("image2slide"+prop).src.length));
				if (document.getElementById ("image2slide"+prop).src.substring(document.getElementById ("image2slide"+prop).src.length-9, document.getElementById ("image2slide"+prop).src.length) ==  "blank.png"){
					document.getElementById ("image2slide"+prop).src = './system/imgtumb.php?url='+window.slideshows[prop].slides[window.slideshows[prop].curslide].image+"&maxsize="+(window.slideshows[prop].quality*window.devicePixelRatio)+"&aspectratio="+window.slideshows[prop].aspectratio;
					fadeslide2in(prop);
				}else{
					window.slideshows[prop].timerfade=setTimeout('document.getElementById ("image2slide'+prop+'").src = "./system/imgtumb.php?url='+window.slideshows[prop].slides[window.slideshows[prop].curslide].image+"&maxsize="+(window.slideshows[prop].quality*window.devicePixelRatio)+"&aspectratio="+window.slideshows[prop].aspectratio+'";'+"fadeslide2in('"+prop+"')",500);
				}
			}else{
				//window.slideshows[prop].image2loaded = false;
				window.slideshows[prop].image1loaded = false;
				//theimage = document.getElementById ("imageslide"+prop);
				if (document.getElementById ("imageslide"+prop).src.length < 2){
					document.getElementById ("imageslide"+prop).src = './system/imgtumb.php?url='+window.slideshows[prop].slides[window.slideshows[prop].curslide].image+"&maxsize="+(window.slideshows[prop].quality*window.devicePixelRatio)+"&aspectratio="+window.slideshows[prop].aspectratio;
					fadeslidein(prop);					
				}else{					
					window.slideshows[prop].timerfade=setTimeout('document.getElementById ("imageslide'+prop+'").src = "./system/imgtumb.php?url='+window.slideshows[prop].slides[window.slideshows[prop].curslide].image+"&maxsize="+(window.slideshows[prop].quality*window.devicePixelRatio)+"&aspectratio="+window.slideshows[prop].aspectratio+'";'+"fadeslide2in('"+prop+"')",500);
				}
				window.slideshows[prop].timerfade=setTimeout('document.getElementById ("imageslide'+prop+'").src = "./system/imgtumb.php?url='+window.slideshows[prop].slides[window.slideshows[prop].curslide].image+"&maxsize="+(window.slideshows[prop].quality*window.devicePixelRatio)+"&aspectratio="+window.slideshows[prop].aspectratio+'";'+"fadeslidein('"+prop+"')",500);			
			}
			//alert ('document.getElementById ("imageslide'+prop+'").src = "./system/imgtumb.php?url='+window.slideshows[prop].slides[window.slideshows[prop].curslide].image+"&maxsize="+window.slideshows[prop].quality+"&aspectratio="+window.slideshows[prop].aspectratio+'";'+"fadeslidein('"+prop+"')")
			
			}
			if (window.slideshows[prop].slides.length < 2){
				changeOpac(0, 'nextslide'+prop);
				changeOpac(0, 'prevslide'+prop);
			}else{
				changeOpac(100, 'nextslide'+prop);
				changeOpac(100, 'prevslide'+prop);
			}
		}

	}
	}
	
}