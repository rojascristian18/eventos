<div class="page-content-wrap">
    <? if (!empty($errorOut)) : ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <?=$errorOut;?> <?= $this->Html->link('Volver a editar el evento', array('action' => 'edit', $evento['Evento']['id']), array('class' => 'btn btn-primary')); ?>
            </div>
        </div>
    </div>
    <? endif; ?>
	<div class="row">
		<div class="col-xs-12">
            <div class="panel panel-default tabs">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#evento" data-toggle="tab">1 - Productos > Marcas</a></li>
                    <li><a>2 - Productos > Categorías</a></li>
                    <li><a>3 - Ordenar categorías</a></li>
                </ul>
                <div class="panel-body tab-content">
                    <div class="tab-pane active" id="evento">
                    	<div class="table-responsive">
                    		<table class="table">
                    			<thead>
                    				<tr>
                    					<th><?=__('MARCAS');?></th>
                    					<th><?=__('PRODUCTOS');?></th>
                    				</tr>
                    			</thead>
                    			<tbody>
                    				<? foreach($grupoMarcas as $ix => $marca) : ?>
                    				<tr>
                    					<td><b><?= $this->Html->image(sprintf('EventosMarca/%d/xs_mini_%s', $marca['marca_id'], $marca['marca_imagen']));?>  <?=$marca['marca_nombre'];?></b></td>
                    					<td>
                    						<ul class="list-group border-bottom">
                                                <? if (!empty($marca['productos'])) : ?>
                    							<? foreach ($marca['productos'] as $i => $producto) : ?>
                    								<li class="list-group-item"><?=$producto['referencia'];?> - <?=$producto['nombre'];?></li>
                    							<? endforeach; ?>
                                            <? else : ?>
                                                <li class="list-group-item">No existen productos relacionados para esta marca.</li>
                                            <? endif; ?>
		                                    </ul>
                    					</td>
                    				</tr>
                    				<? endforeach; ?>
                    			</tbody>
                    		</table>
                    	</div>
                    </div>	              
                </div>
                <div class="panel-footer">
                    <div class="pull-left col-xs-12 col-sm-4">
                        <?= $this->Html->link('Volver al inicio', array('action' => 'index'), array('class' => 'btn btn-default')); ?>
                    </div>
					<div class="pull-right col-xs-12 col-sm-8 text-right">
						<?= $this->Html->link('Continuar', array('action' => 'steps', $evento['Evento']['id'], 2), array('class' => 'btn btn-success')); ?>
						<?= $this->Html->link('Volver a editar el evento', array('action' => 'edit', $evento['Evento']['id']), array('class' => 'btn btn-default')); ?>
					</div>
				</div>
            </div>                                         
		</div> <!-- end col -->
	</div> <!-- end row -->
</div>