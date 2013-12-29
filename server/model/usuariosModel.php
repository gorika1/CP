<?php

	class Usuario {

		private $usuario;
		private $colsTable;
		private $values;


		public function __construct() {
			

		}//end __construct


		public function iniciarSesion( $datos = array() ) {

			$values = 'idUsuario, nombreUsuario, avatar, TiposUsuarios_idTipoUsuario';
			$colTable = array( 'correoUsuario' );

			//Si existe una cuenta que coincida con los datos
			if( $this->usuario = Login::existAccount( 'Usuarios', $colTable, $datos, $values ) ) {
				
				//Crea los valores en SESSION
				$_SESSION[ 'idUsuario' ] = $this->usuario[ 'idUsuario' ];
				$_SESSION[ 'usuario' ] = $this->usuario[ 'nombreUsuario' ];
				$_SESSION[ 'avatar' ] = $this->usuario[ 'avatar' ];
				$_SESSION[ 'user-level' ] = $this->usuario[ 'TiposUsuarios_idTipoUsuario' ];
				
				//Se inicio la sesion y se retorna true
				return true;

			} else {//Si hubo un error en la comprobacion de datos
				return false;

			}//end if..else
			

		}//end iniciarSesion



		//**********************************************************************************************

		public function setUsuario( $datos ) {

			$colsTable = array( 'correoUsuario' );

			if( !Login::existAccount( 'Usuarios', $colsTable, $datos, 'idUsuario' ) ) {
				
				if( Work::setRegister( 'Usuarios', 'nombreUsuario, correoUsuario, pass, TiposUsuarios_idTipoUsuario', 
					sprintf(
							"'".$_POST[ 'registro-nombre' ]."', ".
							"'".$_POST[ 'registro-correo' ]."', ".
							"'".$_POST[ 'registro-pass' ]."',".
							'1'
						) ) ) {

					return true;

				}///end if interno

			} else {
				return false;

			}//end if...else

		}//end setUsuario


		//**********************************************************************************************


		public function getCursosDelUsuario() {

			$idCursos = Work::getRegisters( 'Cursos_has_Usuarios', 'Cursos_idCurso', 'Usuarios_idUsuario='.$_SESSION[ 'idUsuario' ] );

			//Por cada id de los cursos en donde se participa
			foreach ( $idCursos as $idCurso ) {				
				$cursos[] = Work::getRegister( 'Cursos', 'curso, imagen', 'idCurso='.$idCurso[ 'Cursos_idCurso' ] );

			}

			return $cursos;
		}

	}//end Usuario

?>