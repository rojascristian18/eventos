<?= $this->Form->create('Administrador', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Editar Administrador</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
						<?= $this->Form->input('id'); ?>
							<tr>
								<th><?= $this->Form->label('rol_id', 'Rol'); ?></th>
								<td><?= $this->Form->input('rol_id'); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('nombre', 'Nombre'); ?></th>
								<td><?= $this->Form->input('nombre'); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('apellidos', 'Apellidos'); ?></th>
								<td><?= $this->Form->input('apellidos'); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('email', 'Email'); ?></th>
								<td><?= $this->Form->input('email'); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('clave', 'Clave'); ?></th>
								<td><?= $this->Form->input('clave', array('type' => 'password', 'autocomplete' => 'off', 'value' => '')); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('repetir_clave', 'Repetir clave'); ?></th>
								<td><?= $this->Form->input('repetir_clave', array('type' => 'password', 'autocomplete' => 'off', 'value' => '')); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('codigopais_id', 'Codigo fono'); ?></th>
								<td><div class="input-group">
                                    <span class="input-group-addon">+</span>
                                    <?= $this->Form->select('codigopais_id', $codigopaises, array('class' => 'form-control', 'empty' => 'Seleccione código de pais')); ?>
                                </div></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('fono', 'Fono'); ?></th>
								<td><?= $this->Form->input('fono'); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('imagen', 'Imagen'); ?></th>
								<td><?= $this->Form->input('imagen', array('type' => 'file', 'class' => '')); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('count_tareas', 'Count tareas'); ?></th>
								<td><?= $this->Form->input('count_tareas'); ?></td>
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
