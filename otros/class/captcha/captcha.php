<?php

	session_start();

	class Captcha
	{
		private $bgCaptcha;//guarda la direccion del background del captcha
		private $dir;//guarda la direccion del captcha


		public function __construct( $image = null )
		{
			if( isset( $image ) )//si hay una imagen definida
				$this->bgCaptcha = $image;//la usara			
			else
				$this->bgCaptcha = 'bg-captcha.gif';//cargara el por defecto incluido en la libreria

		}//end __construct


	//**************************************************************


		public function getCaptcha( $var = 'captcha', $length = 6 ) 
		{
			$_SESSION[ $var ] = $this->randomText( $length );
			
			//Crea la imagen de acuerdo al type mime de la imagen
			$mimeType = mime_content_type( $this->bgCaptcha );
			
			if( $mimeType == 'image/gif' )
				$captcha = imagecreatefromgif( $this->bgCaptcha );
			elseif( $mimeType == 'image/jpeg' )
				$captcha = imagecreatefromjpeg( $this->bgCaptcha );
			elseif( $mimeType == 'image/png' )
				$captcha = imagecreatefrompng( $this->bgCaptcha );


			$colText = imagecolorallocate( $captcha, 0, 0, 0 );
			imagestring( $captcha, 5, 16, 7, $_SESSION[ $var ], $colText );

			if( $mimeType == 'image/gif' )
				imagegif( $captcha, 'cat.gif' );
			elseif( $mimeType == 'image/jpeg' )
				imagejpeg( $captcha, 'cat.jpg' );
			elseif( $mimeType == 'image/png' )
				imagepng( $captcha, 'cat.png' );

			$this->dir = 'cat.'.substr( $mimeType, 6 );

			echo $dir;

			imagedestroy( $captcha );			

		}//end getCaptcha


	//******************************************************************

	//Obtiene el texto aleatorio del captcha
		public function randomText( $length ) 
		{
		    $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
		    $key = '';

		    if( $length > 8 )
		    	$length = 8;

		    for( $i = 0; $i < $length; $i++ ) 
		    {
		     	$key .= $pattern{ rand( 0, 35 ) };
		    }//end randomText

		    return $key;
		}//end randomText

	}//end Captcha


//********************************************************************


	public function __destruct()
	{
		unlink( $this->dir );
	}//end __destruct

?>

