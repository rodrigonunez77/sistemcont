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
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="../../Images/escudobolivia.png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SISTEMA WEB CONTABLE </title>


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
       //include 'editLiquidacion.php';
       //include 'delLiquidacion.php';
    ?>
    <style type="text/css">
         .minfield {
               max-width: 10px;
               border: 1px solid blue;
               overflow: hidden;
           }
    </style>
</head>

<body>
    <!-- /# inicio wrapper -->
    <div id="wrapper" >

         <!-- Navigation -->
       
        <!--Fin Navigation -->

        <!-- Body internal -->
        <form id="formNew" action="javascript:insertLiquidacion('formNew','save.php<?php echo $Vars;?>','listaLiquidacion.php<?php echo $Vars;?>')" class="form-horizontal" autocomplete="off" >
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header text-center">Liquidación</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Datos del conductor
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-md-3">
                                            <input type="date" class="form-control" placeholder="Fecha Registro" aria-label="Fecha" id="FECHAREGISTRO" name="FECHAREGISTRO" value="<?=date('Y-m-d')?>">
                                            <input id="FECHASISTEMA" name="FECHASISTEMA" type="hidden" class="form-control" value="<?=date('Y-m-d h:i:s')?>">
                                        </div>
                                        <div class="col-md-4 mb-md-3">
                                            <input type="text" class="form-control mayusculas" placeholder="Lugar" aria-label="Lugar" id="LUGARVIAJE" name="LUGARVIAJE">
                                        </div>
                                        <div class="col-md-4 mb-md-3">
                                            <input type="text" class="form-control mayusculas" placeholder="numero de placa" aria-label="numero de placa" id="NROPLACA" name="NROPLACA">
                                        </div>
                                    </div><br>    
                                    <div class="row">
                                        <div class="col-md-3 mb-md-3">
                                            <input type="text" class="form-control mayusculas"  data-validation="number" placeholder="Cedula de identidad" aria-label="" id="CI" name="CI" onblur="buscaPersonasLiq(this.value,'CARGADORPERSONAS','BUSCAPERSONAS','<?php echo $Vars;?>')"
                                         >
                                        </div>
                                        <div class="col-md-3 mb-md-3">
                                            <input type="text" id="NOMBRE" name="NOMBRE" class="form-control mayusculas" placeholder="Nombres"  >
                                        </div>
                                        <div class="col-md-3 mb-md-3">
                                            <input type="text" class="form-control mayusculas" placeholder="Ap. Paterno" aria-label=""  id="PATERNO" name="PATERNO">
                                        </div>
                                        <div class="col-md-3 mb-md-3">
                                            <input type="text" class="form-control mayusculas" placeholder="Ap. Materno" aria-label="" id="MATERNO" name="MATERNO">
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
                                              <td><input type="text"  name="td-localidad-1" id="td-localidad-1" class="form-control mayusculas" placeholder="Lugar"></td>
                                              <td><input type="text"  name="td-nropasajero-1" id="td-nropasajero-1" class="form-control" data-validation="number" placeholder="Nro. Pasajeros" onkeyup="calculaImporte(1)"></td>
                                              <td><input type="text"  name="td-costopasaje-1" id="td-costopasaje-1" class="form-control" placeholder="Costo Pasaje" onkeyup="calculaImporte(1)"></td>
                                              <td><input type="text"  name="td-importe-1" id="td-importe-1" class="form-control" placeholder="CALCULO AUTOMATICO" readonly></td>
                                            </tr>
                                            <tr >
                                              <th scope="row">2</th>
                                              <td><input type="text"  name="td-localidad-2" id="td-localidad-2" class="form-control mayusculas" placeholder="Lugar"></td>
                                              <td><input type="text"  name="td-nropasajero-2" id="td-nropasajero-2" class="form-control" placeholder="Nro. Pasajeros" onkeyup="calculaImporte(2)"></td>
                                              <td><input type="text"  name="td-costopasaje-2" id="td-costopasaje-2" class="form-control" placeholder="Costo Pasaje" onkeyup="calculaImporte(2)"></td>
                                              <td><input type="text"  name="td-importe-2" id="td-importe-2" class="form-control" placeholder="CALCULO AUTOMATICO" readonly></td>
                                            </tr>
                                            <tr >
                                              <th scope="row">3</th>
                                              <td><input type="text"  name="td-localidad-3" id="td-localidad-3" class="form-control mayusculas" placeholder="Lugar"></td>
                                              <td><input type="text"  name="td-nropasajero-3" id="td-nropasajero-3" class="form-control" placeholder="Nro. Pasajeros" onkeyup="calculaImporte(3)"></td>
                                              <td><input type="text"  name="td-costopasaje-3" id="td-costopasaje-3" class="form-control" placeholder="Costo Pasaje" onkeyup="calculaImporte(3)"></td>
                                              <td><input type="text"  name="td-importe-3" id="td-importe-3" class="form-control" placeholder="CALCULO AUTOMATICO" readonly></td>
                                            </tr>
                                            <tr >
                                              <th scope="row">4</th>
                                              <td><input type="text"  name="td-localidad-4" id="td-localidad-4" class="form-control mayusculas" placeholder="Lugar"></td>
                                              <td><input type="text"  name="td-nropasajero-4" id="td-nropasajero-4" class="form-control" placeholder="Nro. Pasajeros" onkeyup="calculaImporte(4)"></td>
                                              <td><input type="text"  name="td-costopasaje-4" id="td-costopasaje-4" class="form-control" placeholder="Costo Pasaje" onkeyup="calculaImporte(4)"></td>
                                              <td><input type="text"  name="td-importe-4" id="td-importe-4" class="form-control" placeholder="CALCULO AUTOMATICO" readonly></td>
                                            </tr>
                                            <tr >
                                              <th scope="row">5</th>
                                              <td><input type="text"  name="td-localidad-5" id="td-localidad-5" class="form-control mayusculas" placeholder="Lugar"></td>
                                              <td><input type="text"  name="td-nropasajero-5" id="td-nropasajero-5" class="form-control" placeholder="Nro. Pasajeros" onkeyup="calculaImporte(5)"></td>
                                              <td><input type="text"  name="td-costopasaje-5" id="td-costopasaje-5" class="form-control" placeholder="Costo Pasaje" onkeyup="calculaImporte(5)"></td>
                                              <td><input type="text"  name="td-importe-5" id="td-importe-5" class="form-control" placeholder="CALCULO AUTOMATICO" readonly></td>
                                            </tr>
                                            <tr >
                                              <th scope="row">6</th>
                                              <td><input type="text"  name="td-localidad-6" id="td-localidad-6" class="form-control mayusculas" placeholder="Lugar"></td>
                                              <td><input type="text"  name="td-nropasajero-6" id="td-nropasajero-6" class="form-control" placeholder="Nro. Pasajeros" onkeyup="calculaImporte(6)"></td>
                                              <td><input type="text"  name="td-costopasaje-6" id="td-costopasaje-6" class="form-control" placeholder="Costo Pasaje" onkeyup="calculaImporte(6)"></td>
                                              <td><input type="text"  name="td-importe-6" id="td-importe-6" class="form-control" placeholder="CALCULO AUTOMATICO" readonly></td>
                                            </tr>
                                            <tr >
                                              <th scope="row">7</th>
                                              <td><input type="text"  name="td-localidad-7" id="td-localidad-7" class="form-control mayusculas" placeholder="Lugar"></td>
                                              <td><input type="text"  name="td-nropasajero-7" id="td-nropasajero-7" class="form-control " placeholder="Nro. Pasajeros" onkeyup="calculaImporte(7)"></td>
                                              <td><input type="text"  name="td-costopasaje-7" id="td-costopasaje-7" class="form-control" placeholder="Costo Pasaje" onkeyup="calculaImporte(7)"></td>
                                              <td><input type="text"  name="td-importe-7" id="td-importe-7" class="form-control" placeholder="CALCULO AUTOMATICO" readonly></td>
                                              <td>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <img src="../../Images/mas.png" width="40%" class="imagen" title="Adicionar nueva ruta">
                                                    </div>
                                                    <div class="col-md-6">
                                                       <img src="../../Images/delete.png" width="40%" class="imagen" title="Eliminar fila"> 
                                                    </div>
                                                </div>
                                              </td>
                                              
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
                                                  <th scope="col" width="">Descripción</th>
                                                  <th scope="col" align="right" width="">Importe</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <tr >
                                                  <th scope="row">1</th>
                                                  <td><input type="text"  name="td-descripcion-1" id="td-descripcion-1" class="form-control" placeholder="IVA 13%" value="IVA 13%" readonly></td>
                                                  <td><input type="text"  name="td-descuento-1" id="td-descuento-1" class="form-control" placeholder="CALCULO AUTOMATICO"  readonly></td>
                                                </tr>
                                                <tr >
                                                  <th scope="row">2</th>
                                                  <td><input type="text"  name="td-descripcion-2" id="td-descripcion-2" class="form-control" placeholder="IT 3%" value="IT 3%" readonly></td>
                                                  <td><input type="text"  name="td-descuento-2" id="td-descuento-2" class="form-control" placeholder="CALCULO AUTOMATICO" readonly></td>
                                                </tr>
                                                <tr >
                                                  <th scope="row">3</th>
                                                  <td><input type="text"  name="td-descripcion-3" id="td-descripcion-3" class="form-control" placeholder="APORTE OF 8.4%" value="APORTE OF 8.4%" readonly></td>
                                                  <td><input type="text"  name="td-descuento-3" id="td-descuento-3" class="form-control" placeholder="CALCULO AUTOMATICO" readonly></td>
                                                </tr>
                                                <tr >
                                                  <th scope="row">4</th>
                                                  <td><input type="text"  name="td-descripcion-4" id="td-descripcion-4" class="form-control" placeholder="PRO ACCIDENTE" value="PRO ACCIDENTE" readonly></td>
                                                  <td><input type="text"  name="td-descuento-4" id="td-descuento-4" class="form-control" placeholder="20" readonly value="20"></td>
                                                </tr>
                                                <tr >
                                                  <th scope="row">5</th>
                                                  <td><input type="text"  name="td-descripcion-5" id="td-descripcion-5" class="form-control" placeholder="PRO DEPORTE" value="PRO DEPORTE" readonly ></td>
                                                  <td><input type="text"  name="td-descuento-5" id="td-descuento-5" class="form-control" placeholder="10" readonly value="10"></td>
                                                </tr>
                                                <tr >
                                                  <th scope="row">6</th>
                                                  <td><input type="text"  name="td-descripcion-6" id="td-descripcion-6" class="form-control" placeholder="PRO ALQUILER" value="PRO ALQUILER" readonly></td>
                                                  <td><input type="text"  name="td-descuento-6" id="td-descuento-6" class="form-control" placeholder="20" readonly value="20"></td>
                                                </tr>
                                                <tr >
                                                  <th scope="row">7</th>
                                                  <td><input type="text"  name="td-descripcion-7" id="td-descripcion-7" class="form-control" placeholder="APORTE PARA TRABAJO" value="APORTE PARA TRABAJO" readonly></td>
                                                  <td><input type="text"  name="td-descuento-7" id="td-descuento-7" class="form-control" placeholder="Importe" onkeyup="calculaLiquidoPagable()" ></td>
                                                  <td>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <img src="../../Images/mas.png" width="40%" class="imagen" title="Adicionar nuevo">
                                                        </div>
                                                        <div class="col-md-6">
                                                           <img src="../../Images/delete.png" width="40%" class="imagen" title="Eliminar fila"> 
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
            </div>

        </form>

        
        <!-- Fin  Body internal -->

         <!-- Pie de Pagina -->
        
        <!-- Fin de Pie de Pagina-->
    </div>
    <!-- /# Fin wrapper -->

</body>

</html>
<script language="javascript">

</script>

