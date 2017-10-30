<?php 
App::uses('AppModel', 'Model');

Class Impuesto extends AppModel {

	/**
	 * Set Cake config DB
	 */
	public $name = 'Impuesto';
	public $useTable = 'tax';
	public $primaryKey = 'id_tax';

	/**
	 * Use Toolmania Connect
	 */
	public $useDbConfig = 'toolmania';

	public $hasMany = array(
		'ReglaImpuesto' => array(
			'className'				=> 'ReglaImpuesto',
			'foreignKey'			=> 'id_tax',
			'dependent'				=> false,
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'limit'					=> '',
			'offset'				=> '',
			'exclusive'				=> '',
			'finderQuery'			=> '',
			'counterQuery'			=> ''
		)
	);

}