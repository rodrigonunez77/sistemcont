
<style>
    #ModalCompraSIZE{
      width: 88% !important;
    }e
	.minusculas{
	text-transform:lowercase;
	}	
	.mayusculas{
		text-transform:uppercase;
	}

</style>
<form id="formNew" action="javascript:saveFormImagen('formNew','save.php<?php echo $Vars;?>')" class="" autocomplete="off" enctype="multipart/form-data">
<div class="modal fade bs-example-modal-lg" id="dataRegister" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
	<div class="modal-dialog modal-lg" id="ModalCompraSIZE" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="gridSystemModalLabel">Recibo de Ingreso <span class="fecha">Fecha: <?=date("d/m/Y")?></span></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div id="datos_ajax"></div>
					</div>
				</div>
				<div class="row">
					<input id="FECHA" name="FECHA" type="hidden" value="<?=date("Y-m-d")?>" />
					<input id="tabla" name="tabla" type="hidden" value="empleado">
					<input id="DESCRIPCION" name="DESCRIPCION" type="hidden" value="">
					
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-1 form-group">
								<label for="ci" class="">BS:</label>
							</div>
							<div class="col-md-2 form-group">
								<input id="MONTOBS" name="MONTOBS" type="text" onblur="getConvertLetraMonto(this.value,'BUSCALETRAS','MONTOLITERAL','<?php echo $Vars ?>')" placeholder="" class="form-control" 
									   data-validation="" onkeypress="return NumCheck(event, this)"
									   />

								<div id="CARGADORPERSONAS" name="CARGADORPERSONAS"></div>
							</div>

							<div class="col-md-1 form-group">
								<label for="ci" class="">NRO.:</label>
							</div>
							<div class="col-md-2 form-group">
								
								<input id="NRORECIBOINGRESO" name="NRORECIBOINGRESO" type="text" placeholder="0000001" class="form-control"  
									   data-validation="number"
									   />
							</div>
							<div class="col-md-1 form-group">
								<label for="dateNac" class="">FECHA:</label>
							</div>
							<div class="col-md-3 form-group">
						
								<input id="FECHAREGISTRO" name="FECHAREGISTRO" type="date" placeholder="Fecha Nac." class="form-control" data-validation="date" data-validation-format="yyyy-mm-dd" value="<?=date("Y-m-d")?>" />
							</div>
							
						</div>
						<div class="row">

							<div class="col-md-2 form-group">
								<label for="fono" class="">Recibido de:</label>
							</div>

							<div class="col-md-10 form-group">
								<input id="NOMBREORIGEN" name="NOMBREORIGEN" type="text" placeholder="Nombre completo" class="form-control mayusculas" data-validation="required" data-validation-optional-if-answered=""/>
							</div>
							
						</div>

						<div class="row">

							<div class="col-md-2 form-group">
								<label for="fono" class="">La suma de:</label>
							</div>

							<div class="col-md-10 form-group">
								<input id="MONTOLITERAL" name="MONTOLITERAL" type="text" placeholder="Nombre monto" readonly class="form-control" data-validation-optional-if-answered="celular"/>
							</div>
							
						</div>

						<hr>
						<div class="row">
							<div class="col-md-2 form-group">
								<label for="sucursal" class="">Concepto:</label>
							</div>
							<div class="col-md-10 form-group">
				
								 <textarea id="CONCEPTO" name="CONCEPTO" cols="2" placeholder="Descripción del concepto" class="form-control"></textarea>
							</div>
						</div>

						<div class="row">
							<div class="col-md-2 form-group">
								<label for="sucursal" class="">Estado Ingreso</label>
							</div>
							<div class="col-md-4 form-group">
							
								<select id="ESTADO" name="ESTADO" class="form-control" onchange="cambiarEstado(this.value)" data-validation="required">
									
									<option value="PAGADO" >PAGADO</option>
									<option value="POR COBRAR" >POR COBRAR</option>
								
								</select>
							</div>
							<!----div----->
							<div class="col-md-2 form-group">
								<label for="sucursal" class="">Tipo Pago</label>
							</div>
							<div class="col-md-4 form-group">
				
								<select style="font-size: 13px;" id="TIPOPAGO" name="TIPOPAGO" class="form-control"  data-validation="required" >
                                    <option value="" disabled selected hidden>Seleccione Tipo Pago </option>

                                        <option value="EFECTIVO" >EFECTIVO</option>BUSCALUGAR
                                        <option value="CHEQUE" >CHEQUE</option>
                                        <option value="DEP. BANCARIO" >DEP. BANCARIO</option>
                                        <option value=" " ></option>
  
                                </select>
                                <div id="CARGADOR" name="CARGADOR"> </div>
							</div>

						</div>

				
	                    <div class="col-md-12 form-group">
	                        <label for="obser" class="sr-only"></label>
	                        <p id="maxText" class="text-info"><span id="max-length-element">200</span> caracteres restantes</p>
	                        <textarea id="OBSERVACION" name="OBSERVACION" cols="2" placeholder="Observaciones" class="form-control"></textarea>
	                    </div>
	            		
					 
					</div>	
					<div class="col-md-4">
				    	<p> Seleccione una imagen del Depósito</p>
						<div class="form-group">
							<input id="IMAGEN" name="IMAGEN" type="file" multiple=true>
						</div>
					</div>

				   
				</div>
				<div class="row">
					
				</div>
				
				
			</div>
			<div class="modal-footer">
				<button type="button" id="close" class="btn btn-danger" data-dismiss="modal">
					<i class="fa fa-close" aria-hidden="true"></i>
					<span>Cancelar</span>
				</button>
				<button type="submit" id="save" class="btn btn-success">
					<i class="fa fa-check" aria-hidden="true"></i>
					<span>Agregar</span>
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</form>

<script>

$(document).ready(function(e) {

	$.validate({
        lang: 'es',
        modules : 'security, modules/logic'
   	});
   
   	$('#OBSERVACION').restrictLength( $('#max-length-element') );// para texarea observacion 

   	$('#dataRegister').on('shown.bs.modal', function () {
	  //$('#DNI').focus()
	})

	$('#dataRegister').on('hidden.bs.modal', function (e) {
		// do something...
		$('#formNew').get(0).reset();
	});

	
});


$("#IMAGEN").fileinput({

	showCaption: false,
	browseClass: "btn btn-primary btn-lg",
	fileType: "any"
});


function reiniciaNroRecibo(){
   getNroRecibo('I','BUSCANUMERACIONRECIBO','NRORECIBOINGRESO','<?php echo $Vars ?>');
}

function asignaDescripcion1(valor){

	$("#DESCRIPCION").val($("#CONCEPTO").find('option:selected').text());

}

function cambiarEstado(estado){
     
    if(estado=='PAGADO'){
		$('#TIPOPAGO').val('EFECTIVO');
		$('#TIPOPAGO').attr('disabled', false);
    }   
    else{
		$('#TIPOPAGO').val(' ');
		$('#TIPOPAGO').attr('disabled', true);
    } 


}

function NumCheck(e, field) {
	  key = e.keyCode ? e.keyCode : e.which
	  // backspace
	
	  if (key == 8) return true
	  // 0-9
	  if (key > 47 && key < 58) {
		if (field.value == "") return true
		regexp = /.[0-9]{5}$/
		return !(regexp.test(field.value))
	  }
	  // .
	  if (key == 46) {
		if (field.value == "") return false
		regexp = /^[0-9]+$/
		return regexp.test(field.value)
	  }
	  // other key
	  return false
	 
}

</script>