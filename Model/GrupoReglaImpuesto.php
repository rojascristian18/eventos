<?php 
App::uses('AppModel', 'Model');

Class GrupoReglaImpuesto extends AppModel {

	/**
	 * Set Cake config DB
	 */
	public $name = 'GrupoReglaImpuesto';
	public $useTable = 'tax_rules_group';
	public $primaryKey = 'id_tax_rules_group';

	/**
	 * Use Toolmania Connect
	 */
	public $useDbConfig = 'toolmania';

	public $hasMany = array(
		'Producto' => array(
			'className'				=> 'Producto',
			'foreignKey'			=> 'id_tax_rules_group',
			'dependent'				=> false,
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'limit'					=> '',
			'offset'				=> '',
			'exclusive'				=> '',
			'finderQuery'			=> '',
			'counterQuery'			=> ''
		),
		'ReglaImpuesto' => array(
			'className'				=> 'ReglaImpuesto',
			'foreignKey'			=> 'id_tax_rules_group',
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