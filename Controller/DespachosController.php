<?php
App::uses('AppController', 'Controller');
class DespachosController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$despachos	= $this->paginate();
		$this->set(compact('despachos'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Despacho->create();
			if ( $this->Despacho->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$eventos	= $this->Despacho->Evento->find('list');
		$this->set(compact('eventos'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Despacho->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Despacho->save($this->request->data) )
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
			$this->request->data	= $this->Despacho->find('first', array(
				'conditions'	=> array('Despacho.id' => $id)
			));
		}
		$eventos	= $this->Despacho->Evento->find('list');
		$this->set(compact('eventos'));
	}

	public function admin_delete($id = null)
	{
		$this->Despacho->id = $id;
		if ( ! $this->Despacho->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Despacho->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Despacho->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Despacho->_schema);
		$modelo			= $this->Despacho->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
