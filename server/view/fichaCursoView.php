<?php


	class FichaCursoView extends View {

		private $myCurso;
		private $myInstitucion;
		private $idCurso;//Guardara el idCurso del curso seleccionado
		private $curso;//Obtendra los datos sobre el curso seleccionado
		private $myModulo;
		private $modulos;
		private $profesores;
		private $instituciones;
		
		public function __construct() {

			parent::__construct();

			$this->myCurso = new Curso();

			$this->myInstitucion = new Institucion();

			$this->idCurso = $this->myCurso->getIdCurso( $_GET[ 'c' ] );//Obtiene el idCurso utilizando el nombre del curso pasado por GET

			$this->curso = $this->myCurso->getCursoByIdCurso( $this->idCurso );//Obtiene los datos necesarios sobre el curso

			$this->myModulo = new Modulo( $this->idCurso );//crea el objeto modulo pasando el idCurso

			$this->modulos = array();

			$this->instituciones = array();

		}


		//************************ TRADUCE EL LISTADO DE MODULOS *********************************
		public function translateModulos() {

			$this->setList( 'modulos' );	

			$this->modulos = $this->myModulo->getModulos();//obtiene los modulos
			
			$nroModulo = 0;//Lleva la cuenta de modulos

			//Por cada modulo
			foreach ( $this->modulos as $modulo ) {
				$this->list[] = array(
					'Imagen Modulo' => 'mod'.$nroModulo.'.png',
					'Modulo' => 'Modulo '.$nroModulo.': '.$modulo[ 'modulo' ]
				);

				$nroModulo++;
			}//end foreach

			$this->translate( 'Modulos' );
		}//end traducirModulos


		//************************** TRADUCE EL LISTADO DE PROFESORES *************************************
	
		public function translateTutores() {

			$this->setList( 'tutores' );

			//Obtiene los profesores del curso
			$this->profesores = $this->myCurso->getProfesores( $this->idCurso );

			//Por cada profesor
			foreach ( $this->profesores as $profesor ) {
				$this->list[] = array(
						'Nombre Tutor' => $profesor[ 'nombreUsuario' ],
						'Imagen Tutor' => $profesor[ 'avatar' ]
					);

			}//end foreach

			$this->translate( 'Tutores' );

		}//end traducirProfesores



		//************************** TRADUCE EL LISTADO DE INSTITUCIONES ***********************************



		public function translateInstituciones() {


			$this->setList( 'instituciones' );

			$this->instituciones = $this->myInstitucion->getInstitucionesByIdCurso( $this->idCurso );

			foreach ( $this->instituciones as $institucion ) {
				$this->list[] = array(
						'Imagen' => $institucion[ 'logo' ],
						'Institucion' => $institucion[ 'institucion' ]

					);
				
			}//end foreach

			$this->translate( 'Instituciones' );

		}

		//******************** VERIFICA SI EL USUARIO ESTA INSCRIPTO EN EL CURSO ***************************

		/*public function estaInscripto() {
			global $login;

			if( isset( $_SESSION[ 'idUsuario' ] ) ) {
				$values = "Cursos_idCurso=".$this->idCurso." and Usuarios_idUsuario=".$_SESSION[ 'idUsuario' ];

				//Si el usuario esta inscripto en el curso
				if( Work::getRegister( 'Cursos_has_Usuarios', '*', $values ) ) {
					$templateForLevel1 = file_get_contents( 'media/html/cp-conditions/condUsuarioInscripto.shtml' );

				//Si no esta inscripto en el curso
				} else {
					$templateForLevel1 = $login->startTranslateByLevel( 'cursoInscripcion' );

				}//end if interno

			} else {
				$templateForLevel1 = $login->startTranslateByLevel( 'cursoInscripcion' );
				
			}//end if..else

			return $templateForLevel1;
		}*/


		//****************************** TRADUCE LA PAGINA COMPLETA ****************************************

		public function translatePage() {
			
			//Establece el video de presentacion
			if( isset( $this->curso[ 'videoPresentacion' ] ) && $this->curso[ 'videoPresentacion' ] != '' ) {
				$this->curso[ 'videoPresentacion' ] = "<iframe src=\"//www.youtube.com/embed/".$this->curso[ 'videoPresentacion' ]."\" allowfullscreen></iframe>";

			} else {
				$this->curso[ 'videoPresentacion' ] = "<img lsrc=\"client/images/cursos/no-video.png\" />";
			}//end if...else
		
			$title = 'Ficha de: '.$this->curso[ 'curso' ];

			$diccionario = array(
					'Video Presentacion' => $this->curso[ 'videoPresentacion' ],
					'Descripcion Curso' => $this->curso[ 'descripcion' ],
					'Conocimientos Necesarios' => $this->curso[ 'conocimientosNecesarios' ],
					'Fecha Inicio' => $this->curso[ 'fechaInicio' ],
					//'Curso Inscripcion' => $this->estaInscripto()
				);

			parent::translatePage( $title, array( 'Modulos', 'Tutores', 'Instituciones' ), $diccionario );

		}//end traducirPagina

	}//end FichaCurso

?>