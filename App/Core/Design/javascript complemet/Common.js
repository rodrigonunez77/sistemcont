// JavaScript Document
RemoveClass = function(Obj, className) {
	if (!(Obj && Obj.className)) {
		return;
	}
	var Cls = Obj.className.split(" ");
	var Ar = Array();
	for (var i = Cls.length; i > 0;) {
		if (Cls[--i] != className) {
			Ar[Ar.length] = Cls[i]; 
		}
	}
	Obj.className = Ar.join(" ");
};
AddClass = function(Obj, className) {
	RemoveClass(Obj, className);
	Obj.className += " " + className;
};
TRMouseOver = function(Obj,Class) {
	AddClass(Obj,Class);
};
TRMouseOut = function(Obj,Class) {
	RemoveClass(Obj,Class);
};
TRMouseClick = function(URL) {
	Redirect(URL);
};
Redirect = function (URL) {
	document.location = URL;
};

function NewWindow(mypage,myname,w,h,scroll){
	LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
	TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
	settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable';
	window.open(mypage,myname,settings);
}

function AbrirVentana(URL,w,h) {
	//alert(document.getElementById('COTIZMON').value);
	day = new Date();
	id = day.getTime();
	LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
	TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,status=no,scrollbars=yes,location=0,statusbar=0,menubar=0,resizable=yes,width="+w+",height="+h+",top="+TopPosition+",left="+LeftPosition+"');");
}

//despliega contenido
function DisplayContents(id,Texto){	
	document.getElementById(id).innerHTML = Texto;	
};

// Param: event e
function ValidaSoloNumero(e){
		tecla = (document.all) ? e.keyCode : e.which;
		//alert(e.keyCode);
		//Tecla de retroceso para borrar, siempre la permite
		if (tecla==8 || e.keyCode==39 || e.keyCode==37 ){
			return true;
		}
			
		// Patron de entrada, en este caso solo acepta numeros
		patron =/[0-9]/;
		tecla_final = String.fromCharCode(tecla);
		return patron.test(tecla_final);
}