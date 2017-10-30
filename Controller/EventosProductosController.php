<?php
App::uses('AppController', 'Controller');
class EventosProductosController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$eventosProductos	= $this->paginate();
		$this->set(compact('eventosProductos'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->EventosProducto->create();
			if ( $this->EventosProducto->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$eventos	= $this->EventosProducto->Evento->find('list');
		$this->set(compact('eventos'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->EventosProducto->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->EventosProducto->save($this->request->data) )
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
			$this->request->data	= $this->EventosProducto->find('first', array(
				'conditions'	=> array('EventosProducto.id' => $id)
			));
		}
		$eventos	= $this->EventosProducto->Evento->find('list');
		$this->set(compact('eventos'));
	}

	public function admin_delete($id = null)
	{
		$this->EventosProducto->id = $id;
		if ( ! $this->EventosProducto->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->EventosProducto->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->EventosProducto->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->EventosProducto->_schema);
		$modelo			= $this->EventosProducto->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
