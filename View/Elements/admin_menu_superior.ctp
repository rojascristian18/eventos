<ul class="x-navigation x-navigation-horizontal x-navigation-panel">
	<li class="xn-icon-button">
		<a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
	</li>
	<li class="xn-search">
    <?= $this->Form->create('Tienda', array('class' => 'form-inline', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
	    <div class="form-group">
	    	<?= $this->Form->select('tienda', $tiendasList, array('class' => 'form-control js-tienda', 'empty' => false)); ?>
	    </div>
    <?= $this->Form->end(); ?>
    </li>
	<li class="pull-right">
		<a href="#" class="mb-control" data-box="#mb-signout"><i class="fa fa-sign-out"></i> Cerrar sesión</a>
	</li>
	<li class="pull-right">
		<a href="#" data-toggle="modal" data-target="#modal_cache" id="clear_cache"><i class="fa fa-trash"></i> Limpiar caché</a>
	</li>
</ul>

<? if ($this->Session->check('Tienda')) : ?>
	<script type="text/javascript">
		$('.js-tienda').val(<?=$this->Session->read('Tienda.id')?>);

		$('.js-tienda').on('change', function(){
			$(this).parents('form').eq(0).submit();
		});
	</script>
<? endif; ?>

<div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
	<div class="mb-container">
		<div class="mb-middle">
			<div class="mb-title"><span class="fa fa-sign-out"></span>¿Cerrar <strong>sesión</strong>?</div>
			<div class="mb-content">
				<p>¿Seguro que quieres cerrar sesión?</p>
				<p>Presiona NO para continuar trabajando y SI para cerrar sesión.</p>
			</div>
			<div class="mb-footer">
				<div class="pull-right">
					<?= $this->Html->link('Si', array('controller' => 'administradores', 'action' => 'logout'), array('class' => 'btn btn-success btn-lg')); ?>
					<button class="btn btn-default btn-lg mb-control-close">No</button>
				</div>
			</div>
		</div>
	</div>
</div>


<!--<div class="modal" id="modal_cache" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="defModalHead">Basic Modal</h4>
            </div>
            <div class="modal-body">
                Some content in modal example
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
-->