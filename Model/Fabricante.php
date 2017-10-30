<?php 
App::uses('AppModel', 'Model');

Class Fabricante extends AppModel {

	/**
	 * Set Cake config DB
	 */
	public $name = 'Fabricante';
	public $useTable = 'manufacturer';
	public $primaryKey = 'id_manufacturer';


	public $hasMany = array(
		'Producto' => array(
			'className'				=> 'Producto',
			'foreignKey'			=> 'id_manufacturer',
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

	/*public $hasAndBelongsToMany = array(
		'EventosMarca' => array(
			'className'				=> 'EventosMarca',
			'joinTable'				=> 'marcas_fabricantes',
			'foreignKey'			=> 'id_manufacturer',
			'associationForeignKey'	=> 'eventos_marca_id',
			'unique'				=> true,
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'limit'					=> '',
			'offset'				=> '',
			'with'					=> 'MarcasFabricante',
			'finderQuery'			=> '',
			'deleteQuery'			=> '',
			'insertQuery'			=> ''
		)
	);*/

}