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


    require_once $App->getPathPages()."Usuario/static.UsuariosList.php";
    require_once $App->getPathPages()."Categoria/static.CategoriasList.php";
    require_once $App->getPathPages()."Dependencia/static.DependenciasList.php";
    require_once $App->getPathPages()."Cargo/static.CargosList.php";
    

    require_once $App->getPathDomain()."lib.Table.php";
    date_default_timezone_set('America/Asuncion');

    $DataConcepto=CategoriasList::getList(); 
    $DataCargo=CargosList::getList(); 

    $condicion="";
    if($_SESSION['NIVEL']=='2'){
       $condicion=" AND IDUSUARIO=".$_GET['SID'];
    }
                                    
    $Data=Table::getListQuery("select * from movimientos where TIPOREGISTRO='I' ".$condicion." and TIPOCONCEPTO='".$_GET['TP']."' ORDER BY NRORECIBOINGRESO DESC");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="../../Images/escudobolivia.png">
   
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>

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
    <script src="../../Core/Design/cargaImagen/js/fileinput.min.js" type="text/javascript"></script>
 


    <?php
       include 'newIngreso.php';
       include 'editIngreso.php';
       include 'delIngreso.php';
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
                                <h3>Ingresos</h3>
                            </div>
                            <div class="col-lg-3">
                               
                            </div>
                            <div class="col-lg-3" >
                                <br>
                                <?php
                                 if($_SESSION['NIVEL']=='2'){
                                 ?>
                                <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#dataRegister" onclick="reiniciaNroRecibo()" >Nuevo Registro</button>
                                <?php     
                                 }
                                 ?>
                               
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
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-personal">
                                <thead>
                                    <tr>
                                        <th>Nro</th>
                                         <th>Fecha Registro</th>
                                        <th>Usuario Op.</th>
                                        
                                        <th>Nro.Recibo</th> 
                                        <th>Origen</th>
                                        <th>Destino</th>
                                        <th>Concepto</th>
                                        <th>Tipo Concepto</th>
                                        <th>Monto Bs</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>

                                
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach ($Data as $key => $value){
                                        
                                        if($value['ESTADO']=='POR COBRAR'){
                                            $colorFila="#F99";
                                        }
                                        else{
                                            $colorFila="";
                                        }
                                        $DataUsuario=Table::getListQuery("Select LOGIN from usuarios where IDUSUARIO='".$value['IDUSUARIO']."'");
                                       
                                        if($value['ESTADODEPOSITO']=='CONFIRMADO'){
                                            $valorCheck="checked";
                                        }
                                        else{
                                            $valorCheck="";
                                        }


                                    ?>
                                    <tr style="background-color:<?=$colorFila?>">
                                        <td><?=$key+1 ?></td>

                                        <td><?=$value['FECHAREGISTRO']?></td>
                                        <td><?=$DataUsuario[0]['LOGIN']?></td>
                                        <td><?=str_pad($value['NRORECIBOINGRESO'],8,'0',STR_PAD_LEFT)?></td>
                                        <td><?=$value['NOMBREORIGEN']?></td>
                                        <td><?=$value['NOMBREDESTINO']?></td>
                                        <td><?=$value['CONCEPTO']?></td>
                                        <td><?=$value['TIPOCONCEPTO']?></td>
                                        <td><?=$value['MONTOBS']?></td>
                                        <td><?=$value['ESTADO']?></td>
                                        <td>
                                        <?php
                                        if($_SESSION['NIVEL']=='1'){

                                        ?>
                                            <div align="center">
                                                Confirmar Depósito
                                               <input type="checkbox" name="CH_VALIDA_<?=$value['IDMOVIMIENTO']?>"  id="CH_VALIDA_<?=$value['IDMOVIMIENTO']?>" onclick="ValidaRegistro(<?=$value['IDMOVIMIENTO']?>)" <?=$valorCheck?> value="CONFIRMA">
                                             </div>

                                            <div class="btn-group" style="width: 50px">
                                            <button type="button" class="btn btn-primary btn-sm"  data-toggle=  "modal" data-target="#dataUpdate" 
                                                data-montobs='<?=$value['MONTOBS']?>'
                                                data-nombreorigen='<?=$value['NOMBREORIGEN']?>'
                                                data-tipoconcepto='<?=$value['TIPOCONCEPTO']?>'
                                                data-idconcepto='<?=$value['IDCONCEPTO']?>'
                                                data-concepto='<?=$value['CONCEPTO']?>'
                                                data-tipopago='<?=$value['TIPOPAGO']?>'
                                                data-fecharegistro='<?=$value['FECHAREGISTRO']?>'
                                                data-observacion='<?=$value['OBSERVACION']?>'
                                                data-nroreciboingreso='<?=$value['NRORECIBOINGRESO']?>'
                                                data-idmovimiento='<?=$value['IDMOVIMIENTO']?>'
                                                data-imagen='<?=$value['IMGDEPOSITO']?>'
                                                data-estado='<?=$value['ESTADO']?>'

                                            >
                                            <i class='fa fa-pencil-square-o '></i>
                                            <span>Modificar</span>
                                            </button>

                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#dataDelete" data-id="<?=$value['IDMOVIMIENTO']?>"  ><i class='glyphicon glyphicon-trash'></i> Eliminar&nbsp;&nbsp;
                                           </button>
                                         
                                           

                                           <?php
                                            }
                                            ?>
                                            <button type="button" class="btn btn-warning btn-sm" onclick="generaRecibo(<?=$value['IDMOVIMIENTO']?>)" > Ver Recibo&nbsp;&nbsp;
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

        $('#dataTables-personal').DataTable({
            "oLanguage": {
                "sUrl": "../../Core/Design/media/js/datatable.spanish.txt"                        
            },
            responsive: true

        });
    });

    function generaRecibo(idMovimiento){
        //alert(idMovimiento);
        window.open('PdfRecibo.php<?php echo $Vars?>&IDMOVIMIENTO='+idMovimiento, '_blank');
    }
     
     function ValidaRegistro(idMovimiento){

        if( $('#CH_VALIDA_'+idMovimiento).prop('checked') ) {
            
            $.post('consultas.php<?php echo $Vars?>',{CONDICION:'ACTUALIZADEPOSITO',ESTADO:'CONFIRMADO',IDMOVIMIENTO:idMovimiento},function(data){
               // alert(data);
                if(data=="TRUE"){
                    alert("Depósito verificado correctamente");
                }   
                else{
                   alert("Contactar con admin, "+data);
                }   
                        
            }); 
        }
        else{
           $.post('consultas.php<?php echo $Vars?>',{CONDICION:'ACTUALIZADEPOSITO',ESTADO:'PENDIENTE',IDMOVIMIENTO:idMovimiento},function(data){
             
                if(data=="TRUE"){
                    //alert("Registro verificado correctamente");
                }   
                else{
                   alert("Contactar con admin, "+data);
                }   
                        
            }); 
        }
     } 

    //$("#dataRegister").modal();
    reiniciaNroRecibo();

</script>