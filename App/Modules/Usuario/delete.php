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
		
	require_once $App->getPathComponents("ImagenesOperaciones/ImagenUpload.php");
	require_once $App->getPathPages()."Usuario/static.UsuariosTransaction.php";
    require_once $App->getPathDomain()."lib.Table.php";

	$data = stripslashes($_POST['res']);

	$data = json_decode($data);
	//se elimina la imagen del directorio
	$usuario = new Usuario($data->id);
	$imagen = new ImagenUpload();
	if($usuario->getImagen()!=""){
	   $imagen->remove("../../Images/Empleados/".$usuario->getImagen());
    }
    UsuarioTransaction::delete($data->id);
    
    echo("TRUE");
	
?>