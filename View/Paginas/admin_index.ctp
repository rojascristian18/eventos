<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Listado de Paginas</h3>
					<div class="btn-group pull-right">
						<? if ($permisos['agregar']) : ?>
						<?= $this->Html->link('<i class="fa fa-plus"></i> Nueva Pagina', array('action' => 'add'), array('class' => 'btn btn-success', 'escape' => false)); ?>
						<? endif; ?>
						<?= $this->Html->link('<i class="fa fa-file-excel-o"></i> Exportar a Excel', array('action' => 'exportar'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
					</div>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr class="sort">
									<th><?= $this->Paginator->sort('evento_id', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('nombre', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('slug', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th><?= $this->Paginator->sort('activo', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ( $paginas as $pagina ) : ?>
								<tr>
									<td><?= $this->Html->link($pagina['Evento']['nombre'], array('controller' => 'eventos', 'action' => 'edit', $pagina['Evento']['id'])); ?></td>
									<td><?= h($pagina['Pagina']['nombre']); ?>&nbsp;</td>
									<td><?= h($pagina['Pagina']['slug']); ?>&nbsp;</td>
									<td><?= ($pagina['Pagina']['activo'] ? '<i class="fa fa-check"></i>' : '<i class="fa fa-remove"></i>'); ?>&nbsp;</td>
									<td>

									<? if ($permisos['editar']) : ?>
									<?= $this->Html->link('<i class="fa fa-edit"></i> Editar', array('action' => 'edit', $pagina['Pagina']['id']), array('class' => 'btn btn-xs btn-info', 'rel' => 'tooltip', 'title' => 'Editar este registro', 'escape' => false)); ?>
									<? endif; ?>
									<? if ($permisos['activar']) : ?>
										<? if ($pagina['Pagina']['activo']) : ?>
											<?= $this->Html->link('<i class="fa fa-eye-slash"></i> Desactivar', array('action' => 'desactivar', $pagina['Pagina']['id']), array('class' => 'btn btn-xs btn-warning', 'rel' => 'tooltip', 'title' => 'Editar este registro', 'escape' => false)); ?>
										<? else : ?>
											<?= $this->Html->link('<i class="fa fa-eye"></i> Activar', array('action' => 'activar', $pagina['Pagina']['id']), array('class' => 'btn btn-xs btn-success', 'rel' => 'tooltip', 'title' => 'Editar este registro', 'escape' => false)); ?>
										<? endif; ?>
									<? endif; ?>
									<? if ($permisos['eliminar']) : ?>
									<?= $this->Form->postLink('<i class="fa fa-remove"></i> Eliminar', array('action' => 'delete', $pagina['Pagina']['id']), array('class' => 'btn btn-xs btn-danger confirmar-eliminacion', 'rel' => 'tooltip', 'title' => 'Eliminar este registro', 'escape' => false)); ?>
									<? endif; ?>
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
