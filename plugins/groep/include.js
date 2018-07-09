<script language="javascript">
function updategroeppic (){
	var el = document.getElementsByClassName("pijldown")
	for (var i = 0, ilen = el.length; i < ilen; i++) {
		el[i].src = "./system/imgtumb.php?url="+themeurl+"systemicon/down.png&maxsize="+(20* window.devicePixelRatio)+"&square=0";
	}
	var el = document.getElementsByClassName("pijlrechts")
	for (var i = 0, ilen = el.length; i < ilen; i++) {
		el[i].src = "./system/imgtumb.php?url="+themeurl+"systemicon/pijl rechts.png&maxsize="+(20* window.devicePixelRatio)+"&square=0";
	}
}
</script>