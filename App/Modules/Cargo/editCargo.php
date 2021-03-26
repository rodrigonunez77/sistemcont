
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
						<label for="name" class="control-label col-md-2">Nombre del Rol:</label>
						<div class="col-md-10">
							<input type="text" class="form-control mayusculas" id="DESCRIPCION" name="DESCRIPCION" placeholder="Descripcion" data-validation="required">
						</div>
					</div>
					
					<div class="form-group">
						<label for="fromRep" class="control-label col-md-2">Nivel:</label>
						<div class="col-md-10">
							<select id="ITEM" name="ITEM" class="form-control" data-validation="required">
									<option value="" disabled selected hidden>Seleccione</option>
									<option value="1">1 (OP)</option>
									<option value="2">2 (ADMIN)</option>

								</select>
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
		var idCargo		= button.data('idcargo'); // Extraer la información de atributos de datos
		var descripcion	= button.data('descripcion'); // Extraer la información de atributos de datos
		var item  	= button.data('item'); // Extraer la información de atributos de datos
		//alert(idSucursal);
		var modal = $(this);
		modal.find('.modal-title').text('Modificar Cargo');
		modal.find('.modal-body #ID').val(idCargo);
		modal.find('.modal-body #DESCRIPCION').val(descripcion);
		modal.find('.modal-body #ITEM').val(item);

		//$('input#suc'+idSuc).iCheck('check');
	});

</script>