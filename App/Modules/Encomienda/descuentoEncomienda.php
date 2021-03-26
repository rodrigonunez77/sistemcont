<form id="formNew" action="javascript:saveFormEncomienda('formNew','saveAnticipo.php<?php echo $Vars;?>','listaLiquidacionCarga.php<?php echo $Vars;?>')" class="form-horizontal" autocomplete="off" >
    <div class="modal fade" id="dataInsert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Adicionar Anticipo </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="datos_ajax_delete"></div>
                        </div>
                    </div>
                    <input id="FECHAREGISTRO" name="FECHAREGISTRO" type="hidden" value="">
                    <input id="NROPLACA" name="NROPLACA" type="hidden" value="">
                    <input id="FECHASISTEMA" name="FECHASISTEMA" type="hidden" value="<?=date('Y-m-d h:i:s')?>">
                    <input id="ID" name="ID" type="hidden">
                    
                    <input type="hidden" id="tabla" name="tabla" value="dependencia">
                    <div class="row">
                        <div class="col-md-2">ANTICIPO:</div>
                        <div class="col-md-3"> <input type="text"  name="ANTICIPO" id="ANTICIPO" class="form-control" data-validation="number" placeholder="" onkeypress="return NumCheck(event, this)"></div>
                    </div>
                   
                   
                </div>
                <div class="modal-footer">
                    <button type="button" id="close" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-close" aria-hidden="true"></i>
                        <span>Cancelar</span>
                    </button>
                    <button type="submit" id="save" class="btn btn-success">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                        <span>Guardar</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $('#dataInsert').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botón que activó el modal
        var fecha = button.data('fecha'); // Extraer la información de atributos de datos
         var nroplaca = button.data('nroplaca'); // Extraer la información de atributos de datos
          var anticipo = button.data('anticipo'); // Extraer la información de atributos de datos
        var modal = $(this);
        modal.find('#FECHAREGISTRO').val(fecha);
        modal.find('#NROPLACA').val(nroplaca);
        modal.find('#ANTICIPO').val(anticipo);
    });
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