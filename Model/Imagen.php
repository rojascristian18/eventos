<?php 
App::uses('AppModel', 'Model');

Class Imagen extends AppModel {

	/**
	 * Set Cake config DB
	 */
	public $name = 'Imagen';
	public $useTable = 'image';
	public $primaryKey = 'id_image';


	public $belongsTo = array(
		'Producto' => array(
			'className'				=> 'Producto',
			'foreignKey'			=> 'id_product',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Plantilla')
		)
	);

}