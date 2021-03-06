<?= $this->Form->create('Pagina', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
<?= $this->Form->input('id');?>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Editar Pagina</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<tr>
								<th><?= $this->Form->label('evento_id', 'Evento'); ?></th>
								<td><?= $this->Form->input('evento_id', array('class' => 'form-control select')); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('nombre', 'Nombre'); ?></th>
								<td><?= $this->Form->input('nombre'); ?></td>
							</tr>
							<? if (!empty($this->request->data['Pagina']['imagen'])) : ?>
							<tr>
								<th><?= $this->Form->label('imagen', 'Imagen actual'); ?></th>
								<td><?=$this->Html->image($this->request->data['Pagina']['imagen']['mini']); ?></td>
							</tr>
							<? endif; ?>
							<tr>
								<th><?= $this->Form->label('imagen', 'Imagen'); ?></th>
								<td><?= $this->Form->input('imagen', array('type' => 'file', 'class' => '')); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('cuerpo', 'Cuerpo'); ?></th>
								<td><?= $this->Form->input('cuerpo', array('class' => 'summernote')); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('orden_menu', 'Orden menu'); ?></th>
								<td><?= $this->Form->input('orden_menu'); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('activo', 'Activo'); ?></th>
								<td><?= $this->Form->input('activo', array('class' => 'icheckbox')); ?></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="panel-footer">
					<div class="pull-right">
						<input type="submit" class="btn btn-primary esperar-carga" autocomplete="off" data-loading-text="Espera un momento..." value="Guardar cambios">
						<?= $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn btn-danger')); ?>
					</div>
				</div>
			</div>
		</div> <!-- end col -->
	</div> <!-- end row -->
</div>
<?= $this->Form->end(); ?>
