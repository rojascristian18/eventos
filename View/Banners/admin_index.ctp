<div class="page-title">
	<h2><span class="fa fa-list"></span> Banners</h2>
</div>

<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Listado de Banners</h3>
					<div class="btn-group pull-right">
						<?= $this->Html->link('<i class="fa fa-plus"></i> Nuevo Banner', array('action' => 'add'), array('class' => 'btn btn-success', 'escape' => false)); ?>
						<?= $this->Html->link('<i class="fa fa-file-excel-o"></i> Exportar a Excel', array('action' => 'exportar'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
					</div>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr class="sort">
													<th><?= $this->Paginator->sort('evento_id', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
															<th><?= $this->Paginator->sort('imagen', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
															<th><?= $this->Paginator->sort('titulo', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
															<th><?= $this->Paginator->sort('url', 'URL', array('title' => 'Haz click para ordenar por este criterio')); ?></th>
															<th><?= $this->Paginator->sort('orden', null, array('title' => 'Haz click para ordenar por este criterio')); ?></th>
													<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ( $banners as $banner ) : ?>
								<tr>
											<td><?= $this->Html->link($banner['Evento']['nombre'], array('controller' => 'eventos', 'action' => 'edit', $banner['Evento']['id'])); ?></td>
													<td><?= h($banner['Banner']['imagen']); ?>&nbsp;</td>
													<td><?= h($banner['Banner']['titulo']); ?>&nbsp;</td>
													<td><?= h($banner['Banner']['url']); ?>&nbsp;</td>
													<td><?= h($banner['Banner']['orden']); ?>&nbsp;</td>
											<td>
										<?= $this->Html->link('<i class="fa fa-edit"></i> Editar', array('action' => 'edit', $banner['Banner']['id']), array('class' => 'btn btn-xs btn-info', 'rel' => 'tooltip', 'title' => 'Editar este registro', 'escape' => false)); ?>
										<?= $this->Form->postLink('<i class="fa fa-remove"></i> Eliminar', array('action' => 'delete', $banner['Banner']['id']), array('class' => 'btn btn-xs btn-danger confirmar-eliminacion', 'rel' => 'tooltip', 'title' => 'Eliminar este registro', 'escape' => false)); ?>
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
