<?php

	class IndexView extends View {

		private $myCurso;
		private $cursos;
		private $myTematica;
		private $tematicas;
		private $idTematica;


		public function __construct( $tematica = false ) {

			parent::__construct();

			$this->myCurso = new Curso();

			$this->myTematica = new Tematica();

			$this->tematicas = $this->myTematica->getTematicas();//Obtiene todas las tematicas

			//Si tematica es falso obtiene todos los cursos
			if( !$tematica ) 
				$this->cursos = $this->myCurso->getCursos();//Obtiene todos los cursos para mostrar un listado
			else {//Si no, obtiene los cursos de acuerdo al idTematica
				$this->idTematica = $this->myTematica->getIdTematica( $_GET[ 'cat' ] );
				$this->cursos = $this->myCurso->getCursosByIdTematica( $this->idTematica );//Obtiene los cursos con la idTematica seleccionada
			}//end if... else

		}//end __construct


		//****************************************************************************************************

		private function createMensaje() {
			$this->principalList[ 'Cursos' ] = '<p style="display:block;text-align:center;width:100%"><strong>No hay cursos que mostrar</strong></p>';
		}


		//*********************************** TRADUCE EL LISTADO DE CURSOS *********************************************************

		public function translateCursos() {

			$this->setList( 'cursos' );

			if( !isset( $this->cursos[ 0 ] ) ) {//Si en el arreglo cursos no hay datos
				$this->createMensaje();		

			} else {

				//Por cada curso
				foreach( $this->cursos as $curso ) {

					//Se almacena los siguientes elementos en lista[]
					$this->list[] = array( 
							'Nombre Curso' => $curso[ 'curso' ],
							'Imagen Curso' => $curso[ 'imagen' ],
							'Detalle Curso' => $curso[ 'descripcion' ],			
							'Tematica' => $curso[ 'tematica' ],
							'Nombre Institucion' => $this->myCurso->getInstitucionesAsString( $curso ),//obtiene el(las) institucion(es) que imparte(n) el curso
							'Ficha del Curso' => $curso[ 'cursoFormateado' ].'/'
						);
					
				}//end foreach

				$this->translate( 'Cursos' );

			}//end if..else

		}//end traducirCursos


		//**************** TRADUCE EL LISTADO DE TEMATICAS ********************************

		public function translateTematicas() {

			//Obtiene el template de la lista de tematicas
			$this->setList( 'tematicas' );

			//Por cada tematica en la base de datos
			foreach( $this->tematicas as $tematica ) {
				$this->list[] = array(
						'Tematica' => $tematica[ 'tematica' ],
						'Tematica Formateada' =>$tematica[ 'tematicaFormateada' ]
					);
			}//end foreach

			$this->translate( 'Tematicas' );

		}//end traducirTematicas

	}//end CursosView

?>