<?php
   /*
	*	CABECERA
	*/
	require_once '../../Core/Components/App.inc.php';
	require_once $App->getPathSecurity("Security.php");	 
	Security::ValidSession();
		/*	Datos del ususario	*/
		require_once $App->getPathDomain()."Usuario.php";	 	 
		$rol = Security::decrypt($_SESSION['ROLES']);
		/* VarsEnviroment	*/
		$Vars = "?SID=".$_GET["SID"]."&SESION=".$_GET["SESION"]."&R=".$_GET["R"];
		$VarsAjax = "SID=".$_GET["SID"]."&SESION=".$_GET["SESION"]."&R=".$_GET["R"];
		$titulo = "";
	/*
	*	FIN CABECERA 
	*/

	require_once $App->getPathPages()."Lugar/static.LugaresList.php";
	require_once $App->getPathPages()."Persona/static.PersonasList.php";
	require_once $App->getPathPages()."Liquidacion/static.LiquidacionesList.php";

	switch ($_POST['CONDICION']) 
    {
	    case 'BUSCALUGAR':
	       
	       if($_POST['ID']=='0'){
	       		$sql="";
	       }
	       else{
				$sql=" where IDDEPENDENCIA='".$_POST['ID']."'";
	       }
			$DataLugar=LugaresList::getList($sql);
			
			echo json_encode($DataLugar);
			break;

	    case 'BUSCAPERSONAS':

			$DataPersonas=LiquidacionesList::getList("where CI='".$_POST['CI']."' ");

			echo json_encode($DataPersonas);
	    break;

	    case 'BUSCAPERSONASCHOFER':

			$DataPersonas=LiquidacionesList::getList("where CICHOFER='".$_POST['CI']."' ");

			echo json_encode($DataPersonas);
	    break;

	    case 'BUSCAPROPIETARIOS':

			$Data=Table::getListQuery("select * from liquidacion where NROINFORME='".$_POST['NROINFORME']."' ");

			echo json_encode($Data);
	    break;

	    case 'BUSCATIPOPERSONA':
	    	if($_POST['TIPO']=='PRO'){
	    		$Data=Table::getListQuery("select CI,NOMBRE,PATERNO,MATERNO from liquidacion ");

	    	}
	    	elseif($_POST['TIPO']=='CHO'){
	    		$Data=Table::getListQuery("select CICHOFER AS CI,NOMBRECHOFER AS NOMBRE,PATERNOCHOFER AS PATERNO,MATERNOCHOFER AS MATERNO from liquidacion ");
	    	}
	    	elseif($_POST['TIPO']=='UOP'){
	    		$Data=Table::getListQuery("select `usuarios`.`IDUSUARIO`  as CI, `personas`.`NOMBRE`, `personas`.`MATERNO`, 
					`personas`.`PATERNO` from `personas`,`usuarios`
					where `personas`.`IDPERSONA`=`usuarios`.`IDPERSONA` ");
	    	}

			

			echo json_encode($Data);
	    break;

	    case 'BUSCAIMAGEN':

			$Data=Table::getListQuery("select * from imagendepositos where NROINFORME='".$_POST['NROINFORME']."' ");

			echo json_encode($Data);
	    break;

	    case 'ELIMINAIMGDEP':
	        require_once $App->getPathComponents("ImagenesOperaciones/ImagenUpload.php");
	    	$imagen = new ImagenUpload();
			//if($_POST['NOMBREIMG']!=""){
				$DataIMG=Table::getListQuery("select * from imagendepositos where IDIMAGENDEP=".$_POST['ID']);
				$ubicacion="../../Images/Depositos/".$DataIMG[0]['NOMBRE'].".".$DataIMG[0]['EXTENCION'];
			   $imagen->remove($ubicacion);
			   
			   $Data=Table::executeQuery("DELETE FROM imagendepositos WHERE IDIMAGENDEP= ".$_POST['ID']);
		    //}
			

			echo json_encode($ubicacion);
	    break;


    }
	
?>