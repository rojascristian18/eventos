<?php 
App::uses('AppModel', 'Model');

Class MarcasFabricante extends AppModel {

	/**
	 * Set Cake config DB
	 */
	public $name = 'MarcasFabricante';


	public $belongsTo = array(
		'EventosMarca' => array(
			'className'				=> 'EventosMarca',
			'foreignKey'			=> 'eventos_marca_id',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Evento')
		)
	);

}