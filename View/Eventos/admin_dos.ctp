<?= $this->Form->create('Evento', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
            <div class="panel panel-default tabs">
                <ul class="nav nav-tabs nav-justified">
                    <li><?= $this->Html->link('1 - Productos > Marcas <i class="fa fa-check-square" aria-hidden="true"></i>', array('action' => 'steps', $evento['Evento']['id'], 1), array('class' => 'btn btn-success', 'escape' => false)); ?></li>
                    <li class="active"><a>2 - Productos > Categorías</a></li>
                    <li><a>3 - Ordenar categorías</a></li>
                </ul>
                <div class="panel-body tab-content">
                    <div class="tab-pane active" id="categorias">
                    	<div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><?=__('PRODUCTOS');?></th>
                                        <th><?=__('CATEGORIAS');?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <? foreach ($evento['Producto'] as $i => $producto) : ?>
                                    <tr>
                                        <td><b><?=$this->Form->hidden(sprintf('%d.Producto.id_product', $i), array('value' => $producto['Producto']['id_product']) ); ?><?=$producto['Producto']['id_product']?>-<?=$producto['Idioma'][0]['ProductosIdioma']['name'];?></b></td>
                                        <td>
                                            <select name="<?=sprintf('data[Evento][%d][Categoria][]', $i);?>" class="form-control select select-productos pull-right" data-live-search="true"  multiple="multiple">
                                            <? foreach($evento['Categoria'] as $ix => $categoria) : ?>
                                                    <option value="<?=$categoria['id'];?>">
                                                    <?=$categoria['nombre'];?></option>
                                            <? endforeach; ?>
                                            </select>
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
                        <?= $this->Html->link('Volver', array('action' => 'steps', $evento['Evento']['id'], 1), array('class' => 'btn btn-default')); ?>
                        <?= $this->Html->link('Volver al inicio', array('action' => 'index'), array('class' => 'btn btn-default')); ?>
                    </div>
					<div class="pull-right col-xs-12 col-sm-8 text-right">
                        <button class="btn btn-success" type="submit">Continuar</button>
						<?= $this->Html->link('Volver a editar el evento', array('action' => 'edit', $evento['Evento']['id']), array('class' => 'btn btn-default')); ?>
					</div>
				</div>
            </div>                                         
		</div> <!-- end col -->
	</div> <!-- end row -->
</div>
<?= $this->Form->end(); ?>

<? foreach($evento['Producto'] as $ix => $producto) : ?>
<script type="text/javascript">
    var arr = [];

    <? foreach ($evento['Categoria'] as $i => $categoria) : ?>
        <? if ( !empty($producto['Categoria']) && in_array($categoria['id'] , Hash::extract($producto['Categoria'], '{n}.id') ) ) : ?>
        arr.push(<?=$categoria['id'];?>);
        <? endif; ?>
    <? endforeach; ?>
    console.log(arr);
    $('select[name="data[Evento][<?=$ix;?>][Categoria][]"]').val(arr);

</script>
<? endforeach; ?>