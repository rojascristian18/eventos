<?php 
App::uses('AppModel', 'Model');

Class Producto extends AppModel {

	/**
	 * Set Cake config DB
	 */
	public $name = 'Producto';
	public $useTable = 'product';
	public $primaryKey = 'id_product';


	/**
	* Config
	*/
	public $displayField	= 'reference';

	/**
	* Asociaciones
	*/
	public $hasAndBelongsToMany = array(
		'Evento' => array(
			'className'				=> 'Evento',
			'joinTable'				=> 'eventos_productos',
			'foreignKey'			=> 'id_product',
			'associationForeignKey'	=> 'evento_id',
			'unique'				=> true,
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'limit'					=> '',
			'offset'				=> '',
			'with'					=> 'EventosProducto',
			'finderQuery'			=> '',
			'deleteQuery'			=> '',
			'insertQuery'			=> ''
		),
		'Idioma' => array(
			'className'				=> 'Idioma',
			'joinTable'				=> 'product_lang',
			'foreignKey'			=> 'id_product',
			'associationForeignKey'	=> 'id_lang',
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
		'Categoria' => array(
			'className'				=> 'Categoria',
			'joinTable'				=> 'categorias_productos',
			'foreignKey'			=> 'id_product',
			'associationForeignKey'	=> 'categoria_id',
			'unique'				=> true,
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'limit'					=> '',
			'offset'				=> '',
			'with'					=> 'CategoriasProducto',
			'finderQuery'			=> '',
			'deleteQuery'			=> '',
			'insertQuery'			=> ''
		),
		'Especificacion' => array(
			'className'				=> 'Especificacion',
			'joinTable'				=> 'feature_product',
			'foreignKey'			=> 'id_product',
			'associationForeignKey'	=> 'id_feature',
			'unique'				=> true,
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'limit'					=> '',
			'offset'				=> '',
			'with'					=> 'EspecificacionProducto',
			'finderQuery'			=> '',
			'deleteQuery'			=> '',
			'insertQuery'			=> ''
		),
		'EspecificacionValor' => array(
			'className'				=> 'EspecificacionValor',
			'joinTable'				=> 'feature_product',
			'foreignKey'			=> 'id_product',
			'associationForeignKey'	=> 'id_feature_value',
			'unique'				=> true,
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'limit'					=> '',
			'offset'				=> '',
			'with'					=> 'EspecificacionValorProducto',
			'finderQuery'			=> '',
			'deleteQuery'			=> '',
			'insertQuery'			=> ''
		)
	);

	public $belongsTo = array(
		'GrupoReglaImpuesto' => array(
			'className'				=> 'GrupoReglaImpuesto',
			'foreignKey'			=> 'id_tax_rules_group',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Plantilla')
		),
		'Fabricante' => array(
			'className'				=> 'Fabricante',
			'foreignKey'			=> 'id_manufacturer',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Plantilla')
		)
	);

	public $hasMany = array(
		'PrecioEspecifico' => array(
			'className'				=> 'PrecioEspecifico',
			'foreignKey'			=> 'id_product',
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
		'EventosMarca' => array(
			'className'				=> 'EventosMarca',
			'foreignKey'			=> 'id_product',
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
		'EventosProducto' => array(
			'className'				=> 'EventosProducto',
			'foreignKey'			=> 'id_product',
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
		'Imagen' => array(
			'className'				=> 'Imagen',
			'foreignKey'			=> 'id_product',
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
	
	/**
	* CAllbacks
	*/

	public function beforeSave($options = array()) {
		parent::beforeSave();
	}

	public function afterSave($created = null, $options = Array()) {
		parent::afterSave();
	}
}
	
?>