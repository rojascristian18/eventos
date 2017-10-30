<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Listado de Eventos</h3>
					<div class="btn-group pull-right">
						<?= $this->Html->link('<i class="fa fa-plus"></i> Nuevo Evento', array('action' => 'add'), array('class' => 'btn btn-success', 'escape' => false)); ?>
						<?= $this->Html->link('<i class="fa fa-file-excel-o"></i> Exportar a Excel', array('action' => 'exportar'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
					</div>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr class="sort">
									<th><?= $this->Paginator->sort('subdomino', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('nombre', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('tienda', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('fecha_inicio', 'Inicio', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('fecha_final', 'Término', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('activo', 'Activo', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ( $eventos as $evento ) : ?>
								<tr>
									<td><?= h($evento['Evento']['subdomino']); ?>&nbsp;</td>
									<td><?= h($evento['Evento']['nombre']); ?>&nbsp;</td>
									<td><?= h($evento['Tienda']['nombre']); ?>&nbsp;</td>
									<td><?= h($evento['Evento']['fecha_inicio']); ?>&nbsp;</td>
									<td><?= h($evento['Evento']['fecha_final']); ?>&nbsp;</td>
									<td><?= ($evento['Evento']['activo'] ? '<i class="fa fa-check"></i>' : '<i class="fa fa-remove"></i>'); ?>&nbsp;</td>
									<td>
										<div class="btn-group">
                                            <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="true">Acciones <span class="caret"></span></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <? if ($permisos['editar']) : ?>
												<? if( !empty($evento['Categoria']) && !empty($evento['EventosMarca']) && !empty(Hash::extract($evento['EventosMarca'], '{n}.MarcasFabricante')) && !empty($evento['Producto']) ) : ?>
													<li><?= $this->Html->link('<i class="fa fa-cog"></i> Configurar', array('action' => 'steps', $evento['Evento']['id'], 1), array('class' => '', 'rel' => 'tooltip', 'title' => 'Editar este registro', 'escape' => false)); ?></li>
												<? endif; ?>
													<li><?= $this->Html->link('<i class="fa fa-edit"></i> Editar', array('action' => 'edit', $evento['Evento']['id']), array('class' => '', 'rel' => 'tooltip', 'title' => 'Editar este registro', 'escape' => false)); ?></li>
												<? endif; ?>
												<? if ($permisos['eliminar']) : ?>
													<li><?= $this->Form->postLink('<i class="fa fa-remove"></i> Eliminar', array('action' => 'delete', $evento['Evento']['id']), array('class' => '', 'rel' => 'tooltip', 'title' => 'Eliminar este registro', 'escape' => false)); ?><li>
												<? endif; ?>
												<? if ($permisos['activar']) : ?>
													<? if ($evento['Evento']['activo']) : ?>
														<li><?= $this->Form->postLink('<i class="fa fa-eye-slash"></i> Desactivar', array('action' => 'desactivar', $evento['Evento']['id']), array('class' => '', 'rel' => 'tooltip', 'title' => 'Desactivar este registro', 'escape' => false)); ?></li>
														<li><?= $this->Html->link('<i class="fa fa-eye"></i> Ver landing', array('action' => 'index', $evento['Evento']['id'], 'admin' => false), array('class' => '', 'rel' => 'tooltip', 'title' => 'Editar este registro', 'escape' => false)); ?></li>
													<? else : ?>
														<li><?= $this->Form->postLink('<i class="fa fa-eye"></i> Activar', array('action' => 'activar', $evento['Evento']['id']), array('class' => '', 'rel' => 'tooltip', 'title' => 'Activar este registro', 'escape' => false)); ?></li>
													<? endif; ?>
												<? endif; ?>                                                 
                                            </ul>
                                        </div>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div> <!-- end col -->
	</div> <!-- end row -->
	<div class="row">
		<div class="col-xs-12">
			<div class="pull-right">
				<ul class="pagination">
					<?= $this->Paginator->prev('« Anterior', array('tag' => 'li'), null, array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'first disabled hidden')); ?>
					<?= $this->Paginator->numbers(array('tag' => 'li', 'currentTag' => 'a', 'modulus' => 2, 'currentClass' => 'active', 'separator' => '')); ?>
					<?= $this->Paginator->next('Siguiente »', array('tag' => 'li'), null, array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'last disabled hidden')); ?>
				</ul>
			</div>
		</div> <!-- end col -->
	</div> <!-- end row -->
</div>
