<?PHP
	/*
	*	CABECERA
	*/
	require_once '../../Core/Components/App.inc.php';
	require_once $App->getPathSecurity("Security.php");	 
	Security::ValidSession();
		/*	Datos del ususario	*/
		require_once $App->getPathDomain()."Usuario.php";	 	 
		// $rol = Security::decrypt($_SESSION['ROLES']);
        $rol = ($_SESSION['ROLES']);
		/* VarsEnviroment	*/
		$Vars = "?SID=".$_GET["SID"]."&SESION=".$_GET["SESION"]."&R=".$_GET["R"];
		$VarsAjax = "SID=".$_GET["SID"]."&SESION=".$_GET["SESION"]."&R=".$_GET["R"];
		$titulo = "";
	/*
	*	FIN CABECERA 
	*/
		

	require_once $App->getPathPages()."Log/static.LogsTransaction.php";
	require_once $App->getPathComponents("ImagenesOperaciones/ImagenUpload.php");
    require_once $App->getPathDomain()."lib.Table.php";

	
    	
	/*$liquidacion = new Liquidacion($_POST['IDLIQUIDACION']);
	$liquidacion->setFechaRegistro($_POST['FECHAREGISTRO']);
	$liquidacion->setFechaSistema($_POST['FECHASISTEMA']);
	$liquidacion->setFechaSistema($_POST['NROINFORME']);
		
   */
	//print_r($_FILES["IMAGEN"]);
	$nombreImagen="";
	$imagenArray=array();
	if(isset($_FILES["IMAGEN"]['tmp_name'])){
		foreach ($_FILES["IMAGEN"]['tmp_name'] as $key => $tmp_name) {
			# code...
		   //$nombreImagen=$nombreImagen.$_FILES["IMAGEN"]['name'][$key]."@";
			//echo($tmp_name[$key]);
			if(isset($_FILES["IMAGEN"]["name"][$key])){
				if($_FILES["IMAGEN"]["name"][$key]!=""){
					
					$imagenArray["name"]=$_FILES["IMAGEN"]["name"][$key];
					$imagenArray["type"]=$_FILES["IMAGEN"]["type"][$key];
					$imagenArray["size"]=$_FILES["IMAGEN"]["size"][$key];
					$imagenArray["tmp_name"]=$_FILES["IMAGEN"]["tmp_name"][$key];
					$imagenArray["error"]=$_FILES["IMAGEN"]["error"][$key];
					// guardamos la imagen
					$extension = explode(".",$_FILES["IMAGEN"]["name"][$key]);
					$num = count($extension)-1;
					$ext = $extension[$num];
					$aletorio=rand (0 , 1000 );
					

					$imagen = new ImagenUpload();
					//$imagen->remove("Empleados/");
					$imagen->upload($imagenArray,'DEPLIK'.$_POST['NROINFORME'].'_'.$key.'_'.$aletorio,"Depositos/");	

					$sentencia="insert into imagendepositos set NROINFORME='".$_POST['NROINFORME']."',NOMBRE='DEPLIK".$_POST['NROINFORME'].'_'.$key.'_'.$aletorio."',UBICACION='Depositos', EXTENCION='".$ext."', DESCRIPCION='".$_POST['DESCRIPCION']."'";
					Table::executeQuery($sentencia);	
				}	
			}
		}
		echo "TRUE";
	}
	else{
		echo " Error! al cargar imagen vuelva a intentarlo"; 
	}
	
	
	//print_r($imagenArray);


?>