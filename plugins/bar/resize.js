
if (window.thebars !== undefined && window.thebars !== null){
	for (var prop in window.thebars) {
		if (window.thebars.hasOwnProperty(prop)) {
			var p = document.getElementById(window.thebars[prop]).parentElement;
			p.style.paddingRight = "0px";
			p.style.marginRight = "0px";
			p.style.marginLeft = "0px";
			p.style.paddingLeft = "0px";
			var barwidth = document.getElementById("barwidth").clientWidth;
			var barscrollwidth = document.getElementById("barscrollwidth").clientWidth;			
			var middel = document.getElementById("Middel");
			var style = p.currentStyle || window.getComputedStyle(p)
			var pstyle = p.currentStyle || window.getComputedStyle(p)
			var stylemiddel = middel.currentStyle || window.getComputedStyle(middel)
			var w = window.innerWidth;
			var scrollbarwidth = w - barscrollwidth;
			//p.style.cssText = pstyle.cssText;
			//alert (pstyle.style.cssText);
			xposition = posx(p)-parseInt(style.marginLeft)
			middelxposition = posx(middel)
			p.style.marginLeft = String(0-xposition)+"px";
			p.style.paddingLeft = String(xposition)+"px";
			var width = parseInt(stylemiddel.width)
			weardoffset = (width - 1000)*0.03
			//weardoffset = 0;
			rightoffset = (parseInt(w)-parseInt(xposition)-parseInt(barwidth)-scrollbarwidth);
			//alert (barwidth)
			p.style.paddingRight = rightoffset+"px";
			p.style.marginRight = 0-rightoffset+"px";
			
			if (typeof getbackimg == "undefined" || getbackimg == null){
				//thebarbackset = "set";
				getbackimg =  pstyle.backgroundImage;
				getbackimg = getbackimg.substring(4, getbackimg.length-1)
				getbackimg = getbackimg.split("Themes");
				getbackimg = "./Themes"+getbackimg[1];
				
				thebacksize = pstyle.backgroundSize;
				thebacksize = thebacksize.replace("px","");
				thebacksize = thebacksize.replace(" ","");
				thebacksize = thebacksize.replace(";","");
				thebacksize = thebacksize.split(",");
				if (thebacksize[1] > thebacksize[0]){
					thebacksize = thebacksize[1];
				}else{
					thebacksize = thebacksize[0];
				}	
			}				
			scale = 1 / window.devicePixelRatio;

			
			tmpbackground = 'url(./system/imgtumb.php?url='+getbackimg+'&maxsize='+(parseInt(thebacksize)*window.devicePixelRatio)+'&square=0)';
			p.style.backgroundImage=tmpbackground;
			
			
			//document.getElementById('logodiv').innerHTML = outputfooter;
		}
	}
	
}