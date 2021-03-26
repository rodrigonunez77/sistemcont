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


	
	$usuario = new Usuario($_POST['IDUSUARIO']);
	//echo ($_POST['EXPEDIDOU']) ;
	$DataLugar=LugaresList::getList("where IDLUGAR='".$_POST['IDLUGARU']."'");
	
	$usuario->setIdPersona($_POST['IDPERSONA']);
	$usuario->setIdLugar($_POST['IDLUGARU']);
	$usuario->setDepartamento($DataLugar[0]['DEPARTAMENTO']);
	$usuario->setLogin($_POST['LOGINU']);
	$usuario->setFecha($_POST['FECHAU']);

	if(isset($_POST['PASSWORDU'])){
		$usuario->setPassword(md5($_POST['PASSWORDU']));
	}
	else{
		$usuario->setPassword($_POST['PASSWORDUAUX']);
	}
	
	$usuario->setNombre(strtoupper($_POST['NOMBREU']));
	$usuario->setPaterno(strtoupper($_POST['PATERNOU']));
	$usuario->setMaterno(strtoupper($_POST['MATERNOU']));
	$usuario->setDni(strtoupper($_POST['DNIU']));
	$usuario->setTelefono($_POST['TELEFONOU']);
	$usuario->setTelefonoOficina($_POST['TELEFONOOFICINAU']);
	$usuario->setEmail($_POST['EMAILU']);
	$usuario->setFechaNacimiento($_POST['FECHANACIMIENTOU']);
	$usuario->setExpedido($_POST['EXPEDIDOU']);
	$usuario->setDireccion($_POST['DIRECCIONU']);
	$usuario->setObservacion($_POST['OBSERVACIONU']);
	$usuario->setCargo($_POST['CARGOU']);
	$usuario->setRol($_POST['ROLU']);
	$usuario->setEstado($_POST['ESTADO']);

	$cadenaSeccion="";
	foreach ($_POST['SECCION'] as $key => $value) {
		$cadenaSeccion=$cadenaSeccion.$value.'@';
	}
	
	$usuario->setSeccion($cadenaSeccion);


	//echo($_POST['IDUSUARIO']."-".$_POST['IDPERSONA']."-".$_POST['SUCURSALU']."-".$_POST['EXPEDIDOU']."-".$_POST['LOGINU']."-".$_POST['PASSWORDU']."-".$_POST['FECHAU']);
	if($_FILES["IMAGENU"]["name"]!=""){
	
		//Antes de modificar la imagen se elimina del directorio
		$imagen = new ImagenUpload();
		if($usuario->getImagen()!=""){
			$imagen->remove("../../Images/Empleados/".$usuario->getImagen());
		}	
		
		// guardamos la imagen
		$extension = explode(".",$_FILES["IMAGENU"]["name"]);
		$num = count($extension)-1;
		$ext = $extension[$num];
			
		$usuario->setImagen($_POST['DNIU'].".".$ext);
		$imagen->upload($_FILES["IMAGENU"], $_POST['DNIU'],"Empleados/");		
	}

	//UsuarioTransaction::update($usuario,"");

	if(!UsuarioTransaction::update($usuario,$_POST['ROLU'])) die("Error en la actualizacion de usuarios");
		
    echo("TRUE");
    
	
?>