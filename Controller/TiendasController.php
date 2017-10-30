<?php
App::uses('AppController', 'Controller');
class TiendasController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$tiendas	= $this->paginate();
		$this->set(compact('tiendas'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Tienda->create();
			if ( $this->Tienda->save($this->request->data) )
			{	# Guardamos la configuración de la nueva tienda
				if ( $this->nuevoOrigenDatos($this->request->data)) {
					$this->Session->setFlash('Registro editado correctamente', null, array(), 'success');
					$this->redirect(array('action' => 'index'));
				}else{
					$this->Session->setFlash('Registro editado correctamente, pero no se pudo crear el archivo. Contacte al administrador.', null, array(), 'danger');
					$this->redirect(array('action' => 'index'));
				}
			}
			else
			{	
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}	
		}
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Tienda->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Tienda->save($this->request->data) )
			{	
				$this->Session->setFlash('Registro editado correctamente', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
				
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		else
		{
			$this->request->data	= $this->Tienda->find('first', array(
				'conditions'	=> array('Tienda.id' => $id)
			));
		}
	}

	public function admin_delete($id = null)
	{
		$this->Tienda->id = $id;
		if ( ! $this->Tienda->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Tienda->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Tienda->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Tienda->_schema);
		$modelo			= $this->Tienda->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}

	public function admin_activar( $id = null ) {
		$this->Tienda->id = $id;
		if ( ! $this->Tienda->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->Tienda->saveField('activo', 1) )
		{
			$this->Session->setFlash('Registro activado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al activar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_desactivar( $id = null ) {
		$this->Tienda->id = $id;
		if ( ! $this->Tienda->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->Tienda->saveField('activo', 0) )
		{
			$this->Session->setFlash('Registro desactivado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al desactivar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * Función que agrega un nuevo datasource al archivo de configuración de base de datos.
	 * @param  array  $datos Arreglo con la infomración de la tienda
	 * @return bool
	 */
	private function nuevoOrigenDatos($datos = array()) {
		if (empty($datos)) {
			return false;
		}

		# Verificamos que la información esté completa
		if ( empty($datos['Tienda']['nombre']) || empty($datos['Tienda']['db_configuracion']) || empty($datos['Tienda']['host']) || empty($datos['Tienda']['usuario_mysql']) || empty($datos['Tienda']['pass_mysql']) || empty($datos['Tienda']['nombre_base_de_datos']) || empty($datos['Tienda']['prefijo']) ) {
			return false;
		}

		App::uses('File', 'Utility');

		# Escribir la configuración del nuevo Datasource en archivo config.php
		$archivoDB = new File( APP . 'Config' . DS .'database.php', true);
		$config = sprintf("
	# %s DB config
	public $%s = array(
		'datasource'	=> 'Database/Mysql',
		'persistent'	=> false,
		'host'			=> '%s',
		'login'			=> '%s',
		'password'		=> '%s',
		'database'		=> '%s',
		'prefix'		=> '%s',
		'encoding'		=> 'utf8'
	);
}", $datos['Tienda']['nombre'], $datos['Tienda']['db_configuracion'], $datos['Tienda']['host'], $datos['Tienda']['usuario_mysql'], $datos['Tienda']['pass_mysql'], $datos['Tienda']['nombre_base_de_datos'], $datos['Tienda']['prefijo']);

		if( $archivoDB->replaceText('}', $archivoDB->prepare($config)) ) {
			$archivoDB->close();
			return true;
		}else{
			return false;
		}
	}
}
