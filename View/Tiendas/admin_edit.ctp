<?= $this->Form->create('Tienda', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
<?= $this->Form->input('id'); ?>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Configuración de la tienda</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<tr>
								<th><?= $this->Form->label('nombre', 'Nombre'); ?></th>
								<td><?= $this->Form->input('nombre'); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('url', 'URL'); ?></th>
								<td><?= $this->Form->input('url'); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('principal', 'Tienda principal'); ?></th>
								<td><?= $this->Form->input('principal', array('class' => 'icheckbox')); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('tema', 'Tema de la tienda'); ?></th>
								<td><?= $this->Form->select('tema', array(
											'dark-head-light' => 'Dark Head Light',
											'dark' => 'Dark',
											'default-head-light' => 'Default Head Light',
											'default' => 'Default',
											'forest-head-light' => 'Forest Head light',
											'forest' => 'Forest',
											'light' => 'Light',
											'night-head-light' => 'Night Head Light',
											'night' => 'Night',
											'nodriza' => 'Nodriza',
											'serenity-head-light' => 'Serenity Head Light',
											'serenity' => 'Serenity'
										), array('class' => 'form-control','empty' => false)); ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('activo', 'Activo'); ?></th>
								<td><?= $this->Form->input('activo', array('class' => 'icheckbox')); ?></td>
							</tr>
							<? if ( !empty($this->request->data['Tienda']['logo']) ) : ?>
								<tr>
									<th><?= $this->Form->label('', 'Logo actual'); ?></th>
									<td><?=$this->Html->image($this->request->data['Tienda']['logo']['mini'], array('class' => 'img-responsive'));?></td>
								</tr>
								<tr>
									<th><?= $this->Form->label('logo', 'Actualiza'); ?></th>
									<td><?= $this->Form->input('logo', array('class' => '', 'type' => 'file')); ?></td>
								</tr>
							<? else : ?>
								<tr>
									<th><?= $this->Form->label('logo', 'Logo'); ?></th>
									<td><?= $this->Form->input('logo', array('class' => '', 'type' => 'file')); ?></td>
								</tr>
							<? endif; ?>
						</table>
						<div class="pull-right">
							<input type="submit" class="btn btn-primary esperar-carga" autocomplete="off" data-loading-text="Espera un momento..." value="Guardar cambios">
							<?= $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn btn-danger')); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Configuración de la base de datos</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<tr>
								<th><?= $this->Form->label('nombre_base_de_datos', 'Nombre BD'); ?></th>
								<td><?= $this->request->data['Tienda']['nombre_base_de_datos']; ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('host', 'Host'); ?></th>
								<td><?= $this->request->data['Tienda']['host']; ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('usuario_mysql', 'Usuario Mysql'); ?></th>
								<td><?= $this->request->data['Tienda']['usuario_mysql']; ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('pass_mysql', 'Contraseña Mysql'); ?></th>
								<td>************</td>
							</tr>
							<tr>
								<th><?= $this->Form->label('db_configuracion', 'Configuracion BD'); ?></th>
								<td><?= $this->request->data['Tienda']['db_configuracion']; ?></td>
							</tr>
							<tr>
								<th><?= $this->Form->label('prefijo', 'Prefijo de las tablas'); ?></th>
								<td><?= $this->request->data['Tienda']['prefijo']; ?></td>
							</tr>
							<tr>
								<td colspan="2"><p class="aviso">Para actualizar la información de la conexión a la base de datos, debe contactar al administrador.</p></td>
							</tr>
						</table>
						<div class="pull-right">
							<input type="submit" class="btn btn-primary esperar-carga" autocomplete="off" data-loading-text="Espera un momento..." value="Guardar cambios">
							<?= $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn btn-danger')); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->Form->end(); ?>
