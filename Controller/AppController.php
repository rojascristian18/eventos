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
		'RequestHandler',
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
		),
		'Minifier.Minifier'
		//'Facebook.Connect'	=> array('model' => 'Usuario'),
		//'Facebook'
	);

	private function minificarCss($arr = array(), $ext = 'minify')
	{
		$extentioncss   = '';

		if (Configure::read('debug') > 0 && $this->Session->check('Todo.Evento')) {

			$arr = MinifierComponent::normalize($arr, $ext);

	        if (MinifierComponent::minifyCSS($arr))
	        {
	            $extentioncss = '.' . $ext;
	        }
    	}

        return $extentioncss;
	}

	private function minificarJs($arr = array(), $ext = 'minify')
	{
        $extentionjs    = '';

        if (Configure::read('debug') > 0 && $this->Session->check('Todo.Evento')) {
            
            $arr = MinifierComponent::normalize($arr, $ext);

            if (MinifierComponent::minifyJS($arr))
            {
                $extentioncss = '.' . $ext;
            }
        }

        return $extentionjs;

	}

	public function deleteAllCache($keys = array())
	{
		foreach ($keys as $i => $v) {
			Cache::delete($v, 'todo');
		}

	}

	public function beforeFilter()
	{	
		/**
		 * Layout y permisos públicos
		 */
		if ( ! isset($this->request->params['prefix']) ) {

			# Borrar en producción

			if ( !empty($this->verificarModificacionEvento()) ){

				$evento = ClassRegistry::init('Evento')->getEvent();
				
				$f_inicio 	= $evento['Evento']['fecha_inicio'];
	    		$f_final 	= $evento['Evento']['fecha_final'];
	    		
	    		# Verificar actividad
	    		if (!$this->verificarActividadEvento($f_inicio, $f_final)) {
	    			$this->request->params['controller'] = 'eventos';
	    			$this->request->params['action'] = 'inactivo';
	    		}else{
	    			$this->layoutPath = $evento['Evento']['nombre_tema'];
	    		}

	    		$todo = ClassRegistry::init('Evento')->getAllCookies();
	    		
				$this->set('todo', $todo);
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
		}else{

	        $jsFilesN = array(
	        	sprintf('%swebroot\%s\js\jquery-1.11.2.min.js', APP, $this->Session->read('Todo.Evento.nombre_tema')),
	        	sprintf('%swebroot\%s\js\materialize.js', APP, $this->Session->read('Todo.Evento.nombre_tema')),
	        	sprintf('%swebroot\%s\js\plugins\perfect-scrollbar\perfect-scrollbar.min.js', APP, $this->Session->read('Todo.Evento.nombre_tema')),
	        	sprintf('%swebroot\%s\js\custom-script.js', APP, $this->Session->read('Todo.Evento.nombre_tema'))
	        	);

	        $cssFilesN = array(
	        	sprintf('%swebroot\%s\css\materialize.css', APP, $this->Session->read('Todo.Evento.nombre_tema')),
	        	sprintf('%swebroot\%s\css\style.css', APP, $this->Session->read('Todo.Evento.nombre_tema')),
	        	sprintf('%swebroot\%s\css\custom\custom.css', APP, $this->Session->read('Todo.Evento.nombre_tema'))
	        	);

			$cssExtencion = ""; #$this->minificarCss($cssFilesN, 'mini');
			$jsExtencion = ""; #$this->minificarJs($jsFilesN, 'mini');
			

			$this->set('extentioncss', $cssExtencion);
			$this->set('extentionjs', $jsExtencion);

			// Camino de migas
			$breadcrumbs	= BreadcrumbComponent::get();
			if ( ! empty($breadcrumbs) ) {
				$this->set(compact('breadcrumbs'));
			}
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


	public function verificarModificacionEvento()
	{	
		$evento = ClassRegistry::init('Evento')->getEvent();

		if (!$evento) {
			$evento = ClassRegistry::init('Evento')->getEvent();
		}else{

			$modificacion =  ClassRegistry::init('Evento')->find('first', array(
				'conditions' => array(
					'Evento.subdomino' => getsubdominio()
					),
				'fields' => array('modified')
				)
			);
			
			if ( strtotime($modificacion['Evento']['modified']) != strtotime($evento['Evento']['modified']) ) {
				Cache::delete('Evento', 'todo');
				$evento = ClassRegistry::init('Evento')->getEvent();
			}
		}

		return $evento;
	}
}
