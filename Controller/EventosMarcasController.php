<?php
App::uses('AppController', 'Controller');
class EventosMarcasController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$eventosMarcas	= $this->paginate();
		$this->set(compact('eventosMarcas'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->EventosMarca->create();
			if ( $this->EventosMarca->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$eventos	= $this->EventosMarca->Evento->find('list');
		$this->set(compact('eventos'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->EventosMarca->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->EventosMarca->save($this->request->data) )
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
			$this->request->data	= $this->EventosMarca->find('first', array(
				'conditions'	=> array('EventosMarca.id' => $id)
			));
		}
		$eventos	= $this->EventosMarca->Evento->find('list');
		$this->set(compact('eventos'));
	}

	public function admin_delete($id = null)
	{
		$this->EventosMarca->id = $id;
		if ( ! $this->EventosMarca->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->EventosMarca->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->EventosMarca->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->EventosMarca->_schema);
		$modelo			= $this->EventosMarca->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
