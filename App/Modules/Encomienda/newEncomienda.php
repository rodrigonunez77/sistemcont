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
    <!-- Styles -->
    <!-- complemento de tabla editable -->

  <!--// complemento de tabla editable -->



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

             <form id="formNew" action="javascript:insertEncomienda('formNew','save.php<?php echo $Vars;?>','listaEncomienda.php<?php echo $Vars;?>','newEncomienda.php<?php echo $Vars;?>')" class="form-horizontal" autocomplete="off" >
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header text-center">Manifiesto De Encomiendas</h1>
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
                                             <input id="TABLAENCOMIENDA" name="TABLAENCOMIENDA" type="hidden" class="form-control">
                                        </div>
                                        <div class="col-md-2 mb-md-2">
                                            <input type="text" class="form-control mayusculas" placeholder="Nro. De Encomienda " aria-label="Lugar" id="NROENCOMIENDA" name="NROENCOMIENDA" data-validation="required" >
                                        </div>
                                        
                                    </div><br>    
                                    <div class="row">
                                        <div class="col-md-3 mb-md-3">
                                            <input type="text" class="form-control mayusculas"  data-validation="required" placeholder="Bus. Nº" aria-label="" id="NROBUS" name="NROBUS" onblur=""
                                         >
                                        </div>
                                        <div class="col-md-3 mb-md-3">
                                            <input type="text" id="NROPLACA" name="NROPLACA" class="form-control mayusculas" data-validation="required"  placeholder="Nro. Placa"  >
                                        </div>
                                        <div class="col-md-5 mb-md-5">
                                            <input type="text" class="form-control mayusculas" placeholder="Localidad" aria-label=""  id="LOCALIDAD" name="LOCALIDAD" data-validation="required">
                                        </div>
                                        
                                    </div><br> 
                                    <div class="row">
                                        <div class="col-md-3 mb-md-3">
                                            <input type="text" class="form-control mayusculas"  data-validation="required" placeholder="Conductor" aria-label="" id="CONDUCTOR" name="CONDUCTOR" 
                                         >
                                        </div>
                                        <div class="col-md-3 mb-md-3">
                                            <input type="text" id="NROLICENCIA" name="NROLICENCIA" class="form-control mayusculas" data-validation="required"  placeholder="Nro Licencia"  >
                                        </div>
                                        <div class="col-md-3 mb-md-3">
                                            <input type="text" class="form-control mayusculas" placeholder="Relevo" aria-label=""  id="RELEVO" name="RELEVO" data-validation="required">
                                        </div>
                                        <div class="col-md-3 mb-md-3">
                                            <input type="text" class="form-control mayusculas" placeholder="Nro Licencia Relevo" aria-label="" id="NROLICENCIAREV" name="NROLICENCIAREV" data-validation="required">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Detalle Encomiendas
                                </div>
                                <div class="panel-body">
                                   <div class="table-content">
                                    <table class="table-responsive" id="table-list" name="table-list">
                                        <thead class="table-dark">
                                            <tr>
                                                <td></td>
                                                <td>Nº Guia </td>
                                                <td>Remitente</td>
                                                <td>Nº Bulto </td>
                                                <td>Consignatario</td>
                                                <td>CI</td>
                                                <td>Contenido</td>
                                                <td>IMP. Pagado</td>
                                                <td>IMP: X Pagar</td>
                                                <td>Factura</td>
                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                              
                                            </tr>
                                        </thead>
                                        <tbody id="tr-encomienda">
                                            <tr >
                                               <td scope="row">1</td>
                                               <td>
                                                 <input type="text"  name="td-nroguia-1" id="td-nroguia-1" class="form-control" data-validation="number" placeholder="Nro. Guia" onkeypress="return NumCheck(event, this)">
                                              </td>
                                              <td>
                                                 <input type="text"  name="td-remitente-1" id="td-remitente-1" class="form-control mayusculas" data-validation="required"  placeholder="Remitente">
                                              </td>
                                             <td>
                                                 <input type="text"  name="td-nrobulto-1" id="td-nrobulto-1" class="form-control" data-validation="number" placeholder="Nro. Bulto" onkeypress="return NumCheck(event, this)">
                                              </td>
                                              <td>
                                                 <input type="text"  name="td-consignatario-1" id="td-consignatario-1" class="form-control mayusculas" placeholder="Consignatario" data-validation="required">
                                              </td>
                                              <td>
                                                 <input type="text"  name="td-ci-1" id="td-ci-1" class="form-control" data-validation="number" placeholder="CI" onkeypress="return NumCheck(event, this)">
                                              </td>
                                              <td>
                                                 <input type="text"  name="td-contenido-1" id="td-contenido-1" class="form-control mayusculas" placeholder="Contenido" data-validation="required">
                                              </td>
                                              <td>
                                                 <input type="text"  name="td-pagado-1" id="td-pagado-1" class="form-control" data-validation="number" placeholder="IMP. Pagado" onkeypress="return NumCheck(event, this)">
                                              </td>
                                              <td>
                                                 <input type="text"  name="td-porpagar-1" id="td-porpagar-1" class="form-control" data-validation="number" placeholder="Por Pagar" onkeypress="return NumCheck(event, this)">
                                              </td>
                                              <td align="center">
                                                    <input class="form-check-input" type="checkbox" value="0" id="check-factura-1" name="check-factura-1" onclick="asignaValor(this);">

                                              </td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                    <!--<span class="glyphicon glyphicon-plus-sign"></span>-->
                              
                                        <div class="row" align="right">
                                            <div class="col-md-12">
                                                <img src="../../Images/mas.png" width="2%" class="imagen" title="Adicionar nueva ruta" onclick="AdicionarFilaEncomienda()">
                                            </div>
                                           <!-- <div class="col-md-6">
                                               <img src="../../Images/delete.png" width="40%" class="imagen" title="Eliminar fila"> 
                                            </div>
                                          -->
                                        </div>
                                                            
                                    
                                </div>
                            </div>
                        </div>
                        <!-- /.col-md-12 -->
                    </div>
                    <div align="right">
                       <button type="submit" id="save" class="btn btn-success">
                          <i class="fa fa-check" aria-hidden="true"></i>
                          <span>Guardar Registro</span>
                     </button> 
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
<script src="bootstable.js"></script>
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
  /*$("#table-list").SetEditable({
      $addButton: $('#add')
  });

*/


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
function asignaValor(id){
  
    if ($(id).is(":checked")){
      //alert("SI");// Función si se checkea
      $(id).val('1');
    } else {
     //alert("NO"); //Función si no
      $(id).val('0');
    }
   
}
</script>



