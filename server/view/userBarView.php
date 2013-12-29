<?php

	class UserBarView extends MasterView {

		private $nombreUsuario;
		private $avatar;

		public function __construct() {
			parent::__construct();
			if( isset( $_SESSION[ 'usuario' ] ) ) {
				$this->nombreUsuario = $_SESSION[ 'usuario' ];
				$this->avatar = $_SESSION[ 'avatar' ];

				$this->nombreUsuario = strstr( $this->nombreUsuario, ' ', true);//Extrae el nombre hasta encontrar un espacio

			}//end if

		}//end __construct


		//***********************************************************************************************************

		public function getTemplate() {

			$this->setTemplate();

			//Si es un usuario logueado
			if( isset( $this->nombreUsuario ) ) {
				$this->translate = array(
					'Identidad Usuario' => $this->login->startTranslateByLevel( 'userBar' ),//Agrega el section template correspondiente
					'Nombre Usuario' => $this->nombreUsuario, //el nombre
					'Imagen Usuario' => $this->avatar // el avatar
				);
				
			} else { 
				$this->translate = array( 
					'Identidad Usuario' => $this->login->startTranslateByLevel( 'userBar' ) //Solo agrega el section template correspondiente
				);
				
			}//end if..else

			$this->translateConst();
			return $this->template;
		}

	}//end UserBarView

?>