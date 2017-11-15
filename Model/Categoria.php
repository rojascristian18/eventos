<?php
App::uses('AppModel', 'Model');
class Categoria extends AppModel
{
	/**
	 * CONFIGURACION DB
	 */
	public $displayField	= 'nombre';

	/**
	 * BEHAVIORS
	 */
	var $actsAs			= array(
		/**
		 * IMAGE UPLOAD
		 */
		'Image'		=> array(
			'fields'	=> array(
				'imagen_principal'	=> array(
					'versions'	=> array(
						array(
							'prefix'	=> 'mini',
							'width'		=> 100,
							'height'	=> 100,
							'crop'		=> true
						),
						array(
							'prefix'	=> 'xs_mini',
							'width'		=> 50,
							'height' 	=> 30,
							'crop'		=> false
						)
					)
				),
				'icono_imagen_dos'	=> array(
					'versions'	=> array(
						array(
							'prefix'	=> 'mini',
							'width'		=> 100,
							'height'	=> 100,
							'crop'		=> true
						),
						array(
							'prefix'	=> 'xs_mini',
							'width'		=> 50,
							'height' 	=> 30,
							'crop'		=> false
						)
					)
				)
			)
		)
	);

	/**
	 * VALIDACIONES
	 */
	public $validate = array(
		'nombre' => array(
			'notBlank' => array(
				'rule'			=> array('notBlank'),
				'last'			=> true,
				//'message'		=> 'Mensaje de validación personalizado',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
		'nombre_corto' => array(
			'notBlank' => array(
				'rule'			=> array('notBlank'),
				'last'			=> true,
				//'message'		=> 'Mensaje de validación personalizado',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
		'activo' => array(
			'boolean' => array(
				'rule'			=> array('boolean'),
				'last'			=> true,
				//'message'		=> 'Mensaje de validación personalizado',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
	);

	/**
	 * ASOCIACIONES
	 */
	public $belongsTo = array(
		'Evento' => array(
			'className'				=> 'Evento',
			'foreignKey'			=> 'evento_id',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Evento')
		),
		'ParentCategoria' => array(
			'className'				=> 'Categoria',
			'foreignKey'			=> 'parent_id',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Categoria')
		)
	);
	public $hasMany = array(
		'ChildCategoria' => array(
			'className'				=> 'Categoria',
			'foreignKey'			=> 'parent_id',
			'dependent'				=> false,
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> 'orden',
			'limit'					=> '',
			'offset'				=> '',
			'exclusive'				=> '',
			'finderQuery'			=> '',
			'counterQuery'			=> ''
		)
	);

	public $hasAndBelongsToMany = array(
		'Producto' => array(
			'className'				=> 'Producto',
			'joinTable'				=> 'categorias_productos',
			'foreignKey'			=> 'categoria_id',
			'associationForeignKey'	=> 'id_product',
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
		)
	);

	public function beforeSave($options = array()) {
		# Se agrega el nombre_corto
		if ( ! empty($this->data[$this->alias]['nombre']) ) {

			# Slug
			$this->data[$this->alias]['nombre_corto'] = strtolower(Inflector::slug($this->data[$this->alias]['nombre'], '-'));

			# meta titulo
			#$this->data[$this->alias]['meta_titulo'] = $this->data[$this->alias]['nombre'];

			# meta descripción
			#$this->data[$this->alias]['meta_descripcion'] = CakeText::truncate($this->data[$this->alias]['cuerpo'], 165);
		}

		# Eliminamos la relación de categorías con productos
		if (isset($this->data['Producto']) && isset($this->data[$this->alias]['id'])) {
			ClassRegistry::init('CategoriasProducto')->deleteAll(array('CategoriasProducto.categoria_id' => $this->data[$this->alias]['id']));
		}
	}
}
