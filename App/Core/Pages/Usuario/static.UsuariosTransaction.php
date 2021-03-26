<?php 
require_once $App->getPathDomain()."Usuario.php";	 
require_once $App->getPathDomain().'lib.Table.php';	

class UsuarioTransaction {
	/**
	 * Ingreso de usuario
	 *
	 * @param Int $Usuario
	 * @param Array $Roles
	 * @return boolean
	 */
	public static function insert($Usuario, $Roles){
		$persona = new Persona();
		$usuario = new Usuario();
		$usuario = $Usuario;

		$Base = new MySql();
		$codigoPersona = Table::__PRIMARY_KEY__($Base,"personas","IDPERSONA");
		
		$persona->setNombre($usuario->getNombre());
		$persona->setPaterno($usuario->getPaterno());
		$persona->setMaterno($usuario->getMaterno());
		$persona->setDni($usuario->getDni());
		$persona->setTelefono($usuario->getTelefono());
		$persona->setTelefonoOficina($usuario->getTelefonoOficina());
		$persona->setEmail($usuario->getEmail());
                $persona->setFechaNacimiento($usuario->getFechaNacimiento());
                $persona->setExpedido($usuario->getExpedido());
                $persona->setDireccion($usuario->getDireccion());
                $persona->setObservacion($usuario->getObservacion());
                $persona->setImagen($usuario->getImagen());
		$persona->insert($codigoPersona);

		$codigoUsuario = Table::__PRIMARY_KEY__($Base,"usuarios","IDUSUARIO");
		
		$usuario->setIdPersonaU($codigoPersona);		
		
		$usuario->insert($codigoUsuario);
		

		$usuario->setRol($Roles);
		/*$codigoUsuarioRol = Table::__PRIMARY_KEY__($Base,"usuarios_rol","IDUSUARIOROL");
		$usuario->insertUsuarioRol($codigoUsuarioRol);
	    */
		
		return true;		
	}	
	public static function insertOnlyUsuario($Usuario){
		$persona = new Persona();
		$usuario = new Usuario();
		$usuario = $Usuario;

		$Base = new MySql();
		$codigoPersona = Table::__PRIMARY_KEY__($Base,"personas","IDPERSONA");
		
		$persona->setNombre($usuario->getNombre());
		$persona->setPaterno($usuario->getPaterno());
		$persona->setMaterno($usuario->getMaterno());
		//$persona->setEdad($usuario->getEdad());
		$persona->setDni($usuario->getDni());
		//$persona->setEmail($usuario->getEmail());
		//$persona->setSexo($usuario->getSexo());
		//$persona->setEstadoCivil($usuario->getEstadoCivil());
		//$persona->setProfesion($usuario->getProfesion());
		$persona->setTelefono($usuario->getTelefono());
		$persona->setTelefono_oficina($usuario->getTelefono_oficina());
		//$persona->setDireccion($usuario->getDireccion());		
		$persona->insert($codigoPersona);

		$codigoUsuario = Table::__PRIMARY_KEY__($Base,"usuarios","IDUSUARIO");
		//$usuario->setIdPersona($codigoPersona);
		$usuario->insert($codigoUsuario);
		return true;		
	}
	
	/**
	 * Inserta los roles del usuario
	 *
	 * @param Object $Usuario
	 * @param Array $Roles
	 */
	public static function insertRoles($Usuario, $Roles){
		if ($Usuario->getIdUsuario()=="" || $Usuario->getIdUsuario()==NULL) die("Error el usuario no se inserto correctamente, revise UsuarioTransaction.insertRoles");
		$usuario = new Usuario($Usuario->getIdUsuario());
		
		$Base = new MySql();
		
			$usuario->setRol($Roles);
			$codigoUsuarioRol = Table::__PRIMARY_KEY__($Base,"usuarios_rol","IDUSUARIOROL");
			$usuario->insertUsuarioRol($codigoUsuarioRol);
		
		return true;
	}
	/**
	 * Elimina una lista serializada de usuarios
	 *
	 * @param string $strSerializado
	 * @param char $caracterSeparador
	 * @return true-false
	 */
	public static function deleteList($Serializado, $_caracter){
		if ($Serializado!="" ){
			$usuarioTransaction = new Usuario();
			$ArrayList = explode($_caracter,$Serializado);	
			for($i=0; $i<count($ArrayList) ; $i++){
				$usuarioTransaction->delete($ArrayList[$i]);
			}			
		} 
		return true;
	}
	
	
	/**
	 * Elimina el usuario
	 *
	 * @param $Usuario $Usuario
	 */
	public static function delete($id){
            $usuario = new Usuario;
	    $usuario->delete($id);
		
	}

	/**
	 * Actualizacion
	 *
	 * @param Int $usuarioActualizado
	 * @param Array $Roles
	 */
	public static function update($usuarioActualizado, $Roles){
		$usuario = new Usuario();
		$usuario = $usuarioActualizado;
		$usuario->update();

		$persona = new Persona($usuario->getIdPersona());
		$persona->setNombre($usuario->getNombre()); 
		$persona->setPaterno($usuario->getPaterno());
		$persona->setMaterno($usuario->getMaterno());
		$persona->setDni($usuario->getDni());
		$persona->setFechaNacimiento($usuario->getFechaNacimiento());
		$persona->setTelefono($usuario->getTelefono());
		$persona->setTelefonoOficina($usuario->getTelefonoOficina());
		$persona->setEmail($usuario->getEmail());
                $persona->setExpedido($usuario->getExpedido());
		$persona->setDireccion($usuario->getDireccion());
                $persona->setObservacion($usuario->getObservacion());
                $persona->setImagen($usuario->getImagen());
		$persona->update();

		//$usuario->deleteRoles($usuario->getIdUsuario());

		$Base = new MySql();

		//$usuario->setRol($Roles);
		/*$codigoUsuarioRol = Table::__PRIMARY_KEY__($Base,"usuarios_rol","IDUSUARIOROL");
		$usuario->insertUsuarioRol($codigoUsuarioRol);	
		*/
		return true;
	}
	public static function executeQuery($Query){
		
	}	
}
?>