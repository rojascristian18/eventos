<?php 
App::uses('AppModel', 'Model');

Class Idioma extends AppModel {

	/**
	 * Set Cake config DB
	 */
	public $name = 'Idioma';
	public $useTable = 'lang';
	public $primaryKey = 'id_lang';

	/**
	 * Use Toolmania Connect
	 */

	public $belongsTo = array(
		'IdiomaImpuesto' => array(
			'className'				=> 'IdiomaImpuesto',
			'foreignKey'			=> 'id_lang',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Plantilla')
		)
	);

	public $hasAndBelongsToMany = array(
		'Producto' => array(
			'className'				=> 'Producto',
			'joinTable'				=> 'product_lang',
			'foreignKey'			=> 'id_lang',
			'associationForeignKey'	=> 'id_product',
			'unique'				=> true,
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'limit'					=> '',
			'offset'				=> '',
			'with'					=> 'ProductosIdioma',
			'finderQuery'			=> '',
			'deleteQuery'			=> '',
			'insertQuery'			=> ''
		),
		'Especificacion' => array(
			'className'				=> 'Especificacion',
			'joinTable'				=> 'feature_lang',
			'foreignKey'			=> 'id_lang',
			'associationForeignKey'	=> 'id_feature',
			'unique'				=> true,
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'limit'					=> '',
			'offset'				=> '',
			'with'					=> '',
			'finderQuery'			=> 'EspecificacionIdioma',
			'deleteQuery'			=> '',
			'insertQuery'			=> ''
		),
		'EspecificacionValor' => array(
			'className'				=> 'EspecificacionValor',
			'joinTable'				=> 'feature_value_lang',
			'foreignKey'			=> 'id_lang',
			'associationForeignKey'	=> 'id_feature_value',
			'unique'				=> true,
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'limit'					=> '',
			'offset'				=> '',
			'with'					=> '',
			'finderQuery'			=> 'EspecificacionValorIdioma',
			'deleteQuery'			=> '',
			'insertQuery'			=> ''
		)

	);
}