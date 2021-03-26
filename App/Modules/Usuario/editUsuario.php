

<form id="formUpdate" action="javascript:updateFormImagen('formUpdate','update.php<?php echo $Vars;?>')" class="" autocomplete="off" enctype="multipart/form-data">
<div class="modal fade bs-example-modal-lg" id="dataUpdate" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog modal-lg" id="ModalCompraSIZE" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Modificar Usuario <span class="fecha">Fecha: <?=date("d/m/Y")?></span></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="datos_ajax_update"></div>
                    </div>
                </div>
                <div class="row">
                    <input id="FECHAU" name="FECHAU" type="hidden" value="<?=date("Y-m-d")?>" />
                    <input id="tabla" name="tabla" type="hidden" value="empleado">
                    <input id="IDPERSONA" name="IDPERSONA" type="hidden" >
                    <input id="IDUSUARIO" name="IDUSUARIO" type="hidden" >
                    <input id="PASSWORDUAUX" name="PASSWORDUAUX" type="hidden" >
                    <input id="DEPARTAMENTOU" name="DEPARTAMENTOU" type="hidden" value="">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-2 form-group">
                                <label for="ci" class="sr-only">N° C.I.:</label>
                                <input id="DNIU" name="DNIU" type="text" placeholder="N° C.I." class="form-control" onblur="buscaPersonas(this.value,'CARGADORPERSONAS','BUSCAPERSONAS')"
                                       data-validation="number"
                                       />
                                <div id="CARGADORPERSONAS" name="CARGADORPERSONAS"></div>
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="dep" class="sr-only">Lugar Exp.:</label>
                                <select id="EXPEDIDOU" name="EXPEDIDOU" class="form-control" data-validation="required">
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
                                <input id="NOMBREU" name="NOMBREU" type="text" placeholder="Nombre" class="form-control mayusculas" data-validation="required" autocomplete="off" />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="paterno" class="sr-only">Paterno:</label>
                                <input id="PATERNOU" name="PATERNOU" type="text" placeholder="Paterno" data-validation="required" class="form-control mayusculas" />
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="materno" class="sr-only">Materno:</label>
                                <input id="MATERNOU" name="MATERNOU" type="text" placeholder="Materno" data-validation="required" class="form-control mayusculas" />
                            </div>
                            
                        </div>
                        <div class="row">
                            
                            <div class="col-md-3 form-group">
                                <label for="dateNac" class="sr-only">Fecha de Nacimiento:</label>
                                <input id="FECHANACIMIENTOU" name="FECHANACIMIENTOU" type="date" placeholder="Fecha Nac." class="form-control" data-validation="date" data-validation-format="yyyy-mm-dd"/>
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="fono" class="sr-only">Telefono:</label>
                                <input id="TELEFONOOFICINAU" name="TELEFONOOFICINAU" type="text" placeholder="Telefono" class="form-control" data-validation="number" data-validation-optional-if-answered="celular"/>
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="celular" class="sr-only">Celular:</label>
                                <input id="TELEFONOU" name="TELEFONOU" type="text" placeholder="Celular" class="form-control" data-validation="number" data-validation-optional-if-answered="fono"/>
                            </div>
                            <div class="col-md-5 form-group">
                                <label for="email" class="sr-only">Correo Electronico:</label>
                                <input id="EMAILU" name="EMAILU" type="text" placeholder="Correo Electronico" value="" class="form-control minusculas" data-validation="email"/>
                            </div>
                        </div>

                        <div class="row">
                    
                            <div class="col-md-8 form-group">
                                <label for="addres" class="sr-only"></label>
                                <input id="DIRECCIONU" name="DIRECCIONU" type="text" placeholder="Direcci&oacute;n" class="form-control mayusculas" data-validation="required"/>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-5 form-group">
                                <label for="sucursal" class="sr-only">Trabaja en:</label>
                                <select style="font-size: 13px;" id="IDDEPENDENCIAU" name="IDDEPENDENCIAU" class="form-control" onchange="getBuscaLugar(this.value,'CARGADORU','BUSCALUGAR','IDLUGARU','<?php echo $Vars ?>')" data-validation="required" >
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
                                <div id="CARGADORU" name="CARGADORU"> </div>
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="sucursal" class="sr-only">Oficina:</label>
                                <select id="IDLUGARU" name="IDLUGARU" class="form-control" data-validation="required">
                                    <option value="" disabled selected hidden>Seleccione Lugar</option>
                                </select>
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="cargo" class="sr-only">Rol:</label>
                                <select id="CARGOU" name="CARGOU" class="form-control" data-validation="required">
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
                                <select id="ROLU" name="ROLU" class="form-control"  data-validation="required">
                                    <option value="" disabled selected hidden>Seleccione Nivel</option>
                                   <option value="1">1 (ADMIN)</option>
                                    <option value="2">2 (OPE)</option>
                                 
                                </select>
                                <div id="CARGADOR" name="CARGADOR"> </div>
                            </div>


                            <div class="col-md-2 form-group">
                                <label for="codUser" class="sr-only">Usuario:</label>
                                <input id="LOGINU" name="LOGINU" type="text" placeholder="Usuario" class="form-control"
                                       data-validation="required" />
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="password" class="sr-only">Contraseña:</label>
                                <input id="PASSWORDU" name="PASSWORDU" type="text" placeholder="Contraseña" value="**********" class="form-control" data-validation="required"/>
                            </div>
                            <div class="col-md-2 form-group">
                                 <div class="checkbox checkbox-primary">
                                    <input id="CHECKPASS" name="CHECKPASS" class="styled" type="checkbox" onclick="verificaPass()" >
                                    <label for="checkbox2">
                                        Cambiar Contraseña
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="cargo" class="sr-only">Estado:</label>
                                <select id="ESTADO" name="ESTADO" class="form-control"  data-validation="required">
                                
                                    <option value="A">Habilitado</option>
                                    <option value="I">Deshabilitado</option>
                            
                                </select>
                            
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="cargo" class="sr-only">Seleccione Sección:</label>
                                <label><input type="checkbox" id="CH-ADMIN" name="SECCION[]" value="A">&nbsp;&nbsp;ADMINISTRATIVO</label><br>
                                <label><input type="checkbox" id="CH-BOLE" name="SECCION[]" value="B">&nbsp;&nbsp;BOLETERIA</label><br>
                                <label><input type="checkbox" id="CH-ENCO" name="SECCION[]" value="E">&nbsp;&nbsp;ENCOMIENDA</label><br>
                            
                            </div>
                        
                        </div>      

                    </div>


                    <div class="col-md-3" align="center">
                        <!--<div class="">
                            <img class="img-responsive"   src="../../Images/Empleados/jorge.jpg"  >
                        </div>-->

                        <label for="IMAGENU" id="IMAGENP" >
                            
                        </label>
                        <div>
                            <p> Seleccione una foto</p>
                            <div class="form-group">
                                <input id="IMAGENU" name="IMAGENU" type="file" accept="image/x-png,image/jpeg"  multiple=true  >
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    
                </div>
                <div class="row">
                    <div class="col-md-9 form-group">
                        <label for="obser" class="sr-only"></label>
                        <p id="maxText" class="text-info"><span id="max-length-element-update">200</span> caracteres restantes</p>
                        <textarea id="OBSERVACIONU" name="OBSERVACIONU" cols="2" placeholder="Observaciones" class="form-control"></textarea>
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
                    <span>Actuaizar</span>
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
   
    $('#OBSERVACIONU').restrictLength( $('#max-length-element-update') );// para texarea observacion 

    $('#dataUpdate').on('shown.bs.modal', function () {
      //$('#DNI').focus()
    })

    $('#dataUpdate').on('hidden.bs.modal', function (e) {
        // do something...
        $('#formUpdate').get(0).reset();
    });

    $('#dataUpdate').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget); // Botón que activó el modal
    
        var modal = $(this);
        var idpersona=button.data('idpersona');
        var idusuario=button.data('idusuario');
        var dni=button.data('dni');
        var expedido=button.data('expedido');
         var departamento=button.data('departamento');
        var nombre=button.data('nombre');
        var paterno=button.data('paterno');
        var materno=button.data('materno');
        var fechaNacimiento=button.data('fechanacimiento');
        var telefono=button.data('telefono');
        var telefonoOficina=button.data('telefonooficina');
        var email=button.data('email');
        var direccion=button.data('direccion');
        var rol=button.data('rol');
        var idDependencia=button.data('iddependencia');
        var idLugar=button.data('idlugar');
        var login=button.data('login');
        var password=button.data('password');
        var imagen=button.data('imagen');
        var observacion=button.data('observacion');
        var cargo=button.data('cargo');
        var estado=button.data('estado');
        var seccion=button.data('seccion');

       getBuscaLugar(idDependencia,'CARGADORU','BUSCALUGAR','IDLUGARU','<?php echo $Vars ?>');
        modal.find('.modal-body #IDPERSONA').val(idpersona);
        modal.find('.modal-body #IDUSUARIO').val(idusuario);
        modal.find('.modal-body #DNIU').val(dni);// Extraer la información de atributos de datos
        modal.find('.modal-body #DEPARTAMENTOU').val(departamento);
        modal.find('.modal-body #EXPEDIDOU').val(expedido);
        modal.find('.modal-body #NOMBREU').val(nombre);
        modal.find('.modal-body #PATERNOU').val(paterno);
        modal.find('.modal-body #MATERNOU').val(materno);
        modal.find('.modal-body #FECHANACIMIENTOU').val(fechaNacimiento);
        modal.find('.modal-body #TELEFONOU').val(telefono);
        modal.find('.modal-body #TELEFONOOFICINAU').val(telefonoOficina);
        modal.find('.modal-body #EMAILU').val(email);
        modal.find('.modal-body #DIRECCIONU').val(direccion);
        modal.find('.modal-body #ROLU').val(rol);
        modal.find('.modal-body #IDDEPENDENCIAU').val(idDependencia);
        modal.find('.modal-body #IDLUGARU').val(idLugar);
        modal.find('.modal-body #LOGINU').val(login);
        modal.find('.modal-body #CARGOU').val(cargo);
        modal.find('.modal-body #PASSWORDU').val("*************");
        modal.find('.modal-body #PASSWORDUAUX').val(password);
        modal.find('.modal-body #ESTADO').val(estado);
        modal.find('.modal-body #IMAGENP').html("<img src='../../Images/Empleados/"+imagen+"' width='30%'> ");
        modal.find('.modal-body #OBSERVACIONU').val(observacion);
        if(seccion!=""){
            seccion=seccion.split('@');
            for(var i=0;i<seccion.length-1;i++){
                // modal.find('.modal-body #SECCION').val(seccion[i]);
                
                if(seccion[i]==   modal.find('.modal-body #CH-ADMIN').val()){
                  //alert(seccion[i]);
                   // $("#CH-ADMIN").prop("checked", true);
                    modal.find('.modal-body #CH-ADMIN').prop("checked", true);
                }
                if(seccion[i]==   modal.find('.modal-body #CH-BOLE').val()){
                  //alert(seccion[i]);
                   // $("#CH-ADMIN").prop("checked", true);
                    modal.find('.modal-body #CH-BOLE').prop("checked", true);
                }
                if(seccion[i]==   modal.find('.modal-body #CH-ENCO').val()){
                  //alert(seccion[i]);
                   // $("#CH-ADMIN").prop("checked", true);
                    modal.find('.modal-body #CH-ENCO').prop("checked", true);
                }
            }
        }
      //  alert(idDependencia);
       
    
    });

 });

$("#IMAGENU").fileinput({

    showCaption: false,
    browseClass: "btn btn-primary btn-lg",
    fileType: "any"
});
function verificaPass(){

    if ($('#CHECKPASS').is(':checked') ) {
        $("#PASSWORDU").attr("disabled", false);
        $("#PASSWORDU").val("");
    }
    else{
        $("#PASSWORDU").attr("disabled", true);
        $("#PASSWORDU").val("***************");
    }

}
$("#PASSWORDU").attr("disabled", true);


</script>