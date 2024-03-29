<?php

	class View extends MasterView
	{
		protected $server; // almacena la url absoluta en donde trabaja el programador		
		protected $template; // template de la lista con el que trabaja el codigo cliente en un momento dado
		protected $list; // lista de los words y su correspondiente traduccion

		protected $principalList = array(); // Almacena los distintos fragmentos html de listados


		public function __construct()
		{
			parent::__construct();
			//Establece la raiz de trabajo del programador
			global $server;
			if( isset( $server ) )
				$this->server = $server . '/server/';
			else
				$this->server = 'http://localhost/server/';
		}//end __construct


		//***********************************************************************************


		public function setList( $name )
		{
			//Establece el directorio de las listas de una vista			
			$directory = 'client/html/app/' . lcfirst( $this->className ).'/list/';
			// Obtiene el template a procesar
			$this->template = file_get_contents( $directory . $name . 'List.html' );
		}

		//***********************************************************************************
		//Crea la fraccion html correspondiente recibiendo como parametro el atributo (del codigo cliente) en donde se guardara el fragmento
		public function translate( $listName )
		{
			$this->principalList[ $listName ] = ''; // Crea el indice en el arreglo

			//Si no hay indices en $this->list no hay nada que traducir
			if( isset( $this->list ) )
				// Crea el fragmento HTML
				$this->dictionary->convertListToString( $this->list, $this->template, $this->principalList[ $listName ] );
			

			// Borra los valores de $this->list para recibir un nuevo conjunto de words a traducir
			unset( $this->list );
		}//end translate

		//************************************************************************************

		public function translatePage( $title, $replaced = null, $extras = null )
		{
			//Clona los datos del objeto dictionary
			global $dictionary;
			$this->dictionary = clone( $dictionary );
			
			//Si se ha pasado de lista que reemplazar
			if( isset( $replaced ) )
			{
				foreach ( $replaced as $function ) 
					call_user_func( array( $this->className . 'View', 'translate' . $function ) );
			}//end if

			//Si se pasaron elementos extras que traducir
			if( isset( $extras) )
			{
				foreach ( $extras as $key => $value ) {
					$this->principalList[ $key ] = $value;
				}
			}
			
			$this->principalList[ 'Title' ] = $title;
			$this->dictionary->translate( $this->principalList );
		}//end translatePage

	}//end View