	
var d= document, root= d.documentElement, body= d.body;
 var realWidth= window.scrollWidth || root.clientWidth || body.clientWidth, 
 realHeight= window.scrollHeight || root.clientHeight || body.clientHeight ;

	
	    realWidth = parseInt(realWidth) - 70;
	realHeight =  parseInt(realHeight) - 120;

if (window.curgalleryimg != -1 && window.galleryfunction == "gal"){

     	 realWidth = parseInt(realWidth) + 70 ;
	 realHeight =  parseInt(realHeight) + 120;
	
	currW = parseInt(window.galleryimages[window.curgalleryimg].theWidth);
	currH = parseInt(window.galleryimages[window.curgalleryimg].theHeight);
    	maxW = parseInt(realWidth) ;
	maxH =  parseInt(realHeight) ;
	
	
	var ratio ;
	ratio = currW/ currH;
	maxratio = maxW / maxH;
	if(currW > maxW && ratio > maxratio){
		var percent1 = (maxW / currW) ;
		
	}  else if(currH > maxH){
		var percent1 = (maxH / currH) ;
	} else {
		var percent1 = 1 ;
	}

	if (currH < 150){currH = 100}
	if (currW < 150){currW = 100}
	
	document.getElementById("editimg").style.top = parseInt((realHeight - (currH * percent1)) /2)+ 'px';
	document.getElementById("editimg").style.bottom = parseInt((realHeight - (currH * percent1)) /2)+ 'px';
	document.getElementById("editimg").style.left = parseInt((realWidth - (currW * percent1)) /2)+ 'px';
	document.getElementById("editimg").style.right = parseInt((realWidth - (currW * percent1)) /2)+ 'px';
	
	
	document.getElementById('imgshower').width =  window.galleryimages[window.curgalleryimg].theWidth * percent1;
	document.getElementById('imgshower').height =  window.galleryimages[window.curgalleryimg].theHeight * percent1;
	

	}
	

if (window.curgalleryimg != -1 && window.galleryfunction == "Main"){
	

var d= document, root= d.documentElement, body= d.body;
 var realWidth= window.scrollWidth || root.clientWidth || body.clientWidth, 
 realHeight= window.scrollHeight || root.clientHeight || body.clientHeight ;
		
     	realWidth = parseInt(realWidth) - 20;
	 realHeight =  parseInt(realHeight) - 20;
	
	
    	maxW = parseInt(realWidth) ;
	maxH =  parseInt(realHeight) ;

	currW = parseInt(window.maingalleryimages[window.curgalleryimg].theWidth);
	currH = parseInt( window.maingalleryimages[window.curgalleryimg].theHeight);

	var ratio ;
	ratio = currW/ currH;
	maxratio = maxW / maxH;
	if(currW > maxW && ratio > maxratio){
		var percent1 = (maxW / currW) ;
		
	}  else if(currH > maxH){
		var percent1 = (maxH / currH) ;
	} else {
		var percent1 = 1 ;
	}
	if (currH < 150){currH = 100}
	if (currW < 150){currW = 100}

	
	document.getElementById("editimgmain").style.top = parseInt((realHeight - (currH * percent1)) /2)+ 'px';
	document.getElementById("editimgmain").style.bottom = parseInt((realHeight - (currH * percent1)) /2)+ 'px';
	document.getElementById("editimgmain").style.left = parseInt((realWidth - (currW * percent1)) /2)+ 'px';
	document.getElementById("editimgmain").style.right = parseInt((realWidth - (currW * percent1)) /2)+ 'px';

	document.getElementById("imgcontainermain2").style.top = parseInt((realHeight - (currH * percent1)) /2)+ 'px';
	document.getElementById("imgcontainermain2").style.bottom = parseInt((realHeight - (currH * percent1)) /2)+ 'px';
	document.getElementById("imgcontainermain2").style.left = parseInt((realWidth - (currW * percent1)) /2)+ 'px';
	document.getElementById("imgcontainermain2").style.right = parseInt((realWidth - (currW * percent1)) /2)+ 'px';

	document.getElementById('imgshowermain').width =  window.maingalleryimages[window.curgalleryimg].theWidth * percent1;
	document.getElementById('imgshowermain').height =  window.maingalleryimages[window.curgalleryimg].theHeight * percent1;
	
	}

