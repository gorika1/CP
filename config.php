<?php

	return array(
		'Master Page' => array(
			'HEAD' 		=> 'head',
			'HEADER' 	=> 'header',
			'FOOTER' 	=> 'footer',
			'With Controller'  => array(
				'USER BAR' => array(
					'Files Names' => 'UserBar',
				),
			),
		),

		'server' => $_SERVER[ 'HTTP_HOST'].'/CP_Bootstrap',
	);

	//****************************************************************
	//*********************** VARIABLES GENERALES ********************
	//****************************************************************
	$login = new Login();
	$login->setFolder( 'media/html/cp-levels/' );

	

	$headTemplate = file_get_contents( 'media/html/cp-includes/head.html' );

	$headerTemplate = file_get_contents( 'media/html/cp-includes/header.html' );

	$footerTemplate = file_get_contents( 'media/html/cp-includes/footer.html' );

	
	$index = new Index( $headTemplate, $headerTemplate, $footerTemplate );

	$dictionary = new Dictionary( $index );//pasa el objeto index por referencia para poder imprimir la pagina

	require_once 'controller/userBarController.php';
	$userBar = new UserBarView();
	$userBarTemplate = $userBar->getTemplate();


	$dictionary->setDictionaryConst( $userBarTemplate, 'USER BAR' );

	$urlController = $index->getMVC( 'action', 'index', 'error' );//obtiene el controller de acuerdo al valor de la posicion action en $_GET[]

	

//*****************************************************************


	require_once $urlController;