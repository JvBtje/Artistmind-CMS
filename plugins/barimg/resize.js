
if (window.thebars !== undefined && window.thebars !== null){
	for (var prop in window.thebars) {
		if (window.thebars.hasOwnProperty(prop)) {
			var p = document.getElementById(window.thebars[prop]).parentElement;
			p.style.paddingRight = "0px";
			p.style.marginRight = "0px";
			p.style.marginLeft = "0px";
			p.style.paddingLeft = "0px";
			var pbar = document.getElementById("bar");
			var barwidth = document.getElementById("barwidth").clientWidth;
			var barscrollwidth = document.getElementById("barscrollwidth").clientWidth;			
			var middel = document.getElementById("Middel");
			var style = p.currentStyle || window.getComputedStyle(p)
			var pstyle = pbar.currentStyle || window.getComputedStyle(pbar)
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
			//p.style.paddingRight = String(((((barwidth - width)-middelxposition)+parseInt(stylemiddel.paddingRight)+parseInt(stylemiddel.paddingLeft)+ parseInt(stylemiddel.marginRight)+parseInt(stylemiddel.borderSpacing)+parseInt(stylemiddel.borderRightWidth)+ parseInt(stylemiddel.borderLeftWidth)+weardoffset)))+"px";
			//p.style.marginRight = String((0-(((barwidth - width)-middelxposition)+parseInt(stylemiddel.paddingRight)+parseInt(stylemiddel.paddingLeft)+ parseInt(stylemiddel.marginRight)+parseInt(stylemiddel.borderSpacing)+parseInt(stylemiddel.borderRightWidth)+ parseInt(stylemiddel.borderLeftWidth)+weardoffset)))+"px";
			//alert (window.thebars[prop]);
		}
	}
	
}