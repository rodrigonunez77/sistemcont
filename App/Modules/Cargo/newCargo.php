
<form id="formNew" action="javascript:saveForm('formNew','save.php<?php echo $Vars;?>')" class="form-horizontal" autocomplete="off" >
	<div class="modal fade" id="dataRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="exampleModalLabel">Nueva Cargo</h4>
				</div>
				<div class="modal-body">
					<div id="datos_ajax"></div>

					<div class="form-group">
						<label for="fecha" class="control-label col-md-2">Fecha:</label>
						<div class="col-md-4">
							<input id="FECHAREGISTRO" name="FECHAREGISTRO" type="text" class="form-control" value="<?=date('Y-m-d')?>" readonly>
						</div>

						<input id="FECHASISTEMA" name="FECHASISTEMA" type="hidden" class="form-control" value="<?=date('Y-m-d h:i:s')?>">

					</div>
					
					<div class="form-group">
						<label for="name" class="control-label col-md-2">Nombre del Rol:</label>
						<div class="col-md-10">
							<input type="text" class="form-control mayusculas" id="DESCRIPCION" name="DESCRIPCION" placeholder="Descripcion" data-validation="required">
						</div>
					</div>
					
					<div class="form-group">
						<label for="dep" class="control-label col-md-2">Nivel:</label>
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
						<span>Agregar</span>
					</button>
				</div>
			</div>
		</div>
	</div>
</form>

<script>

	$(document).ready(function(e) {

		$.validate({
          lang: 'es',
          modules : 'security, modules/logic'
      	});
	});

	$('#dataRegister').on('hidden.bs.modal', function (e) {
		// do something...
		$('#formNew').get(0).reset();
	});

</script>