<?php
App::uses('AppModel', 'Model');
class ProductosIdioma extends AppModel
{
	/**
	 * CONFIGURACION DB
	 */
	
	/**
	 * Set Cake config DB
	 */
	public $name = 'ProductosIdioma';
	public $useTable = 'product_lang';
	public $primaryKey = 'id_product';


	/**
	 * BEHAVIORS
	 */
	var $actsAs			= array(
		/**
		 * IMAGE UPLOAD
		 */
		/*
		'Image'		=> array(
			'fields'	=> array(
				'imagen'	=> array(
					'versions'	=> array(
						array(
							'prefix'	=> 'mini',
							'width'		=> 100,
							'height'	=> 100,
							'crop'		=> true
						)
					)
				)
			)
		)
		*/
	);

	/**
	 * VALIDACIONES
	 */
}