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


    require_once $App->getPathPages()."Liquidacion/static.LiquidacionesList.php";
    require_once $App->getPathDomain()."lib.Table.php";
    date_default_timezone_set('America/Asuncion');
    //$DataL=LiquidacionesList::getList();

     $condicion="";
    if($_SESSION['NIVEL']=='2'){
       $condicion=" where `encomienda`.IDUSUARIO=".$_GET['SID'];
    }

    $DataL=Table::getListQuery("select `encomienda`.`FECHAREGISTRO`,
        `encomienda`.`IDUSUARIO`,
        `encomienda`.`USUARIO`,
        `encomienda`.`NROPLACA`,
        `encomienda`.`CONDUCTOR`,
        `encomienda`.`NROLICENCIA`,
        `encomienda`.`LOCALIDAD`
        from `encomienda`
          
         ".$condicion." 
         group by `encomienda`.`NROPLACA`,`encomienda`.`FECHAREGISTRO`
         order by `encomienda`.`FECHAREGISTRO` desc" );
    
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
     <!--  para cargar imagenes -->
    <link href="../../Core/Design/cargaImagen/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
    
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

    <!-- script carga imagen  -->
    <script src="../../Core/Design/cargaImagen/js/fileinputDep.js" type="text/javascript"></script>
    <?php
 
       //include 'delLiquidacion.php';
       include 'descuentoEncomienda.php';
    ?>

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
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div  class="container-fluid"> 
                        <div class="row">
                            <div class="col-lg-6">
                                <h3>Liquidacion De Carga</h3>
                            </div>
                            <div class="col-lg-3">
                               
                            </div>
                            <div class="col-lg-3" >
                                <br><!--
                                <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#dataRegister">Nuevo Registro</button>-->
                            </div>
                            
                        </div>
                    </div>
            
                </div>
               
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Lista de Registros
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-categoria">
                                <thead>
                                    <tr>
                                        <th>Nro</th>
                                        <th>FECHA DE VIAJE</th>
                                        <th>USUARIO OPERADOR</th>
                                        <th>NRO PLACA</th>
                                        <th>NOMBRE PROPIETARIO</th>
                                        <th>NOMBRE CONDUCTOR</th>
                                        <th>ANTICIPO</th>
                                       
                                        <th align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OPCIONES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach ($DataL as $key => $value){
                                          $DataPropietario=Table::getListQuery("select * from liquidacion where NROPLACA='".$value['NROPLACA']."' ORDER BY IDLIQUIDACION DESC");
                                          $DataAnticipo=Table::getListQuery("select * from descuentoencomienda where NROPLACA='".$value['NROPLACA']."'  and FECHAREGISTRO='".$value['FECHAREGISTRO']."'");

                                           $nombreSocio="";
                                           $ciSocio="";
                                           if (isset($DataPropietario[0]['NROPLACA'])) {
                                            # code...
                                                $nombreSocio=$DataPropietario[0]['NOMBRE'].' '.$DataPropietario[0]['PATERNO'].' '.$DataPropietario[0]['MATERNO'];
                                                $ciSocio=$DataPropietario[0]['CI'];
                                           } 
                                            $anticipo_=0;
                                           if (isset($DataAnticipo[0]['ANTICIPO'])) {
                                                # code...
                                                $anticipo_=$DataAnticipo[0]['ANTICIPO'];
                                            } 
                                    ?>
                                    <tr>
                                        <td><?=$key+1 ?></td>
                                        <td><?=$value['FECHAREGISTRO']?></td> 
                                        <td><?=$value['USUARIO']?></td> 
                                        <td><?=$value['NROPLACA']?></td> 
                                        <td><?=utf8_decode($nombreSocio)?></td> 
                                        <td><?=utf8_decode($value['CONDUCTOR']) ?></td> 
                                        <td><?=number_format($anticipo_,2,',','.')?></td> 
                                      
                                        
                                        <td>
                                        
                                            <div class="btn-group" style="width: 50px">
                                                <?php
                                                if ($anticipo_>0) {
                                                    # code...
                                                
                                                ?>
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#dataInsert"
                                                     data-nroplaca = "<?=$value['NROPLACA']?>"
                                                     data-fecha = "<?=$value['FECHAREGISTRO']?>"
                                                    data-anticipo = "<?=$anticipo_?>">
                                                      <i class='glyphicon glyphicon-edit'></i>&nbsp;&nbsp; Modificar Anticipo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </button>
                                                <?php
                                                  # code...
                                                }
                                                else{
                                                ?>
                                              <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#dataInsert"
                                                  data-nroplaca = "<?=$value['NROPLACA']?>"
                                                  data-fecha = "<?=$value['FECHAREGISTRO']?>"
                                                   data-anticipo = "<?=$anticipo_?>"
                                                 >
                                                  <i class='glyphicon glyphicon-edit'></i>&nbsp;&nbsp;&nbsp; Adicionar Anticipo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                              </button>
                                                <?php
                                                }
                                                ?>
                                             
                                            
                                               <button type="button" class="btn btn-warning btn-sm" onclick="verLiquidacionEncomienda('<?=$value['FECHAREGISTRO']?>','<?=$value['IDUSUARIO']?>','<?=$value['NROPLACA']?>')" > Ver Liquidacion de Carga&nbsp;&nbsp;
                                               </button>


                                            </div>  

                                        </td>
                                    
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                    
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            <div class="well">
                                <h4>Nota</h4>
                                <p>

                                </p>
                               
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
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
  $(document).ready(function() {

        $('#dataTables-categoria').DataTable({
            "oLanguage": {
                "sUrl": "../../Core/Design/media/js/datatable.spanish.txt"                        
            },
            responsive: true

        });
    });

   function verLiquidacionEncomienda(fecha,idUsuario,nroPlaca){
        //alert(idMovimiento);
        window.open('PdfLiquidacionCarga.php<?php echo $Vars?>&f='+fecha+'&id='+idUsuario+'&n='+nroPlaca,'_blank');
    }
</script>

