<?php

	class Curso {

		private $cursos;
		private $tematica;
		private $idProfesores;
		private $profesores;
		private $instituciones;
		private $nombreCursoFormateada;

		private $institucionObj;


		public function __construct() {
			$this->institucionObj = new Institucion();
		}


		//*****************************************************************************************************


		private function procesarCursos() {

			//Por cada curso
			for( $i = 0; $i < sizeof( $this->cursos ); $i++ ) {

				$this->cursos[ $i ][ 'tematica' ] = $this->getTematica( $this->cursos[ $i ][ 'Tematicas_idTematica' ] );//crea la clave tematica y obtiene el valor 


				$this->cursos[ $i ][ 'cursoFormateado' ] = Work::textFormat( $this->cursos[ $i ][ 'curso' ], '_' );//formatea el nombre del curso para crear la url


				$this->instituciones = $this->institucionObj->getInstitucionesByIdCurso( $this->cursos[ $i ][ 'idCurso' ] );//)btiene las instituciones que imparten un curso


				foreach ( $this->instituciones as $institucion ){
					$this->cursos[ $i ][ 'instituciones' ][] = $institucion;//Y lo almacena las instituciones

				}//end foreach
				
			}//end for

		}//end procesarCurso



		//********************************************************************************************


		private function getTematica( $idTematica ) {
			$this->tematica = Work::getRegister( 'Tematicas', 'tematica', 
				sprintf( 'idTematica=%s', 
						$idTematica

					) );//obtiene la tematica gracias al id pasada como parámetro

			return ( $this->tematica[ 'tematica' ] );//devuelve el nombre de la tematica
		}//end getTematica



		//********************************************************************************************


		public function getCursos() {
			$values = 'idCurso, curso, descripcion, imagen, Tematicas_idTematica';

			$this->cursos = Work::getRegisters( 'Cursos', $values );//obtiene los registros de la tabla Cursos
			
			$this->procesarCursos();

			return $this->cursos;
		}//end getCursos



		//***********************************************************************************************


		public function getCursoByIdCurso( $idCurso ) {
			$values = 'curso, descripcion, videoPresentacion, conocimientosNecesarios, fechaInicio';

			$curso = Work::getRegister( 'Cursos', $values, 
				sprintf(
						'idCurso=%s',
						$idCurso
					) );

			$curso[ 'fechaInicio' ] = Work::dateReverse( $curso[ 'fechaInicio' ], '/' );
			
			return $curso;

		}//end getCursoByIdCurso



		//**************************************************************************************************


		public function getCursosByIdTematica( $idTematica ) {
			$this->cursos = Work::getRegisters( 'Cursos', '*', 
				sprintf(
						'Tematicas_idTematica=%s',
						$idTematica
					) );
					
			$this->procesarCursos();

			return $this->cursos;

		}//end getCursosByIdCategoria



//************************************************************************************************************


		//Obtiene el id del curso gracias al nombre
		public function getIdCurso( &$nombreCurso ) {
			$nombre = Work::textFormat( $nombreCurso, '_', false );//al pasar false convierte el caracter _ en un espacio

			$id = Work::getRegister( 'Cursos', 'idCurso', 
				sprintf(
						'curso=%s',
						"'".$nombre."'"
					) );
			
			return $id[ 'idCurso' ];
		}//end getIdCurso


//***************************************************************************************************************


		public function getProfesores( $idCurso ) {

			$idProfesores = Work::getRegisters( 'Cursos_has_Instituciones', 'Profesores_Usuarios_idUsuario',
			sprintf(
					'Cursos_idCurso=%s',
					$idCurso
				) );

			$idProfesores2[ 0 ] = $idProfesores[ 0 ];//Copia el primer valor, ya que nunca sera repetido

			//itera a traves de los idProfesores sin filtrar
			for( $i = 1; $i < sizeof( $idProfesores ); $i++ ) {

				//Itera a traves de los idProfesores ya filtrados
				for( $j = 0; $j < sizeof( $idProfesores2 ); $j++ ) {

					//Si en los filtrados no existe uno con el mismo idUsuario
					if( $idProfesores2[ $j ][ 'Profesores_Usuarios_idUsuario' ] != $idProfesores[ $i ][ 'Profesores_Usuarios_idUsuario'] ) {

						$idProfesores2[] = $idProfesores[ $i ];//Agrega una posicion en los filtrados y copia el valor

					}//end if
				}//end for

			}//end for

			//Por cada identificador de profesores
			foreach ( $idProfesores2 as $idProfesor ) {
				$this->profesores[] = Work::getRegister( 'Usuarios', 'nombreUsuario, avatar',
					sprintf(
							'idUsuario=%s',
							$idProfesor[ 'Profesores_Usuarios_idUsuario' ]
						) );
			}//end foreach

			return $this->profesores;

		}//end getProfesores



		//****************************************************************************************************
		


		public function getInstitucionesAsString( &$curso ) {
			$cant = 0;//Contador de instituciones en un mismo curso
			$diccionarioInstitucion = '';//inicializa diccionarioInstitucion

			//Por cada institucion de un curso
			foreach ( $curso[ 'instituciones' ] as $institucion ) {

				//Si es la primera institucion extraida
				if( $cant == 0 ) {
					$diccionarioInstitucion = "<span class='institution-name lg-sm-center visible-lg visible-md'>".
													$institucion[ 'institucion' ].
											   "</span>".
											   "<span class='btn btn-primary institution-name lg-sm-center visible-sm visible-xs'>".
													$institucion[ 'institucion' ].
											   "</span>";
					$cant++;

				} else {//Si son 2 o mas instituciones que imparten un curso

					$diccionarioInstitucion = $diccionarioInstitucion.'<br class="visible-sm visible-xs" />'.
												"<span class='institution-name lg-sm-center visible-lg visible-md'>".
													$institucion[ 'institucion' ].
											   "</span>".
											   "<span class='btn btn-primary institution-name lg-sm-center visible-sm visible-xs'>".
													$institucion[ 'institucion' ].
											   "</span>";//Concatena los nombres
				}//end if..else


			}//end foreach

			return $diccionarioInstitucion;

		}//end getInstitucionesAsString

	}//end Cursos

?>