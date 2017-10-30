<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="page-content-wrap">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Listado de Modulos</h3>
						<div class="btn-group pull-right">
						<? if ($permisos['agregar']) : ?>
							<?= $this->Html->link('<i class="fa fa-plus"></i> Nuevo Modulo', array('action' => 'add'), array('class' => 'btn btn-success', 'escape' => false)); ?>
						<? endif; ?>
						<? if ($permisos['exportar']) : ?>
							<?= $this->Html->link('<i class="fa fa-file-excel-o"></i> Exportar a Excel', array('action' => 'exportar'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
						<? endif; ?>
						</div>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr class="sort">
										<th><?= $this->Paginator->sort('parent_id', 'Modulo padre', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
										<th><?= $this->Paginator->sort('nombre', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
										<th><?= $this->Paginator->sort('url', 'URL', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
										<th><?= $this->Paginator->sort('icono', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
										<th><?= $this->Paginator->sort('activo', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ( $modulos as $modulo ) : ?>
									<tr>
										<td><?= $this->Html->link($modulo['ParentModulo']['nombre'], array('controller' => 'modulos', 'action' => 'edit', $modulo['ParentModulo']['id'])); ?></td>
										<td><?= h($modulo['Modulo']['nombre']); ?>&nbsp;</td>
										<td><?= h($modulo['Modulo']['url']); ?>&nbsp;</td>
										<td><?= h($modulo['Modulo']['icono']); ?>&nbsp;</td>
										<td><?= ($modulo['Modulo']['activo'] ? '<i class="fa fa-check"></i>' : '<i class="fa fa-remove"></i>'); ?>&nbsp;</td>
										<td>
											<? if ($permisos['editar']) : ?>
											<?= $this->Html->link('<i class="fa fa-edit"></i> Editar', array('action' => 'edit', $modulo['Modulo']['id']), array('class' => 'btn btn-xs btn-info', 'rel' => 'tooltip', 'title' => 'Editar este registro', 'escape' => false)); ?>
										<? endif; ?>
										<? if ($permisos['eliminar']) : ?>
											<?= $this->Form->postLink('<i class="fa fa-remove"></i> Eliminar', array('action' => 'delete', $modulo['Modulo']['id']), array('class' => 'btn btn-xs btn-danger confirmar-eliminacion', 'rel' => 'tooltip', 'title' => 'Eliminar este registro', 'escape' => false)); ?>
										<? endif; ?>
										<? if ($permisos['activar']) : ?>
											<? if ($modulo['Modulo']['activo']) : ?>
												<?= $this->Form->postLink('<i class="fa fa-eye-slash"></i> Desactivar', array('action' => 'desactivar', $modulo['Modulo']['id']), array('class' => 'btn btn-xs btn-primary confirmar-eliminacion', 'rel' => 'tooltip', 'title' => 'Desactivar este registro', 'escape' => false)); ?>
											<? else : ?>
												<?= $this->Form->postLink('<i class="fa fa-eye"></i> Activar', array('action' => 'activar', $modulo['Modulo']['id']), array('class' => 'btn btn-xs btn-success confirmar-eliminacion', 'rel' => 'tooltip', 'title' => 'Activar este registro', 'escape' => false)); ?>
											<? endif; ?>
										<? endif; ?>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="pull-right">
				<ul class="pagination">
					<?= $this->Paginator->prev('« Anterior', array('tag' => 'li'), null, array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'first disabled hidden')); ?>
					<?= $this->Paginator->numbers(array('tag' => 'li', 'currentTag' => 'a', 'modulus' => 2, 'currentClass' => 'active', 'separator' => '')); ?>
					<?= $this->Paginator->next('Siguiente »', array('tag' => 'li'), null, array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'last disabled hidden')); ?>
				</ul>
			</div>
		</div>
	</div>
</div>