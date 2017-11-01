<?php
App::uses('AppController', 'Controller');
class EventosController extends AppController
{	
	/**
	 * Función que limpia de una array los elementos vacios
	 * @param 	$modelo 	String 		Nombre del modelo que se desea limpiar
	 * @param 	$sub 		bool 		Determina si es una lista o un arreglo
	 * @param 	$es_imagen 	bool 		Determina si el arreglo debe evaluar los arreglos de ind
	 * @param 	$requerido 	bool 		Esta opción determina que un campo es mandatorio en un arreglo o lista.
	 */
	public function limpiarCampos($modelo = '', $sub = false, $es_imagen = false , $requerido = false) {
		if (isset($this->request->data[$modelo])) {
			foreach ($this->request->data[$modelo] as $key => $val) {
				if (!$sub) {
					if (is_array($val)) {
						if ($es_imagen && is_array($this->request->data[$modelo][$key]) ) {
							if ( isset($this->request->data[$modelo][$key]['error']) && $this->request->data[$modelo][$key]['error'] > 0 ) {
								if ($requerido) {
									unset($this->request->data[$modelo]);
								}else{
									unset($this->request->data[$modelo][$key]);
								}
							}
						}	
					}else{
						if (empty($val)) {
							if ($requerido) {
								unset($this->request->data[$modelo]);
							}else{
								unset($this->request->data[$modelo][$key]);
							}
						}
					}
				}else{
					if (is_array($val)) {
						
						foreach ($val as $k => $v) {
							if ($es_imagen && is_array($this->request->data[$modelo][$key][$k]) ) {
								if ( isset($this->request->data[$modelo][$key][$k]['error']) && $this->request->data[$modelo][$key][$k]['error'] > 0 ) {
									if ($requerido) {
										unset($this->request->data[$modelo][$key]);	
									}else{
										unset($this->request->data[$modelo][$key][$k]);
									}
								}
							}else{
								if (empty($this->request->data[$modelo][$key][$k])) {
									if ($requerido) {
										unset($this->request->data[$modelo][$key]);
									}else{
										unset($this->request->data[$modelo][$key][$k]);
									}
								}
							}
						}
					}
				}
			}
			
			return true;
		}
	}

	public function admin_steps($id = '', $paso = '')
	{
		if ( ! $this->Evento->exists($id) )
		{
			$this->Session->setFlash('No existe el evento solicitado.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if (empty($paso)) {
			BreadcrumbComponent::add('Continuar ');
			$this->set(compact('id'));

		}else{

			$pasos = array(1, 2, 3, 4);

			if (!in_array($paso, $pasos)) {
				$this->Session->setFlash('Ocurrió un error en la solicitud. Intentelo nuevamente.', null, array(), 'danger');
				$this->redirect(array('action' => 'edit', $id));
			}

			$this->cambiarDatasource(array('Producto', 'Fabricante', 'Idioma', 'ProductosIdioma', 'ReglaImpuesto', 'GrupoReglaImpuesto', 'Impuesto', 'PrecioEspecifico'));

			$evento = $this->Evento->find('first', array(
				'conditions' => array('Evento.id' => $id),
				'contain' => array(
					'Categoria' => array('Producto', 'ChildCategoria'), 
					'EventosMarca' => array('MarcasFabricante'), 
					'EventosProducto'
					)
				)
			);

			if (!empty($evento['EventosProducto'])) {
				$productos = ClassRegistry::init('Producto')->find('all', array(
					'fields' => array(
						'Producto.id_product',
						'Producto.id_manufacturer',
						'Producto.id_tax_rules_group',
						'Producto.quantity',
						'Producto.price',
						'Producto.reference',
						
						),
					'conditions' => array(
						'Producto.id_product' => Hash::extract($evento['EventosProducto'], '{n}.id_product')
						),
					'contain' => array('Idioma')
				));
				
				$evento['Producto'] = $productos;
			}
			
			# Paso 1
			if ($paso == 1) {
				
				# Obtenemos las marcas del evento
				$marcasEvento = $evento['EventosMarca'];
				$productosEvento = $evento['Producto'];

				$grupoMarcas = array();
				
				foreach ($marcasEvento as $indice => $marca) {
					$grupoMarcas[$indice]['marca_id'] = $marca['id'];
					$grupoMarcas[$indice]['marca_nombre'] = $marca['nombre'];
					$grupoMarcas[$indice]['marca_imagen'] = $marca['imagen'];

					foreach ($productosEvento as $i => $producto) {
						if (in_array($producto['Producto']['id_manufacturer'], Hash::extract($marcasEvento, sprintf('%d.MarcasFabricante.{n}.id_manufacturer', $indice) ) )) {
							$grupoMarcas[$indice]['productos'][$i]['referencia'] = $producto['Producto']['reference'];
							$grupoMarcas[$indice]['productos'][$i]['nombre'] = $producto['Idioma'][0]['ProductosIdioma']['name'];
						}
					}
				}
				
				$errorOut = '';

				if (count($productosEvento) != count(Hash::extract($grupoMarcas, '{n}.productos')) )  {
					$errorOut = 'Existen productos sin su marca correspondiente. Por favor agregelas a la configuración del evento.';
				}

				$this->set(compact('grupoMarcas', 'evento', 'errorOut'));
				$this->render('admin_uno');
			}

			# Paso 2
			if ($paso == 2) {

				if ( $this->request->is('post') || $this->request->is('put') )
				{	
					if(!ClassRegistry::init('Categoria')->saveAll($this->request->data['Evento'], array('deep' => true))){
						$this->Session->setFlash('Ocurrió un error al guardar la relación.', null, array(), 'danger');
					}else{
						$this->Session->setFlash('Relación Categorias - Productos guardada con éxito.', null, array(), 'success');
						$this->redirect(array('action' => 'steps', $id, 3));
					}
				}

				BreadcrumbComponent::add('Paso dos ');
				$this->set(compact('evento'));
				$this->render('admin_dos');
			}

			# Paso 3
			if ($paso == 3) {
				BreadcrumbComponent::add('Paso tres ');

				#prx($evento);

				$this->set(compact('evento'));
				$this->render('admin_tres');
			}

			# Publicar
			if ($paso == 4) {
				
				# Activar el evento
				$this->Evento->id = $id;
				
				if($this->Evento->saveField('activo', 1))
				{
					$this->Session->setFlash('Evento publicado con éxito.', null, array(), 'success');
					$this->redirect(array('action' => 'index'));
				}else{
					$this->Session->setFlash('Ocurrió un error al publicar el evento. Intente nuevamente', null, array(), 'danger');
					$this->redirect(array('action' => 'steps', $id, 3));
				}

			}
		}
	}


	/**
	 * Método encargado de redireccionar un evento hacia el siguiente paso de configuración
	 * @param 		$id 		int 		Identificador del evento
	 * @param 		$estado 	String 		texto que acompaña al mensaje de retorno
	 */
	public function continuarConfiguracionEvento($id = '', $estado = 'creado')
	{
		if ( ! $this->Evento->exists($id) )
		{
			$this->Session->setFlash('No existe el evento solicitado.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->cambiarDatasource(array('Producto', 'Fabricante', 'Idioma', 'ProductosIdioma', 'ReglaImpuesto', 'GrupoReglaImpuesto', 'Impuesto', 'PrecioEspecifico'));

		$evento = $this->Evento->find('first', array(
				'conditions'	=> array('Evento.id' => $id),
				'contain' => array('Pago', 'Despacho', 'EventosMarca', 'EventosProducto', 'Categoria')
			)
		);

		if (!empty($evento['Despacho']) && !empty($evento['Pago']) && !empty($evento['EventosMarca']) && !empty($evento['EventosProducto']) && !empty($evento['Categoria']) ) {
			$this->Session->setFlash(sprintf('Evento %s y configurado correctamente.', $estado), null, array(), 'success');
			$this->redirect(array('action' => 'steps', $id));
		}else{
			$this->Session->setFlash(sprintf('Evento %s correctamente.', $estado), null, array(), 'success');
			$this->redirect(array('action' => 'edit', $id));
		}
	}


	public function admin_index()
	{	
		$this->cambiarDatasource(array('Producto', 'Fabricante', 'Idioma', 'ProductosIdioma', 'ReglaImpuesto', 'GrupoReglaImpuesto', 'Impuesto', 'PrecioEspecifico'));

		$this->paginate		= array(
			'recursive'			=> 0,
			'contain' => array(
				'Tienda',
				'Categoria', 
				'EventosMarca' => array('MarcasFabricante'), 
				'Producto'
			),
			'conditions' => array('Evento.tienda_id' => $this->Session->read('Tienda.id'))
		);

		$eventos	= $this->paginate();

		$this->set(compact('eventos'));
	}

	
	public function admin_add()
	{	
		$this->cambiarDatasource(array('Producto', 'Fabricante', 'Idioma', 'ProductosIdioma', 'ReglaImpuesto', 'GrupoReglaImpuesto', 'Impuesto', 'PrecioEspecifico'));

		if ( $this->request->is('post') )
		{	
			# Validar campos evento
			$this->limpiarCampos('Evento', false, true);

			# Validar campos pago
			$this->limpiarCampos('Pago', true, false);

			# Validar campos Despacho
			$this->limpiarCampos('Despacho', true, false);
			
			# Validar campos Marcas
			$this->limpiarCampos('EventosMarca', true, true, false);

			# Validar campos Categorias
			$this->limpiarCampos('Categoria', true, false);

			$this->Evento->create();
			if ( $this->Evento->saveAll($this->request->data) )
			{	
				$ultimo_id = $this->Evento->find('first', array(
					'fields' => array('id'),
					'order' => array('id' => 'DESC')
					)
				);

				$this->continuarConfiguracionEvento($ultimo_id['Evento']['id']);

			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}

		$marcas = $this->obtenerMarcas();

		$this->set(compact('marcas'));
	}

	
	public function admin_edit($id = null)
	{
		if ( ! $this->Evento->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->cambiarDatasource(array('Producto', 'Fabricante', 'Idioma', 'ProductosIdioma', 'ReglaImpuesto', 'GrupoReglaImpuesto', 'Impuesto', 'PrecioEspecifico'));

		if ( $this->request->is('post') || $this->request->is('put') )
		{	#prx($this->request->data);

			#prx($this->request->data);
			# Validar campos evento
			$this->limpiarCampos('Evento', false, true);

			# Validar campos pago
			$this->limpiarCampos('Pago', true, false);

			# Validar campos Despacho
			$this->limpiarCampos('Despacho', true, false);
			
			# Validar campos Marcas
			$this->limpiarCampos('EventosMarca', true, true, false);

			# Validar campos Categorias
			$this->limpiarCampos('Categoria', true, false);


			# Se eliminan las marcas
			if ( !empty($this->request->data['Evento']['ElementosEliminadosMarcas']) ) {
				$this->quitarElementos($this->request->data['Evento']['ElementosEliminadosMarcas'], 'EventosMarca');
			}else{
				unset($this->request->data['Evento']['ElementosEliminadosMarcas']);
			}

			# Se eliminan las categorias
			if ( !empty($this->request->data['Evento']['ElementosEliminadosCategorias']) ) {
				$this->quitarElementos($this->request->data['Evento']['ElementosEliminadosCategorias'], 'Categoria');
			}else{
				unset($this->request->data['Evento']['ElementosEliminadosCategorias']);
			}
	
			# Eliminar pagos
			$this->Evento->Pago->deleteAll(array('Pago.evento_id' => $id));

			# Eliminar despachos
			$this->Evento->Despacho->deleteAll(array('Despacho.evento_id' => $id));

			# Eliminar productos
			$this->Evento->EventosProducto->deleteAll(array('EventosProducto.evento_id' => $id));

			if ( $this->Evento->saveAll($this->request->data) )
			{	
				$this->continuarConfiguracionEvento($id, 'editado');
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		else
		{
			$this->request->data	= $this->Evento->find('first', array(
				'conditions'	=> array('Evento.id' => $id),
				'contain' => array(
					'Pago', 
					'Despacho', 
					'EventosMarca' => array('MarcasFabricante'),
					'Categoria',
					'EventosProducto' => array(
						'Producto' => array(
							'Fabricante', 
							'Idioma', 
							'GrupoReglaImpuesto' => array(
								'ReglaImpuesto' => array(
									'Impuesto')
								),
							'PrecioEspecifico' => array(
								'conditions' => array(
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
						)
					) 
				)
			));
		}
		#prx($this->request->data);
		$marcas = $this->obtenerMarcas();
		$this->set(compact('marcas'));
	}

	public function admin_delete($id = null)
	{
		$this->Evento->id = $id;
		if ( ! $this->Evento->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Evento->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Evento->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Evento->_schema);
		$modelo			= $this->Evento->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}

	public function admin_activar( $id = null ) {
		$this->Evento->id = $id;
		if ( ! $this->Evento->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->Evento->saveField('activo', 1) )
		{
			$this->Session->setFlash('Evento activado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al activar el evento. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_desactivar( $id = null ) {
		$this->Evento->id = $id;
		if ( ! $this->Evento->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->Evento->saveField('activo', 0) )
		{
			$this->Session->setFlash('Evento desactivado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al desactivar el evento. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function obtener_productos_por_ids($ids = array()) 
	{
		if (!empty($ids)) {
			$this->cambiarDatasource(array('Producto', 'Fabricante', 'Idioma', 'ProductosIdioma', 'ReglaImpuesto', 'GrupoReglaImpuesto', 'Impuesto', 'PrecioEspecifico'));

	   		$productos = ClassRegistry::init('Producto')->find('all', array(
	   			'conditions' => array(
	   				'Producto.id_product' => $ids
	   			),
	   			'contain' => array(
	   				'Idioma',
	   				'GrupoReglaImpuesto' => array(
						'ReglaImpuesto' => array(
							'Impuesto'
						)
					),
					'PrecioEspecifico' => array(
						'conditions' => array(
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
				)
				)
	   		);

	   		return $productos;
		}
	}

	public function obtener_productos( $palabra = '') {
    	if (!$this->Session->check('Tienda.id') || empty($palabra)) {
    		echo json_encode(array('0' => array('value' => '', 'label' => 'Ingrese referencia')));
    		exit;
    	}

   		$this->cambiarDatasource(array('Producto', 'Fabricante', 'Idioma', 'ProductosIdioma', 'ReglaImpuesto', 'GrupoReglaImpuesto', 'Impuesto', 'PrecioEspecifico'));

   		$productos = ClassRegistry::init('Producto')->find('all', array(
   			'conditions' => array(
   				'Producto.reference LIKE' => $palabra . '%'
   			),
   			'contain' => array(
   				'Idioma',
   				'GrupoReglaImpuesto' => array(
					'ReglaImpuesto' => array(
						'Impuesto'
					)
				),
				'PrecioEspecifico' => array(
					'conditions' => array(
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
			'limit' => 3)
   		);

   		if (empty($productos)) {
    		echo json_encode(array('0' => array('id' => '', 'value' => 'No se encontraron coincidencias')));
    		exit;
    	}
    	
    	foreach ($productos as $index => $producto) {
    		$arrayProductos[$index]['id'] = $producto['Producto']['id_product'];
			$arrayProductos[$index]['value'] = sprintf('%s - %s', $producto['Producto']['reference'], $producto['Idioma'][0]['ProductosIdioma']['name']);

			$tabla = '<tr>';
	    	$tabla .= '<td><input type="hidden" name="data[Producto][[*ID*]][id_product]" value="[*ID*]" class="js-input-id_product">[*ID*]</td>';
	    	$tabla .= '<td>[*REFERENCIA*]</td>';
	    	$tabla .= '<td>[*NOMBRE*]</td>';
	    	$tabla .= '<td><b>[*PRECIO*]</b></td>';
	    	$tabla .= '<td><b>[*DESCUENTO*]</b></td>';
	    	$tabla .= '<td><label class="label label-form label-success">[*PRECIO_FINAL*]</label></td>';
	    	$tabla .= '<td><button class="js-clon-eliminar btn btn-xs btn-danger">Quitar</button></td>';
	    	$tabla .= '</tr>';

			// Armamos la tabla
			$tabla = str_replace('[*ID*]', $producto['Producto']['id_product'] , $tabla);
			$tabla = str_replace('[*REFERENCIA*]', $producto['Producto']['reference'] , $tabla);
			$tabla = str_replace('[*NOMBRE*]', $producto['Idioma'][0]['ProductosIdioma']['name'] , $tabla);

			$precio_normal 		= $this->precio_bruto($producto['Producto']['price'], $producto['GrupoReglaImpuesto']['ReglaImpuesto'][0]['Impuesto']['rate']);
			
			if ( ! empty($producto['PrecioEspecifico']) ) {
				if ($producto['PrecioEspecifico'][0]['reduction'] == 0) {
					$tabla = str_replace('[*PRECIO*]', CakeNumber::currency($precio_normal , 'CLP'), $tabla);
					$tabla = str_replace('[*DESCUENTO*]', intval($producto['PrecioEspecifico'][0]['reduction']) , $tabla);
					$tabla = str_replace('[*PRECIO_FINAL*]', CakeNumber::currency($precio_normal , 'CLP'), $tabla);
				}else {
					$precio_descuento	= $this->precio_bruto($precio_normal, ($producto['PrecioEspecifico'][0]['reduction'] * 100 * -1) );
					
					$tabla = str_replace('[*PRECIO*]', CakeNumber::currency($precio_normal , 'CLP'), $tabla);
					$tabla = str_replace('[*DESCUENTO*]', intval($producto['PrecioEspecifico'][0]['reduction'] * 100 * -1) , $tabla);
					$tabla = str_replace('[*PRECIO_FINAL*]', CakeNumber::currency($precio_descuento , 'CLP') , $tabla);
				}
			}else{
				$tabla = str_replace('[*PRECIO*]', CakeNumber::currency($precio_normal , 'CLP') , $tabla);
				$tabla = str_replace('[*DESCUENTO*]', 0 , $tabla);
				$tabla = str_replace('[*PRECIO_FINAL*]', CakeNumber::currency($precio_normal , 'CLP') , $tabla);
			}
			$arrayProductos[$index]['todo'] = $tabla;
    	}

    	echo json_encode($arrayProductos, JSON_FORCE_OBJECT);
    	exit;
    }



    /**
     * Métodos públicos
     */

    public function inactivo()
    {
    	$this->render(sprintf('%s/no_evento', $this->Session->read('Todo.Evento.nombre_tema')));
    }

    public function index()
    {	
    	$this->getsubdominio();
    	# Verifica existencia
    	if ( ! $this->Session->check('Todo') ) {
    		
    		$tiendas = ClassRegistry::init('Tienda')->find('all', array('conditions' => array('activo' => 1)));
    		$this->set(compact('tiendas'));

    	}else{

    		$sliders = array();

    		if ($this->Session->read('Todo.Evento.mostrar_banners')) {
    			$sliders = $this->get_sliders($this->Session->read('Todo.Evento.id'));
    		}
    		
    		$this->set(compact('sliders'));
    		$this->render(sprintf('%s/index', $this->Session->read('Todo.Evento.nombre_tema')));
  
    	}
    }


    public function ajax_get_products($limite = 10, $salto = 0)
    {
    	$this->cambiarDatasource(array('Producto', 'Fabricante', 'Idioma', 'ProductosIdioma', 'ReglaImpuesto', 'GrupoReglaImpuesto', 'Impuesto', 'PrecioEspecifico', 'Imagen'), $this->Session->read('Todo.Tienda.db_configuracion'));

    	$productos = array();

		# Host de imagenes
		$baul = 'https://' . $this->Session->read('Todo.Tienda.url');
		
		if (!empty($this->Session->read('Todo.Evento.host_imagenes'))) {
			$baul	= 'http://' . $this->Session->read('Todo.Evento.host_imagenes');
		}

		if (!empty($this->Session->read('Todo.EventosProducto'))) {
			$productos = ClassRegistry::init('Producto')->find('all', array(
				'fields' => array(
					'Producto.id_product',
					'Producto.id_manufacturer',
					'Producto.id_tax_rules_group',
					'Producto.quantity',
					'Producto.price',
					'Producto.reference',
					
					),
				'conditions' => array(
					'Producto.id_product' => Hash::extract($this->Session->read('Todo.EventosProducto'), '{n}.EventosProducto.id_product')
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
					'Idioma',
					'GrupoReglaImpuesto' => array(
						'ReglaImpuesto' => array(
							'Impuesto')
						),
					'PrecioEspecifico' => array(
						'conditions' => array(
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
				'limit' => $limite,
				'offset' => $salto
			));
			
			$marcas = ClassRegistry::init('MarcasFabricante')->find('all', array(
				'conditions' => array(
					'MarcasFabricante.id_manufacturer' => Hash::extract($productos, '{n}.Producto.id_manufacturer')
					),
				'contain' => array(
					'EventosMarca'
					)
			));


			foreach ($productos as $ix => $producto) {

				# Precios del producto
				if ( !isset($producto['GrupoReglaImpuesto']['ReglaImpuesto'][0]['Impuesto']['rate']) ) {
					$productos[$ix]['Producto']['valor_iva'] = $producto['Producto']['price'];	
				}else{
					$productos[$ix]['Producto']['valor_iva'] = $this->precio($producto['Producto']['price'], $producto['GrupoReglaImpuesto']['ReglaImpuesto'][0]['Impuesto']['rate']);
				}

				$productos[$ix]['Producto']['valor_final'] = $productos[$ix]['Producto']['valor_iva'];

				// Retornar último precio espeficico según criterio del producto
				foreach ($producto['PrecioEspecifico'] as $precio) {
					if ( $precio['reduction'] == 0 ) {
						$productos[$ix]['Producto']['valor_final'] = $productos[$ix]['Producto']['valor_iva'];

					}else{

						$productos[$ix]['Producto']['valor_final'] = $this->precio($productos[$ix]['Producto']['valor_iva'], ($precio['reduction'] * 100 * -1) );
						$productos[$ix]['Producto']['descuento'] = ($precio['reduction'] * 100 * -1 );

					}
				}

				# Marcas del producto
				foreach ($marcas as $i => $marca) {
					if ($marca['MarcasFabricante']['id_manufacturer'] == $producto['Producto']['id_manufacturer']) {
						$productos[$ix]['MarcasFabricante'] = $marca;
					}		
				}
			}
		}
		
		$this->layout = 'ajax';
		
		$this->set(compact('productos'));

   		$this->render(sprintf('%s/ajax_productos', $this->Session->read('Todo.Evento.nombre_tema')));
   		
   		
    }
}
