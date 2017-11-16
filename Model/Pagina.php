<?php
App::uses('AppModel', 'Model');
class Pagina extends AppModel
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
				'imagen'	=> array(
					'versions'	=> array(
						array(
							'prefix'	=> 'mini',
							'width'		=> 100,
							'height'	=> 100,
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
		'slug' => array(
			'notBlank' => array(
				'rule'			=> array('notBlank'),
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
		)
	);


	public function getPages()
	{
		$evento = ClassRegistry::init('Evento')->getEvent();
		
		if (!$evento) {
			return;
		}

		$paginas = Cache::read('Pagina', 'todo');
		
		if (!$paginas) {
			$paginas = ClassRegistry::init('Pagina')->find('all', array(
				'conditions' => array(
					'Pagina.evento_id' => $evento['Evento']['id'],
					'Pagina.activo' => 1	
					),
				'order' => array('Pagina.orden_menu' => 'ASC')
			));
			if ($evento['Evento']['cache']) {
				Cache::write('Pagina', $paginas, 'todo');
			}
		}

		return $paginas;
	}


	public function getPage($slug = '')
	{	
		if (empty($slug)) {
			return;
		}

		$evento = ClassRegistry::init('Evento')->getEvent();
		
		if (!$evento) {
			return;
		}

		$pagina = Cache::read(sprintf('Pagina-%s', $slug), 'todo');
		
		if (!$pagina) {
			$pagina = ClassRegistry::init('Pagina')->find('first', array(
				'conditions' => array(
					'Pagina.evento_id' => $evento['Evento']['id'],
					'Pagina.slug' => $slug,
					'Pagina.activo' => 1	
					),
				'order' => array('Pagina.orden_menu' => 'ASC')
			));

			if (empty($pagina)) {
				return;
			}
			if ($evento['Evento']['cache']) {
				Cache::write(sprintf('Pagina-%s', $slug), $pagina, 'todo');
			}
		}

		return $pagina;
	}

	public function beforeSave($options = array()) {
		# Se agrega el nombre_corto
		if ( ! empty($this->data[$this->alias]['nombre']) ) {

			# Slug
			$this->data[$this->alias]['slug'] = strtolower(Inflector::slug($this->data[$this->alias]['nombre'], '-'));

			# meta titulo
			#$this->data[$this->alias]['meta_titulo'] = $this->data[$this->alias]['nombre'];

			# meta descripción
			#$this->data[$this->alias]['meta_descripcion'] = CakeText::truncate($this->data[$this->alias]['cuerpo'], 165);
		}
	}
}
