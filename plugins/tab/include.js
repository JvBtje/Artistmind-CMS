<script language="javascript">
function changetab(tabarray, theselectedtab){
	
	for (var i = 0; i < window.thetabs[tabarray].length; i++) {
		//alert (window.thetabs[tabarray].length);
		document.getElementById("tab"+window.thetabs[tabarray][i]).parentElement.style.display = "none";
		document.getElementById("tabname"+window.thetabs[tabarray][i]).parentElement.style.zIndex = "0"
	}
	document.getElementById("tab"+theselectedtab).parentElement.style.display = "block";
	document.getElementById("tabname"+theselectedtab).parentElement.style.zIndex = "3"
}
</script>