<?php 
App::uses('AppModel', 'Model');

Class PrecioEspecifico extends AppModel {

	/**
	 * Set Cake config DB
	 */
	public $name = 'PrecioEspecifico';
	public $useTable = 'specific_price';
	public $primaryKey = 'id_specific_price';

	/**
	 * Use Toolmania Connect
	 */
	public $useDbConfig = 'toolmania';

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