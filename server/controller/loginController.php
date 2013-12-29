<?php

	require_once 'server/model/usuariosModel.php';

	require_once 'server/view/loginView.php';

	$usuario = new Usuario();
	
	//Si intenta loguearse
	if( isset( $_POST [ 'correo'] ) && isset( $_POST[ 'pass' ] ) ) {

		$datos = array( $_POST[ 'correo' ], $_POST[ 'pass'] );//datos a comprobar
		
		if( $usuario->iniciarSesion( $datos ) ) {
			header( "Location: ".Connecting::$server );
			echo 'Se inicio sesion correctamente';

		} else {

			echo 'Los datos ingresados no son correctos';

		}//end else...if

	
	} else {
		//Si intenta registrarse
		if( isset( $_POST[ 'registro' ] ) && $_POST[ 'registro' ] == "si" ) {
			$datos = array( $_POST[ 'registro-correo' ] );//dato a comprobar

			if( $usuario->setUsuario( $datos ) ) {
				echo 'hola';
			}//end if

		}//end if

	}//end if..else

	$page = new LoginView();
	$page->translatePage( 'Registro - Conocimiento Plus' );

?>