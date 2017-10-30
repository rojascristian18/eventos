<?php
App::uses('AppController', 'Controller');
class BannersController extends AppController
{
	public function admin_index()
	{
		$this->paginate		= array(
			'recursive'			=> 0
		);
		$banners	= $this->paginate();
		$this->set(compact('banners'));
	}

	public function admin_add()
	{
		if ( $this->request->is('post') )
		{
			$this->Banner->create();
			if ( $this->Banner->save($this->request->data) )
			{
				$this->Session->setFlash('Registro agregado correctamente.', null, array(), 'success');
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash('Error al guardar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
			}
		}
		$eventos	= $this->Banner->Evento->find('list');
		$this->set(compact('eventos'));
	}

	public function admin_edit($id = null)
	{
		if ( ! $this->Banner->exists($id) )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		if ( $this->request->is('post') || $this->request->is('put') )
		{
			if ( $this->Banner->save($this->request->data) )
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
			$this->request->data	= $this->Banner->find('first', array(
				'conditions'	=> array('Banner.id' => $id)
			));
		}
		$eventos	= $this->Banner->Evento->find('list');
		$this->set(compact('eventos'));
	}

	public function admin_delete($id = null)
	{
		$this->Banner->id = $id;
		if ( ! $this->Banner->exists() )
		{
			$this->Session->setFlash('Registro inválido.', null, array(), 'danger');
			$this->redirect(array('action' => 'index'));
		}

		$this->request->onlyAllow('post', 'delete');
		if ( $this->Banner->delete() )
		{
			$this->Session->setFlash('Registro eliminado correctamente.', null, array(), 'success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Error al eliminar el registro. Por favor intenta nuevamente.', null, array(), 'danger');
		$this->redirect(array('action' => 'index'));
	}

	public function admin_exportar()
	{
		$datos			= $this->Banner->find('all', array(
			'recursive'				=> -1
		));
		$campos			= array_keys($this->Banner->_schema);
		$modelo			= $this->Banner->alias;

		$this->set(compact('datos', 'campos', 'modelo'));
	}
}
