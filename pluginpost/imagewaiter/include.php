<?php

$putimgurlindataoriginal = "true";
?> 

 <script>
  imgwaiter = 0;
 putimgurlindataoriginal = true;
 function doimagewaitscroll(imgwaiter){
	var imgtage=document.getElementById("Middel").getElementsByTagName('img');
	viewportscroll = parseInt(scrollY())+ parseInt(viewPortHeight()); 
	viewportscroll = viewportscroll + (viewportscroll/10)
	imagewaiterloaderb:
		for (var i = imgwaiter; i<imgtage.length; i++){
			
			if (imgtage[i].hasAttribute("data-original")){
			imgtage[i].theposy = parseInt(posY(imgtage[i]));
			
				if (imgtage[i].theposy < viewportscroll){
				
					var att = document.createAttribute("src"); 
					att.value = imgtage[i].getAttribute("data-original"); 
					imgtage[i].setAttributeNode(att);  
					imgtage[i].removeAttribute("data-original");
					imagewaiterloader = i;	
				}else{
					break imagewaiterloaderb;
				}
					 
			}
			
		}
		return imagewaiterloader;
}
 </script>
