window.onload = function() {
	$('[id*="M260887"], .content-kuss').remove();
	$('a[href*="sexy"], a[href*="sex"], a[href*="porn"], a[href*="vagina"], a[href*="penis"]').parent().remove();
	$("body").unbind("click");
	$("body").show();
	//document.getElementsByTagName("body").style.display = "block";
}