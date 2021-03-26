

<form id="formUpdate" action="javascript:updateForm('formUpdate','update.php<?php echo $Vars;?>')" class="" autocomplete="off" enctype="multipart/form-data">
<div class="modal fade bs-example-modal-lg" id="dataUpdate" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
   <div class="modal-dialog modal-lg" id="ModalCompraSIZE" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Modificar Comprobante de Egreso <span class="fecha"></span></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="datos_ajax_update"></div>
                    </div>
                </div>
                <div class="row">
                    <input id="FECHA" name="FECHA" type="hidden" value="<?=date("Y-m-d")?>" />
                    <input id="FECHASISTEMA" name="FECHASISTEMA" type="hidden" class="form-control" value="<?=date('Y-m-d h:i:s')?>">
                    <input id="tabla" name="tabla" type="hidden" value="empleado">
                    <input id="DESCRIPCIONU" name="DESCRIPCIONU" type="hidden" value="">
                    <input id="IDMOVIMIENTO" name="IDMOVIMIENTO" type="hidden" value="">
                    
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-1 form-group">
                                <label for="ci" class="">BS:</label>
                            </div>
                            <div class="col-md-2 form-group">
                                <input id="MONTOBS" name="MONTOBS" type="text" onblur="getConvertLetraMonto(this.value,'BUSCALETRAS','MONTOLITERALU','<?php echo $Vars ?>');copiaMomtoBsU(this.value);" placeholder="" class="form-control" 
                                       data-validation="" onkeypress="return NumCheck(event, this)"
                                       />

                                <div id="CARGADORPERSONAS" name="CARGADORPERSONAS"></div>
                            </div>

                            <div class="col-md-1 form-group">
                                <label for="ci" class="">NRO.:</label>
                            </div>
                            <div class="col-md-2 form-group">
                                
                                <input id="NRORECIBOEGRESO" name="NRORECIBOEGRESO" type="text" placeholder="0000001" class="form-control"  
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
                                <label for="fono" class="">Cancelado a:</label>
                            </div>

                            <div class="col-md-10 form-group">
                                <input id="NOMBREDESTINO" name="NOMBREDESTINO" type="text" placeholder="Nombre completo" class="form-control mayusculas" data-validation-optional-if-answered="celular" data-validation="required" />
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
                                <label for="sucursal" class="">Tipo Concepto:</label>
                            </div>
                            <div class="col-md-4 form-group">
                
                                <select style="font-size: 13px;" id="TIPOCONCEPTO" name="TIPOCONCEPTO" class="form-control" onchange="getCat(this.value,'BUSCACONCEPTO','CONCEPTOU','<?php echo $Vars ?>')" data-validation="required" >

                                         <option value="" disabled selected hidden>Seleccione  </option>
                                        <option value="OFICINA" >OFICINA</option>
                                         <option value="IMPOSITIVO" >IMPOSITIVO</option>

                                </select>
                                <div id="CARGADOR" name="CARGADOR"> </div>
                            </div>

                            <div class="col-md-2 form-group">
                                <label for="sucursal" class="">Seleccione Concepto</label>
                            </div>
                            <div class="col-md-4 form-group">
                            
                                <select id="CONCEPTOU" name="CONCEPTOU" onchange="asignaDescripcion(this.value)" class="form-control" data-validation="required">

                                </select>
                            </div>

                            
                        
                        </div>

                        <div class="row">
                            
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
                                      
  
                                </select>
                                <div id="CARGADOR" name="CARGADOR"> </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-2 form-group">
                                <label for="ci" class="">A cuenta:</label>
                            </div>
                            <div class="col-md-2 form-group">
                                <input id="ACUENTA" name="ACUENTA" type="text" onblur="" placeholder="" class="form-control" 
                                       data-validation="" readonly onkeypress="return NumCheck(event, this)"
                                       />

                            </div>

                            <div class="col-md-1 form-group">
                                <label for="ci" class="">Saldo:</label>
                            </div>
                            <div class="col-md-2 form-group">
                                <input id="SALDO" name="SALDO" type="text" onblur="" placeholder="" class="form-control" 
                                       data-validation="required" readonly value="" onkeypress="return NumCheck(event, this)"
                                       />

                            </div>

                            <div class="col-md-1 form-group">
                                <label for="ci" class="">Total:</label>
                            </div>
                            <div class="col-md-2 form-group">
                                <input id="TOTALBS" name="TOTALBS" type="text" onblur="calculaSaldoU(this.value)" placeholder="" class="form-control" 
                                       data-validation="" onkeypress="return NumCheck(event, this)"
                                       />

                            </div>
                            
                        </div>


                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="obser" class="sr-only"></label>
                            <p id="maxText" class="text-info"><span id="max-length-element-update">200</span> caracteres restantes</p>
                            <textarea id="OBSERVACION" name="OBSERVACION" cols="2" placeholder="Observaciones" class="form-control"></textarea>
                        </div>
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
   
    //$('#OBSERVACION').restrictLength( $('#max-length-element-update') );// para texarea observacion 

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
        var acuenta=button.data('acuenta');
        var saldo=button.data('saldo');
        var totalBs=button.data('totalbs');
        var nombreDestino=button.data('nombredestino');
        var tipoConcepto=button.data('tipoconcepto');
        var idConcepto=button.data('idconcepto');
        var concepto=button.data('concepto');
        var tipoPago=button.data('tipopago');
        var fecharegistro=button.data('fecharegistro');
        var nroreciboegreso=button.data('nroreciboegreso');
        var observacion=button.data('observacion');
        var idmovimiento=button.data('idmovimiento');
      // alert(saldo);
        modal.find('.modal-body #MONTOBS').val(montoBs);
        modal.find('.modal-body #ACUENTA').val(acuenta);
        modal.find('.modal-body #SALDO').val(saldo);
        modal.find('.modal-body #TOTALBS').val(totalBs);
        modal.find('.modal-body #NOMBREDESTINO').val(nombreDestino);
        modal.find('.modal-body #TIPOCONCEPTO').val(tipoConcepto);
        getCat(tipoConcepto,'BUSCACONCEPTO','CONCEPTOU','<?php echo $Vars ?>');
        setTimeout(function(){ modal.find('.modal-body #CONCEPTOU').val(idConcepto);
        }, 1000);
        //alert(tipoPago);
        modal.find('.modal-body #TIPOPAGO').val(tipoPago);
        modal.find('.modal-body #FECHAREGISTRO').val(fecharegistro);
        modal.find('.modal-body #NRORECIBOEGRESO').val("000"+nroreciboegreso);
        modal.find('.modal-body #OBSERVACION').val(observacion);
        modal.find('.modal-body #IDMOVIMIENTO').val(idmovimiento);

        getConvertLetraMonto(montoBs,'BUSCALETRAS','MONTOLITERALU','<?php echo $Vars ?>');
        
       $("#DESCRIPCIONU").val(concepto);
    });
    

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

function copiaMomtoBsU(valor){
    $("#ACUENTA").val(valor);

    var total=$("#TOTALBS").val();
    var acuenta=valor;
    
    if(total-acuenta>=0){
        $("#SALDO").val(total-acuenta); 
    }
    else{
        $("#SALDO").val("");
        //alert("Error! el Total no puede ser menor a cuenta a pagar"); 
    }

}
function calculaSaldoU(valor){
    var total=valor;
    var acuenta=$("#ACUENTA").val();

    if(total-acuenta>=0){
        $("#SALDO").val(total-acuenta); 
    }
    else{
        $("#SALDO").val("");    
        alert("Error! el Total no puede ser menor a cuenta a pagar");   
    }
    
}
</script>