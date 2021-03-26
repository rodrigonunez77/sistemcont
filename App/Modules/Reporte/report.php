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
    $DataC=CategoriasList::getList();
    
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

    <title>SISTEMA GESTION DE PRODUCTOS</title>


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


</head>

<body>
    <!-- /# inicio wrapper -->
    <div id="wrapper" >
        <p align="center"> <strong><?=$_GET['TIPOREPORTE']?></strong></p>

        <!-- /.panel-heading -->
        <div class="panel-body">
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-categoria">
                <thead>
                    <tr>
                        <th>Nro</th>
                        <th>FECHA DE REGISTRO</th>
                        <th>NRO. CONPROBANTE</th>
                        <th>CONCEPTO</th>
                        <th>DETALLE</th>
                        <th>
                            <?php 
                                if($_GET['TIPOREPORTE']=='EGRESOS'){
                                    echo 'EGRESO';
                                    $tipoRegisto='S';
                                    $condicion=" and ESTADO='PAGADO' ";
                                }
                                else if($_GET['TIPOREPORTE']=='CUENTAS POR COBRAR'){
                                    echo 'INGRESO'; 
                                    $tipoRegisto='I';
                                    $condicion=" and ESTADO='POR COBRAR' ";
                                }
                                else{
                                    echo 'INGRESO'; 
                                    $tipoRegisto='I';
                                    $condicion=" and ESTADO='PAGADO' ";
                                }

                            ?>
                        </th>
                    
                
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $Data=Table::getListQuery("select * from movimientos where TIPOREGISTRO='".$tipoRegisto."' AND TIPOCONCEPTO='".$_GET['TIPOCONCEPTO']."' and FECHAREGISTRO between '".$_GET['FECHAINICIO']."' and '".$_GET['FECHAFIN']."' ".$condicion." AND ESTADODEPOSITO='CONFIRMADO' ");
                    foreach ($Data as $key => $value){
                            if($tipoRegisto=='S'){
                                 $nroComprobante=$value['NRORECIBOEGRESO'];
                                $montoEgreso=$value['MONTOBS'];
                                $montoIngreso=0;
                            }
                            else{
                               
                                $nroComprobante=$value['NRORECIBOINGRESO'];
                                $montoIngreso=$value['MONTOBS'];
                                $montoEgreso=0;
                            }
                    ?>
                    <tr>
                        <td><?=$key+1 ?></td>
                        <td><?=$value['FECHAREGISTRO']?></td> 
                        <td><?=str_pad($nroComprobante,8,'0',STR_PAD_LEFT)?></td> 
                        <td><?=$value['CONCEPTO']?></td> 
                        <td><?=$value['OBSERVACION']?></td> 
                        <td>
                            <?php
                                if($_GET['TIPOREPORTE']=='EGRESOS'){
                                    echo $montoEgreso;
                                }
                                else{
                                    echo $montoIngreso; 
                                }

                             ?>
                            
                        </td> 
                        
                    
                    </tr>
                    <?php
                    }
                    ?>
                    
                </tbody>
            </table>

            
        </div>
        <!-- Fin  Body internal -->

    </div>
    <!-- /# Fin wrapper -->

</body>

</html>
<script>
  $(document).ready(function() {

        $('#dataTables-categoria').DataTable({
            "oLanguage": {
                "sUrl": "../../Core/Design/media/js/datatable.spanish.txt"                        
            },
            responsive: true

        });
    });
</script>

