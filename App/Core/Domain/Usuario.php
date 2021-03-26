<?php
require_once "MySql.php";
require_once "ITransaccion.php";
require_once "Persona.php";


class Usuario extends Persona implements ITransaccion  {
	// clase solo para sacar datos de usuario, no para modificar
	private $idUsuario;	
	private $idPersonaU;
	private $idLugar;
	private $departamento;
	private $login;
	private $password;
	private $fecha;
	private $imagen;
	private $rol;
	private $estado;
	private $cargo;
	private $passwordRoot;
	private $seccion;

	public static $__ROLES = array("ADMINISTRADOR GENERAL","OPERADOR DE ACTIVOS","ENCARGADO DE SISTEMAS","TECNICO DE SISTEMAS","PERSONAL");  
	
	function __construct($idUsuario='') {
		if(trim($idUsuario!='')){
			
			$Base = new MySql();
			$Sql = "SELECT * FROM  `usuarios` WHERE usuarios.IDUSUARIO = '".$idUsuario."';";
			$Base->Query($Sql);
			if($Base->NumRows()==1 && $Row = $Base->NextRecord()){
				
				parent::__construct($Row['IDPERSONA']);

				$this->idUsuario= $Row['IDUSUARIO'];
				$this->idPersonaU = $Row['IDPERSONA'];	
				$this->idLugar = $Row['IDLUGAR'];	
				$this->departamento = $Row['DEPARTAMENTO'];	
				$this->login = $Row['LOGIN'];	
				$this->password = $Row['PASSWORD'];	
				$this->fecha= $Row['FECHA'];
				$this->imagen= $Row['IMAGEN'];
				$this->estado= $Row['ESTADO'];
				$this->cargo= $Row['CARGO'];
				$this->rol= $Row['ROL'];
				$this->passwordRoot= $Row['PASSWORDROOT'];
				$this->seccion= $Row['SECCION'];
                                
			}
			else{
				if($idUsuario!=0)
					trigger_error("Error en la clase: USUARIO, funcion: __construct".$Sql); 
			}				
		}
	}
	
	public function getDepartamento() {		return $this->departamento;	}
	
	public function setDepartamento($departamento) {		$this->departamento = $departamento;	}
	
	public function getIdLugar() {		return $this->idLugar;	}
	
	public function setIdLugar($idLugar) {	$this->idLugar = $idLugar;	}
	
	public function getFecha() {		return $this->fecha;	}
	
	public function getIdUsuario() {		return $this->idUsuario;	}
	
	public function getLogin() {		return $this->login;	}
	
	public function getPassword() {		return $this->password;	}

	public function setFecha($fecha) {		$this->fecha = $fecha;	}
	
	public function setIdUsuario($idUsuario) {		$this->idUsuario = $idUsuario;	}
	
	public function setLogin($login) {		$this->login = $login;	}
	
	public function setPassword($password) {		$this->password = $password;	}
	
	public function getImagen() {		return $this->imagen;	}
	
	public function setImagen($imagen) {		$this->imagen = $imagen;	}
	
	public function getCargo() {		return $this->cargo;	}
	
	public function setCargo($cargo) {		$this->cargo = $cargo;	}

	public function getEstado() {		return $this->estado;	}
	
	public function setEstado($estado) {		$this->estado = $estado;	}

	public function getPasswordRoot() {		return $this->passwordRoot;	}
	
	public function setPasswordRoot($passwordRoot) {		$this->passwordRoot = $passwordRoot;	}

	public function getSeccion() {		return $this->seccion;	}
	
	public function setSeccion($seccion) {		$this->seccion = $seccion;	}



	public function setRol($rol) {				
	     $this->rol = $rol;	
	}
	
	public function setIdPersonaU($idPersona){ $this->idPersonaU = $idPersona  ;   }

	
	/**
	 * @see ITransaccion::delete()
	 *
	 * @param [int] $id
	 */
	public function delete($id='') {
		$Base = new MySql();
		if(trim($id)==''){
			$id = $this->idUsuario;
			parent::delete($this->getIdPersona());	
		}
		$Sql = "DELETE FROM usuarios WHERE usuarios.IDUSUARIO = '".$id."';";
		$Base->Query($Sql);	
		
	}
	
	
	
	/**
	 * @see ITransaccion::find()
	 *
	 * @param int $id
	 */
	public function find($id) {
	}
	
	/**
	 * @see ITransaccion::insert()
	 *
	 * @param int $id
	 */
	public function insert($id) {
		$Base = new MySql();
		$Sql = "INSERT INTO usuarios (
					IDUSUARIO,
					IDPERSONA ,
					IDLUGAR,
					DEPARTAMENTO,
					LOGIN,
					PASSWORD,
					FECHA,
					IMAGEN,
					ESTADO,
					CARGO,
					ROL,
					PASSWORDROOT,
					SECCION 
					)
					VALUES (
						'".$id."', 
						'".$this->idPersonaU."',
						'".$this->idLugar."',
						'".$this->departamento."',
						'".$this->login."' , 
						'".$this->password."',
						'".$this->fecha."',
						'".$this->imagen."' ,
						'".$this->estado."' ,
						'".$this->cargo."',
						'".$this->rol."',
						'".$this->passwordRoot."',
						'".$this->seccion."' 

					);";
		$Base->Query($Sql);
		$this->idUsuario = $id;  

		//insertPuestosVenta();	
	}
	
	/**
	 * @see ITransaccion::update()
	 *
	 * @param [int] $id
	 */
	public function update($id='') {
		$Base = new MySql();
		$Sql = "UPDATE usuarios SET 
						IDPERSONA = '".$this->idPersonaU."', 
						IDLUGAR = '".$this->idLugar."',
						DEPARTAMENTO = '".$this->departamento."',
						LOGIN='".$this->login."',
						PASSWORD='".$this->password."',
						FECHA='".$this->fecha."',
						IMAGEN='".$this->imagen."',
						ESTADO='".$this->estado."',
						CARGO='".$this->cargo."' ,
						ROL='".$this->rol."',
						SECCION='".$this->seccion."' 
						";
		if(trim($id)!='')
			$Sql = $Sql." WHERE usuarios.IDUSUARIO='".$id."';";
		else 
			$Sql = $Sql." WHERE usuarios.IDUSUARIO ='".$this->idUsuario."';";
		$Base->Query($Sql);
		//$this->insertPuestosVenta();
	}

	public function insertUsuarioRol($idUsuario_Rol){
		$Base = new MySql();
		
		$Sql = "INSERT INTO usuarios_rol(
					IDUSUARIOROL,
					IDUSUARIO,
					ROL)
					VALUES(
						'".$idUsuario_Rol."',
						'".$this->idUsuario."',
						'".$this->rol."'		
					);";
		$Base->Query($Sql) ;
	}
	
	
	/**
	 * Obtiene la lista de todos las Oecas
	 * (Se puede dar la clausula WHERE para seleccion)'
	 * 
	 * @param [String] $SqlWhere
	 */
	public static function getList($SqlWhere = ''){
		$Base = new MySql();
		$Sql = "SELECT * FROM usuarios ".$SqlWhere;
		$Base->Query($Sql);
		$Data = array();	
		$NumRow = 0;
		while ($Base->NumRows()>0 && $Row = $Base->NextRecord()){
			$Data[$NumRow] = $Row;		
			$NumRow++;
		}		
		return $Data;		
	}

    public static function getRoles($idUsuario=''){
    	return $this->rol;
		/*$Base = new MySql();
		if($idUsuario!='')
			$Sql = "SELECT * FROM usuarios_rol WHERE IDUSUARIO ='".$idUsuario."'";
		else
			$Sql = "SELECT * FROM usuarios_rol WHERE IDUSUARIO ='".$this->idUsuario."'";
			
		$Base->Query($Sql);
		$Data = array();	
		$NumRow = 0;
		while ($Base->NumRows()>0 && $Row = $Base->NextRecord()){
			$Data[$NumRow] = $Row;		
			$NumRow++;
		}		
		return $Data;*/	
	}
	

	public function deleteRoles($idUsuario){
		$Base = new MySql();
		
		$Sql = "DELETE FROM usuarios_rol WHERE usuarios_rol.IDUSUARIO=".$idUsuario;
		$Base->Query($Sql) ;		
	}	
	//funcion para cualque tipo de consulta para el usuario
	public static function getListQueryUsuario($SqlWhere ){
		$Base = new MySql();
		$Base->Query($SqlWhere);
		$Data = array();	
		$NumRow = 0;
		while ($Base->NumRows()>0 && $Row = $Base->NextRecord()){
			$Data[$NumRow] = $Row;		
			$NumRow++;
		}		
		return $Data;		
	}
}
?>