<?php 
    /*
    *   CABECERA
    */
    require_once '../../Core/Components/App.inc.php';
    require_once $App->getPathSecurity().'Security.php';  
    Security::ValidSession();
    /*  Datos del ususario  */
    $rol = Security::decrypt($_SESSION['ROLES']);
    /* VarsEnviroment   */
    $Vars = "?SID=".$_GET["SID"]."&SESION=".$_GET["SESION"]."&R=".$_GET["R"];
    /*
    *   FIN CABECERA 
    */


    require_once $App->getPathPages()."Categoria/static.CategoriasList.php";
    require_once $App->getPathDomain()."lib.Table.php";
    date_default_timezone_set('America/Asuncion');
    //$DataC=CategoriasList::getList();
    
    $Data=Table::getListQuery("select * from liquidacion");
    $DataLugar=Table::getListQuery("select * from ruta");
    $conTextFecha="";
    if($_SESSION['NIVEL']=='2'){
       $conTextFecha="readonly";
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="../../Images/escudobolivia.png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SISTEMA WEB CONTABLE </title>
    <style type="text/css">
        /*.embed-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
        }
        .embed-container iframe {
            position: absolute;
            top:0;
            left: 0;
            width: 100%;
            height: 70%;
        }*/
    </style>

    <!-- Bootstrap Core CSS -->
    <link href="../../Core/Design/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../Core/Design/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

     <!-- Custom CSS -->
    <link href="../../Core/Design/dist/css/sb-admin-2.css" rel="stylesheet">

      <!-- Morris Charts CSS -->
    <link href="../../Core/Design/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../Core/Design/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

   
    <!-- DataTables CSS -->
    <link href="../../Core/Design/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../../Core/Design/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!--  para el mensaje de error y y para el stylo de letras mayusculas -->
    <link href="../../Core/Design/css complement/page-styles.css" rel="stylesheet">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
     <!-- jQuery -->
    <script src="../../Core/Design/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../Core/Design/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../Core/Design/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../Core/Design/dist/js/sb-admin-2.js"></script>
    
    <!-- DataTables JavaScript -->
    <script src="../../Core/Design/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../Core/Design/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../../Core/Design/vendor/datatables-responsive/dataTables.responsive.js"></script>
    <!--  para el cargador de la pagina y la funcion de validar numeros -->
    <script type="text/javascript" src="../../Core/Design/javascript complemet/Loader.js"></script>       
    <script type="text/javascript" src="../../Core/Design/javascript complemet/Common.js"></script>
    <!-- angular js -->
    <script type="text/javascript" src="../../Core/Design/javascript complemet/angular.min.js"></script>

    <!-- script formulario controlador  -->
    <script type="text/javascript" src="../../Core/Design/javascript complemet/jquery.form-validator.js"></script>
    
    <!-- script controlador  -->
    <script type="text/javascript" src="../../Core/Pages/Controller/jquery.json-2.3.js"></script>
    <script type="text/javascript" src="../../Core/Pages/Controller/myJavaScript.js"></script>

    <?php
      // include 'newLiquidacion.php';
      // include 'editLiquidacion.php';
       //include 'delLiquidacion.php';
    ?>
    <style type="text/css">
         .minfield {
               max-width: 10px;
               border: 1px solid blue;
               overflow: hidden;
           }

           .imagen:hover {filter: opacity(.5);}
    </style>

</head>
<body>
    <!-- /# inicio wrapper -->
    <div id="wrapper" >

         <!-- Navigation -->
        <?php
            require_once($App->getPathModules()."Principal/Menu.html");
        ?>
        <!--Fin Navigation -->

        <!-- Body internal -->
  
        <div class="embed-container">
            <!--<iframe src="index_.php<?php echo $Vars?>" frameborder="0" allowfullscreen></iframe>
            -->

             <form id="formNew" action="javascript:insertLiquidacion('formNew','save.php<?php echo $Vars;?>','listaLiquidacion.php<?php echo $Vars;?>')" class="form-horizontal" autocomplete="off" >
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header text-center">Liquidaci??n</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Datos del Propietario
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-md-3">
                                            <input type="date" class="form-control" placeholder="Fecha Registro" aria-label="Fecha" id="FECHAREGISTRO" name="FECHAREGISTRO" value="<?=date('Y-m-d')?>"  <?=$conTextFecha;?> >
                                            <input id="FECHASISTEMA" name="FECHASISTEMA" type="hidden" class="form-control" data-validation="date"  value="<?=date('Y-m-d h:i:s')?>">
                                        </div>
                                        <div class="col-md-4 mb-md-3">
                                            <input type="text" class="form-control mayusculas" placeholder="Lugar" aria-label="Lugar" id="LUGARVIAJE" name="LUGARVIAJE" data-validation="required" list="datalist1" >
                                        </div>
                                        <div class="col-md-4 mb-md-3">
                                            <input type="text" class="form-control mayusculas" placeholder="numero de placa" aria-label="numero de placa" id="NROPLACA" name="NROPLACA" data-validation="required">
                                        </div>
                                    </div><br>    
                                    <div class="row">
                                        <div class="col-md-3 mb-md-3">
                                            <input type="text" class="form-control mayusculas"  data-validation="required" placeholder="Cedula de identidad" aria-label="" id="CI" name="CI" onblur="buscaPersonasLiq(this.value,'CARGADORPERSONAS','BUSCAPERSONAS','<?php echo $Vars;?>')"
                                         >
                                        </div>
                                        <div class="col-md-3 mb-md-3">
                                            <input type="text" id="NOMBRE" name="NOMBRE" class="form-control mayusculas" data-validation="required"  placeholder="Nombres"  >
                                        </div>
                                        <div class="col-md-3 mb-md-3">
                                            <input type="text" class="form-control mayusculas" placeholder="Ap. Paterno" aria-label=""  id="PATERNO" name="PATERNO" data-validation="required">
                                        </div>
                                        <div class="col-md-3 mb-md-3">
                                            <input type="text" class="form-control mayusculas" placeholder="Ap. Materno" aria-label="" id="MATERNO" name="MATERNO" data-validation="">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Datos del Conductor
                                </div>
                                <div class="panel-body">
                                       
                                    <div class="row">
                                        <div class="col-md-3 mb-md-3">
                                            <input type="text" class="form-control mayusculas"  data-validation="" placeholder="Cedula de identidad" aria-label="" id="CICHOFER" name="CICHOFER" onblur="buscaPersonasLiqCho(this.value,'CARGADORPERSONAS','BUSCAPERSONASCHOFER','<?php echo $Vars;?>')"
                                         >
                                        </div>
                                        <div class="col-md-3 mb-md-3">
                                            <input type="text" id="NOMBRECHOFER" name="NOMBRECHOFER" class="form-control mayusculas" placeholder="Nombres"  data-validation="" >
                                        </div>
                                        <div class="col-md-3 mb-md-3">
                                            <input type="text" class="form-control mayusculas" placeholder="Ap. Paterno" aria-label=""  id="PATERNOCHOFER" name="PATERNOCHOFER" data-validation="">
                                        </div>
                                        <div class="col-md-3 mb-md-3">
                                            <input type="text" class="form-control mayusculas" placeholder="Ap. Materno" aria-label="" id="MATERNOCHOFER" name="MATERNOCHOFER" data-validation="">
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!-- /.col-md-12 -->
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Detalle destinos
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <table class="table" id="TR__">
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
                                              <td><input type="text"  name="td-localidad-1" id="td-localidad-1" class="form-control mayusculas" list="datalist1" placeholder="Lugar" >
                                                <datalist id="datalist1">
                                                 <?php
                                                    foreach ($DataLugar as $key => $value) {
                                                         echo"<option id='".$value['DESCRIPCION']."' value='".$value['DESCRIPCION']."'> 

                                                         </option>";                                      
                                                    }
                                                 ?>
                                                </datalist>  

                                              </td>
                                              <td><input type="text"  name="td-nropasajero-1" id="td-nropasajero-1" class="form-control" data-validation="number" placeholder="Nro. Pasajeros" onkeyup="calculaImporte(1)" onkeypress="return NumCheck(event, this)"></td>
                                              <td><input type="text"  name="td-costopasaje-1" id="td-costopasaje-1" class="form-control" placeholder="Costo Pasaje" onkeyup="calculaImporte(1)" onkeypress="return NumCheck(event, this)"></td>
                                              <td><input type="text"  name="td-importe-1" id="td-importe-1" class="form-control" placeholder="CALCULO AUTOMATICO" readonly></td>
                                            </tr>
                                            <tr >
                                              <th scope="row">2</th>
                                              <td><input type="text"  name="td-localidad-2" id="td-localidad-2" class="form-control mayusculas" placeholder="Lugar" list="datalist1"></td>
                                              <td><input type="text"  name="td-nropasajero-2" id="td-nropasajero-2" class="form-control" placeholder="Nro. Pasajeros" onkeyup="calculaImporte(2)" onkeypress="return NumCheck(event, this)"></td>
                                              <td><input type="text"  name="td-costopasaje-2" id="td-costopasaje-2" class="form-control" placeholder="Costo Pasaje" onkeyup="calculaImporte(2)" onkeypress="return NumCheck(event, this)"></td>
                                              <td><input type="text"  name="td-importe-2" id="td-importe-2" class="form-control" placeholder="CALCULO AUTOMATICO" readonly></td>
                                            </tr>
                                            <tr >
                                              <th scope="row">3</th>
                                              <td><input type="text"  name="td-localidad-3" id="td-localidad-3" class="form-control mayusculas" placeholder="Lugar" list="datalist1"></td>
                                              <td><input type="text"  name="td-nropasajero-3" id="td-nropasajero-3" class="form-control" placeholder="Nro. Pasajeros" onkeyup="calculaImporte(3)" onkeypress="return NumCheck(event, this)"></td>
                                              <td><input type="text"  name="td-costopasaje-3" id="td-costopasaje-3" class="form-control" placeholder="Costo Pasaje" onkeyup="calculaImporte(3)" onkeypress="return NumCheck(event, this)"></td>
                                              <td><input type="text"  name="td-importe-3" id="td-importe-3" class="form-control" placeholder="CALCULO AUTOMATICO" readonly></td>
                                            </tr>
                                            <tr >
                                              <th scope="row">4</th>
                                              <td><input type="text"  name="td-localidad-4" id="td-localidad-4" class="form-control mayusculas" placeholder="Lugar" list="datalist1"></td>
                                              <td><input type="text"  name="td-nropasajero-4" id="td-nropasajero-4" class="form-control" placeholder="Nro. Pasajeros" onkeyup="calculaImporte(4)" onkeypress="return NumCheck(event, this)"></td>
                                              <td><input type="text"  name="td-costopasaje-4" id="td-costopasaje-4" class="form-control" placeholder="Costo Pasaje" onkeyup="calculaImporte(4)" onkeypress="return NumCheck(event, this)"> </td>
                                              <td><input type="text"  name="td-importe-4" id="td-importe-4" class="form-control" placeholder="CALCULO AUTOMATICO" readonly></td>
                                            </tr>
                                            <tr >
                                              <th scope="row">5</th>
                                              <td><input type="text"  name="td-localidad-5" id="td-localidad-5" class="form-control mayusculas" placeholder="Lugar" list="datalist1"></td>
                                              <td><input type="text"  name="td-nropasajero-5" id="td-nropasajero-5" class="form-control" placeholder="Nro. Pasajeros" onkeyup="calculaImporte(5)" onkeypress="return NumCheck(event, this)"></td>
                                              <td><input type="text"  name="td-costopasaje-5" id="td-costopasaje-5" class="form-control" placeholder="Costo Pasaje" onkeyup="calculaImporte(5)" onkeypress="return NumCheck(event, this)"></td>
                                              <td><input type="text"  name="td-importe-5" id="td-importe-5" class="form-control" placeholder="CALCULO AUTOMATICO" readonly></td>
                                            </tr>
                                            <tr >
                                              <th scope="row">6</th>
                                              <td><input type="text"  name="td-localidad-6" id="td-localidad-6" class="form-control mayusculas" placeholder="Lugar" list="datalist1" ></td>
                                              <td><input type="text"  name="td-nropasajero-6" id="td-nropasajero-6" class="form-control" placeholder="Nro. Pasajeros" onkeyup="calculaImporte(6)" onkeypress="return NumCheck(event, this)"></td>
                                              <td><input type="text"  name="td-costopasaje-6" id="td-costopasaje-6" class="form-control" placeholder="Costo Pasaje" onkeyup="calculaImporte(6)" onkeypress="return NumCheck(event, this)"></td>
                                              <td><input type="text"  name="td-importe-6" id="td-importe-6" class="form-control" placeholder="CALCULO AUTOMATICO" readonly></td>
                                            </tr>
                                            <tr >
                                              <th scope="row">7</th>
                                              <td><input type="text"  name="td-localidad-7" id="td-localidad-7" class="form-control mayusculas" placeholder="Lugar" list="datalist1"></td>
                                              <td><input type="text"  name="td-nropasajero-7" id="td-nropasajero-7" class="form-control " placeholder="Nro. Pasajeros" onkeyup="calculaImporte(7)" onkeypress="return NumCheck(event, this)"></td>
                                              <td><input type="text"  name="td-costopasaje-7" id="td-costopasaje-7" class="form-control" placeholder="Costo Pasaje" onkeyup="calculaImporte(7)" onkeypress="return NumCheck(event, this)"></td>
                                              <td><input type="text"  name="td-importe-7" id="td-importe-7" class="form-control" placeholder="CALCULO AUTOMATICO" readonly></td>
                                              <td>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <img src="../../Images/mas.png" width="40%" class="imagen" title="Adicionar nueva ruta" onclick="AdicionarFila()">
                                                    </div>
                                                   <!-- <div class="col-md-6">
                                                       <img src="../../Images/delete.png" width="40%" class="imagen" title="Eliminar fila"> 
                                                    </div>
                                                  -->
                                                </div>
                                              </td>
                                              
                                            </tr>

                                            <tr id="" >
                                              
                                            </tr>

                                          </tbody>
                                        </table>
                                        <div class="row">
                                             <div class="col-md-10" align="right">
                                                    TOTAL RECAUDADO: <input type="text" name="TOTALRECAUDADO" id="TOTALRECAUDADO" size="5" value="" readonly >
                                                </div>
                                             </div>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-md-12 -->
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Detalle descuentos
                                </div>
                              
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table">
                                              <thead class="thead-dark">
                                                <tr>
                                                  <th scope="col" width="" >#</th>
                                                  <th scope="col" width="">Descripci??n</th>
                                                  <th scope="col" align="right" width="">Importe</th>
                                                </tr>
                                              </thead>
                                              <tbody id="tr-descuento">
                                                <tr >
                                                  <th scope="row">1</th>
                                                  <td><input type="text"  name="td-descripcion-1" id="td-descripcion-1" class="form-control" placeholder="IVA 13%" value="IVA 13%" readonly></td>
                                                  <td><input type="text"  name="td-descuento-1" id="td-descuento-1" class="form-control" placeholder="CALCULO AUTOMATICO"  >
                                                    <input type="hidden"  name="td-categoria-1" id="td-categoria-1" class="form-control" value="1">

                                                  </td>
                                                </tr>
                                                <tr >
                                                  <th scope="row">2</th>
                                                  <td><input type="text"  name="td-descripcion-2" id="td-descripcion-2" class="form-control" placeholder="IT 3%" value="IT 3%" readonly></td>
                                                  <td><input type="text"  name="td-descuento-2" id="td-descuento-2" class="form-control" placeholder="CALCULO AUTOMATICO" >
                                                  <input type="hidden"  name="td-categoria-2" id="td-categoria-2" class="form-control" value="1">
                                              </td>
                                                </tr>
                                                <tr >
                                                  <th scope="row">3</th>
                                                  <td>
                                        
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <input type="text"  name="td-descripcion-3" id="td-descripcion-3" class="form-control" placeholder="APORTE OF" value="APORTE OFICINA" readonly >
                                                        </div>
                                                        <div class="col-md-3"> 
                                                            <input type="text"  name="td-porcentaje-3" id="td-porcentaje-3" class="form-control" placeholder="%" value="8.4
                                                            " onkeyup="calculaPorcentaje(this.value); calculaLiquidoPagable();"  >
                                                            
                                                        </div>
                                                        <div class="col-md-2">
                                                            % 
                                                        </div>
                                                       

                                                    </div>
                                                 </td>
                                                  <td><input type="text"  name="td-descuento-3" id="td-descuento-3" class="form-control" placeholder="CALCULO AUTOMATICO" readonly>
                                                  <input type="hidden"  name="td-categoria-3" id="td-categoria-3" class="form-control" value="2">
                                              </td>
                                                </tr>
                                                <tr >
                                                  <th scope="row">4</th>
                                                  <td><input type="text"  name="td-descripcion-4" id="td-descripcion-4" class="form-control" placeholder="PRO ACCIDENTE" value="PRO ACCIDENTE" readonly></td>
                                                  <td><input type="text"  name="td-descuento-4" id="td-descuento-4" class="form-control" placeholder="20"  value="20"  onkeyup="calculaLiquidoPagable();">
                                                  <input type="hidden"  name="td-categoria-4" id="td-categoria-4" class="form-control" value="2">
                                              </td>
                                                </tr>
                                                <tr >
                                                  <th scope="row">5</th>
                                                  <td><input type="text"  name="td-descripcion-5" id="td-descripcion-5" class="form-control" placeholder="PRO DEPORTE" value="PRO DEPORTE" readonly ></td>
                                                  <td><input type="text"  name="td-descuento-5" id="td-descuento-5" class="form-control" placeholder="10"  value="10"  onkeyup="calculaLiquidoPagable();">
                                                  <input type="hidden"  name="td-categoria-5" id="td-categoria-5" class="form-control" value="2">
                                              </td>
                                                </tr>
                                                <tr >
                                                  <th scope="row">6</th>
                                                  <td><input type="text"  name="td-descripcion-6" id="td-descripcion-6" class="form-control" placeholder="PRO ALQUILER" value="PRO ALQUILER" readonly></td>
                                                  <td><input type="text"  name="td-descuento-6" id="td-descuento-6" class="form-control" placeholder="20"  value="20"  onkeyup="calculaLiquidoPagable();">
                                                    <input type="hidden"  name="td-categoria-6" id="td-categoria-6" class="form-control" value="2"></td>
                                                </tr>
                                                <tr >
                                                  <th scope="row">7</th>
                                                  <td><input type="text"  name="td-descripcion-7" id="td-descripcion-7" class="form-control" placeholder="MULTA FISCALIZACI??N " value="MULTA FISCALIZACI??N" readonly></td>
                                                  <td><input type="text"  name="td-descuento-7" id="td-descuento-7" class="form-control" placeholder="Importe" onkeyup="calculaLiquidoPagable()" onkeypress="return NumCheck(event, this)">
                                                  <input type="hidden"  name="td-categoria-7" id="td-categoria-7" class="form-control" value="3">
                                                  </td>
                                                  <td>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <img src="../../Images/mas.png" width="40%" class="imagen" title="Adicionar nuevo" onclick="AdicionarFilaDesc()">
                                                        </div>
                                                    </div>
                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>
                                            <hr>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-9" align="right">
                                                TOTAL DESCUENTO: <input type="text" name="TOTALDESCUENTO" id="TOTALDESCUENTO" size="5" value="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                            </div>

                        </div>
                        <div class="col-md-4"> 
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                        Liquido Pagable
                                </div>
                                  
                                <div class="panel-body">
                                    <div align="center" >
                                       <strong > <h3 style="flood-color: blue"><input type="text" name="LIQUIDOPAGABLE" id="LIQUIDOPAGABLE" value="" size="6" readonly > </span> </h3> </strong> 
                                    </div>
                                    
                                    <br>

                                    <div class="modal-footer">
                                        <button type="button" id="close" class="btn btn-danger" data-dismiss="modal" onclick="lipiarFormulario()">
                                            <i class="fa fa-close" aria-hidden="true"></i>
                                            <span>Cancelar</span>
                                        </button>
                                        <button type="submit" id="save" class="btn btn-success">
                                          <i class="fa fa-check" aria-hidden="true"></i>
                                          <span>Guardar Registro</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-md-12 -->
                    </div>
                </div>
            </div><!-- WRAPPER -->

        </form>

        </div>

        <!-- Fin  Body internal -->

         <!-- Pie de Pagina -->
        <div> 
            <?php require_once($App->getPathModules()."Principal/Pie.html") ?>
        </div>
        <!-- Fin de Pie de Pagina-->
    </div>
    <!-- /# Fin wrapper -->

</body>

</html>
<script>
  $(document).ready(function(e) {
        $.validate({
            lang: 'es',
            modules : 'security, modules/logic'
        });

        $('#dataTables-categoria').DataTable({
            "oLanguage": {
                "sUrl": "../../Core/Design/media/js/datatable.spanish.txt"                        
            },
            responsive: true

        });
    });

    function calculaPorcentaje(porcentaje){
       
       var porcentajeOficina =(($("#TOTALRECAUDADO").val()*porcentaje)/100).toFixed(2);

       $("#td-descuento-3").val(porcentajeOficina);
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

