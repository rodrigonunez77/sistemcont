
<style>
    #ModalCompraSIZE{
      width: 96% !important;
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
				<h4 class="modal-title" id="gridSystemModalLabel">Nuevo Usuario <span class="fecha">Fecha: <?=date("d/m/Y")?></span></h4>
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
					<div class="col-md-9">
						<div class="row">
							<div class="col-md-2 form-group">
								<label for="ci" class="sr-only">N° C.I.:</label>
								<input id="DNI" name="DNI" type="text" placeholder="N° C.I." class="form-control" onblur="buscaPersonas(this.value,'CARGADORPERSONAS','BUSCAPERSONAS','<?php echo $Vars;?>')"
									   data-validation="number"
									   />
								<div id="CARGADORPERSONAS" name="CARGADORPERSONAS"></div>
							</div>
							<div class="col-md-2 form-group">
								<label for="dep" class="sr-only">Lugar Exp.:</label>
								<select id="EXPEDIDO" name="EXPEDIDO" class="form-control" data-validation="required">
									<option value="" disabled selected hidden>Lugar Exp.</option>
									<option value="LP">La Paz</option>
									<option value="CB">Cochabamba</option>
									<option value="SC">Santa Cruz</option>
									<option value="BN">Beni</option>
									<option value="TJ">Tarija</option>
									<option value="PT">Potosi</option>
									<option value="OR">Oruro</option>
									<option value="PD">Pando</option>
								</select>
							</div>
							<div class="col-md-3 form-group">
								<label for="name" class="sr-only">Nombre:</label>
								<input id="NOMBRE" name="NOMBRE" type="text" placeholder="Nombre" class="form-control mayusculas" data-validation="required" autocomplete="off" />
							</div>
							<div class="col-md-3 form-group">
								<label for="paterno" class="sr-only">Paterno:</label>
								<input id="PATERNO" name="PATERNO" type="text" placeholder="Paterno" data-validation="required" class="form-control mayusculas" />
							</div>
							<div class="col-md-2 form-group">
								<label for="materno" class="sr-only">Materno:</label>
								<input id="MATERNO" name="MATERNO" type="text" placeholder="Materno" data-validation="required" class="form-control mayusculas" />
							</div>
							
						</div>
						<div class="row">
							
							<div class="col-md-3 form-group">
								<label for="dateNac" class="sr-only">Fecha de Nacimiento:</label>
								<input id="FECHANACIMIENTO" name="FECHANACIMIENTO" type="date" placeholder="Fecha Nac." class="form-control" data-validation="date" data-validation-format="yyyy-mm-dd"/>
							</div>
							<div class="col-md-2 form-group">
								<label for="fono" class="sr-only">Telefono:</label>
								<input id="TELEFONOOFICINA" name="TELEFONOOFICINA" type="text" placeholder="Telefono" class="form-control" data-validation="number" data-validation-optional-if-answered="celular"/>
							</div>
							<div class="col-md-2 form-group">
								<label for="celular" class="sr-only">Celular:</label>
								<input id="TELEFONO" name="TELEFONO" type="text" placeholder="Celular" class="form-control" data-validation="number" data-validation-optional-if-answered="fono"/>
							</div>
							<div class="col-md-5 form-group">
								<label for="email" class="sr-only">Correo Electronico:</label>
								<input id="EMAIL" name="EMAIL" type="text" placeholder="Correo Electronico" value="" class="form-control minusculas" data-validation="email"/>
							</div>
						</div>

						<div class="row">
					
							<div class="col-md-8 form-group">
								<label for="addres" class="sr-only"></label>
								<input id="DIRECCION" name="DIRECCION" type="text" placeholder="Direcci&oacute;n" class="form-control mayusculas" data-validation="required"/>
							</div>

						</div>
						<hr>
						<div class="row">

							<div class="col-md-5 form-group">
								<label for="sucursal" class="sr-only">Trabaja en:</label>
								<select style="font-size: 13px;" id="IDDEPENDENCIA" name="IDDEPENDENCIA" class="form-control" onchange="getBuscaLugar(this.value,'CARGADOR','BUSCALUGAR','IDLUGAR','<?php echo $Vars ?>')" data-validation="required" >
                                    <option value="" disabled selected hidden>Trabaja en: </option>
                                    <?php
                                        foreach ($DataDependencia as $key => $value) {
                                            # code...
                                    ?>
                                        <option value="<?=$value['IDDEPENDENCIA']?>" ><?=$value['DESCRIPCION']?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <div id="CARGADOR" name="CARGADOR"> </div>
							</div>

							<div class="col-md-3 form-group">
								<label for="sucursal" class="sr-only">Oficina:</label>
								<select id="IDLUGAR" name="IDLUGAR" class="form-control" data-validation="required">
									<option value="" disabled selected hidden>Seleccione Lugar</option>
								</select>
							</div>

							<div class="col-md-4 form-group">
								<label for="cargo" class="sr-only">Rol:</label>
								<select id="CARGO" name="CARGO" class="form-control" data-validation="required">
                                    <option value="" disabled selected hidden>Seleccione Rol: </option>
                                    <?php
                                        foreach ($DataCargo as $key => $value) {
                                            # code...
                                    ?>
                                        <option value="<?=$value['DESCRIPCION']?>" ><?=$value['DESCRIPCION']." "?></option>
                                    <?php
                                    }
                                    ?>
                
                                </select>
								
							</div>
						
						</div>
					    <div class="row">
					    	<div class="col-md-3 form-group">
								<label for="cargo" class="sr-only">Nivel:</label>
								<select id="ROL" name="ROL" class="form-control"  data-validation="required">
									<option value="" disabled selected hidden>Seleccione Nivel</option>
									<option value="1">1 (ADMIN)</option>
									<option value="2">2 (OPE)</option>
									
								</select>
								<div id="CARGADOR" name="CARGADOR"> </div>
							</div>

						    <div class="col-md-2 form-group">
								<label for="codUser" class="sr-only">Usuario:</label>
								<input id="LOGIN" name="LOGIN" type="text" placeholder="Usuario" class="form-control"
									   data-validation="required" />
							</div>
							<div class="col-md-2 form-group">
								<label for="password" class="sr-only">Contraseña:</label>
								<input id="PASSWORD" name="PASSWORD" type="text" placeholder="Contraseña" value="" class="form-control" data-validation="required"/>
							</div>
							<div class="col-md-3 form-group">
								<label for="cargo" class="sr-only">Estado:</label>
								<select id="ESTADO" name="ESTADO" class="form-control"  data-validation="required">
								
									<option value="A">Habilitado</option>
									<option value="I">Deshabilitado</option>
							
								</select>
							
							</div>
						</div>	
					</div>	

				    <div class="col-md-3" align="center">
							<!--<div class="">
								<img class="img-responsive"   src="../../Images/Empleados/PPPPRODRI.jpg"  >
							</div>
						    -->
						     <label for="IMAGENU" id="IMAGENP" >
                            
                            </label>
                        <div>
                        <p> Seleccione una foto</p>
                        <div class="form-group">
                            <input id="IMAGENU" name="IMAGENU" type="file" accept="image/x-png,image/jpeg"  multiple=true  >
                        </div>

				    </div>
				
				<div class="row">
					
				</div>
				<div class="row">
					<div class="col-md-9 form-group">
						<label for="obser" class="sr-only"></label>
						<p id="maxText" class="text-info"><span id="max-length-element">200</span> caracteres restantes</p>
						<textarea id="OBSERVACION" name="OBSERVACION" cols="2" placeholder="Observaciones" class="form-control"></textarea>
					</div>
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

</script>