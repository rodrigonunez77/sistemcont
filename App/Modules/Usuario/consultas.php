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

			$DataPersonas=PersonasList::getList("where personas.DNI='".$_POST['CI']."' ");

			echo json_encode($DataPersonas);
	    break;
    }
	
?>