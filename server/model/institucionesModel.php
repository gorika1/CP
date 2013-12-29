<?php

	class Institucion {

		private $instituciones;
		private $institucion;

		public function getInstituciones() {
			$this->instituciones = Work::getRegisters( 'Instituciones' );
			return $this->instituciones;

		}//end getInstituciones

		public function getInstitucionesByIdCurso( $idCurso ) {

			$idInstituciones = Work::getRegisters( 'Cursos_has_Instituciones', 'Instituciones_idInstitucion', 
				sprintf(
						'Cursos_idCurso=%s',
						$idCurso
					) );//obtiene el idInstitucion mediante la table Cursos_has_Instituciones
			
			unset( $this->instituciones );//resetea las instituciones para que en el listado de cursos solo se almacenen las instituciones relacionadas con el curso pasado como parametro

			//Por cada identificador de las Instituciones
			foreach( $idInstituciones as $idInstitucion ) {
				$this->instituciones[] = Work::getRegister( 'Instituciones', '*',
							sprintf( 'idInstitucion=%s', 
									$idInstitucion[ 'Instituciones_idInstitucion']
								) );//agrega un registro con el idInstitucion y el nombre en la propiedad instituciones
			}//end foreach

			return $this->instituciones;//devuelve un array tipo Array ( [0] => Array ( [idInstitucion] => 1 [institucion] => nombreInstitucion ) )

		}//end getInstituciones

	}//end Institucion

?>