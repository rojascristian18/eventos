<?php
App::uses('AppController', 'Controller');
class CategoriasProductosController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$categoriasProductos	= $this->paginate();
		$this->set(compact('categoriasProductos'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->CategoriasProducto->create();
			if ( $this->CategoriasProducto->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$categorias	= $this->CategoriasProducto->Categoria->find('list');
		$this->set(compact('categorias'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->CategoriasProducto->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->CategoriasProducto->save($this->request->data) )
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
			$this->request->data	= $this->CategoriasProducto->find('first', array(
				'conditions'	=> array('CategoriasProducto.id' => $id)
			));
		}
		$categorias	= $this->CategoriasProducto->Categoria->find('list');
		$this->set(compact('categorias'));
	}

	public function admin_delete($id = null)
	{
		$this->CategoriasProducto->id = $id;
		if ( ! $this->CategoriasProducto->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->CategoriasProducto->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->CategoriasProducto->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->CategoriasProducto->_schema);
		$modelo			= $this->CategoriasProducto->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
