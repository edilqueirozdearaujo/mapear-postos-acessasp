function CheckElement(ElemID,condicao) {
   var Elemento = document.getElementById(ElemID);
	if (condicao) {
		Elemento.checked = true;
	}else {
		Elemento.checked = false;
	}
}

 function PrintDiv(divID) {
     var divElements = document.getElementById(divID).innerHTML;
     var oldPage = document.body.innerHTML;
     document.body.innerHTML = 
       "<html><head><title></title></head><body>" + 
       divElements + "</body>";
     window.print();
     document.body.innerHTML = oldPage;
 }

function EmUpperCase(obj){
	obj.value = obj.value.toUpperCase();
}	


//source = http://stackoverflow.com/questions/3437786/get-the-size-of-the-screen-current-web-page-and-browser-window
function GetScreenHeight() {
	//Por alguma razão, mantendo estas variváveis e a consulta o valor é retornado corretamente | Verificar isso
	var avw = window.screen.availWidth,
		 avh = window.screen.availHeight;	
   return window.innerHeight;
}