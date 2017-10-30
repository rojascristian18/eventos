<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
            <div class="panel panel-default tabs">
                <ul class="nav nav-tabs nav-justified">
                    <li><?= $this->Html->link('1 - Productos > Marcas <i class="fa fa-check-square" aria-hidden="true"></i>', array('action' => 'steps', $evento['Evento']['id'], 1), array('class' => 'btn btn-success', 'escape' => false)); ?></li>
                    <li><?= $this->Html->link('2 - Productos > Categorías <i class="fa fa-check-square" aria-hidden="true"></i>', array('action' => 'steps', $evento['Evento']['id'], 2), array('class' => 'btn btn-success', 'escape' => false)); ?></li>
                    <li class="active"><a>3 - Ordenar categorías</a></li>
                </ul>
                <div class="panel-body tab-content">
                    <div class="tab-pane active" id="categorias">
                    	<div class="row">
                            <div class="col-sm-12">
                                <h4>Arbol de categorias</h4>
                                <p>Arrastre las categorias para ordenar. El nível máximo de profundidad de las categorias es de 2 niveles.</p>
                                <div class="dd" id="nestable">
                                    <ol class="dd-list">
                                        <? foreach ($evento['Categoria'] as $ix => $categoria) : ?>
                                            <? if (empty($categoria['ChildCategoria']) && empty($categoria['parent_id']) ) : ?>
                                            <li class="dd-item" data-id="<?=$categoria['id'];?>"><div class="dd-handle"><?=$categoria['nombre'];?></div></li>
                                            <? elseif (empty($categoria['parent_id'])) : ?>
                                            <li class="dd-item" data-id="<?=$categoria['id'];?>"><div class="dd-handle"><?=$categoria['nombre'];?></div></li>
                                            <ol class="dd-list">
                                                <? foreach ($categoria['ChildCategoria'] as $ich => $hijo) : ?>
                                                <li class="dd-item" data-id="<?=$hijo['id'];?>"><div class="dd-handle"><?=$hijo['nombre'];?></div></li>
                                                <? endforeach; ?>
                                            </ol>
                                            <? endif; ?>
                                        <? endforeach; ?>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>	              
                </div>
                <div class="panel-footer">
                    <div class="pull-left col-xs-12 col-sm-4">
                        <?= $this->Html->link('Volver', array('action' => 'steps', $evento['Evento']['id'], 2), array('class' => 'btn btn-default')); ?>
                        <?= $this->Html->link('Volver al inicio', array('action' => 'index'), array('class' => 'btn btn-default')); ?>
                    </div>
					<div class="pull-right col-xs-12 col-sm-8 text-right">
                        <?= $this->Html->link('Publicar evento', array('action' => 'steps', $evento['Evento']['id'], 4), array('class' => 'btn btn-success')); ?>
						<?= $this->Html->link('Volver a editar el evento', array('action' => 'edit', $evento['Evento']['id']), array('class' => 'btn btn-default')); ?>
					</div>
				</div>
            </div>                                         
		</div> <!-- end col -->
	</div> <!-- end row -->
</div>