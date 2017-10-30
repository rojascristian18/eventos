<?php
App::uses('Controller', 'Controller');
//App::uses('FB', 'Facebook.Lib');
class AppController extends Controller
{	
	public $usarBreadCrumbs;
	public $helpers		= array(
		'Session', 'Html', 'Form', 'PhpExcel'
		//, 'Facebook.Facebook'
	);

	public $components	= array(
		'Session',
		'Cookie',
		'Auth'		=> array(
			'Form'				=> array(
				'fields' => array(
					'username'	=> 'email',
					'password'	=> 'clave'
				)
			)
		),
		'Google'		=> array(
			'applicationName'		=> 'Eventos Nodriza',
			'developerKey'			=> 'cristian.rojas@nodriza.cl',
			'clientId'				=> '786064646822-7u5pp20t3s2ifm71mktt59r3gbt6eo6t.apps.googleusercontent.com',
			'clientSecret'			=> 'K_uJpj0sI4ivolyO8GwNYO8z',
			//'redirectUri'			=> Router::url(array('controller' => 'administradores', 'action' => 'google', 'admin' => false), true)),
			'approvalPrompt'		=> 'auto',
			'accessType'			=> null,//'offline',
			'scopes'				=> array('profile', 'email')
		),
		'DebugKit.Toolbar',
		'Breadcrumb' => array(
			'crumbs'		=> array(
				array('Inicio', ''),
			)
		)
		//'Facebook.Connect'	=> array('model' => 'Usuario'),
		//'Facebook'
	);

	public function beforeFilter()
	{	
		/**
		 * Layout y permisos públicos
		 */
		if ( ! isset($this->request->params['prefix']) ) {
			$this->Session->delete('Todo');
			$this->verificarEvento();

			if (!empty($this->Session->read('Todo'))) {

				$f_inicio 	= $this->Session->read('Todo.Evento.fecha_inicio');
	    		$f_final 	= $this->Session->read('Todo.Evento.fecha_final');

	    		# Verificar actividad
	    		if (!$this->verificarActividadEvento($f_inicio, $f_final)) {
	    			$this->request->params['controller'] = 'eventos';
	    			$this->request->params['action'] = 'inactivo';
	    		}else{
	    			$this->layoutPath = $this->Session->read('Todo.Evento.subdomino');
	    		}
	    		#prx($this->Session->read('Todo'));
				$this->set('todo', $this->Session->read('Todo'));
			}

			$this->Auth->allow();
		}


		/**
		 * Layout administracion
		 */
		if ( ! empty($this->request->params['admin']) )
		{
			$this->layoutPath				= 'backend';
			AuthComponent::$sessionKey		= 'Auth.Administrador';

			// Login action config
			$this->Auth->loginAction['controller'] 	= 'administradores';
			$this->Auth->loginAction['action'] 		= 'login';
			$this->Auth->loginAction['admin'] 		= true;

			// Login redirect and logout redirect
			$this->Auth->loginRedirect = '/admin';
			$this->Auth->logoutRedirect = '/admin';

			// Login Form config
			$this->Auth->authenticate['Form']['userModel']		= 'Administrador';
			$this->Auth->authenticate['Form']['fields']['username'] = 'email';
			$this->Auth->authenticate['Form']['fields']['password'] = 'clave';


			/**
			 * OAuth Google
			 */
			$this->Google->cliente->setRedirectUri(Router::url(array('controller' => 'administradores', 'action' => 'login'), true));
			$this->Google->oauth();

			if ( ! empty($this->request->query['code']) && $this->Session->read('Google.code') != $this->request->query['code'] )
			{
				$this->Google->oauth->authenticate($this->request->query['code']);
				$this->Session->write('Google', array(
					'code'		=> $this->request->query['code'],
					'token'		=> $this->Google->oauth->getAccessToken()
				));
			}

			if ( $this->Session->check('Google.token') )
			{
				$this->Google->cliente->setAccessToken($this->Session->read('Google.token'));
			}


			/**
			 * Cambiar tienda
			 */

			$this->cambioTienda();
			
			if ($this->request->params['controller'] == 'tareas' && $this->request->params['action'] == sprintf('%s_edit', $this->request->params['prefix']) && ! empty($this->request->params['pass']) ) {
				$this->forzarCambioTienda();
			}

		}

		/**
		 * Logout FB
		 */
		/*
		if ( ! isset($this->request->params['admin']) && ! $this->Connect->user() && $this->Auth->user() )
			$this->Auth->logout();
		*/

		/**
		 * Detector cliente local
		 */
		$this->request->addDetector('localip', array(
			'env'			=> 'REMOTE_ADDR',
			'options'		=> array('::1', '127.0.0.1'))
		);

		/**
		 * Detector entrada via iframe FB
		 */
		$this->request->addDetector('iframefb', array(
			'env'			=> 'HTTP_REFERER',
			'pattern'		=> '/facebook\.com/i'
		));

		/**
		 * Cookies IE
		 */
		header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');
		
	}

	/**
	 * Guarda el usuario Facebook
	 */
	public function beforeFacebookSave()
	{
		if ( ! isset($this->request->params['admin']) )
		{
			$this->Connect->authUser['Usuario']		= array_merge(array(
				'nombre_completo'	=> $this->Connect->user('name'),
				'nombre'			=> $this->Connect->user('first_name'),
				'apellido'			=> $this->Connect->user('last_name'),
				'usuario'			=> $this->Connect->user('username'),
				'clave'				=> $this->Connect->authUser['Usuario']['password'],
				'email'				=> $this->Connect->user('email'),
				'sexo'				=> $this->Connect->user('gender'),
				'verificado' 		=> $this->Connect->user('verified'),
				'edad'				=> $this->Session->read('edad')
			), $this->Connect->authUser['Usuario']);
		}

		return true;
	}

	public function beforeRender() {

		if ( ! empty($this->request->params['admin']) ) {
			// Capturar permisos de usuario
			try {
				$permisos = $this->hasPermission();
			} catch (Exception $e) {
				$permisos = $e;
			}
			
			// Permisos públicos
			if ( is_object($permisos) && $permisos->getCode() != 66 ) {
				$this->Session->setFlash($permisos->getMessage(), null, array(), 'danger');
				$this->redirect(sprintf('/%s', $this->request->params['prefix']));
			}

			// Modulos activos y disponibles para este Rol
			$modulosDisponibles = $this->modulosDisponibles( $this->Auth->user('rol_id') );
			
			// Tiendas
			$tiendasList = $this->obtenerTiendas();

			/**
			 * Camino de migas automático
			 */
			$this->caminoAutomatico();

			# Titulo de controladores
			if ( ! empty($this->obtenerTitulo())) {
				$titulo = $this->obtenerTitulo();
			}else{
				$titulo = '';
			}

			// Camino de migas
			$breadcrumbs	= BreadcrumbComponent::get();
			if ( ! empty($breadcrumbs) ) {
				$this->set(compact('breadcrumbs'));
			}


			$this->set(compact('permisos', 'modulosDisponibles', 'tiendasList', 'titulo'));
		}

	}

	/**
	 * Retorna un listado de tiendas activas
	 * @return 	array 	Listado de tiendas
	 */
	private function obtenerTiendas() {
		$tiendas = ClassRegistry::init('Tienda')->find('list', array(
			'conditions' => array('Tienda.activo' => 1)
			));

		if (empty($tiendas)) {
			return array( 0 => 'No existen tiendas');
		}

		return $tiendas;
	}

	/**
	* Functión que determina si el usuario tien permisos para editar, 
	* eliminar y agregar dentro de los módulos.
	* @return 	Array 	$permisosControladorActual 	Arreglo con infromación del acceso al módulo.
	*/ 
	public function hasPermission()
	{
		$jsonPermisos = ClassRegistry::init('Rol')->find('first', array('conditions' => array('Rol.id' => $this->Auth->user('rol_id')), 'fields' => array('permisos')));

		if (empty($jsonPermisos)) {
			return false;
		}

		if (empty($jsonPermisos['Rol']['permisos']) && $this->request->params['action'] != 'admin_login' && $this->request->params['action'] != 'admin_logout') {
		 	throw new Exception('Falta Json con información de permisos.', 11);
		}

		if ( $this->request->params['action'] == 'admin_login' || $this->request->params['action'] == 'admin_logout' ) {
			throw new Exception('Acceso público.', 66);
		}

		$json = json_decode( $jsonPermisos['Rol']['permisos'], true );

		$controladorActual = $this->request->params['controller'];

		$accionActual = $this->request->params['action'];
		

		if( ! array_key_exists($controladorActual, $json) ){
			throw new Exception('Imposible acceder a ese módulo.', 12);
		}

		$permisosControladorActual = $json[$controladorActual];
	
		if( empty($permisosControladorActual) ) {
			throw new Exception('No tiene permiso de acceder a ese módulo.', 13);
		}else {
			return $permisosControladorActual;
		}	
	}


	/**
	 * Function que determina el Rol del usuario y controla el acceos a los módulos
	 * @return array $data  Lista de módulos disponibles para le usuario.
	 */
	public function modulosDisponibles( $rol = '' ){

		if ( empty($rol) ) {
			return false;
		}

		$modulos = ClassRegistry::init('Modulo')->find('all', array(
				'conditions' => array('parent_id' => NULL, 'Modulo.activo' => 1),
				'order' => array('orden' => 'ASC'),
				'joins' => array(
					array(
						'table' => 'modulos_roles',
			            'alias' => 'md',
			            'type'  => 'INNER',
			            'conditions' => array(
			                'md.modulo_id = Modulo.id',
			                'md.rol_id' => $rol)
					)
				),
				'fields' => array('Modulo.id', 'Modulo.parent_id', 'Modulo.nombre', 'Modulo.url', 'Modulo.icono')));
		$data = array();
		foreach ($modulos as $padre) {
			$data[] = array(
				'nombre' => $padre['Modulo']['nombre'],
				'icono'	 => $padre['Modulo']['icono'],
				'url'	 => $padre['Modulo']['url'],
				'hijos' => ClassRegistry::init('Modulo')->find(
					'all', array(
						'conditions' => array('Modulo.parent_id' => $padre['Modulo']['id'], 'Modulo.activo' => 1 ),
						'contain' => array('Rol'),
						'order' => array('orden' => 'ASC'),
						'joins' => array(
							array(
								'table' => 'modulos_roles',
					            'alias' => 'md',
					            'type'  => 'INNER',
					            'conditions' => array(
					                'md.modulo_id = Modulo.id',
					                'md.rol_id' => $rol					            )
							)
						),
						'fields' => array('Modulo.id', 'Modulo.parent_id', 'Modulo.nombre', 'Modulo.url', 'Modulo.icono')
					)
				)
			);
		}
		return $data;
	}


	private function cambioTienda() {
		# si es una peticioón post
		if (isset($this->request->data['Tienda']['tienda']) ) {

			# Tema de la tienda
			$tienda = ClassRegistry::init('Tienda')->find('first', array(
				'conditions' => array('Tienda.id' => $this->request->data['Tienda']['tienda'])
				));

			# Método actual
			$action = str_replace(sprintf('%s_', $this->request->params['prefix']), '', $this->request->params['action']);
			
			# Redireccionamos a mismo
			# Si tiene parámetros se redirecciona al index del controllador actual
			if ( !empty($this->request->params['pass']) ) {

				# Cambiamos Session Tienda
				$this->Session->write('Tienda', $tienda['Tienda']);
				
				# Redireccionamos
				if ( isset($this->request->params['maintainers']) ) {
					$this->redirect(array('controller' => 'tareas', 'action' => 'index'));	
				}else{
					$this->redirect(array('action' => 'index'));
				}
			}

			# Cambiamos Session Tienda
			$this->Session->write('Tienda', $tienda['Tienda']);

			$this->redirect(array('action' => $action));
			
		}

	}

	private function forzarCambioTienda()
	{
		$tarea = ClassRegistry::init('Tarea')->find('first', array(
			'conditions' => array('Tarea.id' => $this->request->params['pass'][0])
			)
		);

		# Tema de la tienda
		$tienda = ClassRegistry::init('Tienda')->find('first', array(
			'conditions' => array('Tienda.id' => $tarea['Tarea']['tienda_id'])
			));

		# Cambiamos Session Tienda
		$this->Session->write('Tienda', $tienda['Tienda']);
		return;

	}

	/**
	 * Método que agrega un datasource a los modelos pasados en el arreglo, según la ´tienda que se esté trabajando.
	 * @param  array  	$modelos 	Nombres de los modelos
	 * @param  string 	$tienda 	nombre de la configuración de la tienda. Se utiliza para cuando no registramos en sesión el ID de la tienda.
	 * @return void
	 */
	public function cambiarDatasource( $modelos = array(), $tienda = '' ) {
		if (empty($tienda)) {
			foreach ($modelos as $instancia) {
				ClassRegistry::init($instancia)->useDbConfig 	= $this->Session->read('Tienda.db_configuracion');
			}
		}else{
			foreach ($modelos as $instancia) {
				ClassRegistry::init($instancia)->useDbConfig 	= $tienda;
			}
		}
	}


	/**
	 * Función que crea un camino de migas según el controllador y la acción que se está ejecutando.
	 * @return [type] [description]
	 */
	public function caminoAutomatico() {

		BreadcrumbComponent::add(Inflector::humanize($this->request->params['controller']), sprintf('/%s/%s', $this->request->params['prefix'], $this->request->params['controller']));
	
		switch ($this->request->params['action']) {
			case sprintf('%s_index', $this->request->params['prefix']):
				 // Do nothing
				break;
			case sprintf('%s_add', $this->request->params['prefix']):
				BreadcrumbComponent::add('Agregar ');
				break;
			case sprintf('%s_edit', $this->request->params['prefix']):
				BreadcrumbComponent::add('Editar ');
				break;
			case sprintf('%s_view', $this->request->params['prefix']):
				BreadcrumbComponent::add('Ver ');
				break;
		}
	}

	public function obtenerTitulo() {
		if (isset($this->request->params['controller'])) {
			$modulo = ClassRegistry::init('Modulo')->find('first', array(
				'conditions' => array(
					'Modulo.url' => $this->request->params['controller']
					)
				));

			if (!empty($modulo)) {
				$md = array(
					'icono' => $modulo['Modulo']['icono'],
					'nombre' => $modulo['Modulo']['nombre']
					);
				return $md;
			}
		}
	}


	public function obtenerMarcas()
	{ 	
		$this->cambiarDatasource(array('Fabricante'));
		$marcas = ClassRegistry::init('Fabricante')->find('list');
		return $marcas;
	}


	public function precio_bruto($precio = null, $iva = 19)
	{
		if (!is_null($precio)) {

			$iva = (intval($iva) / 100) +1;

			return round( $precio * $iva );
		}
		
		return;
	}


	/**
	 * Función que elimna lós elementos adjuntos por id
	 * @param  string 	$ids 	String de IDs separados por coma  
	 * @return void
	 */
	public function quitarElementos( $ids = '', $clase = '' ) {
		if ( ! empty($ids) ) {
			# Adjuntos eliminados
			$arrayEliminadas = explode(",", $ids);
			
			ClassRegistry::init($clase)->deleteAll(array(sprintf('%s.id', $clase) => $arrayEliminadas));	
		}
	}


	public function obtenerTiendaConf($id = '')
	{
		# Tema de la tienda
		$tienda = ClassRegistry::init('Tienda')->find('first', array(
			'conditions' => array('Tienda.id' => $id)
			)
		);

		if (!empty($tienda)) {
			return $tienda['Tienda']['db_configuracion']; 	
		}
		return;
	}



	public function verificarActividadEvento($f_inicio = '', $f_final = '')
	{
		if (!empty($f_inicio) && !empty($f_final)) {
			$hoy = strtotime(date("Y-m-d H:i:s",time()));

			if ( $hoy >= strtotime($f_inicio) &&  $hoy < strtotime($f_final) ) {
				return true;
			}
		}
		return false;
	}


	public function verificarEvento()
	{	
		if (!$this->Session->check('Todo')) {
			$this->Session->write('Todo', $this->obtenerEvento());
		}else{

			$modificacion =  ClassRegistry::init('Evento')->find('first', array(
				'conditions' => array(
					'Evento.subdomino' => $this->getsubdominio()
					),
				'fields' => array('modified')
				)
			);
			
			if ( strtotime($modificacion['Evento']['modified']) != strtotime($this->Session->read('Todo.Evento.modified')) ) {
				$this->Session->write('Todo', $this->obtenerEvento());
			}
		}
	}


	public function obtenerEvento($limite = 10)
	{	

		$todo = array();

		$todo = ClassRegistry::init('Evento')->find('first', array(
			'fields' => array(
				'Evento.id',
				'Evento.nombre',
				'Evento.subdomino',
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
				'Evento.modified',
				'Tienda.id',
				'Tienda.db_configuracion',
				'Tienda.nombre',
				'Tienda.url'
				),
			'conditions' => array(
				'Evento.subdomino' => $this->getsubdominio(),
				'Evento.activo' => 1
				),
			'order' => array('Evento.created' => 'DESC'),
			'contain' => array('Tienda')
			)
		);

		if (empty($todo) || empty($todo['Evento']['tienda_id']) || empty($todo['Evento']['subdomino'])) {
			return;
		}

		# Configuración de la tienda
		if (empty($todo['Tienda']['db_configuracion'])) {
			return;
		}

		$this->cambiarDatasource(array('Producto', 'Fabricante', 'Idioma', 'ProductosIdioma', 'ReglaImpuesto', 'GrupoReglaImpuesto', 'Impuesto', 'PrecioEspecifico'), $todo['Tienda']['db_configuracion']);

		
		# Categorias del evento
		$todo['Categoria'] = ClassRegistry::init('Categoria')->find('all', array(
			'fields' => array(
				'Categoria.id',
				'Categoria.nombre_corto',
				'Categoria.parent_id',
				'Categoria.nombre', 
				'Categoria.icono_imagen'
				),
			'conditions' => array(
				'Categoria.evento_id' => $todo['Evento']['id']
				),
			'contain' => array(
				'ChildCategoria' => array(
					'fields' => array(
						'ChildCategoria.id',
						'ChildCategoria.parent_id',
						'ChildCategoria.nombre_corto',
						'ChildCategoria.nombre',
						'ChildCategoria.icono_imagen'
					)
				)
			),
			'order' => array('Categoria.orden' => 'ASC')
		));
		
		# Marcas
		$todo['EventosMarca'] = ClassRegistry::init('EventosMarca')->find('all', array(
			'conditions' => array(
				'EventosMarca.evento_id' => $todo['Evento']['id']
				),
			'contain' => array(
				'MarcasFabricante'
				)
			)
		);

		# Productos
		$relProductos = ClassRegistry::init('EventosProducto')->find('all', array('conditions' => array('EventosProducto.evento_id' => $todo['Evento']['id'])));
		
		$todo['Producto'] = array();

		if (!empty($relProductos)) {
			$productos = ClassRegistry::init('Producto')->find('all', array(
				'conditions' => array(
					'Producto.id_product' => Hash::extract($relProductos, '{n}.EventosProducto.id_product')
					),
				'contain' => array(
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
				),
				'limit' => $limite
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
				foreach ($marcas as $i => $marca) {
					if ($marca['MarcasFabricante']['id_manufacturer'] == $producto['Producto']['id_manufacturer']) {
						$productos[$ix]['MarcasFabricante'] = $marca;
					}		
				}	
			}
			$todo['Producto'] = $productos;
			// Agrgar marcas al producto
		}
		
		return (!empty($todo)) ? $todo : '';
	}

	public function getsubdominio()
	{	
		$dominio = $_SERVER['SERVER_NAME'];
		if (!preg_match("~^(?:f|ht)tps?://~i", $dominio)) {
            $dominio = $dominio;
        }

        $dominio = str_replace("www.", "", $dominio);
	
		$subdomino = substr($dominio, 0, strpos($dominio, '.') );

		return $subdomino;
	}

}
