/**
 * Created by TAPIA on 13/07/2016.
 */
 function verifica(id_F, p){

	var dato = JSON.stringify( $('#'+id_F).serializeObject() );

	$.ajax({
		url: "inc/"+p,
		type: 'post',
		dataType: 'json',
		async:true,
		data:{res:dato},
		beforeSend: function(data){
			$('#error').css('display','block');
			$('#error').html('<div id="loader"><p>Validando...</p></div>');
		},
		success: function(data){
			if(data !== 0){
				$(location).attr('href','admin.php');
			}else{
				$('#alert').css('display','block').fadeIn(6000,function () {
					$('#alert').fadeOut(4000);
					$('.btn').delay(4000).val('Ingresar');
					$('.btn').delay(4000).removeAttr('disabled');

					$('#login').click();
					$('#password').val('');
					$('#username').val('');

					$('input, select, textarea').filter(':first').focus();
				});
			}
		},
		error: function(data){
			//alert('Error al guardar el formulario');
		}
	});
}

function outSession(user){
	$(location).attr('href','inc/outSession.php?user='+user);
}

function despliega(p, div, id){
	alert(idCategoria);
	$.ajax({
		url: p,
		type: 'post',
		cache: false,
		data: 'id='+id,
		beforeSend: function(data){
			$("#"+div).html('<div id="load" align="center" class="alert alert-success" role="alert"><p>Cargando contenido. Por favor, espere ...</p></div>');
		},
		success: function(data){
			$("#"+div).fadeOut(1000,function(){
				$("#"+div).html(data).fadeIn(2000);
			});
		}
	});
}


/**
 * [displaySection despliega lista despues de guardar o actualizar]
 * @param  {[type]} p   [description]
 * @param  {[type]} sec [description]
 * @param  {[type]} id  [description]
 * @return {[type]}     [description]
 */
function displaySection(p, sec, id){
	$.ajax({
		url: p,
		type: 'post',
		cache: false,
		data: 'id='+id,
		beforeSend: function(data){
			$("#"+sec).html('<div id="load" align="center" class="alert alert-success" role="alert"><p>Cargando contenido. Por favor, espere ...</p></div>');
		},
		success: function(data){
			$("#"+sec).fadeOut(1000,function(){
				$("#"+sec).html(data).fadeIn(2000);
			});
		}
	});
}

/**
 * GENERA CONTRASEÑA
 */
 function generaPass(id){
	$.ajax({
		url: '../../inc/generaPass.php',
		type: 'post',
		cache: false,
		success: function(data){
			//alert();
			$("#"+id).val(data);
		}
	});
}

function serializarSubCategoria(){
	var resultado="";

	for (var i = 0; i < 50; i++) {
		if($("#NOMBRESUBCATEGORIA"+i).length>0){
			resultado=resultado+$("#NOMBRESUBCATEGORIA"+i).val()+"@";
		}
	}
	return resultado;
}
/**
** se guarda el modulo categoria
**/
function saveFormCategoria(idForm, p){
	var serializadoSubCat=serializarSubCategoria();
	//alert(serializadoSubCat);

	var dato = JSON.stringify( $('#'+idForm).serializeObject() );
	$.post(p,{res:dato,subCat:serializadoSubCat},function(data){
		//alert(data);
		if(data=="TRUE"){
			$('#datos_ajax').html('<div class="alert alert-success" role="alert"><strong>Guardado Correctamente!!!</strong></div><br>').fadeIn(4000,function () {
				$('#datos_ajax').fadeOut(2000,function () {
					$('#dataRegister').modal('hide').delay(2000);
					displaySection('index.php','unseen');
					location.reload();
				});
			});
		}	
		else{
           alert("Contactar con admin "+data);
		}	
				
   });	

}
/***
**Actualiza el modulo categoria
**
**/
function updateFormCategoria(idForm, p){
	var serializadoSubCat=serializarSubCategoria();
	//alert(serializadoSubCat);

	var dato = JSON.stringify( $('#'+idForm).serializeObject() );
	$.post(p,{res:dato,subCat:serializadoSubCat},function(data){
		//alert(data);
		if(data=="TRUE"){
			$('#datos_ajax_update').html('<div class="alert alert-success" role="alert"><strong>Actualizado Correctamente!!!</strong></div><br>').fadeIn(4000,function () {
				$('#datos_ajax_update').fadeOut(2000,function () {
					$('#dataUpdate').modal('hide').delay(2000);
					displaySection('index.php','unseen');
					location.reload();
				});
			});
		}	
		else{
           alert("Contactar con admin "+data);
		}	
				
   });	

}


/**
* SE GUARDA EL FORMULARIO CON IMAGEN
*/
function saveFormImagen(idForm,p){
    var formElement = document.getElementById(idForm);
    var data = new FormData(formElement); //Creamos los datos a enviar con el formulario
    $.ajax({
        url: p, //URL destino
        data: data,
        processData: false, //Evitamos que JQuery procese los datos, daría error
        contentType: false, //No especificamos ningún tipo de dato
        type: 'POST',
        success: function (data) {
           //alert(data+'');
           if(data=="TRUE"){
                $('#datos_ajax').html('<div class="alert alert-success" role="alert"><strong>Guardado Correctamente!!!</strong></div><br>').fadeIn(4000,function () {
                        $('#datos_ajax').fadeOut(2000,function () {
                                $('#dataRegister').modal('hide').delay(2000);
                                displaySection('index.php','unseen');
                                location.reload();
                        });
                });
            }	
            else{
             alert("Contactar con admin "+data);
            }
        }
    });
}


/**
* SE ACTUALIZA EL FORMULARIO CON IMAGEN
*/
function updateFormImagen(idForm,p){
    var formElement = document.getElementById(idForm);
    var data = new FormData(formElement); //Creamos los datos a enviar con el formulario
    $.ajax({
        url: p, //URL destino
        data: data,
        processData: false, //Evitamos que JQuery procese los datos, daría error
        contentType: false, //No especificamos ningún tipo de dato
        type: 'POST',
        success: function (data) {
           //alert(data);
           if(data=="TRUE"){
                $('#datos_ajax_update').html('<div class="alert alert-success" role="alert"><strong>Actualizado Correctamente!!!</strong></div><br>').fadeIn(4000,function () {
                        $('#datos_ajax_update').fadeOut(2000,function () {
                                $('#dataUpdate').modal('hide').delay(2000);
                                displaySection('index.php','unseen');
                                location.reload();
                        });
                });
            }	
            else{
             alert("Contactar con admin "+data);
            }
        }
    });
}

/**
 *  GUARDA FORMULARIO 
 */
	

function saveForm(idForm, p){

	var dato = JSON.stringify( $('#'+idForm).serializeObject() );
	$.post(p,{res:dato},function(data){
		//alert(data);
		if(data=="TRUE"){
			$('#datos_ajax').html('<div class="alert alert-success" role="alert"><strong>Guardado Correctamente!!!</strong></div><br>').fadeIn(4000,function () {
				$('#datos_ajax').fadeOut(2000,function () {
					$('#dataRegister').modal('hide').delay(2000);
					displaySection('index.php','unseen');
					location.reload();
				});
			});
		}	
		else{
           alert("Contactar con admin "+data);
		}	
				
   });	

}
function saveFormEncomienda(idForm, p,pAux){

	var dato = JSON.stringify( $('#'+idForm).serializeObject() );
	$.post(p,{res:dato},function(data){
		//alert(data);
		if(data=="TRUE"){
			location=pAux;
		}	
		else{
           alert("Contactar con admin "+data);
		}	
				
   });	

}

function updateFormVentas(idForm, p){

	var dato = JSON.stringify( $('#'+idForm).serializeObject() );

	$.post(p,{res:dato},function(data){
		//alert(data);
		if(data=="TRUE"){
			$('#datos_ajax_update').html('<div class="alert alert-success" role="alert"><strong>Anulado Correctamente!!!</strong></div><br>').fadeIn(4000,function () {
				$('#datos_ajax_update').fadeOut(2000,function () {
					$('#dataUpdate').modal('hide').delay(4000);
					//displaySection('listTabla.php','unseen');
					location.reload();
				});
			});
		}	
		else{
           alert("Contactar con admin "+data);
		}	
				
    });		
}


function updateForm(idForm, p){

	var dato = JSON.stringify( $('#'+idForm).serializeObject() );

	$.post(p,{res:dato},function(data){
		//alert(data);
		if(data=="TRUE"){
			$('#datos_ajax_update').html('<div class="alert alert-success" role="alert"><strong>Modificado Correctamente!!!</strong></div><br>').fadeIn(4000,function () {
				$('#datos_ajax_update').fadeOut(2000,function () {
					$('#dataUpdate').modal('hide').delay(4000);
					displaySection('listTabla.php','unseen');
					location.reload();
				});
			});
		}	
		else{
           alert("Contactar con admin, "+data);
		}	
				
    });		
}


function fDelete(idForm, p){
	var dato = JSON.stringify( $('#'+idForm).serializeObject() );
	$.post(p,{res:dato},function(data){
		//alert(data);
		if(data=="TRUE"){
			$('#datos_ajax_delete').html('<div class="alert alert-success" role="alert"><strong>Eliminado Correctamente!!!</strong></div><br>').fadeIn(4000,function () {
				$('#datos_ajax_delete').fadeOut(2000,function () {
					$('#dataDelete').modal('hide').delay(4000);
					  //displaySection('index.php','unseen');
					  location.reload();
				});
			});
		}
		else{
           alert("Contactar con admin "+data);
		}	
				
    });	

	/*$.ajax({
		url: p,
		type: 'post',
		dataType: 'json',
		async:false,
		data:{res:dato},
		success: function(data){
			if(data.tabla === 'repuesto'){
				$('#datos_ajax_delete').html('<div class="alert alert-success" role="alert"><strong>Eliminado Correctamente!!!</strong></div><br>').fadeIn(4000,function () {
					$('#datos_ajax_delete').fadeOut(2000,function () {
						$('#dataDelete').modal('hide').delay(4000);
						displaySection('listTabla.php','unseen');
					});
				});
			}
			if(data.tabla === 'empleado'){
				$('#datos_ajax_delete').html('<div class="alert alert-success" role="alert"><strong>Eliminado Correctamente!!!</strong></div><br>').fadeIn(4000,function () {
					$('#datos_ajax_delete').fadeOut(2000,function () {
						$('#dataDelete').modal('hide').delay(4000);
						displaySection('listTabla.php','unseen');
					});
				});
			}
			if(data.tabla === 'sucursal'){
				$('#datos_ajax_delete').html('<div class="alert alert-success" role="alert"><strong>Eliminado Correctamente!!!</strong></div><br>').fadeIn(4000,function () {
					$('#datos_ajax_delete').fadeOut(2000,function () {
						$('#dataDelete').modal('hide').delay(4000);
						displaySection('listTabla.php','unseen');
					});
				});
			}
			if(data.tabla === 'categoria'){
				$('#datos_ajax_delete').html('<div class="alert alert-success" role="alert"><strong>Eliminado Correctamente!!!</strong></div><br>').fadeIn(4000,function () {
					$('#datos_ajax_delete').fadeOut(2000,function () {
						$('#dataDelete').modal('hide').delay(4000);
						displaySection('listTabla.php','unseen');
					});
				});
			}
			if(data.tabla === 'cliente'){
				$('#datos_ajax_delete').html('<div class="alert alert-success" role="alert"><strong>Eliminado Correctamente!!!</strong></div><br>').fadeIn(4000,function () {
					$('#datos_ajax_delete').fadeOut(2000,function () {
						$('#dataDeleteCli').modal('hide').delay(4000);
						displaySection('listTabla.php','unseen');
					});
				});
			}
			if(data.tabla === 'produccion'){
				$('#datos_ajax_delete').html('<div class="alert alert-success" role="alert"><strong>Eliminado Correctamente!!!</strong></div><br>').fadeIn(4000,function () {
					$('#datos_ajax_delete').fadeOut(2000,function () {
						$('#dataDelete').modal('hide').delay(4000);
						despliega('modulo/produccion/listTabla.php','listTabla');
					});
				});
			}
			if(data.tabla === 'proveedor'){
				$('#datos_ajax_delete').html('<div class="alert alert-success" role="alert"><strong>Eliminado Correctamente!!!</strong></div><br>').fadeIn(4000,function () {
					$('#datos_ajax_delete').fadeOut(2000,function () {
						$('#dataDeletePro').modal('hide').delay(4000);
						displaySection('listTabla.php','unseen');
					});
				});
			}
		},
		error: function(data){
			alert('Error al eliminar');
		}
	});
	*/
}

function listaInv(idForm){
	var dato = JSON.stringify( $('#'+idForm).serializeObject() );
	$.ajax({
		url: "modulo/empleado/idListaInv.php",
		type: 'post',
		dataType: 'json',
		async:false,
		data:{res:dato},
		beforeSend: function(data){
			//$("#"+div).html('<div id="load" align="center"><p>Cargando contenido. Por favor, espere ...</p></div>');
		},
		success: function(data){
			despliega('modulo/empleado/listaInv.php', 'lista', data.id);
		},
		error: function(data){
			alert('error al mostrar');
		}
	});
}

function obtenerCoor(id){
	$.ajax({
		url: "modulo/empleado/obtenerCoor.php",
		type: 'post',
		dataType: 'json',
		async:false,
		data:{res:id},
		success: function(data){
			return data;
		},
		error: function(data){
			alert('Error al eliminar');
		}
	});
}

/**
 *  WEB CAM
 * */

 /* RECARGA IMAGEN */

 function recargaImg(img, mod){
	$('#foto').html('<img class="thumb" src="../../thumb/phpThumb.php?src=../modulo/'+mod+'/uploads/files/'+img+'&amp;w=120&amp;h=75&amp;far=1&amp;bg=FFFFFF&amp;hash=361c2f150d825e79283a1dcc44502a76" alt="">');
}

function recargaImgU(img, mod){
	$('#fotoU').html('<img class="thumb" src="../../thumb/phpThumb.php?src=../modulo/'+mod+'/uploads/files/'+img+'&amp;w=120&amp;h=75&amp;far=1&amp;bg=FFFFFF&amp;hash=361c2f150d825e79283a1dcc44502a76" alt="">');
}

function closeWebcam(){
	$('#camera').css('display','none');
	$('#save').removeAttr('disabled', 'disabled');
}

function openWebcam(){
	$('#camera').css('display','block');
	$('#save').attr('disabled', 'disabled');
}

function loadImg(mod, tabla){
	$.ajax({
		url: '../../inc/img.php',
		type: 'post',
		cache: false,
		data: 'tabla='+tabla,
		success: function(data){
			recargaImg(data,mod);
			recargaImgU(data,mod);
		}
	});
}

/**
 * STATUS EMPLEADO
 */
 function statusEmp(id, status){
	$.ajax({
		url: '../../inc/statusEmp.php',
		type: 'post',
		async:true,
		data: 'id='+id+'&status='+status,
		success: function(data){

		}
	});
}
/**
 *  STATUS CLIENTE
 */
function statusCli(id, status){
	$.ajax({
		url: '../../inc/statusCli.php',
		type: 'post',
		async:true,
		data: 'id='+id+'&status='+status,
		success: function(data){

		}
	});
}

/**
 *  STATUS SUCURSAL
 */
function statusSuc(id, status){
	$.ajax({
		url: '../../inc/statusSuc.php',
		type: 'post',
		async:true,
		data: 'id='+id+'&status='+status,
		success: function(data){

		}
	});
}

/**
 *  STATUS REPUESTO
 */
function statusRep(id, status){
	$.ajax({
		url: '../../inc/statusRep.php',
		type: 'post',
		async:true,
		data: 'id='+id+'&status='+status,
		success: function(data){

		}
	});
}

/**
 *  STATUS CATEGORIA
 */
function statusCat(id, status){
	$.ajax({
		url: '../../inc/statusCat.php',
		type: 'post',
		async:true,
		data: 'id='+id+'&status='+status,
		success: function(data){

		}
	});
}

/**
 *  STATUS PROVEEDOR
 */
function statusPro(id, status){
	$.ajax({
		url: '../../inc/statusPro.php',
		type: 'post',
		async:true,
		data: 'id='+id+'&status='+status,
		success: function(data){

		}
	});
}
/**
 * MODULO PEDIDO
 * AGREGA PEDIDO
 */

 function adicFila(idForm, p){

	var dato = JSON.stringify( $('#'+idForm).serializeObject() );
	//alert(dato);
	$.ajax({
		url: "inc/"+p,
		type: 'post',
		dataType: 'json',
		async:true,
		data:{res:dato},
		success: function(data){
			sw = 0;

			$('#tabla tbody').find('tr').each(function(index, element){
				cod = $(this).attr('id');

				if( cod === data.producto ){
					cantidad = $('tr#'+data.producto).find('td').eq(1).find('input').val();
					//alert('******'+cantidad);
					cantidad = parseInt(cantidad) + parseInt(data.cant);
					//alert('-------'+cantidad);
					if( parseFloat(cantidad) <= parseFloat(data.cantI) ){

					  precio = $('tr#'+data.producto).find('td').eq(2).find('input').val();
					  precio = parseFloat(precio) * parseFloat(cantidad);
					  $('tr#'+data.producto).find('td').eq(1).find('input').val(cantidad);
					  //$('tr#'+data.producto).find('td').eq(3).find('input').val(cant);
					  $('tr#'+data.producto).find('td').eq(5).find('input').val(precio.toFixed(2));
					  //$('tr#'+data.producto).find('td').eq(4).find('input').val(precio);

				  }else{
					alert('Producto sin Stock...!!!');
				}
				sw = 1;
			}
		});

			if( sw === 0 && data.producto !== undefined ){
				agregarFila(data);
			}
			$('#producto').val('');
			$('#cant').val('');
			subPrecio = 0;
			$('#tabla tbody').find('tr').each(function(index, element){
				subPrecio = parseFloat(subPrecio) + parseFloat($(this).find('td').eq(5).find('input').val());
			});
			$('#tabla tfoot').find('th').eq(1).find('input').val(subPrecio.toFixed(2));

			des = $('#tabla tfoot').find('tr').eq(1).find('th').eq(1).find('input').val();
			if(des === '') des = 0;

			bon = $('#tabla tfoot').find('tr').eq(2).find('th').eq(1).find('input').val();
			if(bon === '') bon = 0;

			total = parseFloat(subPrecio)-parseFloat(des)-parseFloat(bon);
			$('#tabla tfoot').find('tr').eq(3).find('th').eq(1).find('input').val(total.toFixed(2));

			/**
			 * Quitar la validacion
			 */
			 $('#ventIzq').find('div').removeClass('has-success');
			 $('#ventIzq').find('label').removeClass('has-success');
			 $('#ventIzq').find('#producto, #cant').removeClass('valid');
			/**
			 * Fin
			 */
		 },
		 error: function(data){
			alert('Error al guardar el formulario');
		}
	});
	$('#efectivo').val('');
	$('#cambio').val('');
	$('#codigo').focus();
}

/* EDITA PEDIDO */

function adicFilaEdit(idForm, p){
	"use strict";
	var dato = JSON.stringify( $('#'+idForm).serializeObject() );
	$.ajax({
		url: "inc/"+p,
		type: 'post',
		dataType: 'json',
		async:true,
		data:{res:dato},
		success: function(data){
			sw = 0;
			$('#tabla tbody').find('tr').each(function(index, element){
				cod = $(this).attr('id');
				if( cod === data.producto ){
					cant = $('tr#'+data.producto).find('td').eq(1).find('input#cantidad').val();
					cant = parseInt(cant) + parseInt(data.cant);
					if( parseFloat(cant) <= (parseFloat(data.cantI) + parseInt(data.cantInv)) ){
					  precio = $('tr#'+data.producto).find('td').eq(2).find('input').val();
					  precio = parseFloat(precio) * parseFloat(cant);
					  $('tr#'+data.producto).find('td').eq(1).find('input#cantidad').val(cant);
					  //$('tr#'+data.producto).find('td').eq(3).find('input').val(cant);
					  $('tr#'+data.producto).find('td').eq(5).find('input').val(precio.toFixed(2));
					  //$('tr#'+data.producto).find('td').eq(4).find('input').val(precio);
				  }else{
					alert('Producto sin Stock...!!!');
				}
				sw = 1;
			}
		});

			if( sw === 0 && data.producto !== undefined ){
				agregarFila(data);
			}
			$('#producto').val('');
			$('#cant').val('');
			subPrecio = 0;
			$('#tabla tbody').find('tr').each(function(index, element){
				subPrecio = parseFloat(subPrecio) + parseFloat($(this).find('td').eq(5).find('input').val());
			});
			$('#tabla tfoot').find('th').eq(1).find('input').val(subPrecio.toFixed(2));

			des = $('#tabla tfoot').find('tr').eq(1).find('th').eq(1).find('input').val();
			if(des === '') des = 0;

			bon = $('#tabla tfoot').find('tr').eq(2).find('th').eq(1).find('input').val();
			if(bon === '') bon = 0;

			total = parseFloat(subPrecio)-parseFloat(des)-parseFloat(bon);
			$('#tabla tfoot').find('tr').eq(3).find('th').eq(1).find('input').val(total.toFixed(2));

		},
		error: function(data){
			alert('Error al guardar el formulario');
		}
	});
	$('#efectivo').val('');
	$('#cambio').val('');
	$('#codigo').focus();
}

function agregarFila(data){

  cant = $('input#cant').val();
  //cant = parseInt(cant) + parseInt(data.cant);
  if( parseFloat(cant) <= parseFloat(data.cantI) ){
  // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
  //if( data.cantidad > 0 ){
	  //$('#tabla thead').removeAttr('hidden');
	  $('#tabla tfoot').removeAttr('hidden');
	  //$('#submitVenta').removeAttr('hidden');
	  //alert(data.cant);
	  precio = parseFloat(data.cant) * parseFloat(data.precio);

	  var strNueva_Fila = '<tr id="'+data.producto+'">'+
	  '<td class="det">'+data.producto+' '+data.detalle+''+
	  '<input type="hidden" id="item" name="item" value="'+data.producto+'" ></td>'+

	  '<td><input type="text" disabled="disabled" id="cantidad" name="cantidad" value="'+data.cant+'" >'+
	  '<input type="hidden" id="cantidad" name="cantidad" value="'+data.cant+'" ></td>'+

	  '<td><input type="text" disabled="disabled" id="precio" name="precio" value="'+data.precio+'" >'+
	  '<input type="hidden" id="precio" name="precio" value="'+data.precio+'" ></td>'+

	  '<td></td>'+
	  '<td></td>'+
	  '<td><input type="text" disabled="disabled" id="subTotal" name="subTotal" value="'+precio.toFixed(2)+'" ></td>'+
	  '<td align="right" class="delete"><a class="del" onclick="eliminarFila(&#39;&#39;, &#39;'+0+'&#39;, &#39;'+data.producto+'&#39;)"><i class="fa fa-ban fa-2x" aria-hidden="true"></i></a></td>'+
	  '</tr>';

	  $("#tabla tbody").append(strNueva_Fila);

	  $('#tabla tbody').find('tr').each(function(index, element){
		  if( (index % 2) === 0 ){
			  $(this).addClass('even');
		  }else{
			  $(this).addClass('odd');
		  }
	  });

	  $('#tabla tbody').find('tr').each(function(index, element){
		var p = parseFloat($(this).find('td').eq(6).find('input').val());
		$(this).find('td').eq(6).find('input').val(p.toFixed(2));
	});

  }else{

	  alert('Producto sin Stock');

  }
}
/**
 * [eliminarFila Elimina los registros de los pedidos]
 * @param  {[type]} idTr [description]
 * @param  {[type]} sw   [description]
 * @return {[type]}      [description]
 */
function eliminarFila(idTr, cant, idInv){

	if( $('#tabla tbody').find('tr').length == 1 ){

		if(confirm('Si elimina el ultimo registro. "SE ELIMINARA TODO EL PEDIDO...!!!"')){
			deleteRowBD('delPedido.php',idTr, 'pedido', 'pedido');
			despliega('modulo/pedido/pedido.php','contenido');
		}

	}else{

		if(confirm('¿Esta seguro que desea ELIMINAR EL REGISTRO...!!!?')){
			$.ajax({
				url: 'modulo/pedido/generaXML.php',
				async: true,
				type: 'post',
				cache: false,
				data: 'id='+idInv+'&cant='+cant,
				success: function(data){
					$('#'+idInv).remove();

					subPrecio = 0;
					$('#tabla tbody').find('tr').each(function(index, element){
						subPrecio = parseFloat(subPrecio) + parseFloat($(this).find('td').eq(5).find('input').val());
					});

					$('#tabla tfoot').find('th').eq(1).find('input').val(subPrecio.toFixed(2));

					des = $('#tabla tfoot').find('tr').eq(1).find('th').eq(1).find('input').val();
					if(des === '') des = 0;

					bon = $('#tabla tfoot').find('tr').eq(2).find('th').eq(1).find('input').val();
					if(bon === '') bon = 0;

					total = parseFloat(subPrecio)-parseFloat(des)-parseFloat(bon);
					$('#tabla tfoot').find('tr').eq(3).find('th').eq(1).find('input').val(total.toFixed(2));

					if( total < 0  )
						$('#tabla tfoot').find('tr').eq(1).find('th').eq(1).find('input').css('color','#F7070B');
					else
						$('#tabla tfoot').find('tr').eq(1).find('th').eq(1).find('input').css('color','#000000');

					$('#tabla tbody').find('tr').each(function(index, element){
						if( index % 2 === 0 ){
							$(this).removeClass('odd');
							$(this).addClass('even');
						}else{
							$(this).removeClass('even');
							$(this).addClass('odd');
						}
					});
					$('#efectivo').val('');
					$('#cambio').val('');
					$('#codigo').focus();

				}
			});
		}

	}

}

/* RECARGA TOTALES DEL EDIT */

function recargaFila(){
	subPrecio = 0;
	$('#tabla tbody').find('tr').each(function(index, element){
		subPrecio = parseFloat(subPrecio) + parseFloat($(this).find('td').eq(5).find('input').val());
	});
	$('#tabla tfoot').find('th').eq(1).find('input').val(subPrecio.toFixed(2));

	des = $('#tabla tfoot').find('tr').eq(1).find('th').eq(1).find('input').val();
	if(des === '') des = 0;

	bon = $('#tabla tfoot').find('tr').eq(2).find('th').eq(1).find('input').val();
	if(bon === '') bon = 0;

	total = parseFloat(subPrecio)-parseFloat(des)-parseFloat(bon);
	$('#tabla tfoot').find('tr').eq(3).find('th').eq(1).find('input').val(total.toFixed(2));

}

/* GUARDA PEDIDO */

function savePedido(idForm, p){

	if( !confirm('CONFIRMAR PEDIDO!!!')){
		return;
	}
	var dato = JSON.stringify( $('#'+idForm).serializeObject() );
	$.ajax({
		url: "modulo/pedido/"+p,
		type: 'post',
		dataType: 'json',
		async:true,
		data:{res:dato},
		success: function(data){
			despliega('modulo/pedido/pedido.php','contenido');
			window.open('modulo/pedido/pdfPedido.php?res='+dato, '_blank');
		},
		error: function(data){
			alert('Error al guardar el formulario');
		}
	});
}

/**
 * CANCELAR PEDIDO
 */

function cancelarPedido(){
	if(confirm("Seguro que desea eliminar pedido..!!!"))
	despliega('modulo/pedido/pedido.php','contenido');
}

function cancelarPedidoEdit(){
	if(confirm("Si cancela la modificación no se guardara ningun cambio..!!!"))
	despliega('modulo/pedido/pedido.php','contenido');
}

/**
 * [detalle description genera pdf]
 * @param  {[type]} id [description]
 * @return {[type]}    [description]
 */
 function detalle(id){
	window.open('modulo/pedido/pdfPedDet.php?res='+id, '_blank');
}

 function detalleAlm(id){
	window.open('modulo/pedido/pdfPedAlm.php?res='+id, '_blank');
}
/**
 * [selecCampo Recarga camppo producto]
 * @param  {[type]} name [input producto]
 * @return {[type]}      [description]
 */
 function selecCampo( name ){
	$('#producto').val(name);
}
/**
 * [deleteRowBD Elimina un registritro del modulo de pedido]
 * @param  {[type]} p     [pagina]
 * @param  {[type]} idTr  [id a eliminar]
 * @param  {[type]} tipo  [descripticion de modulo]
 * @param  {[type]} table [tabla de BD]
 * @return {[type]}       [Elimina el item]
 */
 function deleteRowBD(p, idTr, tipo, table){
  var resp=0;
  rr = $.ajax({
	url: 'modulo/'+tipo+'/'+p,
	type: 'post',
	async:false,
	data: 'id='+idTr+'&tipo='+tipo+'&table='+table,
	success: function(data){
		if(data!=1)
			alert('No se puede eliminar el ITEM.');
		else
			resp = data;
	},
	error: function(data){
		alert('Error al eliminar el ITEM.');
	}
});
  	return resp;
}
/**
 * [pad aumenta ceros a la izquierda]
 * @param  {[type]} n      [description]
 * @param  {[type]} length [description]
 * @return {[type]}        [description]
 */
function pad (n, length) {
	var  n = n.toString();
	l=n.length;
	while(l!=0){
		l--;
		 n = "0" + n;
	 }
return n;
}

/**
 * Guardar imagenes a la bd
 */
function saveImg(mod, name, size){
	//alert('entra varias veces...!!!');
	$.ajax({
		url: '../../modulo/'+mod+'/uploadFile.php',
		type: 'post',
		async:false,
		data:{
			name: name,
			size: size
		},
		success: function(data){
			//return data;
		}
	});
}

/**
 * cargas las imagenes en la op modificar
 */

function loadImages(mod, id){
    var dato = JSON.stringify(id);
    $.ajax({
        url: '../../modulo/'+mod+'/loadImages.php',
        type: 'post',
        dataType: 'json',
        cache: false,
        data: 'id='+id,
        beforeSend: function(data){
           // $("#"+div).html('<div id="load" align="center" class="alert alert-success" role="alert"><p>Cargando contenido. Por favor, espere ...</p></div>');
        },
        success: function(data){
        	var row = new Array();
        	var sw = 0;
        	var cont = data.num;
        	i = 0;
            $.each(data,function(index,contenido){
            	j = 0;
                $.each(contenido,function(index,valor){
                	if(i >= cont){
                		sw = 1;
                	}
                	if(sw == 1 && row[j] != ""){
                		size = valor/1000;
                		size = size.toFixed(2);
	                    html = '<tr class="template-download fade in">'+
	                    '<td><span class="preview">'+
	                    '<a href="../../modulo/'+mod+'/uploads/files/'+row[j]+'" title="'+row[j]+'" download="'+row[j]+'" data-gallery=""><img src="../../modulo/'+mod+'/uploads/files/thumbnail/'+row[j]+'"></a>'+
	                    '</span></td>'+
	                    '<td><p class="name">'+
	                    '<a href="../../modulo/'+mod+'/uploads/files/'+row[j]+'" title="'+row[j]+'" download="'+row[j]+'" data-gallery="">'+row[j]+'</a></p></td>'+
	                    '<td><span class="size">'+size+' KB</span></td>'+
	                    '<td>'+
	                    '<button class="btn btn-danger btn-sm delete" data-type="DELETE" data-url="../../modulo/'+mod+'/uploads/index.php?file='+row[j]+'">'+
	                    '<i class="fa fa-trash-o"></i>'+
	                    '<span> Borrar</span>'+
	                    '</button>'+
	                    ' <input id="delete" name="delete" value="1" class="toggle" type="checkbox">'+
	                    '</td>'
	                    '</tr>';
	                   	j++;
	                    $("#loadImages tbody").append(html);
	                }else{
	                	row[i] = valor;
	                }
	                i++;
                });
            });
        }
    });
}

function loadImagesMulti(mod, id){
    var dato = JSON.stringify(id);
    $.ajax({
        url: '../../modulo/'+mod+'/loadImages.php',
        type: 'post',
        dataType: 'json',
        cache: false,
        data: 'id='+id,
        beforeSend: function(data){
           // $("#"+div).html('<div id="load" align="center" class="alert alert-success" role="alert"><p>Cargando contenido. Por favor, espere ...</p></div>');
        },
        success: function(data){
        	var row = new Array();
        	var sw = 0;
        	var cont = data.num;
        	i = 0;
            $.each(data,function(index,contenido){
            	j = 0;
                $.each(contenido,function(index,valor){
                	if(i >= cont){
                		sw = 1;
                	}
                	if(sw == 1){
                		size = valor/1000;
                		size = size.toFixed(2);
	                    html = '<tr class="template-download fade in">'+
	                    '<td><span class="preview">'+
	                    '<a href="../../modulo/'+mod+'/uploads/files/'+row[j]+'" title="'+row[j]+'" download="'+row[j]+'" data-gallery=""><img src="../../modulo/'+mod+'/uploads/files/thumbnail/'+row[j]+'"></a>'+
	                    '</span></td>'+
	                    '<td><p class="name">'+
	                    '<a href="../../modulo/'+mod+'/uploads/files/'+row[j]+'" title="'+row[j]+'" download="'+row[j]+'" data-gallery="">'+row[j]+'</a></p></td>'+
	                    '<td><span class="size">'+size+' KB</span></td>'+
	                    '<td>'+
	                    '<button class="btn btn-danger btn-sm delete" data-type="DELETE" data-url="../../modulo/'+mod+'/uploads/index.php?file='+row[j]+'">'+
	                    '<i class="fa fa-trash-o"></i>'+
	                    '<span> Borrar</span>'+
	                    '</button>'+
	                    ' <input id="delete" name="delete" value="1" class="toggle" type="checkbox">'+
	                    '</td>'
	                    '</tr>';
	                   	j++;
	                    $("#loadImages tbody").append(html);
	                }else{
	                	row[i] = valor;
	                }
	                i++;
                });
            });
        }
    });
}


/*FUNCIONES PARA EL PUNTO DE VENTA*/
/************************************************************************************/
function busca_articulo(){
    $(document).ready(function(){
    var cod = $("#codigo").val().trim();
        if(cod.trim()!=""){
        $(document).ready(function(){
        	$.ajax({
          	beforeSend: function(){
            	$("#data_articulo").html("Buscando informacion del Producto...");
         	},
          	url: 'buscaRepuesto.php',
          	dataType: 'json',
          	type: 'POST',
          	data: 'codigo='+$("#codigo").val(),
          	success: function(data){
          		//alert(data[0].priceSale);
            	if(data==0){
            		alert("No existe el producto...!");
            		$("#codigo").val("");
            		$("#idProducto").val("");
            		$("#codigo").focus();
            		$("#cantidad").attr("disabled", true);
            		$("#preciou").attr("disabled", true);
            	}else{
            		$("#idProducto").val(data[0].IDPRODUCTO);
		            $(".widget-user-desc").html(data[0].NOMBRE);
		            $(".exis").html(data[0].CANTIDADSTOCK);
		            $(".preciol").html("Bs. "+data[0].PRECIOVENTA);
		            //$("#preciou").attr("disabled", false);
		            //$('#preciou').number(true, 2);
		            $("#preciou").val("Bs. "+data[0].PRECIOVENTA);
		            //$('#cantidad').number(true, 2);
		            $("#cantidad").attr("disabled", false);
		            $("#cantidad").val(0.00);
		            $("#preciou").select();
		            $("#cantidad").focus();
			            if(data[0].IMAGEN!=""){
			            	var foto=data[0].IMAGEN.split('@');

			               $("#imagen").attr("src",'../../Images/Productos/'+foto[0]);
			            }else{
			               $("#imagen").attr("src",'../../Images/Productos/ninguno.jpg');
			            }
			            if(data[0].CANTIDADSTOCK <= 0){
			                alert("No hay suficiente existencia...!")
			                $("#codigo").val("");
			                $("#idProducto").val("");
			                $("#codigo").focus();
			                $("#cantidad").attr("disabled", true);
			                $("#preciou").attr("disabled", true);
			            }
            }
           },
           error: function(jqXHR,estado,error){
            alert("Parece ser que hay un error por favor, reportalo a Soporte inmediatamente...!");
           }
           });
          });
          }else{
          }
          })
         }
/***************************************************************************************/
function busqueda_art(){
   $("#modal_busqueda_arts").modal({
             show:true,
             backdrop: 'static',
             keyboard: false
            });
   $('#modal_busqueda_arts').on('shown.bs.modal', function () {
   $("#lista_articulos").html("");
   $("#articulo_buscar").val("");
   $("#articulo_buscar").focus();
   });
}
/*****************************************************************************/
function busca(){
	//lert($("#articulo_buscar").val());
	// alert("okoko");
	// $.post("../../Modulo/Ventas/busca_articulos_ayuda.php",{articulo:$("#articulo_buscar").val()},function(data){
       // Repuestos=$.parseJSON(data);
        //alert(data);
   		
    //  });
    $.ajax({
        beforeSend: function(){
          $("#lista_articulos").html("<img src='dist/img/default.gif'></img>");
          },
        url: 'busca_articulos_ayuda.php',
        type: 'POST',
        data: 'PRODUCTO='+$("#articulo_buscar").val(),
        success: function(x){
        	$("#lista_articulos").html(x);
        },
        error: function(jqXHR,estado,error){
        	$("#lista_articulos").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
    });
    
}
/*****************************************************************************/
function add_art(art){
  //alert(art);
  $("#modal_busqueda_arts").modal("toggle");
  $("#codigo").val(art.trim());
  busca_articulo();
}
/*************************************************************************************/
 function agrega_a_lista(){

   $(document).ready(function(){
        if( $("#cantidad").val() > 0 ){

            var articulo 	=	$("#codigo").val();
           // alert($("#idProducto").val());
            var idrepuesto  =   $("#idProducto ").val();
            var descripcion =	articulo;//$(".widget-user-desc").html();

            var precio 		=	$("#preciou").val();
            var cantidad 	=	$("#cantidad").val();
            var canTotal	=	$(".exis").text();
            
            var price 		=	precio.split("Bs. ");
            var monto 		=	cantidad*price[1];
            var sw = 0;
			//alert(precio);
            $('#tabla_articulos tbody').find('tr').each(function(index, element){
				cod = $(this).attr('id');
			   

				if( cod === articulo ){
					
					cant = $('tr#'+articulo).find('td').eq(2).text();
					cant = parseInt(cant) + parseInt(cantidad);

					if( parseFloat(cant) <= parseFloat(canTotal) ){

					  precio = $('tr#'+articulo).find('td').eq(3).text();
					  precio = parseFloat(precio) * parseFloat(cant);
					  //alert(precio);
					  $('tr#'+articulo).find('td').eq(2).text(cant);
					  //$('tr#'+articulo).find('td').eq(3).find('input').val(cant);
					  $('tr#'+articulo).find('td').eq(4).text(precio.toFixed(2));
					  //$('tr#'+articulo).find('td').eq(4).find('input').val(precio);

				  	}else{
						alert('Producto sin Stock...!!!');
					}
					sw = 1;
				}
			});

            if( sw === 0 && articulo !== undefined ){
            	if( parseFloat(cantidad) <= parseFloat(canTotal) ){
            		$("#tabla_articulos > tbody").append("<tr id='"+idrepuesto+"'><td class='center'>"+articulo+"</td><td class='center'>"+descripcion+"</td><td class='center'>"+cantidad+"</td><td class='center'>"+price[1]+"</td><td class='center'>"+monto.toFixed(2)+"</td><td class='center'><button class='btn btn-block btn-danger btn-xs delete'><i class='icon-trash bigger-120'></i> Eliminar</button></td></tr>");
            		$("#codigo").val("");
		            $("#cantidad").val("");
		            $("#preciou").val("");
		            $(".widget-user-desc").text("");
		            $(".preciol").text("0.00");
		            $(".exis").text("0.00");
		            $("#cantidad").attr("disabled", true);
		            $("#preciou").attr("disabled", true);
		            $("#codigo").focus();
		            /*cancela_operacion();*/
		            $("#imagen").attr("src",'../../Images/sin_foto.jpg');
		            resumen();
            	}else{
					alert('Producto sin Stock...!!!');
				}
        	}else{
        		/**
        		 * cuando el producto ya esta agregado y solo cambian las cantidades
        		 */
        		$("#codigo").val("");
		            $("#cantidad").val("");
		            $("#preciou").val("");
		            $(".widget-user-desc").text("");
		            $(".preciol").text("0.00");
		            $(".exis").text("0.00");
		            $("#cantidad").attr("disabled", true);
		            $("#preciou").attr("disabled", true);
		            $("#codigo").focus();
		            /*cancela_operacion();*/
		            $("#imagen").attr("src",'../../assets/img/sin_foto.png');
		            resumen();
        	}

        }else{
            var n = noty({
                text: "La cantidad es invalida...!",
                theme: 'relax',
                layout: 'center',
                type: 'error',
                timeout: 2000,
            });
        }
    })

    $("#ci").focus();
}
/******************************************************************************************/
$(function(){
        // Evento que selecciona la fila y la elimina
	    $('#tabla_articulos').on("click",".delete",function(){
	    	var parent = $(this).parents().parents().get(0);
		  	$(parent).remove();
           	resumen();
       	});
       });
/****************************************************************************************/
function pone_num_venta(){
          $(document).ready(function(){
          $.ajax({
          beforeSend: function(){
            $("#num_ticket").html("Buscando...");
           },
          url: 'busca_ticket.php',
          type: 'POST',
          data: 'caja='+$("#ncaja").val(),
          success: function(x){
            $("#num_ticket").html("Caja: "+$("#ncaja").val()+" - Ticket # " +x);
           },
           error: function(jqXHR,estado,error){
             $("#num_ticket").html('Hubo un error: '+estado+' '+error);
           }
           });
          });
        }
/*****************************************************************************************/
function resumen(){
	//alert($("#descuento").val());
  	$(document).ready(function(){
    var articulos=0.00;
    var monto=0.00;
    $('#tabla_articulos > tbody > tr').each(function(){
    	articulos	+=parseFloat($(this).find("td").eq(2).html());
    	monto		+=parseFloat($(this).find('td').eq(4).html());
    });
    $("#total_articulos").html("Total de Articulos: "+articulos.toFixed(2));

    var des = $("#descuento").val();
    des = des.split(" ");
    if(des==""){
    	des[0] = 0;
    	//alert(des);
    }

    subTotal = monto;
    monto = monto-((monto*des[0])/100);
    $("#totales").html('Bs. ' + monto.toFixed(2));
    $("#des").html(des[0]+' %');
    $("#subTotal").html('Bs. '+ subTotal.toFixed(2));
    if(articulos>0){
      $("#btn-procesa").prop('disabled', false);
      $("#btn-cancela").prop('disabled', false);
      $("#descuento").prop('disabled', false);
    }else{
      $("#btn-procesa").prop('disabled', true);
      $("#btn-cancela").prop('disabled', true);
      $("#descuento").prop('disabled', true);
    }
    $("#total_venta").val(monto.toFixed(2));
    })
}

/***********************************************************************************************/
function cancela_venta(){
     $("#btn_cancela").prop("disabled", true);
     var n = noty({
              text: "Deseas cancelar la venta...?",
              theme: 'relax',
              layout: 'center',
              type: 'information',
              buttons     : [
                {addClass: 'btn btn-primary',
                 text    : 'Si',
                 onClick : function ($noty){
                      $noty.close();
                      $("#tabla_articulos > tbody:last").children().remove();
                      resumen();
                      cancela_codigo();
                      limpiaVenta();
                      $("#codigo").focus();
                  }
               },
               {addClass: 'btn btn-danger',
                text    : 'No',
                onClick : function ($noty){
                  $("#btn_cancela").prop("disabled", false);
                   $noty.close();
                 }
                }
              ]
          });
       
   }
/***************************************************************************************/
function cancela_codigo(){
   $("#preciou").val("");
   $("#cantidad").val("");
   $("#preciou").attr("disabled", true);
   $("#cantidad").attr("disabled", true);
   $("#codigo").val("");
   $("#codigo").focus();
}
/********************************************************************************************/
function busca_cliente(){
	if($("#ci").val()==''){
	    $(document).ready(function(){
	        $("#modal_tabla_clientes").modal({
	            show:true,
	            backdrop: 'static',
	            keyboard: false
	        });
	       $.ajax({
	          beforeSend: function(){
	            $("#lista_clientes").html("Cargando los clientes...");
	          },
	          url: 'lista_clientes.php',
	          type: 'POST',
	          data: null,
	          success: function(x){
	            $("#lista_clientes").html(x);
	            $(document).ready(function() {
	             $('#sample-table-3').DataTable();
	            });
	           },
	          error: function(jqXHR,estado,error){
	            $("#lista_clientes").html('Hubo un error: '+estado+' '+error);
	          }
	       });
	    })
    }
}
/*********************************************************************************************/
function pone_cliente(elid){
	//alert(elid);
    var client=elid;
    var idcl=client.split("|");
    $("#idcliente_credito").val(idcl[0]);
    $("#modal_tabla_clientes").modal('hide');
    $("#tipo_de_venta").html("<button class='btn btn-danger btn-xs' onclick='quita_cliente();'>Quitar</button> Venta al Contado a: "+idcl[1]);
   // $("#btn_cre").attr('disabled', true);
    //window.alert(client);

    $('#ci').val(idcl[1]);
    $('#name').val(idcl[2]);
    $('#paterno').val(idcl[3]);
    $('#materno').val(idcl[4]);
    $('#celular').val(idcl[5]);
    $('#email').val(idcl[6]);
}
/*********************************************************************************************/
function quita_cliente(){
  $("#btn_cre").attr('disabled', false);
  $("#tipo_de_venta").html("Venta de Contado.");
  $("#idcliente_credito").val("");
}
/***************************************************************************************/
function prepara_venta(){
  $(document).ready(function(){
   $("#modal_prepara_venta").modal({
        show:true,
        backdrop: 'static',
        keyboard: false
   });
   $('#modal_prepara_venta').on('shown.bs.modal', function () {
   $("#paga_con").select();
   $('#paga_con').focus();
   });
   $("#total_de_venta").val("Bs. "+ $("#total_venta").val()+"");
   })
}
/***********************************************************************************/
function calcula_cambio(){
   var m1=$("#total_venta").val();
   var m2=$("#paga_con").val();
   var change=parseFloat(m2)-parseFloat(m1);
   $("#el_cambio").val("Bs. "+change.toFixed(2));
}
/**************************************************************************************/
function procesaVenta(swNuevoCliente){
	var resp=0;
	var idCliente 	=	$("#idcliente_credito").val();
	var subTotal 	=	$('#subTotal').html();
	var total		=	$('#totales').html();
	var descuento 	= 	$('#descuento').val();
	/// variables de cliente
	if(swNuevoCliente==1){//cuando el clienten no existe, se inserta
		var idCliente=$("#ci").val();
		$.ajax({
	    	url: '../../modulo/venta/insertaClienteNuevo.php',
	        type: 'POST',
	        async: false,
	        data: {
	        	ci: idCliente,
	        	nombre: $("#nombre").val(),
	        	celular: $("#celular").val(),
	        	empresa: $("#empresa").val(),
	        	fono: $("#fono").val(),
	        	email:$("#email").val(),

	        },
	    });
	}


	//alert("pppppppppppp "+idCliente);

	descuento 	= descuento.split(" ");
	subTotal	=	subTotal.split(" ");
	total		=	total.split(" ");
	//alert(total[1]);
    /*var descuento	= 	$(this).find('td').eq(0).html();
    var total		= 	$(this).find('td').eq(2).html();*/

	$.ajax({
    	url: '../../modulo/venta/procesaVenta.php',
        type: 'POST',
        async: false,
        data: {
        	subTotal: subTotal[1],
        	idCliente: idCliente,
        	descuento: descuento[0],
        	total: total[1],
        },
        success: function(x){
        	//alert(x);
        	resp = x;
        }
    });
    limpiaVenta();
 	return(resp);
}
function limpiaVenta(){
	$("#ci").val("");
	$("#name").val("");
	$("#celular").val("");
	$("#paterno").val("");
	$("#materno").val("");
	$("#fono").val("");
	$("#email").val("");
	$('#tabla_articulos > tbody > tr').remove();
/*
	var nFilas = $("#tabla_articulos tr").length;
	for (i=0 ; i<=nFilas;i++){
        $("#tr-compra"+i).remove();
    }
    */
}
function procesa_venta(){

  $(document).ready(function(){

	    if($("#name").val()!=""){
	        $('#modal_prepara_venta').modal('toggle');

	    	// se obtiene el detalle de la venta
	    	var detalle="";
	    	$('#tabla_articulos > tbody > tr').each(function(){
	            //var descripcion_art	=	$(this).find('td').eq(1).html();
	            //var cod 	= 	$(this).find('td').eq(0).html();
	            var cod 	=   $(this).attr('id');
	            var can 	= 	$(this).find('td').eq(2).html();
	            var preciou	= 	$(this).find('td').eq(3).html();
	            var monto	=	$(this).find('td').eq(4).html();
	         	detalle=detalle+cod+"/"+can+"/"+preciou+"/"+monto+"@";
	        });

	    	//alert(detalle);
	        var clients  ='0';
	        var descuento 	= 	$('#des').html();
	        var subTotal 	=	$('#subTotal').html();
		    var total		=	$('#totales').html();
		    subTotal=subTotal.split("Bs. ");
		    total=total.split("Bs. ");

	        if($('#idcliente_credito').val()!=""){
	            credi 	=	'1';
	            clients =	$("#idcliente_credito").val();
	        }
	       
	    	var dato = JSON.stringify( $('#datosCliente').serializeObject() );
			$.post("procesa_venta.php",{res:dato,IDCLIENTE:clients, DESCUENTO:descuento,TOTAL:total[1],SUBTOTAL:subTotal[1],DETALLE:detalle},function(data){
				//alert(data);
				var idVenta=data.split('@');

				if(idVenta[0]=="TRUE"){
					alert("Datos guardados correctamente");
					window.open('PdfVentas.php?IDVENTA='+idVenta[1],'_blank');
				}	
				else{
		           alert("Contactar con admin "+data);
				}	
					
		    });	
		    limpiaVenta();

	       //	VentanaCentrada('');
    	}
    	else{
    		alert("Error! Regristrar venta antes de guardar");
    	}

    });
}

function verCompra(idX, clients){
    VentanaCentrada('../../pdf/documentos/venta_pdf.php?idX='+idX+'&clients='+clients,'Cotizacion','','1024','768','true');
}


function BuscarRepuesto(){
	//alert($("#numParteE").val());
	//alert($("#numParte").val());
	
	
  $(document).ready(function(){
    var cod = $("#numParte").val().trim();
        if(cod.trim()!=""){
	        $(document).ready(function(){
	        	$.ajax({
	          	beforeSend: function(){
	            	$("#data_articulo").html("Buscando informacion del articulo...");
	         	},
	          	url: '../../modulo/repuesto/buscaRepuestoAdmin.php',
	          	dataType: 'json',
	          	type: 'POST',
	          	data: 'codigo='+$("#numParte").val(),
	          	success: function(data){
	          		//alert($("#numParteE").val());
	            	if(data==0){//por verdad no existe el repuesto
	            		//alert(data+"  if")
	            		//alert("No existe el articulo...!");
	            		$("#idrepuesto").val("");
	            		$("#codigo").val("");
	            		$("#name").val("");
	            		$("#fromRep").val("");
	            		$("#priceSale").val("");
	            		$("#priceBuy").val("");
	            		$("#swModifica").val("NO");
			            $("#IDREPUESTOMODIFICA").val("");

			            $("#categoria_").removeAttr('readonly');
			            $("#proveedor_").removeAttr('readonly');
			            $("#codigo").removeAttr('readonly');
	            		$("#name").removeAttr('readonly');
	            		$("#fromRep").removeAttr('readonly');
	            		$("#cantidadMin").removeAttr('readonly');
	            		$("#priceSale").removeAttr('readonly');
	            		$("#priceBuy").removeAttr('readonly');
	            		$("#swModifica").removeAttr('readonly');
			            $("#IDREPUESTOMODIFICA").removeAttr('readonly');
			            $("#detail").removeAttr('readonly');

			            //$("#categoria_").append("<option value='' disabled selected hidden>dsd</option>");
			            //$("#proveedor_").append("<option value='' disabled selected hidden>22</option>");
			            //$("#categoria_ option[value="+0+"]").attr("selected",true);
						$("#proveedor_ option[value="+ 0 +"]").attr("selected",true);

	            		
	            		//document.getElementById("detail").innerHTML=("dd");
	            		
	            	}else{

	            		$("#categoria_").attr('readonly', 'readonly');
			            $("#proveedor_").attr('readonly', 'readonly');
			            $("#codigo").attr('readonly', 'readonly');
	            		$("#name").attr('readonly', 'readonly');
	            		$("#fromRep").attr('readonly', 'readonly');
	            		$("#cantidadMin").attr('readonly', 'readonly');
	            		$("#priceSale").attr('readonly', 'readonly');
	            		$("#priceBuy").attr('readonly', 'readonly');
	            		$("#swModifica").attr('readonly', 'readonly');
			            $("#IDREPUESTOMODIFICA").attr('readonly', 'readonly');
			            $("#detail").attr('readonly', 'readonly');

	            		//alert(data[0].id_categoria);
	            		$("#idrepuesto").val(data[0].id_repuesto);
			           // $(".widget-user-desc").html(data[0].namePro);

						$("#categoria_ option[value="+ data[0].id_categoria+"]").attr("selected",true);
						$("#proveedor_ option[value="+ data[0].id_proveedor+"]").attr("selected",true);
			            $("#name").val(data[0].namePro);
			            $("#fromRep").val(data[0].fromRep);
						$("#cantidadMin").val(data[0].stockMin);
			            $("#priceSale").val(data[0].priceSale);
	            		$("#priceBuy").val(data[0].priceBuy);
	            		$("#detail").val(data[0].detail);
						//document.getElementById("detail").innerHTML=(data[0].detail);
			            //$('#cantidad').number(true, 2);
			            //$("#cantidad").attr("disabled", false);
			            //$("#cantidad").val(0.00);
			            //$("#preciou").select();
			            $("#cantidad").focus();
			            $("#swModifica").val("SI");
			            $("#IDREPUESTOMODIFICA").val(data[0].id_repuesto);


				           
	                }
	           },
	           error: function(jqXHR,estado,error){
	            alert("Parece ser que hay un error por favor, reportalo a Soporte inmediatamente...!");
	           }
	           });
	        });
        
    	}
    	else{
         
        }
    });
        
}

function RepuestoSinStock(){
	//alert("posi");
	$('#DIV-ULTIMOS-REPUESTOS').hide(1000);
    $('#DIV-SIN-STOCK').toggle(1000, function() {
            
    });
}

function UltimosRepuestos(){

	//alert("posi");
    //$(selector).hide(duracion,callback);
    
    $('#DIV-SIN-STOCK').hide(1000);
    $('#DIV-ULTIMOS-REPUESTOS').toggle(1000, function() {
            
    });
}

function VerificaVenta(idRepuesto){

	//alert(idRepuesto);

	$.ajax({
		url: "../../modulo/repuesto/buscaRepuestoVenta.php",
		type: 'post',
		dataType: 'json',
		data:{IDREPUESTO:idRepuesto},
		beforeSend: function(data){
			//alert(data+" 1");
			//$("#"+div).html('<div id="load" align="center"><p>Cargando contenido. Por favor, espere ...</p></div>');
		},
		success: function(data){
			//alert(data+" 2" );
			if(data==1){
				alert("El repuesto seleccionado no se puede eliminar por que tiene ventas realizadas");
				$('#dataDelete').modal('hide').delay(1000);
			}
		},
		error: function(data){
			//alert(data+" 3");
			alert("error al verificar.. contactar con sistemas");
		}
			
	});
   

}


function busca_cotizacion(){
	var dato = $('#cotizacion').val();
	$.ajax({
		url: "busca_cotizacion.php",
		type: 'post',
		dataType: 'json',
		async:false,
		data:{rol:rol},
		beforeSend: function(data){
			//$("#"+div).html('<div id="load" align="center"><p>Cargando contenido. Por favor, espere ...</p></div>');
		},
		success: function(data){
			$('#tabla tfoot').removeAttr('hidden');
			//$('#submitVenta').removeAttr('hidden');
			//alert(data.cant);
			for (var i = 0; i < data.length; i++) {
				var monto 	=	data[i].cantidad*data[i].priceSale;
				$("#tabla_articulos > tbody").append("<tr id='"+data[i].id_repuesto+"'><td class='center'>"+data[i].numparte+"</td><td class='center'>"+data[i].name+"</td><td class='center'>"+data[i].cantidad+"</td><td class='center'>"+data[i].priceSale+"</td><td class='center'>"+monto.toFixed(2)+"</td><td class='center'><button class='btn btn-block btn-danger btn-xs delete'><i class='icon-trash bigger-120'></i> Eliminar</button></td></tr>");
			}
			$("#ci").val(data[0].ci);
			$("#nombre").val(data[0].atencion);
			$("#celular").val(data[0].tel1);
			$("#empresa").val(data[0].empresa);
			$("#fono").val(data[0].tel2);
			$("#email").val(data[0].email);
			resumen();
		},
		error: function(data){

		}
	});	
}


function getBuscaLugar(valor,div,condicion,id,vars){
	
    $.ajax({
            url: "../../Modules/Usuario/consultas.php"+vars,
            type: 'post',
            dataType: 'json',
            async:false,
            data:{ID:valor,CONDICION:condicion},
			beforeSend: function(data){
				 $("#"+div).html('<div id="load" align="center"><p>Cargando contenido. Por favor, espere ...</p></div>');  
                    
			},
            success: function(data){
            	//alert(data);
                    $("#"+id).empty();
                   
                    for(var i=0; i<data.length;i++){
                    	$('#'+id).append('<option value="'+data[i].IDLUGAR+'" selected="selected">'+data[i].DEPARTAMENTO+'-'+data[i].DESCRIPCION+'</option>');
                    }

                    $("#"+div).fadeOut(1000,function(){
						$("#"+div).html(data).fadeIn(1000);
					});
                   	                               
            },
            error: function(data){
            alert(data+"nega");
		  }

    });	

}
//SE BUSCA LA SUB CATEGORIA EN EL FORMULARIO DE PRODUCTOS

function getSubCat(idCategoria,condicion,subCategoria){
	//alert(idCategoria)
    $.ajax({
            url: "../../Modules/Producto/consultas.php",
            type: 'post',
            dataType: '',
            async:false,
            data:{IDCATEGORIA:idCategoria,CONDICION:condicion},
			beforeSend: function(data){
				 //$("#"+div).html('<div id="load" align="center"><p>Cargando contenido. Por favor, espere ...</p></div>');  
                    
			},
            success: function(data){
            	 ArraySubCat=$.parseJSON(data);
                    $("#"+subCategoria).empty();
                   
                    for(var i=0; i<ArraySubCat.length;i++){
                    	$('#'+subCategoria).append('<option value="'+ArraySubCat[i].IDSUBCATEGORIA+'" selected="selected">'+ArraySubCat[i].DESCRIPCION+'</option>');
                    }


                    $('#'+subCategoria).append('<option value="" disabled selected hidden>Sub Categoria</option>');
                    $('#'+subCategoria).append('<option value="0" >Ninguno</option>');

                    /*
                    $("#"+div).fadeOut(1000,function(){
						$("#"+div).html(data).fadeIn(1000);
					});

					*/                   	                               
            },
            error: function(data){
            alert(data+"nega");
		  }
    });	
}
//busca Producto

//SE BUSCA LA SUB CATEGORIA EN EL FORMULARIO DE PRODUCTOS

function getCat(idCategoria,condicion,objeto,vars){
	//alert(idCategoria)
    $.ajax({
            url: "../../Modules/Ingreso/consultas.php"+vars,
            type: 'post',
            dataType: '',
            async:false,
            data:{ID:idCategoria,CONDICION:condicion},
			beforeSend: function(data){
				 //$("#"+div).html('<div id="load" align="center"><p>Cargando contenido. Por favor, espere ...</p></div>');  
                    
			},
            success: function(data){
            	 ArraySubCat=$.parseJSON(data);
                    $("#"+objeto).empty();

                   
                    for(var i=0; i<ArraySubCat.length;i++){
                    	$('#'+objeto).append('<option value="'+ArraySubCat[i].IDCATEGORIA+'" selected="selected">'+ArraySubCat[i].DESCRIPCION+'</option>');
                    }  
                    $('#'+objeto).append('<option value="" disabled selected hidden>Seleccionar</option>');                	                               
            },
            error: function(data){
            alert(data+"nega");
		  }
    });	
}
//////////
function getTipoPersona(tipoPersona,condicion,objeto,vars){
	//alert(idCategoria)
	if(tipoPersona!='-'){
		// $('#'+objeto).append('<option value="-" selected="selected">-</option>');
	
    	$.ajax({
            url: "../../Modules/Liquidacion/consultas.php"+vars,
            type: 'post',
            dataType: '',
            async:false,
            data:{TIPO:tipoPersona,CONDICION:condicion},
			beforeSend: function(data){
				 //$("#"+div).html('<div id="load" align="center"><p>Cargando contenido. Por favor, espere ...</p></div>');  
                    
			},
            success: function(data){
            	 ArraySubCat=$.parseJSON(data);
                    $("#"+objeto).empty();

                   
                    for(var i=0; i<ArraySubCat.length;i++){
                    	if(tipoPersona=='NPLA'){
                    		$('#LABEL-PERSONA').html('NRO. PLACA');
                    		$('#'+objeto).append('<option value="'+ArraySubCat[i].CI+'" selected="selected">'+ArraySubCat[i].CI+'</option>');
                    	
                    	}else{
                    		$('#LABEL-PERSONA').html('PERSONA');
                    		if(ArraySubCat[i].CI!=""){
                    			$('#'+objeto).append('<option value="'+ArraySubCat[i].CI+'" selected="selected">'+ArraySubCat[i].NOMBRE+' '+ArraySubCat[i].PATERNO+' '+ArraySubCat[i].MATERNO+'</option>');
                    		}
                    		
                    	}
                    	
                    }  

                    $('#'+objeto).append('<option value="" disabled selected hidden>Seleccionar</option>');                	                               
            },
            error: function(data){
            alert(data+"nega");
		  }
   		});	
   	}
   	else{
   		 $("#"+objeto).empty();
   	}
}

function getConvertLetraMonto(montoBs,condicion,objeto,vars){
	//alert(idCategoria)
    $.ajax({
            url: "../../Modules/Ingreso/consultas.php"+vars,
            type: 'post',
            dataType: '',
            async:false,
            data:{MONTOBS:montoBs,CONDICION:condicion},
			beforeSend: function(data){
				 //$("#"+div).html('<div id="load" align="center"><p>Cargando contenido. Por favor, espere ...</p></div>');  
                    
			},
            success: function(data){
            
            	ArraySubCat=$.parseJSON(data);
            	//alert(ArraySubCat);
                $('#'+objeto).val(ArraySubCat);
                                   	                               
            },
            error: function(data){
            alert(data+"nega");
		  }
    });	
}
function getNroRecibo(tipoReg,condicion,objeto,vars,tipoConcepto){
//alert(tipoConcepto);
    $.ajax({
            url: "consultas.php"+vars,
            type: 'post',
            dataType: '',
            async:false,
            data:{TIPOREGISTRO:tipoReg,CONDICION:condicion,TIPOCONCEPTO:tipoConcepto},
			beforeSend: function(data){
				 //$("#"+div).html('<div id="load" align="center"><p>Cargando contenido. Por favor, espere ...</p></div>');  
                    
			},
            success: function(data){
            
            	ArrayD=$.parseJSON(data);
            	//alert(ArrayD);
                $('#'+objeto).val(ArrayD);
                                   	                               
            },
            error: function(data){
            alert(data+"nega");
		  }
    });	
}
//busca Producto
function buscaProducto(codigo){
	//alert(codigo)
    $.ajax({
            url: "../../Modules/Producto/consultas.php",
            type: 'post',
            dataType: '',
            async:false,
            data:{CODIGO:codigo,CONDICION:"BUSCAPRODUCTO"},
			beforeSend: function(data){
				                 
			},
            success: function(data){
            	//alert(data);
            	ArrayProductos=$.parseJSON(data);
            	if(ArrayProductos.length>0){
            		$("#CATEGORIA").val(ArrayProductos[0].IDCATEGORIA);
            		$("#SUBCATEGORIA").val(ArrayProductos[0].IDSUBCATEGORIA);

					$("#NUMEROSERIE").val(ArrayProductos[0].NUMEROSERIE); 
					$("#NOMBRE").val(ArrayProductos[0].NOMBRE); 
					$("#TIPOMATERIAL").val(ArrayProductos[0].TIPOMATERIAL); 
					$("#TAMANIO").val(ArrayProductos[0].TAMANIO); 
					$("#COLOR").val(ArrayProductos[0].COLOR); 
					$("#VOLTAJE").val(ArrayProductos[0].VOLTAJE); 
					//$("#CANTIDAD").val(ArrayProductos[0].CANTIDAD);
					$("#PRECIOCOMPRA").val(ArrayProductos[0].PRECIOCOMPRA);
					$("#PRECIOVENTA").val(ArrayProductos[0].PRECIOVENTA); 
					$("#IDPRODUCTO").val(ArrayProductos[0].IDPRODUCTO); 
            	}
            	else{
            		$("#NUMEROSERIE").val(""); 
            		$("#NOMBRE").val(""); 
					$("#TIPOMATERIAL").val(""); 
					$("#TAMANIO").val(""); 
					$("#COLOR").val(""); 
					$("#VOLTAJE").val(""); 
					//$("#CANTIDAD").val("");
					$("#PRECIOCOMPRA").val("");
					$("#PRECIOVENTA").val(""); 
					$("#IDPRODUCTO").val(""); 
					
            	}
				  
                  	                               
            },
            error: function(data){
            alert(data+"nega");
		  }
    });	
}

//BUSCA A LA S PERSONAS REGISTRADAS
function buscaPersonas(ci,div,condicion,vars){
	//alert(ci+" "+div+" "+condicion);
    $.ajax({
            url: "../../Modules/Usuario/consultas.php"+vars,
            type: 'post',
            dataType: 'json',
            async:false,
            data:{CI:ci,CONDICION:condicion},
			beforeSend: function(data){
				 $("#"+div).html('<div id="load" align="center"><p>Cargando contenido. Por favor, espere ...</p></div>');  
                    
			},
            success: function(data){
                 // alert(" wwww ->"+data[0].NOMBRE);
               if(data!=""){
            		$("#NOMBRE").val(data[0].NOMBRE);
	            	$("#PATERNO").val(data[0].PATERNO);
	            	$("#MATERNO").val(data[0].MATERNO);
	            	$("#EXPEDIDO option[value="+ data[0].EXPEDIDO +"]").attr("selected",true);
	            	$("#FECHANACIMIENTO").val(data[0].FECHANACIMIENTO);
	            	$("#TELEFONO").val(data[0].TELEFONO);
	            	$("#TELEFONOOFICINA").val(data[0].TELEFONO_OFICINA);
	            	$("#EMAIL").val(data[0].EMAIL);
	            	$("#DIRECCION").val(data[0].DIRECCION);
	            	$("#OBERVACION").val(data[0].OBERVACION);
	            	$("#IDDEPENDENCIA").focus();

            	}
            	else{
            	    $("#NOMBRE").val("");
	            	$("#PATERNO").val("");
	            	$("#MATERNO").val("");
	            	$("#EXPEDIDO option[value='']").attr("selected",true);
	            	$("#FECHANACIMIENTO").val("");
	            	$("#TELEFONO").val("");
	            	$("#TELEFONOOFICINA").val("");
	            	$("#EMAIL").val("");
	            	$("#DIRECCION").val("");
	            	$("#OBERVACION").val("");
	            
            	}
            	

                $("#"+div).fadeOut(1000,function(){
					$("#"+div).html(data).fadeIn(1000);
				});
               	                               
            },
            error: function(data){
              alert(data +" nega-");
		  }
    });	

}

function buscaPersonasLiq(ci,div,condicion,vars){
	//alert(ci+" "+div+" "+condicion);
    $.ajax({
            url: "../../Modules/Liquidacion/consultas.php"+vars,
            type: 'post',
            dataType: 'json',
            async:false,
            data:{CI:ci,CONDICION:condicion},
			beforeSend: function(data){
				 //$("#"+div).html('<div id="load" align="center"><p>Cargando contenido. Por favor, espere ...</p></div>');  
                    
			},
            success: function(data){
                 // alert(" wwww ->"+data[0].NOMBRE);
               if(data!=""){
            		$("#NOMBRE").val(data[0].NOMBRE);
	            	$("#PATERNO").val(data[0].PATERNO);
	            	$("#MATERNO").val(data[0].MATERNO);
	            	

            	}
            	else{
            	    $("#NOMBRE").val("");
	            	$("#PATERNO").val("");
	            	$("#MATERNO").val("");
            	}
            	

                /*$("#"+div).fadeOut(1000,function(){
					$("#"+div).html(data).fadeIn(1000);
				});*/
               	                               
            },
            error: function(data){
              alert(data +" nega-");
		  }
    });	

}



function buscaPersonasLiqCho(ci,div,condicion,vars){
	//alert(ci+" "+div+" "+condicion);
    $.ajax({
            url: "../../Modules/Liquidacion/consultas.php"+vars,
            type: 'post',
            dataType: 'json',
            async:false,
            data:{CI:ci,CONDICION:condicion},
			beforeSend: function(data){
				 //$("#"+div).html('<div id="load" align="center"><p>Cargando contenido. Por favor, espere ...</p></div>');  
                    
			},
            success: function(data){
                 // alert(" wwww ->"+data[0].NOMBRE);
               if(data!=""){
            		$("#NOMBRECHOFER").val(data[0].NOMBRECHOFER);
	            	$("#PATERNOCHOFER").val(data[0].PATERNOCHOFER);
	            	$("#MATERNOCHOFER").val(data[0].MATERNOCHOFER);
	            	

            	}
            	else{
            	    $("#NOMBRECHOFER").val("");
	            	$("#PATERNOCHOFER").val("");
	            	$("#MATERNOCHOFER").val("");
            	}
            	

                /*$("#"+div).fadeOut(1000,function(){
					$("#"+div).html(data).fadeIn(1000);
				});
               	  */                             
            },
            error: function(data){
              alert(data +" nega-");
		  }
    });	

}



function validaDescuento(){

	

	if($("#descuento").val()<=0 || $("#descuento").val()>9){
		alert("no! puede realizar un descuento mayor a 9 %")
		$("#descuento").val("");
	}

}


function insertLiquidacion(idForm,p,aux){

    var formElement = document.getElementById(idForm);
    var data = new FormData(formElement); //Creamos los datos a enviar con el formulario
    // alert(data.push($(this).find('input[name="LIQUIDOPAGABLE"]').val()));
    $.ajax({
        url: p, //URL destino
        data: data,
        processData: false, //Evitamos que JQuery procese los datos, daría error
        contentType: false, //No especificamos ningún tipo de dato
        type: 'POST',
        success: function (data) {
           //alert(data+'');
           if(data=="TRUE"){
           	    var mensaje;
			    var opcion = confirm("DATOS GUARDADOS... DESEA SEGUIR REGISTRANDO ?");
			    if (opcion == true) {
			      	lipiarFormulario();
				} else {
				    location=aux;
				}
	               /* $('#datos_ajax').html('<div class="alert alert-success" role="alert"><strong>Guardado Correctamente!!!</strong></div><br>').fadeIn(4000,function () {
	                        $('#datos_ajax').fadeOut(2000,function () {
	                                $('#dataRegister').modal('hide').delay(2000);
	                                displaySection('index.php','unseen');
	                                location.reload();
	                        });
	                });-*/

            }
            else if(data=="TRUEFALSE"){
            	alert("El Liquido pagable tiene que ser mayor a 0");
            }	
            else{
             alert("Contactar con admin "+data);
            }
        }
    });
}


function insertEncomienda(idForm,p,aux,auxInici){
	var nFilas = $("#table-list tr").length;
	  //alert(nFilas);
	var tablaItem="";
	  for (var i = 0; i < nFilas; i++) {
	  	for (var j = 0; j < 10; j++) {
	  		tablaItem=tablaItem+document.getElementById("table-list").rows[i].cells[j].innerText+"//";
	  		
	  	}
	  	tablaItem=tablaItem+"@";
	  	
	}
    //alert(tablaItem);
  	$("#TABLAENCOMIENDA").val(tablaItem);

    var formElement = document.getElementById(idForm);
    var data = new FormData(formElement); //Creamos los datos a enviar con el formulario
    // alert(data.push($(this).find('input[name="LIQUIDOPAGABLE"]').val()));
    $.ajax({
        url: p, //URL destino
        data: data,
        processData: false, //Evitamos que JQuery procese los datos, daría error
        contentType: false, //No especificamos ningún tipo de dato
        type: 'POST',
        success: function (data) {
           //alert(data);
           if(data=="TRUE"){
           	    var mensaje;
			    var opcion = confirm("DATOS GUARDADOS... DESEA SEGUIR REGISTRANDO ?");
			    if (opcion == true) {
			      	//lipiarFormulario();
			      	 location=auxInici;
			      	 
				} else {
				    location=aux;
				}
	               /* $('#datos_ajax').html('<div class="alert alert-success" role="alert"><strong>Guardado Correctamente!!!</strong></div><br>').fadeIn(4000,function () {
	                        $('#datos_ajax').fadeOut(2000,function () {
	                                $('#dataRegister').modal('hide').delay(2000);
	                                displaySection('index.php','unseen');
	                                location.reload();
	                        });
	                });-*/

            }
            else if(data=="TRUEFALSE"){
            	alert("El Liquido pagable tiene que ser mayor a 0");
            }	
            else{
             alert("Contactar con admin "+data);
            }
        }
    });
}


function updateLiquidacion(idForm,p,aux){

    var formElement = document.getElementById(idForm);
    var data = new FormData(formElement); //Creamos los datos a enviar con el formulario
    // alert(data.push($(this).find('input[name="LIQUIDOPAGABLE"]').val()));
    $.ajax({
        url: p, //URL destino
        data: data,
        processData: false, //Evitamos que JQuery procese los datos, daría error
        contentType: false, //No especificamos ningún tipo de dato
        type: 'POST',
        success: function (data) {
           //alert(data+'');
           if(data=="TRUE"){
           	    var mensaje;
			    var opcion = confirm("DATOS MODIFICADOS CORRECTAMENTE");
			    
				    location=aux;
				

            }
            else if(data=="TRUEFALSE"){
            	alert("El Liquido pagable tiene que ser mayor a 0");
            }	
            else{
             alert("Contactar con admin "+data);
            }
        }
    });
}

function updateImg(idForm,p,aux){

    var formElement = document.getElementById(idForm);
    var data = new FormData(formElement); //Creamos los datos a enviar con el formulario
    // alert(data.push($(this).find('input[name="LIQUIDOPAGABLE"]').val()));
    $.ajax({
        url: p, //URL destino
        data: data,
        processData: false, //Evitamos que JQuery procese los datos, daría error
        contentType: false, //No especificamos ningún tipo de dato
        type: 'POST',
        success: function (data) {
           //alert(data+'');
           if(data=="TRUE"){
           	    var mensaje;
			    var opcion = confirm("IMAGEN GUARDADA CON EXITO");
			    
				    location=aux;
				

            }
        	
            else{
             alert("Contactar con admin "+data);
               location=aux;
            }
        }
    });
}




function calculaImporte(Nro){
	//alert(Nro);
	var importe=$("#td-nropasajero-"+Nro).val()*($("#td-costopasaje-"+Nro).val()/1);
	$("#td-importe-"+Nro).val(importe);
	calculaTotalLiquido();
}

function calculaTotalLiquido(){
	var total=0;
	var descuento=0;
	for (var i = 1; i<=15 ; i++) {

	  if ($("#td-importe-"+i).length>0 ) {
	    total= (total/1)+$("#td-importe-"+i).val()/1;  
	  }
	  
	}
	$("#TOTALRECAUDADO").val(total);

	// CALCULO DE DESCUENTO
	 descuentos=['0','13','3','8.4']
	for (var i = 1; i<=3 ; i++) {

	  if ($("#td-descuento-"+i).length>0 ) {
	  
	    $("#td-descuento-"+i).val((total*descuentos[i])/100);
	    
	  }
	  
	}

	///suma de descuento
	for (var i = 1; i<=15 ; i++) {

	  if ($("#td-descuento-"+i).length>0 ) {
	  
	     descuento= (descuento/1)+$("#td-descuento-"+i).val()/1; 
	    
	  }
	  
	}
	$("#TOTALDESCUENTO").val(descuento.toFixed(2));

	//liquido pagable
	$("#LIQUIDOPAGABLE").val((total-descuento).toFixed(2));
} 

function calculaLiquidoPagable(){
 ///suma de descuento
	 var descuento=0;
	for (var i = 1; i<=15 ; i++) {

	  if ($("#td-descuento-"+i).length>0 ) {
	  
	     descuento= (descuento/1)+$("#td-descuento-"+i).val()/1; 
	    
	  }
	  
	}
	$("#TOTALDESCUENTO").val(descuento.toFixed(2));

	//liquido pagabletoFixed(2)
	var liquidoP=$("#TOTALRECAUDADO").val()-descuento;
	$("#LIQUIDOPAGABLE").val(liquidoP.toFixed(2));
}
		
function lipiarFormulario(){
	$("#LUGARVIAJE").val('');
	$("#NROPLACA").val('');
	$("#CI").val('');
	$("#NOMBRE").val('');
	$("#PATERNO").val('');
	$("#MATERNO").val('');

	$("#CICHOFER").val('');
	$("#NOMBRECHOFER").val('');
	$("#PATERNOCHOFER").val('');
	$("#MATERNOCHOFER").val('');

	for (var i = 1; i<=15 ; i++) {

	  if ($("#td-localidad-"+i).length>0 ) {
	  
	    $("#td-localidad-"+i).val('');
	    $("#td-nropasajero-"+i).val('0');
	    $("#td-costopasaje-"+i).val('0');
	    $("#td-importe-"+i).val('0'); 
	    
	  }
	  
	}

	for (var i = 1; i<=15 ; i++) {
		if(i<=3 || i >=7){
			if ($("#td-descuento-"+i).length>0 ) {
			    $("#td-descuento-"+i).val('0');
			    
			}
		}
	  
	  
	}


	$("#TOTALRECAUDADO").val('0');
	$("#TOTALDESCUENTO").val('0');
	$("#LIQUIDOPAGABLE").val('0');



}



/////

function AdicionarFila(id){
    var items = document.getElementById("tr-recaudacion");
   // var aleatorio = Math.round(Math.random()*10000);
   var idAux=0;
    for (var i = 1; i <= 15; i++) {

        if ($("#td-nropasajero-"+i).length>0 ) {
          idAux=i+1;
        }
    }

    var tr = items.insertRow(-1);
    tr.id ="TR__"+idAux;
    tr.className= "font12h";
    
    var td = tr.insertCell(0);
    td.style.textAlign = 'center';
    tr.className= "font13h";
    contenido = "<th scope='row'>"+idAux+"</th> <td><input type='text'  name='td-localidad-"+idAux+"' id='td-localidad-"+idAux+"' list='datalist1'  data-validation='required' class='form-control mayusculas' placeholder='Lugar'></td> <td><input type='text'  name='td-nropasajero-"+idAux+"' id='td-nropasajero-"+idAux+"' class='form-control' placeholder='Nro. Pasajeros' onkeyup='calculaImporte("+idAux+")' onkeypress='return NumCheck(event, this)'></td> <td><input type='text'  name='td-costopasaje-"+idAux+"' id='td-costopasaje-"+idAux+"' class='form-control' placeholder='Costo Pasaje' onkeyup='calculaImporte("+idAux+")' onkeypress='return NumCheck(event, this)'></td> <td><input type='text'  name='td-importe-"+idAux+"' id='td-importe-"+idAux+"' class='form-control' placeholder='CALCULO AUTOMATICO' readonly></td><td><div class='col-md-6'><img src='../../Images/delete.png' width='40%' class='imagen' title='Eliminar fila' onclick='EliminarFila("+idAux+");'> </div> </td> ";
    tr.innerHTML = contenido;

  }

  function AdicionarFilaDesc(){
     var items = document.getElementById("tr-descuento");
     // var aleatorio = Math.round(Math.random()*10000);
     var idAux=0;
      for (var i = 1; i <= 15; i++) {

          if ($("#td-descuento-"+i).length>0 ) {
            idAux=i+1;
          }
      }

      var tr = items.insertRow(-1);
      tr.id ="TR___"+idAux;
      tr.className= "font12h";
      
      var td = tr.insertCell(0);
      td.style.textAlign = 'center';
      tr.className= "font13h";
      contenido = "<th scope='row'>"+idAux+"</th> <td><input type='text'  name='td-descripcion-"+idAux+"' id='td-descripcion-"+idAux+"' data-validation='required' class='form-control' placeholder='DESCRIPCION DE DESCUENTO' value=' '></td> <td><input type='text'  name='td-descuento-"+idAux+"' id='td-descuento-"+idAux+"' class='form-control' placeholder='Importe' onkeyup='calculaLiquidoPagable()' onkeypress='return NumCheck(event, this)'> <input type='hidden'  name='td-categoria-"+idAux+"' id='td-categoria-"+idAux+"' class='form-control' value='4'> </td> <td>  <div class='row'> <div class='col-md-6'> <img src='../../Images/delete.png' width='40%' class='imagen' title='Eliminar fila' onclick='EliminarFilaDes("+idAux+")'> </div> </div> </td>";
      tr.innerHTML = contenido;

  }


  function EliminarFila(id){
    var Row = document.getElementById("TR__"+id);
        Row.parentNode.removeChild(Row);
        calculaTotalLiquido();
  }

  function EliminarFilaDes(id){
    var Row = document.getElementById("TR___"+id);
        Row.parentNode.removeChild(Row);
        calculaTotalLiquido();
  }

  function AdicionarFilaEncomienda(id){
    var items = document.getElementById("tr-encomienda");
   // var aleatorio = Math.round(Math.random()*10000);
    var idAux=0;
    for (var i = 1; i <= 50; i++) {

        if ($("#td-nroguia-"+i).length>0 ) {
          idAux=i+1;
        }
    }

    var tr = items.insertRow(-1);
    tr.id ="TR__"+idAux;
    tr.className= "font12h";
    
    var td = tr.insertCell(0);
    td.style.textAlign = 'center';
    tr.className= "font13h";
    contenido = '<td scope="row">'+idAux+'</td> '+
                '<td><input type="text"  name="td-nroguia-'+idAux+'" id="td-nroguia-'+idAux+'" class="form-control" data-validation="number" placeholder="Nro. Guia" onkeypress="return NumCheck(event, this)"> </td>'+
                                              
                '<td><input type="text"  name="td-remitente-'+idAux+'" id="td-remitente-'+idAux+'" class="form-control mayusculas" placeholder="Remitente"></td>'+
                                             
                '<td><input type="text"  name="td-nrobulto-'+idAux+'" id="td-nrobulto-'+idAux+'" class="form-control" data-validation="number" placeholder="Nro. Bulto" onkeypress="return NumCheck(event, this)"></td>'+
                                              
                '<td><input type="text"  name="td-consignatario-'+idAux+'" id="td-consignatario-'+idAux+'" class="form-control mayusculas" placeholder="Consignatario"></td>'+                            
                                                 
                                              
                '<td><input type="text"  name="td-ci-'+idAux+'" id="td-ci-'+idAux+'" class="form-control" data-validation="number" placeholder="CI" onkeypress="return NumCheck(event, this)"></td>'+                              
                                                
                                              
                '<td><input type="text"  name="td-contenido-'+idAux+'" id="td-contenido-'+idAux+'" class="form-control mayusculas" placeholder="Contenido"></td>' +                             
                                                
                                              
                                              
                '<td><input type="text"  name="td-pagado-'+idAux+'" id="td-pagado-'+idAux+'" class="form-control" data-validation="number" placeholder="IMP. Pagado" onkeypress="return NumCheck(event, this)"></td>'+                                
                                              
                                              
                                               
                '<td><input type="text"  name="td-porpagar-'+idAux+'" id="td-porpagar-'+idAux+'" class="form-control" data-validation="number" placeholder="Por Pagar" onkeypress="return NumCheck(event, this)"></td>'+                              
                                              
                 
                '<td align="center"> <input class="form-check-input" type="checkbox" value="" id="check-factura-'+idAux+'" name="check-factura-'+idAux+'" onclick="asignaValor(this);" > </td>'+                                
                 

                '<td><img src="../../Images/delete.png" width="100%" class="imagen" title="Eliminar fila" onclick="EliminarFila('+idAux+')";> </td>';                              
    tr.innerHTML = contenido;

   }

 