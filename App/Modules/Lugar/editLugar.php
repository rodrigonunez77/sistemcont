
<form id="formUpdate" action="javascript:updateForm('formUpdate','update.php<?php echo $Vars;?>')" class="form-horizontal" autocomplete="off" >
	<div class="modal fade" id="dataUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				   <h4 class="modal-title" id="exampleModalLabel"></h4>
				</div>
				<div class="modal-body">
					<div id="datos_ajax_update"></div>

					<div class="form-group">
						<label for="fecha" class="control-label col-md-2">Fecha:</label>
						<div class="col-md-4">
							<input id="FECHAREGISTRO" name="FECHAREGISTRO" type="text" class="form-control" value="<?=date('Y-m-d')?>" readonly>
						</div>

						<input id="FECHASISTEMA" name="FECHASISTEMA" type="hidden" class="form-control" value="<?=date('Y-m-d h:i:s')?>">
						<input id="ID" name="ID" type="hidden" class="form-control" value="">

					</div>
					<div class="form-group">
						<label for="name" class="control-label col-md-2">Departamento:</label>
						<div class="col-md-4">
							<select id="DEPARTAMENTO" name="DEPARTAMENTO" class="form-control" data-validation="required">
									<option value="" disabled selected hidden>Seleccione</option>
									<option value="LP">LA PAZ</option>
									<option value="BN">BENI</option>
									<option value="PD">PANDO</option>
									<option value="SC">SANTA CRUZ</option>
									<option value="CB">COCHABAMBA</option>
									<option value="PT">POTOSI</option>
									<option value="OR">ORURO</option>
									<option value="TJ">TARIJA</option>
									<option value="CH">SUCRE</option>
									
						    </select>
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="control-label col-md-2">Dependencia:</label>
						<div class="col-md-10">
							<select id="IDDEPENDENCIA" name="IDDEPENDENCIA" class="form-control" data-validation="required">
									<option value="" disabled selected hidden>Seleccione</option>
									<?php
                                        foreach ($DataDependencia as $key => $value) {
                                            # code...
                                    ?>
                                        <option value="<?=$value['IDDEPENDENCIA']?>" ><?=$value['DESCRIPCION'] ?></option>
                                    <?php
                                    }
                                    ?>
									
						    </select>
						</div>	
						
					</div>

					<div class="form-group">
						<label for="name" class="control-label col-md-2">Lugar:</label>
						<div class="col-md-10">
							<input type="text" class="form-control" id="DESCRIPCION" name="DESCRIPCION" placeholder="Lugar de la Oficina" data-validation="required">
						</div>
					</div>
					
					<div class="form-group">
						<label for="fromRep" class="control-label col-md-2">Dirección:</label>
						<div class="col-md-10">
							<input type="text" class="form-control" id="DIRECCION" name="DIRECCION" placeholder="Dirección" data-validation="required">
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
						<span>Modificar</span>
					</button>
				</div>
			</div>
		</div>
	</div>
</form>

<script>

	$('#dataUpdate').on('hidden.bs.modal', function (e) {
		// do something...
		$('#formUpdate').get(0).reset();
	});

	$('#dataUpdate').on('show.bs.modal', function (event) {

		var button  	= $(event.relatedTarget); // Botón que activó el modal
		var idLugar		= button.data('idlugar'); // Extraer la información de atributos de datos
		var idDependencia		= button.data('iddependencia'); // Extraer la información de atributos de datos
		var departamento  	= button.data('departamento'); // Extraer la información de atributos de datos
		var tipo  	= button.data('tipo'); // Extraer la información de atributos de datos
		var descripcion		= button.data('descripcion'); // Extraer la información de atributos de datos
		var direccion  	= button.data('direccion'); // Extraer la información de atributos de datos
		var sistemas  	= button.data('sistemas'); // Extraer la información de atributos de datos
		//alert(idSucursal);
		var modal = $(this);
		modal.find('.modal-title').text('Modificar Oficina');
		modal.find('.modal-body #ID').val(idLugar);
		modal.find('.modal-body #IDDEPENDENCIA').val(idDependencia);
		modal.find('.modal-body #DEPARTAMENTO').val(departamento);
		modal.find('.modal-body #DESCRIPCION').val(descripcion);
		modal.find('.modal-body #DIRECCION').val(direccion);

		//$('input#suc'+idSuc).iCheck('check');
	});

</script>