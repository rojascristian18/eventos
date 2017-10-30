<?php
App::uses('AppModel', 'Model');
class EventosMarca extends AppModel
{
	/**
	 * CONFIGURACION DB
	 */
	public $displayField	= 'nombre';
	public $name = 'EventosMarca';
	public $useTable = 'eventos_marcas';
	public $primaryKey = 'id';

	/**
	 * BEHAVIORS
	 */
	var $actsAs			= array(
		/**
		 * IMAGE UPLOAD
		 */
		'Image'		=> array(
			'fields'	=> array(
				'imagen'	=> array(
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
		)
	);


	public $belongsTo = array(
		'Evento' => array(
			'className'				=> 'Evento',
			'foreignKey'			=> 'evento_id',
			'conditions'			=> '',
			'fields'				=> '',
			'order'					=> '',
			'counterCache'			=> true,
			//'counterScope'			=> array('Asociado.modelo' => 'Evento')
		)
	);


	public $hasMany = array(
		'MarcasFabricante' => array(
			'className'				=> 'MarcasFabricante',
			'foreignKey'			=> 'eventos_marca_id',
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
		'Fabricante' => array(
			'className'				=> 'Fabricante',
			'joinTable'				=> 'marcas_fabricantes',
			'foreignKey'			=> 'eventos_marca_id',
			'associationForeignKey'	=> 'id_manufacturer',
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

	public function afterSave($created, $options = array())
	{
		if ($created) {
			# Último agregado
			$arr = array();
			$last = $this->find('first', array('order' => array('id' => 'DESC'), 'limit' => 1));

			foreach ($this->data['MarcasFabricante'] as $indice => $fabricante) {
				$arr[$indice]['eventos_marca_id'] = $last['EventosMarca']['id'];
				$arr[$indice]['id_manufacturer'] = $fabricante;
			}

			# Guardamos
			ClassRegistry::init('MarcasFabricante')->saveMany($arr);

		}else{

			if (!empty($this->data['MarcasFabricante'])) {
				$arr = array();
				foreach ($this->data['MarcasFabricante'] as $indice => $fabricante) {
					$arr[$indice]['eventos_marca_id'] = $this->data['EventosMarca']['id'];
					$arr[$indice]['id_manufacturer'] = $fabricante;
				}
			}

			# Elimnamos la relación
			ClassRegistry::init('MarcasFabricante')->deleteAll(array('eventos_marca_id' => $this->data['EventosMarca']['id']));

			# Guardamos
			ClassRegistry::init('MarcasFabricante')->saveMany($arr);
		}
	}

}
