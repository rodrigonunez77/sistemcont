

<form id="formUpdate" action="javascript:updateImg('formUpdate','updateImg.php<?php echo $Vars;?>','listaLiquidacion.php<?php echo $Vars;?>')" class="form-horizontal" autocomplete="off" >
	<div class="modal fade" id="dataUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					Modificar Registro 
					
				</div>
				<div class="modal-body">
					<input type="hidden" class="form-group" name="NROINFORME" id="NROINFORME">
					<input type="hidden" class="form-group" name="NROIMGDEP" id="NROIMGDEP">
					<table class="table">
					  <thead class="thead-dark">
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Nombre Completo (Propietario)</th>
					      <th scope="col">CI</th>
					      <th scope="col">Total Recaudado</th>
					      <th scope="col"></th>
					    </tr>
					  </thead>
					  <tbody id="tabla-editar">
					    
					  </tbody>
					</table>

					<hr>
					<label>Comprobantes de Depositos</label>
					<div id="IMAGENDEP" class="row">
						
					
						
					</div>

				</div>
				
				<div class="modal-footer">
					<div class="panel-body">
						<div class="row">
							<select style="font-size: 13px;" id="DESCRIPCION" name="DESCRIPCION" class="form-control"  data-validation="required"  >

									    <!--<option value="" disabled selected hidden>Seleccione Descipcion  </option>-->
                                        <option value="APORTE OFICINA" >APORTE OFICINA</option>
                                        <option value="RENTENCIONES" >RENTENCIONES</option>
                                        <option value="HOJA CONTROL" >HOJA CONTROL</option>
                                        <option value="VARIOS" >VARIOS</option>
                                      
                             </select>
							<div class="col-md-12">

								<div class="scrollable-panel">
									<div class="form-group">
										<input id="IMAGEN" name="IMAGEN[]" type="file"  >
									</div>
								</div>
									
							</div>
							
							<!--<div class="col-md-3">
								<input type="submit" name="" class="btn btn-default" value="Guardar Imagen">
								
								<button class="btn btn-default">
									<img src="../../images/mas.png" width="25%"></img>  &nbsp;Depósitos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								</button>
							</div>
							-->

						</div>
					</div><!--//content-->
				</div><!--//modal-footer-->
			</div>
		</div>
	</div>
</form>
<?php
 
    include 'delLiquidacion.php';
     
?>
<script>

	$('#dataUpdate').on('hidden.bs.modal', function (e) {
		// do something...
		$('#formUpdate').get(0).reset();
	});

	$('#dataUpdate').on('show.bs.modal', function (event) {

		var button  	= $(event.relatedTarget); // Botón que activó el modal
		var nroinforme	= button.data('nroinforme'); // Extraer la información de atributos de datos

		//alert(idSucursal);
		var modal = $(this);
		modal.find('.modal-title').text('Modificar Concepto');
		modal.find('.modal-body #ID').val("-");
		modal.find('.modal-body #NROINFORME').val(nroinforme);
		//alert(nroinforme);
		eliminaFilas();

 		$.post('consultas.php<?php echo $Vars?>',{CONDICION:'BUSCAPROPIETARIOS',NROINFORME:nroinforme},function(data){
            dataPropietario=$.parseJSON(data); 
            var items = document.getElementById("tabla-editar");

            for (var i = 0; i < dataPropietario.length; i++) {
            	//alert(i);
            	
              	var tr = items.insertRow(-1);
	    		tr.id ="TR__"+i;
	    		tr.className= "font12h";
	    
	    		var td = tr.insertCell(0);
	    		td.style.textAlign = 'center';
	    		tr.className= "font13h";
	    		contenido = "<tr><th>"+(i+1)+"</th><th>"+dataPropietario[i].PATERNO+" "+dataPropietario[i].MATERNO+" "+dataPropietario[i].NOMBRE+"</th><th>"+dataPropietario[i].CI+"</th><th>"+dataPropietario[i].TOTALRECAUDADO+"</th><th><button  type='button' id='btn-editar-liquidacion' class='btn btn-success btn-sm' onclick='editarLiquidacion("+dataPropietario[i].IDLIQUIDACION+")' > <i class='glyphicon glyphicon-edit'></i>Editar&nbsp;&nbsp;&nbsp;&nbsp; </button> <?php
                                             if($_SESSION['NIVEL']=='1'){
                                            ?> <button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#dataDelete' data-id='"+dataPropietario[i].IDLIQUIDACION+"' onclick='cerrarVentana()'  data-nroinforme=''  ><i class='glyphicon glyphicon-trash'></i> Eliminar</button> <?php
                                             }
                                            ?></th> </tr>";
	    		tr.innerHTML = contenido;
            }  
                        
        }); 
        //cargarimagen de la tabla imagendeposito

 		$.post('consultas.php<?php echo $Vars?>',{CONDICION:'BUSCAIMAGEN',NROINFORME:nroinforme},function(data){
 			//alert(data);
            dataImagen=$.parseJSON(data); 
            
            var cadena="";
            var nroImagenes=0;
            for (var i = 0; i < dataImagen.length; i++) {
            	cadena=cadena+"	<div align='center' class='col-md-6' id='div-imgdep-"+i+"'>"+dataImagen[i].DESCRIPCION+" <button type='button' class='close' data-dismiss='' title='Eliminar' aria-label='Close' onclick='eliminarImg("+i+","+dataImagen[i].IDIMAGENDEP+")'><span aria-hidden='true'>&times;</span></button><img class='thumbnail' width='90%' src='../../images/depositos/"+dataImagen[i].NOMBRE+"."+dataImagen[i].EXTENCION+"'> </div>";
            		nroImagenes++;
            }  
            $('#IMAGENDEP').html(cadena);  
            $('#NROIMGDEP').html(nroImagenes);           
        }); 
	    
	});

	function editarLiquidacion(id){
		//alert("pso");
		location ="editLiquidacion.php<?php echo $Vars;?>&id="+id;
	}

	function eliminaFilas(){
	    //OBTIENE EL NÚMERO DE FILAS DE LA TABLA
	    var n=0;
		$("#tabla-editar tr").each(function () {
		  n++;
		});
		//
		//alert(n);
		//BORRA LAS n-1 FILAS VISIBLES DE LA TABLA
		//LAS BORRA DE LA ULTIMA FILA HASTA LA SEGUNDA
		//DEJANDO LA PRIMERA FILA VISIBLE, MÁS LA FILA PLANTILLA OCULTA
		for(i=n-1;i>=0;i--){
	    	$("#tabla-editar tr:eq('"+i+"')").remove();
		}
	}

	function eliminarImg(idDiv,id){
		//alert(nomImg);
		$('#div-imgdep-'+idDiv).remove();
		$.post('consultas.php<?php echo $Vars?>',{CONDICION:'ELIMINAIMGDEP',ID:id},function(data){
 			 // alert(data);
            dataImagen=$.parseJSON(data); 
          
           if(dataImagen=!"null"){
            	alert('Error! al eliminar');
            }         
        }); 
	}

	function cerrarVentana(){
		 $('#dataUpdate').modal('hide');
	}

	$("#IMAGEN").fileinput({

		showCaption: false,
		//browseClass: "btn btn-primary btn-lg",
		fileType: "any"
	});

</script>