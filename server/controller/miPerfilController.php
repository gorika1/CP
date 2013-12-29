<?php

	require_once 'view/miPerfilView.php';
	require_once 'model/usuariosModel.php';

	if( isset( $_SESSION[ 'idUsuario'] ) ) {
		$myPefil = new miPerfilView();
		$myPefil->traducirPagina();

	} else {
		header( 'Location: '.Connecting::$server.'login/');

	}//end if...else
	

?>