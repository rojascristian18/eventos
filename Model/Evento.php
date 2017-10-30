<?php
App::uses('AppModel', 'Model');
class Evento extends AppModel
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
				'logo'	=> array(
					'versions'	=> array(
						array(
							'prefix'	=> 'mini',
							'width'		=> 100,
							'height'	=> 100,
							'crop'		=> true
						)
					)
				),
				'imagen_portada'	=> array(
					'versions'	=> array(
						array(
							'prefix'	=> 'mini',
							'width'		=> 100,
							'height'	=> 100,
							'crop'		=> true
						)
					)
				),
				'imagen_inactivo' => array(
					'versions'	=> array(
						array(
							'prefix'	=> 'mini',
							'width'		=> 100,
							'height'	=> 100,
							'crop'		=> true
						)
					)
				),
				'favicon' => array(
					'versions'	=> array(
						array(
							'prefix'	=> 'mini',
							'width'		=> 100,
							'height'	=> 100,
							'crop'		=> true
						),
						array(
							'prefix'	=> 'favicon',
							'width'		=> 32,
							'height'	=> 32,
							'crop'		=> true
						),
						array(
							'prefix'	=> 'apple',
							'width'		=> 152,
							'height'	=> 152,
							'crop'		=> true
						),
						array(
							'prefix'	=> 'window',
							'width'		=> 144,
							'height'	=> 144,
							'crop'		=> true
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
		'subdomino' => array(
			'notBlank' => array(
				'rule'			=> array('notBlank'),
				'last'			=> true,
				'message'		=> 'Campo es obligatorio',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
		'nombre' => array(
			'notBlank' => array(
				'rule'			=> array('notBlank'),
				'last'			=> true,
				'message'		=> 'Campo es obligatorio',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
		/*'logo' => array(
	        'rule' => 'uploadError',
	        'message' => 'Ocurrió un error al subir la imagen'
    	),
    	'imagen_portada' => array(
	        'rule' => 'uploadError',
	        'message' => 'Ocurrió un error al subir la imagen'
    	),
    	'imagen_inactivo' => array(
	        'rule' => 'uploadError',
	        'message' => 'Ocurrió un error al subir la imagen'
    	),*/
		'fecha_inicio' => array(
			'notBlank' => array(
				'rule'			=> array('notBlank'),
				'last'			=> true,
				'message'		=> 'Campo es obligatorio',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
			'datetime' => array(
				'rule'			=> array('datetime'),
				'last'			=> true,
				'message'		=> 'Formato de fecha no válido',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
		),
		'fecha_final' => array(
			'notBlank' => array(
				'rule'			=> array('notBlank'),
				'last'			=> true,
				'message'		=> 'Campo es obligatorio',
				//'allowEmpty'	=> true,
				//'required'		=> false,
				//'on'			=> 'update', // Solo valida en operaciones de 'create' o 'update'
			),
			'datetime' => array(
				'rule'			=> array('datetime'),
				'last'			=> true,
				'message'		=> 'Formato de fecha no válido',
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
		'mostrar_banners' => array(
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
	public $hasMany = array(
		'Banner' => array(
			'className'				=> 'Banner',
			'foreignKey'			=> 'evento_id',
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
		'Categoria' => array(
			'className'				=> 'Categoria',
			'foreignKey'			=> 'evento_id',
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
		'Despacho' => array(
			'className'				=> 'Despacho',
			'foreignKey'			=> 'evento_id',
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
		'Pago' => array(
			'className'				=> 'Pago',
			'foreignKey'			=> 'evento_id',
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
			'foreignKey'			=> 'evento_id',
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
			'foreignKey'			=> 'evento_id',
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

	public $belongsTo = array(
		'Tienda' => array(
			'className'				=> 'Tienda',
			'foreignKey'			=> 'tienda_id',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Evento')
		)
	);


	public $hasAndBelongsToMany = array(
		'Producto' => array(
			'className'				=> 'Producto',
			'joinTable'				=> 'eventos_productos',
			'foreignKey'			=> 'evento_id',
			'associationForeignKey'	=> 'id_product',
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
		)
	);


	public function afterSave($created, $options = array())
	{
		#prx($this->data);
	}
}
