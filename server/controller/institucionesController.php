<?php

	require_once 'server/model/institucionesModel.php';
	require_once 'server/view/institucionesView.php';

	$page = new institucionesView();
	$page->translatePage( 'Instituciones - Conocimiento Plus', array( 'Instituciones' ) );

?>