function trocarMenu(pagina) {
	var menu = document.getElementById("menu_pai");	
		
	if (pagina != undefined && pagina != '') {
		document.getElementById("classe_menu").value = menu.className;	
		document.forms[0].action = pagina;
		document.forms[0].submit();
    }
}

