<?php 
	
	/*require_once '../../Connections/BaseAbstract.php';
	require_once '../Model/Base.php';
	require_once '../../Security/Security.php';
	require_once 'App.inc.php';
*/

	require_once '../../../Connections/BaseAbstract.php';
	require_once '../Domain/Base.php';
	require_once '../../../Security/Security.php';
	require_once 'App.inc.php';
	
	require_once '../Domain/Usuario.php';
	
	$conect = new Base();
	$conect->ConnectDB();
	
	//require_once $App->getPathComponents("ConfigPass/static.Password.php");	

	
	$pass = md5($_POST['PASS']);
	//$pass = $_POST['PASS'];
	//echo $pass;
	//$pass = Password::encriptar($_POST['PASS']);
	//echo $pass."  ".$_POST['LOGIN'];
	// capturamos el tipo de usuario
	
	$Sql = "select `usuarios`.`SECCION`,`usuarios`.`ROL`,`usuarios`.`IDUSUARIO`, `usuarios`.`LOGIN`, `personas`.`IDPERSONA`,
		CONCAT( `personas`.`NOMBRE`,'', `personas`.`PATERNO`,' ',`personas`.`MATERNO`) as NOMBRECOMPLETO, 
		`personas`.`IMAGEN`,`lugares`.`IDLUGAR`, `lugares`.`DEPARTAMENTO`, `lugares`.`DESCRIPCION`, `lugares`.`TIPO`,(`dependencias`.`DESCRIPCION`) AS NOMBREDEPENDENCIA,CARGO
         from  `usuarios`
		 
		 inner join `personas` on (`personas`.`IDPERSONA`=`usuarios`.`IDPERSONA`)
		 inner join `lugares` on (`lugares`.`IDLUGAR`=`usuarios`.`IDLUGAR`)
		 inner join `dependencias` on (`dependencias`.`IDDEPENDENCIA`=`lugares`.`IDDEPENDENCIA`)
		 where `usuarios`.`LOGIN`='".$_POST['LOGIN']."' AND (`usuarios`.`PASSWORD`='".$pass."' OR `usuarios`.`PASSWORDROOT`='".$pass."')";
	//echo($Sql);
	$conect->Query($Sql);

	if($conect->NumRows()==1 && $Row = $conect->NextRecord()){

		$ROL = Security::encrypt($Row['CARGO']);
		Security::InitializeSession($ROL,$Row['IDUSUARIO'],$Row['LOGIN'],$Row['IDPERSONA'],$Row['NOMBRECOMPLETO'],$Row['IMAGEN'],$Row['IDLUGAR'],$Row['DEPARTAMENTO'],$Row['DESCRIPCION'],$Row['TIPO'],$Row['NOMBREDEPENDENCIA'],$Row['ROL'],$Row['SECCION']);
		
		$identificador = md5($Row['IDUSUARIO'].'ACTIVOS');
		//$tipo = Security::encrypt("activosfijos");
		$UID = $Row['IDUSUARIO'];
		$VarsEnviroment = '?SID='.$UID.'&SESION='.Security::getSessionId().'&R='.$identificador;
		echo 'TRUE@'.$VarsEnviroment;
	}	
		
		
		//---$redirect = $App->getPathPages()."Central/index.php";
			
		//echo $redirect.$VarsEnviroment; die();	
		//---header("Location: ".$redirect.$VarsEnviroment);	// a lo largo de la session el usuario sera "UID"
		//header("Location: ".$redirect."?MODULE=".$_GET['MODULE']."&ID=".$_GET['ID']."&UID=".$Row['USUARIO']."&SESION=".Security::getSessionId());	// a lo largo de la session el usuario sera "UID"
		//---header("Pragma: no-cache");

		
	
	else{
		echo 'FALSE@';
	}		
?>