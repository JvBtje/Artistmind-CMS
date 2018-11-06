// Copyright (C) 2005-2008 Ilya S. Lyubinskiy. All rights reserved.
// Technical support: http://www.php-development.ru/
//
// YOU MAY NOT
// (1) Remove or modify this copyright notice.
// (2) Re-distribute this code or any part of it.
//     Instead, you may link to the homepage of this code:
//     http://www.php-development.ru/javascripts/dropdown.php
//
// YOU MAY
// (1) Use this code on your website.
// (2) Use this code as part of another product.
//
// NO WARRANTY
// This code is provided "as is" without warranty of any kind.
// You expressly acknowledge and agree that use of this code is at your own risk.


// ***** Popup Control *********************************************************

// ***** at_show_aux *****
function changeOpac(opacity, id) {
	
    var object = document.getElementById(id).style;
	if (opacity != 0){
		object.opacity = (opacity / 100);
		object.MozOpacity = (opacity / 100);
		object.KhtmlOpacity = (opacity / 100); 	
	}else{
		object.opacity = 0;
		object.MozOpacity = 0;
		object.KhtmlOpacity = 0;
	}
    object.filter = "alpha(opacity=" + opacity + ")";
}

function addalphamenu(child){
	
	if (document.getElementById(child).style.stat == "showing"){	
	//window.timerIDbodyfade=clearTimeout(window.timerIDbodyfade);
	var curalpha = parseFloat( document.getElementById(child).style.opacity);	
	curalpha =  (parseFloat(parseFloat(1 - curalpha)/8) + parseFloat(curalpha))*100	
	changeOpac(curalpha, child);
	
	if (parseInt(curalpha) < 99){		
		window.timerIDmenu=setTimeout("addalphamenu('"+child+"')",30);
	}else{		
		curalpha = 100;
		changeOpac(curalpha, child);		
		//window.timerIDbodyfade=clearTimeout(window.timerIDbodyfade);		
	}
	}
	
}


function growmenuwindow(child){
	if (document.getElementById(child).style.stat == "showing"){
		
		
		//window.timerIDbodyoffset=clearTimeout(window.timerIDbodyoffset);
		var c = document.getElementById(child );
		//c.style.height = ((c.style.height - c.style.targetheight)/8)+"px";
		
		var menuoffset =  parseInt(c.style.targettop) -  parseInt(c.style.top) 
		var menuoffset =  parseInt(c.style.top) + (menuoffset/8);
		c.style.top =  menuoffset + "px"
		//alert (menuoffset)
		if (parseInt(menuoffset) > -1 && parseInt(menuoffset) < 1 ){		
			window.imagebodyoffset = 0;
			document.getElementById(child).style.top = c.style.targettop	+ "px"
		}else{		
			window.timerIDmenu=setTimeout("growmenuwindow('"+child+"')",30);
				
		}
	}
}

function delalphamenu(child){
	if (document.getElementById(child).style.stat == "hiding"){
		//window.timerIDbodyfade=clearTimeout(window.timerIDbodyfade);
		var curalpha = parseFloat( document.getElementById(child).style.opacity);
		curalpha =  (parseFloat(curalpha)-parseFloat(curalpha/8)  )*100
		changeOpac(curalpha, child);
		//alert ("hallo")
		if (parseInt(curalpha) > 1){		
			window.timerIDmenu=setTimeout("delalphamenu('"+child+"')",30);
		}else{		
			curalpha = 0;
			changeOpac(curalpha, child);	
			document.getElementById(child).style.visibility = 'hidden';	
			document.getElementById(child).style.stat == "hidden"
		//window.timerIDbodyfade=clearTimeout(window.timerIDbodyfade);		
		}
	}
}


function delgrowmenuwindow(child){
if (document.getElementById(child).style.stat == "hiding"){
		//window.timerIDbodyoffset=clearTimeout(window.timerIDbodyoffset);
		var c = document.getElementById(child );
		var menuoffset =  parseInt(c.style.targettop) -  parseInt(c.style.top) 
		if (menuoffset < 2){
			menuoffset = -1
		}
		var menuoffset =  parseInt(c.style.top) - (menuoffset*2);

		c.style.top =  menuoffset + "px"
		//alert (menuoffset)
		if (document.getElementById(child).style.visibility == 'hidden' ){		
			window.imagebodyoffset = 0;
			document.getElementById(child).style.top = c.style.targettop	+ "px"
		}else{		
			window.timerIDmenu=setTimeout("delgrowmenuwindow('"+child+"')",30);
		}
	}
}

function at_show_aux(parent, child)
{
  

  var p = document.getElementById(parent);
  var c = document.getElementById(child ); 
  
	clearTimeout(c["at_timeout"]);
	clearTimeout(c["at_timeoutB"]);
	clearTimeout(c["at_timeout2"]);

	var top = c.style.top 
	var left =c.style.left

	if ( c.style.visibility != "visible"){
		var top  = ((c["at_position"] == "y") ? p.offsetHeight +1 : 0);
		var left = ((c["at_position"] == "x") ? p.offsetWidth +1 : 0);
		theWidth = parseInt(c.clientWidth);
		parenttheWidth = parseInt(p.innerWidth || p.clientWidth || p.clientWidth);
		if (c["at_position"] == "y"){
			top  += 6;
      //left += +4;
		}
		
		c.style.opacity = 0;
		 for (; p; p = p.offsetParent)
			 {
				top  += p.offsetTop;
				left += p.offsetLeft;
			  }
		left = left //- (theWidth/2) 
		targettop = top
		top +=25
		c.style.height = "0px";
	}
  c.style.top        = top +'px';
  c.style.targettop  = targettop ;
  c.style.left       = left+'px';
  c.style.visibility = "visible";
  c.style.zIndex 	 = 99998;
  
	var d= document, root= d.documentElement, body= d.body;
  	var realWidth= window.innerWidth || root.clientWidth || body.clientWidth, 
      	realHeight= window.innerHeight || root.clientHeight || body.clientHeight ;
	realWidth = parseInt(scrollX()+realWidth);
	realHeight = parseInt(realHeight);
 	
	theLeft = parseInt(c.offsetLeft);
		
	if ((theLeft + theWidth) > realWidth){		
		c.style.left = (realWidth - theWidth)+'px';		
  	}

	theLeft = parseInt(c.offsetLeft);

	if (theLeft < scrollX()){		
		c.style.left = scrollX()+"px";		
  	}
	
	if ((theLeft + theWidth) > realWidth){		
		c.style.left = (realWidth - theWidth)+'px';		
  	}
	if (theLeft < 0){		
		c.style.left = "0px";		
  	}
  //alert (top + " " + left);
	c.style.stat = "showing";
	 
	addalphamenu(child)
	
	growmenuwindow(child)
	
	if (c["at_over"]!= true){
		c["at_timeoutB"] = setTimeout("at_realhide('"+c.id+"','')", 4420);
	}
	
}

// ***** at_show *****
function scrollX() {
    if( window.pageXOffset ) { return window.pageXOffset; }
    return Math.max(document.documentElement.scrollLeft, document.body.scrollLeft);
}

function at_show()
{
	//alert (this["at_parent"]);

	 var p = document.getElementById(this["at_parent"]);
	 var c = document.getElementById(this["at_child" ]);
	 var changed = false;
	  
	 if (c["at_over"]== false){
		c["at_over"] = true;
		changed = true;
	 }
	  
	 if (c["at_lock_id"]!= "" && changed == true){
	var locker = document.getElementById(c["at_lock_id"]);
	locker["at_lock"] += 1;
	 }
		

	 c["at_timein"] = setTimeout("at_show_aux('"+p.id+"','"+c.id+"')", 222);	
	  //at_show_aux(p.id, c.id);
	clearTimeout(c["at_timeout"]);
	clearTimeout(c["at_timeoutB"]);
	clearTimeout(c["at_timeout2"]);

}

// ***** at_hide *****

function at_hide(){
  var p = document.getElementById(this["at_parent"]);
  var c = document.getElementById(this["at_child" ]);
  clearTimeout(c["at_timein"]);
  var changed = false;
  if (c["at_over"]== true){
  c["at_over"]= false;
  changed = true;
  }
  if (c["at_lock"] == 0){
  if (c["at_lock_id"]!= ""){
	  
	  var locker = document.getElementById(c["at_lock_id"]);
	  var lockerc = document.getElementById(locker["at_child"]);
	  	if (changed == true){
		c["at_timeout2"] = setTimeout("document.getElementById('"+locker.id+"')['at_lock'] -= 1;", 1420);
		}
		c["at_timeout"] = setTimeout("at_realhide('"+c.id+"','"+locker.id+"')", 1420);
	}else{
		c["at_timeout"] = setTimeout("at_realhide('"+c.id+"','')", 1420);
	}
  }
}
function at_realhide(child, locker){
    var c = document.getElementById(child);
	c.style.stat = "hiding";
	//c.style.visibility = 'hidden';

	/*if (locker != ""){
		var locker = document.getElementById(locker);
		
		if (locker["at_over"] == false && locker['at_lock'] == 0){
			
			if (locker["at_lock_id"]!= ""){
				var locker_locker = document.getElementById(locker["at_lock_id"]);	
				locker["at_timeout2"] = setTimeout("document.getElementById('"+locker_locker.id+"')['at_lock'] -= 1;", 222);
				locker["at_timeout"]=  setTimeout("at_realhide('"+locker.id+"','"+locker_locker.id+"')", 222);
			} else {
				locker["at_timeout"]=  setTimeout("at_realhide('"+locker.id+"','')", 222);
			}
		}else{
				
		}
	}*/
	delalphamenu(child)
	delgrowmenuwindow(child)
}
// ***** at_click *****

function at_click()
{
  var p = document.getElementById(this["at_parent"]);
  var c = document.getElementById(this["at_child" ]);

 // if (c.style.visibility != "visible") at_show_aux(p.id, c.id); else c.style.visibility = "hidden";
 at_show_aux(p.id, c.id);
  return false;
}

// ***** at_attach *****

// PARAMETERS:
// parent   - id of the parent html element
// child    - id of the child  html element that should be droped down
// showtype - "click" = drop down child html element on mouse click
//            "hover" = drop down child html element on mouse over
// position - "x" = display the child html element to the right
//            "y" = display the child html element below
// cursor   - omit to use default cursor or specify CSS cursor name

function at_attach(parent, child, showtype, position, cursor, lock)
{
  var p = document.getElementById(parent);
  var c = document.getElementById(child);

  p["at_parent"]     = p.id;
  c["at_parent"]     = p.id;
  p["at_child"]      = c.id;
  c["at_child"]      = c.id;
  p["at_position"]   = position;
  c["at_position"]   = position;
  c["at_lock"]		= 0;
  c["at_over"]		= false;
  c["at_lock_id"]   = lock;
  c["at_timeout"] == "";
c.style.targetheight = c.style.height;
  
  c.style.visibility = "hidden";

  if (cursor != undefined) p.style.cursor = cursor;

 /* switch (showtype)
  {
    case "click":*/
	
      p.onclick     = at_click;
      p.onmouseout  = at_hide;
      c.onmouseover = at_show;
      c.onmouseout  = at_hide;
	  
/*      break;
    case "hover":
      p.onmouseover = at_show;
      p.onmouseout  = at_hide;
      c.onmouseover = at_show;
      c.onmouseout  = at_hide;
      break;
  }*/
}
