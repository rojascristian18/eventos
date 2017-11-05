<?php
App::uses('AppController', 'Controller');
class CategoriasController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$categorias	= $this->paginate();
		$this->set(compact('categorias'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Categoria->create();
			if ( $this->Categoria->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$eventos	= $this->Categoria->Evento->find('list');
		$parentCategorias	= $this->Categoria->ParentCategoria->find('list');
		$this->set(compact('eventos', 'parentCategorias'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Categoria->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Categoria->save($this->request->data) )
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
			$this->request->data	= $this->Categoria->find('first', array(
				'conditions'	=> array('Categoria.id' => $id)
			));
		}
		$eventos	= $this->Categoria->Evento->find('list');
		$parentCategorias	= $this->Categoria->ParentCategoria->find('list');
		$this->set(compact('eventos', 'parentCategorias'));
	}

	public function admin_delete($id = null)
	{
		$this->Categoria->id = $id;
		if ( ! $this->Categoria->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Categoria->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Categoria->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Categoria->_schema);
		$modelo			= $this->Categoria->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}


	public function actualizar_orden_categorias($data = '')
	{
		if ( $this->request->is('post') )
		{	
			$json = json_decode($this->request->data, true);
			$output = 'ok';
			if (!empty($json)) {
				foreach ($json as $indice => $valor) {
					$arr = array();
					$arr['Categoria']['id'] = $valor['id'];
					$arr['Categoria']['parent_id'] = null;
					$arr['Categoria']['orden'] = $indice;
					if (isset($valor['children'])) {
					 	foreach ($valor['children'] as $i => $hijo) {
					 		$arr['ChildCategoria'][$i]['id'] = $hijo['id'];
					 		$arr['ChildCategoria'][$i]['parent_id'] = $valor['id'];
					 		$arr['ChildCategoria'][$i]['orden'] = $i;
					 	}
					}

					if(!$this->Categoria->saveAll($arr)) {
						$output = 'error';
					}
				}
			}
			echo $output;
			exit;
		}
	}



	public function view()
	{
		if (empty($this->request->query['c'])) {
			$this->redirect(array('controller' => 'eventos', 'action' => 'index'));
		}
		
		$this->cambiarDatasource(array('Producto', 'Fabricante', 'Idioma', 'ProductosIdioma', 'ReglaImpuesto', 'GrupoReglaImpuesto', 'Impuesto', 'PrecioEspecifico', 'Imagen'), $this->Session->read('Todo.Tienda.db_configuracion'));

		$categoria = $this->Categoria->find('first', array(
			'conditions' => array(
				'Categoria.nombre_corto' => strtolower($this->request->query['c']),
				'Categoria.activo' => 1
				),
			'contain' => array('ParentCategoria', 'Producto')
		));

		if (empty($categoria)) {
			$this->redirect(array('controller' => 'eventos', 'action' => 'index'));
		}

		BreadcrumbComponent::add($this->Session->read('Todo.Evento.nombre'), '/');
		if (!empty($categoria['Categoria']['parent_id'])) {
			BreadcrumbComponent::add($categoria['ParentCategoria']['nombre'], '?c'. $categoria['ParentCategoria']['nombre_corto'] );
		}
		BreadcrumbComponent::add($categoria['Categoria']['nombre']);
		
		$this->set(compact('categoria'));
		$this->render(sprintf('%s/view', $this->Session->read('Todo.Evento.nombre_tema')));

	}
}
