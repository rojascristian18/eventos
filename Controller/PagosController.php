<?php
App::uses('AppController', 'Controller');
class PagosController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$pagos	= $this->paginate();
		$this->set(compact('pagos'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Pago->create();
			if ( $this->Pago->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$eventos	= $this->Pago->Evento->find('list');
		$this->set(compact('eventos'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Pago->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Pago->save($this->request->data) )
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
			$this->request->data	= $this->Pago->find('first', array(
				'conditions'	=> array('Pago.id' => $id)
			));
		}
		$eventos	= $this->Pago->Evento->find('list');
		$this->set(compact('eventos'));
	}

	public function admin_delete($id = null)
	{
		$this->Pago->id = $id;
		if ( ! $this->Pago->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Pago->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Pago->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Pago->_schema);
		$modelo			= $this->Pago->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
