<?php
  
require_once("DataBase.php");
require_once("Crypto.php");
require_once("Util.php");
  
class Users
{
    var $database;
      
    public function __construct() {
    	Utils::setFullLimit();
		
        $this->database = new DataBase();
    }
	      
    public function all( $params ) {
    	$sql  = "";
        $sql .= " SELECT * ";
        $sql .= " FROM USERS ";
        $sql .= " WHERE ACTIVE = " . $params['active'];
        	
		$retorno = $this->database->select_sql( $sql );
		foreach ($retorno as $key => $value) {
			$retorno[ $key ][ 'PASSWORD' ] = Crypto::decode( $value['PASSWORD'] );
		}
		return $retorno;
	}  
	
	public function edit( $params ) {
		$code = utf8_decode($params['code']);
		
    	$sql  = "";
        $sql .= " SELECT * FROM USERS ";
        $sql .= " WHERE ID_USER = " . $code;
			 
       	$r = $this->database->select_sql( $sql );
		$r[0]['PASSWORD'] = Crypto::decode($r[0]['PASSWORD']);
		return $r[0];
	}		

	private function userExist( $params ) {
		$params = utf8_decode($params);
		
    	$sql  = "";
        $sql .= " SELECT * FROM OPERADORES ";
        $sql .= " WHERE USUARIO = '" . $params . "'";
        $sql .= " ORDER BY ID_OPERADORES ";
			 
       	return $this->database->select_sql( $sql );
	}
	
	// private function emailExiste( $params ) {
		// $params = utf8_decode($params);
// 		
    	// $sql  = "";
        // $sql .= " SELECT * FROM OPERADORES ";
        // $sql .= " WHERE EMAIL = '" . $params . "'";
        // $sql .= " ORDER BY ID_OPERADORES ";
// 			 
       	// return $this->database->select_sql( $sql );
	// }
	
	private function validate( $params ) {
		if ( $params['id_user'] == 0 ) 
		{
			$r = $this->userExist( $params['username'] );
			if ( is_array($r) ) 
				return 'Este usuário já está sendo usado.';
		
			//$r = $this->emailExiste( $params['email'] );
			//if ( is_array($r) ) 
				//return 'Este endereço de e-mail já está sendo usado.';
		}
		
		return true;
	}				
       
    public function save( $params ) {
    	if ( is_string($r = $this->validate( $params )) ) {
    		return $r;
    	}
    	
    	// if ( array_key_exists('operadores-novo', $params) ) {
 		   	// $params['id_operadores'] = 0;
 		   	// $params['ativo'] = '1';
    	// } else {
    		// $params['email'  ] = Session::get('EMAIL');
			// $params['usuario'] = Session::get('USUARIO');
    	// }
    	
    	$id_operadores 	= utf8_decode( $params['id_operadores'] );
    	$nome  		   	= utf8_decode( $params['nome'] );		
 		$email 	 		= utf8_decode( $params['email'] );		
		$usuario 		= strtoupper(utf8_decode( $params['usuario'] ));
    	$senha 	 	   	= Crypto::encode(strtoupper(utf8_decode( $params['senha'] )));
    	$ativo 	 	   	= utf8_decode( $params['ativo'] );
    	    	    	
    	$params = array(
    		'ID_USER' 		=> $id_operadores,
    		'NAME' 			=> "'$nome'",
    		'EMAIL' 		=> "'$email'",
    		'USERNAME' 		=> "'$usuario'",
    		'PASSWORD' 		=> "'$senha'",
    	    'ACTIVE' 		=> $ativo,
    	    'ACCESS_LEVEL' 	=> $ativo
    	);
    	
    	return (int) $this->database->execute_sp('SX_USERS', $params, $id_name, $id);
    }

	public function remove( $params ) {
		$code = utf8_decode($params['code']);
		return $this->database->execute_sql("UPDATE USERS SET ACTIVE = 0 WHERE ID_USER = $code ");
	}	
}