<div class="page-title">
	<h2><span class="fa fa-list"></span> Categorias</h2>
</div>
<?= $this->Form->create('Categoria', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Nuevo Categoria</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
																				<tr>
												<th><?= $this->Form->label('evento_id', 'Evento'); ?></th>
												<td><?= $this->Form->input('evento_id'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('parent_id', 'Categoria padre'); ?></th>
												<td><?= $this->Form->input('parent_id'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('nombre', 'Nombre'); ?></th>
												<td><?= $this->Form->input('nombre'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('nombre_corto', 'Nombre corto'); ?></th>
												<td><?= $this->Form->input('nombre_corto'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('cuerpo', 'Cuerpo'); ?></th>
												<td><?= $this->Form->input('cuerpo'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('imagen_principal', 'Imagen principal'); ?></th>
												<td><?= $this->Form->input('imagen_principal'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('icono_imagen', 'Icono imagen'); ?></th>
												<td><?= $this->Form->input('icono_imagen'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('icono_texto', 'Icono texto'); ?></th>
												<td><?= $this->Form->input('icono_texto'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('orden', 'Orden'); ?></th>
												<td><?= $this->Form->input('orden'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('seo_titulo', 'Seo titulo'); ?></th>
												<td><?= $this->Form->input('seo_titulo'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('seo_descripcion', 'Seo descripcion'); ?></th>
												<td><?= $this->Form->input('seo_descripcion'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('seo_palabras_claves', 'Seo palabras claves'); ?></th>
												<td><?= $this->Form->input('seo_palabras_claves'); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('activo', 'Activo'); ?></th>
												<td><?= $this->Form->input('activo', array('class' => 'icheckbox')); ?></td>
											</tr>
																				<tr>
												<th><?= $this->Form->label('contador_productos', 'Contador productos'); ?></th>
												<td><?= $this->Form->input('contador_productos'); ?></td>
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
