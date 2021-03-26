

<form id="formUpdate" action="javascript:updateFormImagen('formUpdate','update.php<?php echo $Vars;?>')" class="" autocomplete="off" enctype="multipart/form-data">
<div class="modal fade bs-example-modal-lg" id="dataUpdate" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    
    <div class="modal-dialog modal-lg" id="ModalCompraSIZE" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Modificar Recibo de Ingreso <span class="fecha">Fecha: <?=date("d/m/Y")?></span></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="datos_ajax_update"></div>
                    </div>
                </div>
                <div class="row">
                    <input id="FECHA" name="FECHA" type="hidden" value="<?=date("Y-m-d")?>" />
                    <input id="tabla" name="tabla" type="hidden" value="">
                    <input id="DESCRIPCIONU" name="DESCRIPCIONU" type="hidden" value="">
                    <input id="IDMOVIMIENTO" name="IDMOVIMIENTO" type="hidden" value="">
                    
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-1 form-group">
                                <label for="ci" class="">BS:</label>
                            </div>
                            <div class="col-md-2 form-group">
                                <input id="MONTOBS" name="MONTOBS" type="text" onblur="getConvertLetraMonto(this.value,'BUSCALETRAS','MONTOLITERALU','<?php echo $Vars ?>')" placeholder="" class="form-control" 
                                       data-validation="" onkeypress="return NumCheck(event, this)"
                                       />

                                <div id="CARGADORPERSONAS" name="CARGADORPERSONAS"></div>
                            </div>

                            <div class="col-md-1 form-group">
                                <label for="ci" class="">NRO.:</label>
                            </div>
                            <div class="col-md-2 form-group">
                                
                                <input id="NRORECIBOINGRESO" name="NRORECIBOINGRESO" type="text" placeholder="00000001" class="form-control"  
                                       data-validation="number"
                                       />
                            </div>
                            <div class="col-md-1 form-group">
                                <label for="dateNac" class="">FECHA:</label>
                            </div>
                            <div class="col-md-3 form-group">
                        
                                <input id="FECHAREGISTRO" name="FECHAREGISTRO" type="date" placeholder="" class="form-control" data-validation="date" data-validation-format="yyyy-mm-dd" value="<?=date("Y-m-d")?>" />
                            </div>
                            
                        </div>
                        <div class="row">

                            <div class="col-md-2 form-group">
                                <label for="fono" class="">Recibido de:</label>
                            </div>

                            <div class="col-md-10 form-group">
                                <input id="NOMBREORIGEN" name="NOMBREORIGEN" type="text" placeholder="Nombre completo" class="form-control mayusculas" data-validation="required" data-validation-optional-if-answered="celular"/>
                            </div>
                            
                        </div>

                        <div class="row">

                            <div class="col-md-2 form-group">
                                <label for="fono" class="">La suma de:</label>
                            </div>

                            <div class="col-md-10 form-group">
                                <input id="MONTOLITERALU" name="MONTOLITERALU" type="text" placeholder="Nombre monto" readonly class="form-control" data-validation-optional-if-answered="celular"/>
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
                            <p id="maxText" class="text-info"><span id="max-length-element-update">200</span> caracteres restantes</p>
                            <textarea id="OBSERVACION" name="OBSERVACION" cols="2" placeholder="Observaciones" class="form-control"></textarea>
                        </div>
                        
                     
                    </div>  
                    <div class="col-md-4">
                        <label for="IMAGENU" id="IMAGENP" >
                                
                        </label>
                    
                        <p> Seleccione una foto</p>
                        <div class="form-group">
                            <input id="IMAGENU" name="IMAGENU" type="file" accept="image/x-png,image/jpeg"  multiple=true  >
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
                    <span>Modificar</span>
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

    $('#dataUpdate').on('shown.bs.modal', function (event) {
       var modal = $(this);
       modal.find('.modal-body #OBSERVACION').restrictLength( $('#max-length-element-update') );

    })

    $('#dataUpdate').on('hidden.bs.modal', function (e) {
        // do something...
        $('#formUpdate').get(0).reset();
    });

    $('#dataUpdate').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget); // Botón que activó el modal
    
        var modal = $(this);
        var montoBs=button.data('montobs');
        var nombreorigen=button.data('nombreorigen');
        var tipoConcepto=button.data('tipoconcepto');
        var idConcepto=button.data('idconcepto');
        var concepto=button.data('concepto');
        var tipoPago=button.data('tipopago');
        var fecharegistro=button.data('fecharegistro');
        var nroreciboingreso=button.data('nroreciboingreso');
        var observacion=button.data('observacion');
        var idmovimiento=button.data('idmovimiento');
        var imagen=button.data('imagen');
        var estado=button.data('estado');
       
        modal.find('.modal-body #MONTOBS').val(montoBs);
        modal.find('.modal-body #NOMBREORIGEN').val(nombreorigen);
        modal.find('.modal-body #TIPOCONCEPTO').val(tipoConcepto);
        getCat(tipoConcepto,'BUSCACONCEPTO','CONCEPTOU','<?php echo $Vars ?>');
        setTimeout(function(){ modal.find('.modal-body #CONCEPTOU').val(idConcepto);
        }, 1000);
        //alert(tipoPago);
        modal.find('.modal-body #TIPOPAGO').val(tipoPago);
        modal.find('.modal-body #FECHAREGISTRO').val(fecharegistro);
        modal.find('.modal-body #NRORECIBOINGRESO').val("000"+nroreciboingreso);
        modal.find('.modal-body #OBSERVACION').val(observacion);
        modal.find('.modal-body #IDMOVIMIENTO').val(idmovimiento);

        getConvertLetraMonto(montoBs,'BUSCALETRAS','MONTOLITERALU','<?php echo $Vars ?>');

        modal.find('.modal-body #IMAGENP').html("<img src='../../Images/Depositos/"+imagen+"' width='30%'> ");
        modal.find('.modal-body #CONCEPTO').val(concepto);
        modal.find('.modal-body #ESTADO').val(estado);

    
    });

 });

$("#IMAGENU").fileinput({

    showCaption: false,
    browseClass: "btn btn-primary btn-lg",
    fileType: "any"
});

function asignaDescripcion(valor){

    //alert($("#CONCEPTO").val();
    $("#DESCRIPCIONU").val($("#CONCEPTOU").find('option:selected').text());

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