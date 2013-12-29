<?php

	require_once 'server/libraries.php'; // Carga las librerias a usar

	$config = require 'config.php';

	$server = 'http://'.$config[ 'server' ];	

	$login = new Login();

	$dictionary = new Dictionary( $config[ 'Master Page' ] ); // pasa el objeto index por referencia para poder imprimir la pagina
	$dictionary->cualquier();
	/*require_once 'server/controller/userBarController.php';
	$userBar = new UserBarView();
	$userBarTemplate = $userBar->getTemplate();

	$dictionary->setDictionaryConst( $userBarTemplate, 'USER BAR' );*/


	$urlController = $dictionary->getMVC( 'action', 'index', 'error' );//obtiene el controller de acuerdo al valor de la posicion action en $_GET[]

	

//*****************************************************************


	require_once $urlController;