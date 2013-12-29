<?php

	require_once 'server/model/cursosModel.php';
	require_once 'server/model/modulosModel.php';
	require_once 'server/model/institucionesModel.php';
	require_once 'server/view/fichaCursoView.php';

	
	//Si se pasa el nombre de un curso
	if( isset( $_GET[ 'c' ] ) ) {
		$myCurso = new Curso();

		//Si no existe el curso pasado, se carga el template de error
		if( !$myCurso->getIdCurso( $_GET[ 'c' ] ) ) {
			$errorTemplate = file_get_contents( 'client/html/notification/error.html' );
			$dictionary->setPage( $errorTemplate );
			require_once 'server/controller/errorController.php';
			exit();

		}//end if interno
		

		if( isset( $_POST[ 'inscribirse' ] ) ) {
			$idCurso = $myCurso->getIdCurso( $_GET[ 'c' ] );//Obtiene el idCurso utilizando el nombre del curso pasado por GET

			if( $_POST[ 'inscribirse' ] == "si" ) {							
				Work::setRegister( 'Cursos_has_Usuarios', '*', $idCurso.", ".$_SESSION[ 'idUsuario' ] );

			} else if( $_POST[ 'inscribirse' ] == "no" ) {
				Work::deleteRegister( 'Cursos_has_Usuarios', 'Cursos_idCurso='.$idCurso." AND Usuarios_idUsuario=".$_SESSION[ 'idUsuario' ] );
				Work::viewQuery();

			}//end if...else
		
		}//end if interno

	}//end if

	$page = new FichaCursoView();
	$page->translatePage();

?>