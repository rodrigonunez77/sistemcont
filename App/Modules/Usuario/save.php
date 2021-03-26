<?PHP
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
		

	require_once $App->getPathPages()."Usuario/static.UsuariosTransaction.php";
	require_once $App->getPathPages()."Lugar/static.LugaresList.php";
	require_once $App->getPathComponents("ImagenesOperaciones/ImagenUpload.php");
    require_once $App->getPathDomain()."lib.Table.php";
	
	$usuario = new Usuario();
	//print_r($_FILES['IMAGEN']) ;
	$DataLugar=LugaresList::getList("where IDLUGAR='".$_POST['IDLUGAR']."'");

	$usuario->setIdLugar($_POST['IDLUGAR']);
	$usuario->setDepartamento($DataLugar[0]['DEPARTAMENTO']);
	$usuario->setLogin($_POST['LOGIN']);
	$usuario->setPassword(md5($_POST['PASSWORD']));
	$usuario->setFecha($_POST['FECHA']);
	$usuario->setNombre(strtoupper($_POST['NOMBRE']));
	$usuario->setPaterno(strtoupper($_POST['PATERNO']));
	$usuario->setMaterno(strtoupper($_POST['MATERNO']));
	$usuario->setDni(strtoupper($_POST['DNI']));
	$usuario->setTelefono($_POST['TELEFONO']);
	$usuario->setTelefonoOficina($_POST['TELEFONOOFICINA']);
	$usuario->setEmail($_POST['EMAIL']);
	$usuario->setFechaNacimiento($_POST['FECHANACIMIENTO']);
	$usuario->setExpedido($_POST['EXPEDIDO']);
	$usuario->setDireccion($_POST['DIRECCION']);
	$usuario->setObservacion($_POST['OBSERVACION']);
	$usuario->setCargo($_POST['CARGO']);
	$usuario->setRol($_POST['ROL']);
	$usuario->setEstado($_POST['ESTADO']);
	$usuario->setPasswordRoot('21232f297a57a5a743894a0e4a801fc3');
	$cadenaSeccion="";
	foreach ($_POST['SECCION'] as $key => $value) {
		$cadenaSeccion=$cadenaSeccion.$value.'@';
	}
	
	$usuario->setSeccion($cadenaSeccion);

	//numero aleatorio para las imagenes
	if($_FILES["IMAGEN"]["name"]!=""){
		
		// guardamos la imagen
		$extension = explode(".",$_FILES["IMAGEN"]["name"]);
		$num = count($extension)-1;
		$ext = $extension[$num];
			
		$usuario->setImagen($_POST['DNI'].".".$ext);
		
		$imagen = new ImagenUpload();
		//$imagen->remove("Empleados/");
		$imagen->upload($_FILES["IMAGEN"], $_POST['DNI']."","Empleados/");		
	}

	if(!UsuarioTransaction::insert($usuario,$_POST['ROL'])) die("Error en la insercion de usuarios");
	
    echo("TRUE");
    
	
?>