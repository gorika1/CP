<?php

	class InstitucionesView extends View
	{
		private $instituciones;

		public function __construct()
		{
			parent::__construct();

			$instituciones =  new Institucion();
			$this->instituciones = $instituciones->getInstituciones();
		}

		public function translateInstituciones()
		{
			//Obtiene el template de la lista de tematicas
			$this->setList( 'instituciones' );

			//Por cada tematica en la base de datos
			foreach( $this->instituciones as $institucion ) {
				$this->list[] = array(
						'Imagen Institucion' => $institucion[ 'logo' ],
						'Institucion' =>$institucion[ 'institucion' ]
					);
			}//end foreach
			
			$this->translate( 'Instituciones' );

		}
	}