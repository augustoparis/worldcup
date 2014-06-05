<?php

class Session {

	public static function start() {
		if ( !isset($_SESSION) ) 
			session_start();
	}
	
	public static function finish() {
		session_unset( $_SESSION );
	}
	
	public static function create( $retorno ) {
		$_SESSION['ID_OPERADORES'] 	= $retorno['ID_OPERADORES'];
		$_SESSION['USUARIO'] 		= $retorno['USUARIO'];
		$_SESSION['NOME'] 			= $retorno['NOME'];
		$_SESSION['EMAIL'] 			= $retorno['EMAIL'];
	}
	
	public static function get( $param ) {
		return $_SESSION[ $param ];	
	}
	
	public static function validate() {
		if ( empty($_SESSION) ) {
			echo "<div style='color:#FF0000; font-style:italic; margin:10px auto 0; text-align:center; width:300px;' >";
			echo "<p>Usuário não está logado!</p>";	
			echo "</div>";			
			echo "<script>";
			echo "window.setTimeout(function() {"; 
			echo "	window.location.href = '?';"; 
			echo "}, 2000);";
			echo "</script>";
			
			return false;
		}	
		
		return true;
	}
}