<?php

	class MiPerfilView {

		private $lista;
		private $listaCursosTraducida;//listado de cursos en donde participa el usuario
		private $templateList;


		private $myUser;

		public function __construct() {
			$this->myUser = new Usuario();

		}//end __construct


		//***************************************************************************


		private function traducirCursos() {

			global $dictionary;

			$cursos = $this->myUser->getCursosDelUsuario();

			$this->templateList = file_get_contents( 'media/html/cp-lists/cursosUsuarioList.html' );

			//Por cada curso
			foreach ( $cursos as $curso ) {
				$curso[ 'cursoFormateado' ] = Work::textFormat( $curso[ 'curso' ], '_' );

				$this->lista[] = array(
						'Nombre Curso' => $curso[ 'curso' ],
						'Imagen Curso' => $curso[ 'imagen' ],
						'Curso Formateado' => $curso[ 'cursoFormateado' ]
					);

			}//end foreach

			$dictionary->convertListToString( $this->lista, $this->templateList, $this->listaCursosTraducida );

			return $this->listaCursosTraducida;

		}//end traducirCursos


		//**************************************************************************



		public function traducirPagina() {
			global $dictionary;

			$this->lista = array(
					'Titulo' => 'Perfil de '.$_SESSION[ 'usuario' ],
					'Listado Cursos' => $this->traducirCursos()
				);

			$dictionary->translate( $this->lista );
		}

	}

?>