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

    <title>SISTEMA WEB CONTABLE</title>


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

         <!-- Navigation -->
        <?php
            require_once($App->getPathModules()."Principal/Menu.html");
        ?>
        <!--Fin Navigation -->

        <!-- Body internal -->
        <div id="page-wrapper">
            <div class="row">
                <form name="formulario" id="formulario" action="" method="post" target="_blank">
                <div class="col-lg-12">
                    <div  class="container-fluid"> 
                        <hr>
                        <div class="row">
                           
                            <div class="col-lg-2" align="right">    
                             TIPO REPORTE:
                            </div>
                          
                            <div class="col-lg-3">
                               
                                <select style="font-size: 13px;" id="TIPOREPORTE" name="TIPOREPORTE" class="form-control" data-validation="required" onchange="getTipoPersona(this.value,'BUSCATIPOPERSONA','TIPOPERSONA','<?php echo $Vars ?>')" >

                                  <option value="" disabled selected hidden>Seleccione</option>
                                  <option value="PRO" >PROPIETARIO</option>
                                  <option value="UOP" >USUARIO OPERADOR</option>
                                  <option value="CHO" >CHOFER</option>
                                  
                                </select>
                            </div>
                            <div class="col-lg-1">
                                PERSONA:
                            </div>
                            <div class="col-lg-2">    
                                 <select style="font-size: 13px;" id="TIPOPERSONA" name="TIPOPERSONA" class="form-control" data-validation="required"  >

     
                                  
                                </select> 
                            </div>
                            <div class="col-lg-2">  
                                 
                            </div>
                            <div class="col-lg-2">
                            </div>

                            
                        </div>
                        <hr>
                         <div class="row">
                            <div class="col-lg-2">
                                FECHA INICIO
                            </div>
                            <div class="col-lg-3">
                               <input id="FECHAINICIO" name="FECHAINICIO" type="date"  class="form-control" size="10" data-validation="date" data-validation-format="yyyy-mm-dd" value="<?=date("Y-m-d")?>" />
                            </div>
                            <div class="col-lg-1">
                                FECHA FIN
                            </div>
                            <div class="col-lg-3">
                               <input id="FECHAFIN" name="FECHAFIN" type="date"  class="form-control" size="10" data-validation="date" data-validation-format="yyyy-mm-dd" value="<?=date("Y-m-d")?>" />
                            </div>
                            <div class="col-lg-2">
                             <button type="button" class="btn btn-primary" onclick="generarReport()" data-toggle="modal" data-target="">Generar</button> 
                            </div>

                        
                            
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6">
                                <h3>Reportes</h3>
                            </div>
                            <div class="col-lg-3">
                               
                            </div>
                            <div class="col-lg-3" >
                                
                                
                            </div>
                            
                        </div>
                    </div>
            
                </div>
               
                <!-- /.col-lg-12 -->
                </form>
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
                            <div id="DIV-REPORT">
                               <!-- /.aca se asigna otra pagina con el IFRAME -->  
                            </div>
                            
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

    function generarReport(){
       // alert($("#TIPOPERSONA").val());
       // var tipoConcept=$('input:radio[name=TIPOCONCEPTO]:checked').val();
       if($("#TIPOPERSONA").val()!=null){
        var divReport = document.getElementById("DIV-REPORT");
        
             divReport.innerHTML ="<iframe id='FRAME' overflow:scroll; width='100%' height='450' src='report.php<?=$Vars?>&CI="+$("#TIPOPERSONA").val()+"&FECHAINICIO="+$("#FECHAINICIO").val()+"&FECHAFIN="+$("#FECHAFIN").val()+"&TIPOREPORTE="+$("#TIPOREPORTE").val()+"' frameborder='0' > </iframe>"; 
       }
       else{
           alert("Error! seleccione persona");
       }
    }

    function generaPdfReport(){
      
       if($("#TIPOREPORTE").val()=='OFICINA'){
             var FormReporte = $('#formulario');
                FormReporte.attr("action", 'PdfReport.php'+ '<?php echo $Vars?>&FECHAINICIO='+$('#FECHAINICIO').val()+'&FECHAFIN='+$('#FECHAFIN').val());
                FormReporte.submit();
        }
        else{
             var FormReporte = $('#formulario');
                FormReporte.attr("action", 'PdfReport.php'+ '<?php echo $Vars?>&FECHAINICIO='+$('#FECHAINICIO').val()+'&FECHAFIN='+$('#FECHAFIN').val()+'&TIPOREPORTE='+$('#TIPOREPORTE').val());
                FormReporte.submit();
        }
    }
    /////busca   persoan tipo reporte

    function buscaTipoUsuario(tipoU){
        //alert(tipoU);
    }
</script>

