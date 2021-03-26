<?php
class Security {
	
	static function InitializeSession($ROL,$IDUSUARIO,$USUARIO,$IDPERSONA,$NOMBRECOMPLETO,$IMAGEN,$IDLUGAR,$DEPARTAMENTO,$DEPENDENCIA,$TIPO,$NOMBREDEPENDENCIA,$NIVEL,$SECCION){

		session_set_cookie_params(0,"/");
		ini_set("session.gc_maxlifetime",50000);
		
		session_start();

		 

		$_SESSION['LAST_LOGIN'] = time();
		$_SESSION['ROLES']=$ROL;
		$_SESSION['IDUSUARIO']=$IDUSUARIO;
		$_SESSION['IDLUGAR']=$IDLUGAR;
		$_SESSION['USUARIO']=$USUARIO;
		$_SESSION['IDPERSONA']=$IDPERSONA;
		$_SESSION['NOMBRECOMPLETO']= $NOMBRECOMPLETO;
		
		$_SESSION['IMAGEN']= $IMAGEN;
		$_SESSION['DEPARTAMENTO']= $DEPARTAMENTO;
		$_SESSION['DEPENDENCIA']= $DEPENDENCIA;
		$_SESSION['TIPO']= $TIPO;
		$_SESSION['NOMBREDEPENDENCIA']= $NOMBREDEPENDENCIA;
		$_SESSION['NIVEL']= $NIVEL;
		$_SESSION['SECCION']= $SECCION;
		$_SESSION['IDENTIFICADOR']=$IDUSUARIO.'ACTIVOS';
		
	
		/*$value = 'cualquier cosa';

		setcookie("TestCookie", $value);
		setcookie("TestCookie", $value, time()+3600);
		*/
		
		//session_register("virtual2");
		$virtual = array();		
	}
	static function getSessionId(){
		return session_id();	
			
	}	
	/**
	 * *Actualizado para php5, para xampp 5.6.3
	 *
	 * @return unknown
	 */
	
	static function ValidSession(){
		/*if(isset($_COOKIE["TestCookie"])){
			session_start();
	  	}*/
		//echo $_COOKIE["PHPSESSID"];

		ini_set("session.gc_maxlifetime",5000000);
		if(isset($_COOKIE["PHPSESSID"])){
			ini_set("session.gc_maxlifetime",5000000);
			session_start();
			//print_r($_SESSION['LAST_LOGIN']);
			//
				// 30 segundos = medio minuto
				// 1800 segundos = 30 minutos
				// 900 segundos = 15 minutos
			   if (isset($_SESSION['LAST_LOGIN']) && (time() - $_SESSION['LAST_LOGIN'] > 129600000)) {  
			     if (isset($_COOKIE[session_name()])) {  
			       setcookie(session_name(), "", time() - 360000, "/");  
			       //limpiamos completamente el array superglobal    
			       session_unset();  
			       //Eliminamos la sesión (archivo) del servidor   
			       session_destroy();  
			     }  
			     echo "tiempo expirado...";  
			     exit;  
			   } 		
			//			
	  	}
	  	else {
			echo "incorrecto inicio de session. ACCESO DENEGADO!"; 
			echo "<script languaje='javascript'> location='http://localhost/sistemCont'; </script>";
			die();
	  	}
	}
	static function endSession($startPage='',$VARS){
		session_start();
		$_COOKIE["PHPSESSID"] = array();
		echo '<meta http-equiv="pragma" content="no-cache">';
		header("Location: ../Main/index.php");
		echo '<meta http-equiv="pragma" content="no-cache">';
	}
	static function SecurityMeta(){
		echo '<meta http-equiv="pragma" content="no-cache">';		
	}
	
    // aun no funciona bien con urls
	private static $Key = "";
	/* 
    public static function encrypt ($input) {
        $output = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(Security::$Key), $input, MCRYPT_MODE_CBC, md5(md5(Security::$Key))));
        return $output;
    }
 
    public static function decrypt ($input) {
        $output = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5(Security::$Key), base64_decode($input), MCRYPT_MODE_CBC, md5(md5(Security::$Key))), "\0");
        return $output;
    }
    */
    public static function encrypt ($input) {
        
        return $input;
    }
 
    public static function decrypt ($input) {
        
        return $input;
    }
    // esto si funciona con urls
    private static $semilla = "4827397";
	public static function _enc($s){
	    $str = (string) $s ;
	    if ('' == trim($str)) {
	        return '';
	    }
	    for ($i = 0; $i < strlen($str); $i++) {
	        $r[] = hexdec(decoct(ord($str[$i]) + Security::$semilla));
	    }
	    return implode('_', $r);
	}
	
	public static function _dec($s){
	    $str = (string) $s;
	    if ('' == trim($str)) {
	        return '';
	    }
	    $s = explode('_', $str);
	    for ($i = 0; $i < count($s) ; $i++) {
	        $s[$i] = chr(octdec(dechex($s[$i])) - Security::$semilla);
	    }
	    $cad = implode('', $s);
	    return $cad;
	}
}
?>