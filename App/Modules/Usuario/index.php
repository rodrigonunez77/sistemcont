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
    require_once $App->getPathPages()."Dependencia/static.DependenciasList.php";
    require_once $App->getPathPages()."Cargo/static.CargosList.php";
    

    require_once $App->getPathDomain()."lib.Table.php";
    date_default_timezone_set('America/Asuncion');

    $DataDependencia=DependenciasList::getList(); 
    $DataCargo=CargosList::getList(); 

    $Data=Table::getListQuery("select `personas`.`IDPERSONA`,`personas`.`NOMBRE`,`personas`.`PATERNO`,
                 `personas`.`MATERNO`,`personas`.`DNI`,`personas`.`EXPEDIDO`, `personas`.`TELEFONO`,`personas`.`TELEFONO_OFICINA`,`personas`.`FECHANACIMIENTO`,`personas`.`DIRECCION`,`personas`.`EMAIL`,`personas`.`OBSERVACION`,
                `usuarios`.`IDUSUARIO`,`lugares`.`DEPARTAMENTO`, `usuarios`.`IDLUGAR`,`usuarios`.`CARGO`,`lugares`.`IDDEPENDENCIA`,`usuarios`.`LOGIN`,`usuarios`.`PASSWORD`, `usuarios`.`IMAGEN`,
               `usuarios`.`ROL`,`usuarios`.`ESTADO`,`usuarios`.`SECCION`,
                `lugares`.`IDLUGAR`, `lugares`.`DESCRIPCION`,`personas`.`IMAGEN`
                 from personas, `lugares`,  `usuarios`
                where `personas`.`IDPERSONA`=`usuarios`.`IDPERSONA` AND 
                `lugares`.`IDLUGAR`=`usuarios`.`IDLUGAR` ORDER BY personas.IDPERSONA desc");
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
       include 'newUsuario.php';
       include 'editUsuario.php';
       include 'delUsuario.php';
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
                                <h3>Usuarios</h3>
                            </div>
                            <div class="col-lg-3">
                               
                            </div>
                            <div class="col-lg-3" >
                                <br>
                                <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#dataRegister">Nuevo Registro</button>
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
                                        <th>Nombre Completo</th> 
                                        <th>NRO. DOC.</th> 
                                        <th>Celular</th>
                                        <th>Usuario</th>
                                        <th>Oficina</th>
                                        <th>Rol</th>
                                        <th>Nivel</th>
                                        <th>Estado</th>
                                        <th>Foto</th>
                                    
                                        <th>Acciones</th>
                                
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach ($Data as $key => $value){
                                         $DataD=DependenciasList::getList(" where IDDEPENDENCIA=".$value['IDDEPENDENCIA']);
                                            if($value['ESTADO']=='A'){
                                                $estadoU='Habilitado';
                                            }
                                            else{
                                                $estadoU='Deshabilitado';
                                            }
                                            if($value['ROL']=='1'){
                                                $nivelRol='1 (ADMIN)';
                                            }
                                            else{
                                                $nivelRol='2 (OPE)';
                                            }
                                    ?>
                                    <tr>
                                        <td><?=$key+1 ?></td>
                                        <td><?= utf8_decode( strtoupper($value['NOMBRE']." ".$value['PATERNO']." ".$value['MATERNO']))?></td>
                                        <td><?=$value['DNI']?></td>
                                        <td><?=$value['TELEFONO']?></td>
                                        <td><?=$value['LOGIN']?></td>
                                        <td><?=utf8_decode( $DataD[0]['DESCRIPCION'].' - '.$value['DEPARTAMENTO'].' - '.$value['DESCRIPCION'])?></td>
                                        <td><?=$value['CARGO']?></td>
                                        <td><?=$nivelRol?></td>
                                        <td><?=$estadoU?></td>
                                        <?php
                                            if($value['IMAGEN']!=""){
                                                $foto=$value['IMAGEN'];
                                            }
                                            else{
                                                $foto="ninguno.jpg";
                                            }
                                        ?>
                                        <td align="center">
                                            <img  width="" class="img-responsive img-thumbnail"   src="../../Images/Empleados/<?=$foto?>" >
                                        </td>
                                        <td>
                                            <div class="btn-group" style="width: 50px">
                                          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#dataUpdate"
                                                  data-idlugar="<?=$value['IDLUGAR']?>"
                                                   data-idpersona="<?=$value['IDPERSONA']?>"
                                                  data-idusuario="<?=$value['IDUSUARIO']?>"
                                                  data-dni="<?=$value['DNI']?>"
                                                  data-expedido="<?=$value['EXPEDIDO']?>"
                                                  data-nombre="<?=$value['NOMBRE']?>"
                                                  data-paterno="<?=$value['PATERNO']?>"
                                                  data-materno="<?=$value['MATERNO']?>"
                                                  data-fechanacimiento="<?=$value['FECHANACIMIENTO']?>"
                                                  data-telefonooficina="<?=$value['TELEFONO_OFICINA']?>"
                                                  data-telefono="<?=$value['TELEFONO']?>"
                                                  data-email="<?=$value['EMAIL']?>"
                                                  data-direccion="<?=$value['DIRECCION']?>"
                                                  data-rol="<?=$value['ROL']?>"
                                                  data-iddependencia="<?=$value['IDDEPENDENCIA']?>"
                                                  data-login="<?=$value['LOGIN']?>"
                                                  data-password="<?=($value['PASSWORD']); ?>"
                                                  data-observacion="<?=$value['OBSERVACION']?>"
                                                  data-cargo="<?=$value['CARGO']?>"
                                                  data-imagen="<?=$value['IMAGEN']?>"
                                                  data-departamento="<?=$value['DEPARTAMENTO']?>"
                                                  data-seccion="<?=$value['SECCION']?>"
                                                  data-estado="<?=$value['ESTADO']?>"
                                            
                                          >
                                            <i class='fa fa-pencil-square-o '></i>
                                            <span>Modificar</span>
                                             </button>
                                             <?php
                                             if($value['IDUSUARIO']!=94){
                                             ?>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#dataDelete" data-id="<?=$value['IDUSUARIO']?>"  ><i class='glyphicon glyphicon-trash'></i> Eliminar
                                               </button>
                                            <?php
                                             }
                                             ?>
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
                                <p>El Usuario con algun tipo de movimiento en el sistema no podra ser eliminado
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
</script>