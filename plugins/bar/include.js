<script language="javascript">



function posx(elm) {
    var test = elm, left = 0;

    while(!!test && test.tagName.toLowerCase() !== "body") {
        left += test.offsetLeft;
        test = test.offsetParent;
    }

    return left;
}



function fadesubmenuheight(divid, targetheight){

	window.timerIDmenuheight=clearTimeout(window.timerIDmenuheight);
	thediv = document.getElementById(divid)
	if (targetheight == -1){
		var sOriginalOverflow = thediv.style.overflow;
		var sOriginalHeight = thediv.style.height;
		thediv.style.overflow = "";
		thediv.style.height = "";
		targetheight = thediv.offsetHeight ;
		thediv.style.height = sOriginalHeight;
		thediv.style.overflow = sOriginalOverflow;
	}	
	
	if (parseFloat(thediv.style.height) > targetheight -1 && parseFloat(thediv.style.height) < targetheight +1){			
			thediv.style.height = "";	
			if (targetheight == 0){
				thediv.style.display="none";
			}			
	}else{
		//alert (parseFloat(thediv.style.height)+" "+targetheight)
		if (targetheight > parseFloat(thediv.style.height)){
			var newheight =  (((targetheight - parseFloat(thediv.style.height))/2)+parseFloat(thediv.style.height))
		}else{
			var newheight =  parseFloat(thediv.style.height) - (((parseFloat(thediv.style.height) - targetheight )/2))
		}
		
		thediv.style.height = newheight + "px"
		window.timerIDmenuheight = setTimeout("fadesubmenuheight('"+divid+"',"+targetheight+")",30);
				
	}
}
</script>