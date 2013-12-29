<?php

	class Tematica {

		private $tematicas;


//***********************************************************************************************

		public function __construct() {
			$this->categorias = array();

		}//end __construct


//**************************************************************************************************

		public function getTematicas() {
			$this->tematicas = Work::getRegisters( 'Tematicas' );

			for( $i = 0; $i < sizeof( $this->tematicas ); $i++ ) {
				$this->tematicas[ $i ][ 'tematicaFormateada' ] = Work::textFormat( $this->tematicas[ $i ][ 'tematica' ], '_' );
			}//end foreach

			return $this->tematicas;
		}//end getCategorias
		


//******************************************************************************************************************


		//obtiene el id de la categoria gracias al nombre
		public function getIdTematica( &$nombreTematica ) {

			$nombre = Work::textFormat( $nombreTematica, '_', false );//al pasar false convierte el caracter _ en un espacio

			$id = Work::getRegister( 'Tematicas', 'idTematica', 
				sprintf(
						'tematica=%s',
						"'".$nombre."'"
					) );

			//Si no existe un curso con ese nombre
			if( !isset( $id ) ){
				return false;
			}
			
			return $id[ 'idTematica' ];
		}

	}//end Categoria

?>