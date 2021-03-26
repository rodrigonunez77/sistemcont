<style>
    #ModalCompraSIZE{
      width: 99% !important;
    }e
	.minusculas{
	text-transform:lowercase;
	}	
	.mayusculas{
		text-transform:uppercase;
	}

	.imagen:hover {filter: opacity(.5);}

</style>

<form id="formNew" action="javascript:saveForm('formNew','save.php<?php echo $Vars;?>')" class="form-horizontal" autocomplete="off" >
	<div class="modal fade" id="dataRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		<div class="modal-dialog modal-lg" id="ModalCompraSIZE" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="exampleModalLabel">Nueva Liquidación</h4>
				</div>
				<div class="modal-body">

					<div class="row">
						<div class="col-md-12">
							<div id="datos_ajax"></div>
						</div>
					</div>
					<div class="row">
						    <div class="col-md-1">
								<label for="fecha" class="control-label">Fecha:</label>
							</div>
							<div class="col-md-2 form-group">
								<input id="FECHAREGISTRO" name="FECHAREGISTRO" type="date" class="form-control" value="<?=date('d/m/Y')?>" >
							</div>
							<div class="col-md-1">
								<label for="name" class="control-label">Lugar de Viaje:</label>
							</div>
							<div class="col-md-3 form-group">
								<input type="text" class="form-control mayusculas" id="LUGARVIAJE" name="LUGARVIAJE" placeholder="Lugar de Viaje" data-validation="required">
							</div>
							<div class="col-md-1">
							<label for="name" class="control-label">Bus Placa:</label>
							</div>	
							<div class="col-md-2 form-group">
								<input type="text" class="form-control mayusculas" id="NROPLACA" name="NROPLACA" placeholder="Nro. Placa" data-validation="required">
							</div>
 							<div class="col-md-2 form-group">
								<input id="FECHASISTEMA" name="FECHASISTEMA" type="hidden" class="" value="<?=date('Y-m-d h:i:s')?>">
							</div>
							

						
					</div>
					<hr>
					<span> <STRONG> DATOS DEL PROPIETARIO </STRONG></span>
					<div class="row">
						<div class="col-md-1">
							<label for="name" class="control-label">Nro. Doc.:</label>
						</div>
						<div class="col-md-2 form-group">
							<input type="text" class="form-control mayusculas" id="DESCRIPCION" name="DESCRIPCION" placeholder="CI" data-validation="required">
						</div>
						<div class="col-md-1">
							<label for="name" class="control-label">Nombres:</label>
						</div>
						<div class="col-md-3 form-group">
							<input type="text" class="form-control mayusculas" id="NOMPROPIETARIO" name="DESCRIPCION" placeholder="Nombre Propietario" data-validation="required">
						</div>
						<div class="col-md-1">
							<label for="name" class="control-label">1er Ape.:</label>
						</div>
						<div class="col-md-2 form-group">
							<input type="text" class="form-control mayusculas" id="PATERNO" name="PATERNO" placeholder="1er Apellido" data-validation="required">
						</div>
						<div class="col-md-1">
							<label for="name" class="control-label">2do Ape.:</label>
						</div>
						<div class="col-md-2 form-group">
							<input type="text" class="form-control mayusculas" id="MATERNO" name="MATERNO" placeholder="2do Apellido" data-validation="required">
						</div>
					</div>
					<hr>
					<div class="row" align="center">
						<div class="col-md-7">
							<label for="name" class="control-label">DETALLE  RECAUDACION</label>
						</div>

						<div class="col-md-5">
							<label for="name" class="control-label">DETALLE DESCUENTO</label>
						</div>
						
					</div>
					<div class="row">
						
						<div class="col-md-7">
							<table class="table">
							  <thead class="thead-dark">
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">Localidad</th>
							      <th scope="col">Nro Pasajeros</th>
							      <th scope="col">Costo Pasaje</th>
							      <th scope="col">Importe</th>
							      <th scope="col" width="15%"></th>
							     
							    </tr>
							  </thead>
							  <tbody id="tr-recaudacion">
							  	<?php
							  		$idFilaReca=rand(0, 1000);
							  	?>
							    <tr >
							      <th scope="row">1</th>
							      <td>Cobija</td>
							      <td>28</td>
							      <td>200</td>
							      <td>5600</td>
							      <td>
							      	<div class="row">
							      		<div class="col-md-6">
							      			<img src="../../Images/mas.png" width="90%" class="imagen">
							      		</div>
							      		<div class="col-md-6">
							      	       <img src="../../Images/delete.png" width="90%" class="imagen"> 
							      		</div>
							      	</div>
							      	
							      </td>
							      
							    </tr>
							    <tr>
							      <th scope="row">2</th>
							      <td>Puerto Rico</td>
							      <td>2</td>
							      <td>180</td>
							       <td>360</td>
							    </tr>
							    <tr>
							      <th scope="row">3</th>
							      <td>Puerto Cena</td>
							      <td>2</td>
							      <td>170</td>
							      <td>340</td>
							    </tr>
							  </tbody>
							</table>

							<div class="row">
								<div class="col-md-10" align="right">
									TOTAL RECAUDADO: <input type="text" name="TOTALRECAUDADO" id="TOTALRECAUDADO" size="5" value="6.670" readonly >
								</div>
							</div>
						</div>

						<div class="col-md-5">
							<table class="table">
							  <thead class="thead-dark">
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">Localidad</th>
			
							      <th scope="col">Importe</th>
							      <th scope="col" width="20%"></th>
							    </tr>
							  </thead>
							  <tbody>
							    <tr>
							      <th scope="row">1</th>
							      <td>IVA 13%</td>
							      <td>867.10</td>
							      <td>
							      	<div class="row">
							      		<div class="col-md-6">
							      			<img src="../../Images/mas.png" width="100%" class="imagen">
							      		</div>
							      		<div class="col-md-6">
							      	       <img src="../../Images/delete.png" width="100%" class="imagen"> 
							      		</div>
							      	</div>
							      	
							      </td>
							
							    </tr>
							    <tr>
							      <th scope="row">2</th>
							      <td>IT 3%</td>
							      <td>200.10</td>
							     
							    </tr>
							    <tr>
							      <th scope="row">3</th>
							      <td> SAPORTE OF. 8.9%</td>
							      <td>560.20<td>
							     
							    </tr>
							  </tbody>
							</table>
							<div class="row">
								<div class="col-md-10" align="right">
									TOTAL DESCUENTO: <input type="text" name="TOTALDESCUENTO" id="TOTALDESCUENTO" size="5" value="1.627,4" readonly>
								</div>
							</div>
						</div>
					</div>			
					<hr>
					<div class="row">
						<div   class="col-md-11" align="right">
							<p style="font-size: 15px"> <strong style="flood-color:Navy"> LIQUIDO PAGABLE : 4.672,60 </strong></p> 
							
						</div>
						<div class="col-md-1"></div>
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