<?php
App::uses('AppModel', 'Model');
class Evento extends AppModel
{
	/**
	 * CONFIGURACION DB
	 */
	public $displayField	= 'nombre';
	public $baul = '';
	public $relProductos = array();
	public $prefijo = '';

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
		),
		'Pagina' => array(
			'className'				=> 'Pagina',
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

	public function getAllCookies()
	{
		$evento = $this->getEvent();
			
		$productos = $this->getProducts();
		$marcas = $this->getBrands();
		$sliders = $this->get_sliders();
		$categorias = $this->getCategories();
		$paginas = ClassRegistry::init('Pagina')->getPages();

		$todo = $evento;

		if (!empty($productos)) {
			$todo['Producto'] = $productos;
		}

		if (!empty($marcas)) {
			$todo['Marcas'] = $marcas;
		}

		if (!empty($sliders)) {
			$todo['Sliders'] = $sliders;
		}

		if (!empty($categorias)) {
			$todo['Categoria'] = $categorias;
		}

		if (!empty($paginas)) {
			$todo['Pagina'] = $paginas;
		}
		
		return $todo;
	}

	public function getEvent()
	{
		$evento = Cache::read('Evento', 'todo');
		
		if (!$evento) {

			$evento = $this->find('first', array(
				'fields' => array(
					'Evento.id',
					'Evento.nombre',
					'Evento.subdomino',
					'Evento.nombre_tema',
					'Evento.host_imagenes',
					'Evento.tienda_id',
					'Evento.sub_titulo',
					'Evento.logo',
					'Evento.favicon',
					'Evento.fono',
					'Evento.email',
					'Evento.fecha_inicio',
					'Evento.fecha_final',
					'Evento.imagen_inactivo',
					'Evento.activo',
					'Evento.mostrar_banners',
					'Evento.mostrar_cuotas',
					'Evento.cantidad_cuotas',
					'Evento.informacion_adicional_productos',
					'Evento.css_adicional',
					'Evento.js_adicional',
					'Evento.minificar_css',
					'Evento.minificar_js',
					'Evento.cache',
					'Evento.modified',
					'Tienda.id',
					'Tienda.db_configuracion',
					'Tienda.nombre',
					'Tienda.prefijo',
					'Tienda.url'
					),
				'conditions' => array(
					'Evento.subdomino' => getsubdominio(),
					'Evento.activo' => 1
					),
				'order' => array('Evento.created' => 'DESC'),
				'contain' => array('Tienda', 
					'Pago' => array('order' => array('Pago.orden' => 'ASC'), 'conditions' => array('Pago.activo' => 1)), 
					'Despacho' => array('order' => array('Despacho.orden' => 'ASC'), 'conditions' => array('Despacho.activo' => 1)),
					'EventosProducto')
				)
			);
			
			if ($evento['Evento']['cache']) {
				Cache::write('Evento', $evento, 'todo');
			}

		}

		return $evento;

	}

	public function getProductosFromCache()
	{	
		$this->id = $id;

		$result = $this->getEvent();
		if (!$result) {
            $result = $this->find('first', array(
            	'conditions' => array(
            		'Evento.id' => $this->id
            		),
            	'contain' => array(
            		'Tienda',
            		'EventosProducto'
            		)
            	));
            if ($evento['Evento']['cache']) {
				Cache::write('evento', $result, 'todo');
			}
        }
	}

	public function getCategories()
	{
		$evento = $this->getEvent();
		
		if (!$evento) {
			return;
		}

		$categorias = Cache::read('Categoria', 'todo');
		
		if (!$categorias) {
			$categorias = ClassRegistry::init('Categoria')->find('all', array(
				'fields' => array(
					'Categoria.id',
					'Categoria.nombre_corto',
					'Categoria.parent_id',
					'Categoria.nombre', 
					'Categoria.icono_imagen',
					'Categoria.icono_texto'
					),
				'conditions' => array(
					'Categoria.evento_id' => $evento['Evento']['id']
					),
				'contain' => array(
					'ChildCategoria' => array(
						'fields' => array(
							'ChildCategoria.id',
							'ChildCategoria.parent_id',
							'ChildCategoria.nombre_corto',
							'ChildCategoria.nombre',
							'ChildCategoria.icono_imagen',
							'ChildCategoria.icono_texto'
						)
					),
					'Producto' => array(
						'fields' => array('Producto.id_product')
						)
				),
				'order' => array('Categoria.orden' => 'ASC')
			));
			if ($evento['Evento']['cache']) {
				Cache::write('Categoria', $categorias, 'todo');
			}
		}

		return $categorias;
	}


	public function getBrands()
	{
		$evento = $this->getEvent();
		
		if (!$evento) {
			return;
		}

		$marcas = Cache::read('Marca', 'todo');
		
		if (!$marcas) {
			$marcas = ClassRegistry::init('EventosMarca')->find('all', array(
				'conditions' => array(
					'EventosMarca.evento_id' => $evento['Evento']['id']
					),
				'contain' => array(
					'MarcasFabricante'
					)
				)
			);
			if ($evento['Evento']['cache']) {
				Cache::write('Marca', $marcas, 'todo');
			}
		}

		return $marcas;
	}

	public function getProducts() 
	{
		
		$evento = $this->getEvent();

		if (!$evento) {
			return;
		}

		$baul = 'https://' . $evento['Tienda']['url'];
			
		if (!empty($evento['Evento']['host_imagenes'])) {
			$baul	= $evento['Evento']['host_imagenes'];
		}

		$this->cambiarDatasourceModelo(array('Producto', 'Fabricante', 'Idioma', 'ProductosIdioma', 'ReglaImpuesto', 'GrupoReglaImpuesto', 'Impuesto', 'PrecioEspecifico', 'Imagen', 'Especificacion', 'EspecificacionIdioma', 'EspecificacionProducto', 'EspecificacionValorProducto', 'EspecificacionValor', 'EspecificacionValorIdioma'), $evento['Tienda']['db_configuracion']);

		$productos = Cache::read('Producto', 'todo');
		
		if (!$productos) {
			$productos = ClassRegistry::init('Producto')->find('all', array(
				'fields' => array(
					'Producto.id_product',
					'Producto.id_manufacturer',
					'Producto.id_tax_rules_group',
					'Producto.quantity',
					'Producto.price',
					'PrecioEspecifico.reduction',
					'Producto.reference',
					'Producto.id_tax_rules_group',
	    			'GrupoReglaImpuesto.id_tax_rules_group',
	    			'ReglaImpuesto.id_tax',
	    			'Impuesto.id_tax',
	    			'Impuesto.rate',
	    			'Impuesto.active',
	    			'ProductosIdioma.id_product',
	    			'ProductosIdioma.link_rewrite',
	    			'ProductosIdioma.name',
	    			'ProductosIdioma.description',
	    			'ProductosIdioma.description_short'
					),
				'conditions' => array(
					'Producto.id_product' => Hash::extract($evento['EventosProducto'], '{n}.id_product')
					),
				'joins' => array(
	    			array(
	    				'table' => sprintf('%stax_rules_group', $evento['Tienda']['prefijo']),
	    				'alias' => 'GrupoReglaImpuesto',
	    				'type' 	=> 'LEFT',
	    				'conditions' => array(
	    					'Producto.id_tax_rules_group = GrupoReglaImpuesto.id_tax_rules_group'
	    					)
	    				),
	    			array(
	    				'table' => sprintf('%stax_rule', $evento['Tienda']['prefijo']),
	    				'alias' => 'ReglaImpuesto',
	    				'type' 	=> 'LEFT',
	    				'conditions' => array(
	    					'GrupoReglaImpuesto.id_tax_rules_group = ReglaImpuesto.id_tax_rules_group'
	    					)
	    				),
	    			array(
	    				'table' => sprintf('%stax', $evento['Tienda']['prefijo']),
	    				'alias' => 'Impuesto',
	    				'type' 	=> 'LEFT',
	    				'conditions' => array(
	    					'ReglaImpuesto.id_tax = Impuesto.id_tax',
	    					'Impuesto.active' => 1
	    					)
	    				),
	    			array(
	    				'table' => sprintf('%sproduct_lang', $evento['Tienda']['prefijo']),
	    				'alias' => 'ProductosIdioma',
	    				'type' 	=> 'LEFT',
	    				'conditions' => array(
	    					'Producto.id_product = ProductosIdioma.id_product'
	    					)
	    				),
	    			array(
	    				'table' => sprintf('%sspecific_price', $evento['Tienda']['prefijo']),
	    				'alias' => 'PrecioEspecifico',
	    				'type' 	=> 'LEFT',
	    				'conditions' => array(
	    					'Producto.id_product = PrecioEspecifico.id_product',
	    					'OR' => array(
								array(
									'PrecioEspecifico.from <= "' . date('Y-m-d H:i:s') . '"',
									'PrecioEspecifico.to >= "' . date('Y-m-d H:i:s') . '"'
								),
								array(
									'PrecioEspecifico.from' => '0000-00-00 00:00:00',
									'PrecioEspecifico.to >= "' . date('Y-m-d H:i:s') . '"'
								),
								array(
									'PrecioEspecifico.from' => '0000-00-00 00:00:00',
									'PrecioEspecifico.to' => '0000-00-00 00:00:00'
								),
								array(
									'PrecioEspecifico.from <= "' . date('Y-m-d H:i:s') . '"',
									'PrecioEspecifico.to' => '0000-00-00 00:00:00'
								)
							)
	    					)
	    				)
	    			),
				'contain' => array(
					'Imagen' => array(
						'fields' => array(
							'concat(\'' . $baul . '/img/p/\',mid(Imagen.id_image,1,1),\'/\', if (length(Imagen.id_image)>1,concat(mid(Imagen.id_image,2,1),\'/\'),\'\'),if (length(Imagen.id_image)>2,concat(mid(Imagen.id_image,3,1),\'/\'),\'\'),if (length(Imagen.id_image)>3,concat(mid(Imagen.id_image,4,1),\'/\'),\'\'),if (length(Imagen.id_image)>4,concat(mid(Imagen.id_image,5,1),\'/\'),\'\'), Imagen.id_image, \'-home_default.jpg\' ) AS url_image_thumb',
							'concat(\'' . $baul . '/img/p/\',mid(Imagen.id_image,1,1),\'/\', if (length(Imagen.id_image)>1,concat(mid(Imagen.id_image,2,1),\'/\'),\'\'),if (length(Imagen.id_image)>2,concat(mid(Imagen.id_image,3,1),\'/\'),\'\'),if (length(Imagen.id_image)>3,concat(mid(Imagen.id_image,4,1),\'/\'),\'\'),if (length(Imagen.id_image)>4,concat(mid(Imagen.id_image,5,1),\'/\'),\'\'), Imagen.id_image, \'.jpg\' ) AS url_image_large',
							'position',
							'cover'
							),
						'order' => array(
							'Imagen.position' => 'ASC'
							)
						),
					'Fabricante',
					'Categoria',
					'Especificacion' => array('Idioma'),
					'EspecificacionValor' => array('Idioma')
				),
				)
			);
			
			foreach ($productos as $ix => $producto) {

				$productos['Filtro']['json'][$producto['ProductosIdioma']['name']] = $producto['Imagen'][0]['Imagen'][0]['url_image_thumb'];

				# Precios del producto
				if ( !isset($producto['Impuesto']['rate']) ) {
					$productos[$ix]['Producto']['valor_iva'] = $producto['Producto']['price'];	
				}else{
					$productos[$ix]['Producto']['valor_iva'] = $this->precio($producto['Producto']['price'], $producto['Impuesto']['rate']);
				}

				$productos[$ix]['Producto']['valor_final'] = $productos[$ix]['Producto']['valor_iva'];
				
				// Retornar último precio espeficico según criterio del producto
				foreach ($producto['PrecioEspecifico'] as $precio) {

					if ( $precio == 0 || empty($precio) || is_null($precio)) {
						$productos[$ix]['Producto']['valor_final'] = $productos[$ix]['Producto']['valor_iva'];

					}else{

						$productos[$ix]['Producto']['valor_final'] = $this->precio($productos[$ix]['Producto']['valor_iva'], ($precio * 100 * -1) );
						$productos[$ix]['Producto']['descuento'] = ($precio * 100 * -1 );

					}
				}
			}

			$productos['Filtro']['json'] = json_encode($productos['Filtro']['json']);
			$productos['Filtro']['rango_precios'] = $this->obtenerRangoPrecios($productos, 'valor_final');

			if ($evento['Evento']['cache']) {
				Cache::write('Producto', $productos, 'todo');
			}
			
		}

		return $productos;
	        
    }

    public function precio($precio = null, $iva = null) {
		if ( !empty($precio) && !empty($iva)) {
			// Se quitan los 00
			$iva = intval($iva);

			//Calculamos valor con IVA
			$precio = ($precio + round( ( ($precio*$iva) / 100) ) );

			return round($precio);
		}
	}

	public function get_sliders()
	{	
		$evento = $this->getEvent();

		if (!$evento) {
			return;
		}

		$sliders = Cache::read('Banner', 'todo');

		if (!$sliders && $evento['Evento']['mostrar_banners']) {
			$sliders = ClassRegistry::init('Banner')->find('all', array(
				'conditions' => array(
					'Banner.evento_id' => $evento['Evento']['id'],
					'Banner.activo' => 1
					),
				'order' => array('Banner.orden')
			));
			if ($evento['Evento']['cache']) {
				Cache::write('Banner', $sliders, 'todo');
			}
		}
			
		return $sliders;
	}


	/**
     * Método que crea un arreglo con los valores rangoSinFormato : rangoFormateado
     * Arma una lista de rangos segun el menor y el mayor valor del parámetro $campo 
     * y su rango será definido por el parámetro $rango
     * @param 		$campo 		String 		Nombre del campo que se obtendrán los precios
     * @param 		$rango 		Int 		Intervalo entre los rangos de precios 
     * @return 		Array
     */
    public function obtenerRangoPrecios($lista = array(), $campo = 'price', $rango = 100000)
    {	
 		
    	$preciosFinal = array_unique(Hash::extract($lista, sprintf('{n}.Producto.%s', $campo)));

    	# Se quitan los decimales
		foreach ($preciosFinal as $k => $precio) {
			$preciosFinal[$k] = round($precio, 0);	
		}

		# Se ordena de menor a mayor
		sort($preciosFinal);

		# Variables para definir el rango
		$primerValor = array_shift($preciosFinal);
		$ultimoValor = array_pop($preciosFinal);

		# Arreglo de rangos obtenidos 
		$rangosArr = range($primerValor, $ultimoValor, $rango);
		
		$rangos = array();

		foreach ($rangosArr as $k => $valor) {
			if ($k == 0) {
				$rangos[$k]['valor1'] = $valor;
			}else{
				$rangos[$k]['valor1'] = $valor+1;
			}
			
			if (isset($rangosArr[$k+1])) {
				$rangos[$k]['valor2'] = $rangosArr[$k+1];
			}else{
				$rangos[$k]['valor2'] = '+ más';
			}
		    
		}

		$nwRangos = array();
		foreach ($rangos as $i => $rango) {
			if (is_string($rango['valor2'])) {
				$rangoVal = sprintf('%d-%d', $rango['valor1'], 10000000000);
				$rangoTxt = sprintf('%s - %s', CakeNumber::currency($rango['valor1'], 'CLP'), $rango['valor2']);
			}else{
				$rangoVal = sprintf('%d-%d', $rango['valor1'], $rango['valor2']);
				$rangoTxt = sprintf('%s - %s', CakeNumber::currency($rango['valor1'], 'CLP'), CakeNumber::currency($rango['valor2'], 'CLP'));
			}

			$nwRangos[$rangoVal] = $rangoTxt;
		}
		
		return $nwRangos;
    }
}
