try {
	xmlhttp = new XMLHttpRequest();
} catch(ee) {
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch(e) {
		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch(E) {
			xmlhttp = false;
		}
	}
}
div_base = "";
function abre(arquivo, metodo, div) {
	div_base = div;
	xmlhttp.open(metodo, arquivo);
	xmlhttp.onreadystatechange = estatico
	xmlhttp.send(null)
}

function estatico() {
	nova_div = div_base;
	document.getElementById(nova_div).innerHTML = "<div style='top:0%;left:0%;position:absolute;'>carregando...</div>"
	if (xmlhttp.readyState == 4) {
		document.getElementById(nova_div).innerHTML = xmlhttp.responseText
	}
}
