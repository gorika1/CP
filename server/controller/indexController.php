<?php

	require_once 'server/model/cursosModel.php';
	require_once 'server/model/tematicasModel.php';
	require_once 'server/model/institucionesModel.php';
	require_once 'server/view/indexView.php';

	if( isset( $_GET[ 'cat' ] ) ) 
	{
		$myTematica = new Tematica();//crea un objeto Tematica

		//Si la tematica pasada no existe en la base de datos
		if( !$myTematica->getIdTematica( $_GET[ 'cat' ] ) ) 
		{
			$errorTemplate = file_get_contents( 'client/html/notification/error.html' );//Obtiene el template de error
			$index->setPage( $errorTemplate );//Establece el template del objeto index			
			require_once 'server/controller/errorController.php';//Y llama al controlador de error
			exit();
		
		} 
		else //Si existe la tematica, pasa true para que CursosView solo obtenga los cursos relacionados con la tematica pasada
		{
			$page = new IndexView( true );
		}//end if...else interno

	//Si no existe una tematica especificada, se mostraran todos los cursos
	} else {
		$page = new IndexView( false );
	}//end if...else

	$page->translatePage( 'Cursos - Conocimiento Plus', array( 'Cursos', 'Tematicas' ) );//Traduce la pagina

?>