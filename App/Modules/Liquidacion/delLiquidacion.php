<form id="formDelete" action="javascript:fDelete('formDelete','delete.php<?php echo $Vars;?>')" class="form-horizontal" autocomplete="off" >
    <div class="modal fade" id="dataDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Eliminar Liquidación</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="datos_ajax_delete"></div>
                        </div>
                    </div>
                    <input id="FECHAREGISTRO" name="FECHAREGISTRO" type="hidden" value="<?=date('Y-m-d')?>">
                    <input id="FECHASISTEMA" name="FECHASISTEMA" type="hidden" value="<?=date('Y-m-d h:i:s')?>">
                    <input id="ID" name="ID" type="hidden">
                    
                    <input type="hidden" id="tabla" name="tabla" value="dependencia">
                    <div class="alert alert-warning" role="alert"><p><strong>Advertencia!</strong> está seguro que desea eliminar </p></div>

                </div>
                <div class="modal-footer">
                    <button type="button" id="close" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-close" aria-hidden="true"></i>
                        <span>Cancelar</span>
                    </button>
                    <button type="submit" id="save" class="btn btn-success">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                        <span>Eliminar</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $('#dataDelete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botón que activó el modal
        var id = button.data('id'); // Extraer la información de atributos de datos
        var modal = $(this);
        modal.find('#ID').val(id);
    });
   
 
</script>