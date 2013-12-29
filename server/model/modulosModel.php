<?php

	class Modulo {

		private $curso;
		private $modulos;
		private $secciones;


		public function __construct( $idCurso ) {
			$this->curso = $idCurso;
			$this->modulos = array();
			$this->secciones = array();
		}//end __construct

		public function getModulos() {
			$values = 'idModulo, modulo, numeroModulo';
			$this->modulos = Work::getRegisters( 'Modulos', $values, 
				sprintf(
						'Cursos_idCurso=%s',
						$this->curso
					));
					
			return $this->modulos;
		}

	}//end Modulo

?>