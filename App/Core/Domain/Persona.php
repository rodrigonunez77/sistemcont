<?php 
require_once "MySql.php";
require_once "ITransaccion.php";

Class Persona implements ITransaccion  {
	private $idPersona;
	private $nombre;
	private $paterno;
	private $materno;
	private $dni;
	private $telefono;
	private $telefonoOficina;
	private $email;
        private $fechaNacimiento;
        private $expedido;
        private $direccion;
        private $observacion;
        private $imagen;
                
	function __construct($idPersona='') {
		if(trim($idPersona!='')){
			$Base = new MySql();
			$Sql = "SELECT * FROM personas WHERE personas.IDPERSONA= '".$idPersona."';";
			$Base->Query($Sql);
			if($Base->NumRows()==1 && $Row = $Base->NextRecord()){
				$this->idPersona= $Row['IDPERSONA'];
				$this->nombre = $Row['NOMBRE'];	
				$this->paterno = $Row['PATERNO'];	
				$this->materno = $Row['MATERNO'];	
				$this->dni= $Row['DNI'];
				$this->telefono = $Row['TELEFONO'];	
				$this->telefonoOficina = $Row['TELEFONO_OFICINA'];	
				$this->email = $Row['EMAIL'];	
                                $this->fechaNacimiento= $Row['FECHANACIMIENTO'];
                                $this->expedido= $Row['EXPEDIDO'];
                                $this->direccion= $Row['DIRECCION'];
                                $this->observacion= $Row['OBSERVACION'];
                                $this->imagen= $Row['IMAGEN'];
                                
			}
			else{
				if($idPersona!=0)
					trigger_error("Error en la clase: PERSONA, funcion: __construct".$Sql); 
			}				
		}
		
	}
	
	public function getEmail() {		return $this->email;	}
	
	public function setEmail($email) {		$this->email = $email;	}

	public function getDni() {		return $this->dni;	}
	
	public function getIdPersona() {		return $this->idPersona;	}
	
	public function getMaterno() {		return $this->materno;	}
	
	public function getNombre() {		return $this->nombre;	}
	
	public function getPaterno() {		return $this->paterno;	}
	
	public function getTelefono() {		return $this->telefono;	}
	
	public function getTelefonoOficina() {		return $this->telefonoOficina;	}
	
	public function setDni($dni) {		$this->dni = $dni;	}
	
	public function setIdPersona($idPersona) {		$this->idPersona = $idPersona;	}
	
	public function setMaterno($materno) {		$this->materno = $materno;	}
	
	public function setNombre($nombre) {		$this->nombre = $nombre;	}
	
	public function setPaterno($paterno) {		$this->paterno = $paterno;	}
	
	public function setTelefono($telefono) {		$this->telefono = $telefono;	}
	
	public function setTelefonoOficina($telefonoOficina) {		$this->telefonoOficina = $telefonoOficina;	}
        
        public function setFechaNacimiento($fechaNacimiento) {		
            $this->fechaNacimiento = $fechaNacimiento;	
            
        }
        
        public function getFechaNacimiento() {		
            return $this->fechaNacimiento;	
            
        }
        
         public function setExpedido($expedido) {		
            $this->expedido = $expedido;	
            
        }
        
        public function getExpedido() {		
            return $this->expedido;	
            
        }
        
         public function setDireccion($direccion) {		
            $this->direccion = $direccion;	
            
        }
        
        public function getDireccion() {		
            return $this->direccion;	
            
        }
        
        public function setObservacion($observacion) {		
            $this->observacion = $observacion;	
            
        }
        
        public function getObservacion() {		
            return $this->observacion;	
            
        }
        
        public function setImagen($imagen) {		
            $this->imagen = $imagen;	
            
        }
        
        public function getImagen() {		
            return $this->imagen;	
            
        }
/**
	 * @see ITransaccion::delete()
	 *
	 * @param [int] $id
	 */
	public function delete($id='') {
		$Base = new MySql();
		if(trim($id)=='')
			$id = $this->idPersona;

		$Sql = "DELETE FROM personas WHERE personas.IDPERSONA = '".$id."';";
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
		$Sql = "INSERT INTO personas (
					IDPERSONA,
					NOMBRE ,
					PATERNO,
					MATERNO,
					DNI,
					TELEFONO,
					TELEFONO_OFICINA,
					EMAIL,
                                        FECHANACIMIENTO,
                                        EXPEDIDO,
                                        DIRECCION,
                                        OBSERVACION,
                                        IMAGEN
					)
					VALUES (
						'".$id."', 
						'".$this->nombre."', 
						'".$this->paterno."' , 
						'".$this->materno."',
						'".$this->dni."',
						'".$this->telefono."',
						'".$this->telefonoOficina."',
						'".$this->email."' ,
                                                '".$this->fechaNacimiento."',
                                                '".$this->expedido."' ,
                                                '".$this->direccion."' ,
                                                '".$this->observacion."',
                                                '".$this->imagen."' 
					);";
		//echo $Sql;
		$Base->Query($Sql);
		$this->idPersona = $id;  	
	}
	
	/**
	 * @see ITransaccion::update()
	 *
	 * @param [int] $id
	 */
	public function update($id='') {
		$Base = new MySql();
		$Sql = "UPDATE personas SET 
						NOMBRE = '".$this->nombre."', 
						PATERNO='".$this->paterno."',
						MATERNO='".$this->materno."',
						DNI='".$this->dni."', 
						TELEFONO='".$this->telefono."',
						TELEFONO_OFICINA='".$this->telefonoOficina."',
						EMAIL='".$this->email."',
                                                FECHANACIMIENTO='".$this->fechaNacimiento."',
                                                EXPEDIDO='".$this->expedido."',
                                                DIRECCION='".$this->direccion."',
                                                OBSERVACION='".$this->observacion."',
                                                IMAGEN='".$this->imagen."'
						";
		if(trim($id)!='')
			$Sql = $Sql." WHERE personas.IDPERSONA='".$id."';";
		else 
			$Sql = $Sql." WHERE personas.IDPERSONA ='".$this->idPersona."';";
		$Base->Query($Sql);
	}

	/**
	 * Obtiene la lista de todos las Oecas
	 * (Se puede dar la clausula WHERE para seleccion)'
	 * 
	 * @param [String] $SqlWhere
	 */
	public static function getList($SqlWhere = ''){
		$Base = new MySql();
		$Sql = "SELECT * FROM personas ".$SqlWhere;
		$Base->Query($Sql);
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