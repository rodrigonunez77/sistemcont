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
    require_once $App->getPathPages()."Movimiento/static.MovimientosTransaction.php";
	require_once $App->getPathPages()."Lugar/static.LugaresList.php";
	require_once $App->getPathPages()."Categoria/static.CategoriasList.php";
	require_once $App->getPathPages()."Persona/static.PersonasList.php";
	require_once $App->getPathComponents("Formatos/static.ConvertirNumerosLetras.php"); 
	require_once $App->getPathDomain()."lib.Table.php";

	switch ($_POST['CONDICION']) 
    {
	    case 'BUSCACONCEPTO':
	       
			$sql=" where TIPOCONCEPTO='".$_POST['ID']."'";
	    
			$Data=CategoriasList::getList($sql);
			
			echo json_encode($Data);
		break;
		case 'BUSCALETRAS':
			echo json_encode(convertir_a_letras($_POST['MONTOBS']));
		break;

		case 'BUSCANUMERACION':
	       
			$Data=Table::getListQuery("Select MAX(NRORECIBOINGRESO) from movimientos where TIPOREGISTRO='".$_POST['TIPOREGISTRO']."' and TIPOCONCEPTO='".$_POST['TIPOCONCEPTO']."'");
			if(count($Data)>0){
				$numero=str_pad(($Data[0][0]+1),7,"0",STR_PAD_LEFT);
			}
			else{
				$numero=str_pad(1,7,"0",STR_PAD_LEFT);
			}
			echo json_encode($numero);
		break;
		case'ACTUALIZADEPOSITO':
			$movimiento = new Movimiento($_POST['IDMOVIMIENTO']);
			$movimiento->setEstadoDeposito($_POST['ESTADO']);
			MovimientosTransaction::update($movimiento);
			echo "TRUE";
		break;

    }
	
?>