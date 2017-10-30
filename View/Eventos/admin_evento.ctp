<?= $this->Form->create('Evento', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
<?= $this->Form->input('id'); ?>
<?= $this->Form->input('tienda_id', array('type' => 'hidden', 'value' => $this->Session->read('Tienda.id'))); ?>
<div class="page-content-wrap">
	<div class="row">
		<div class="col-xs-12">
            <div class="panel panel-default tabs">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#evento" data-toggle="tab">Evento</a></li>
                    <li><a href="#pagos" data-toggle="tab">Opc. de pago</a></li>
                    <li><a href="#despachos" data-toggle="tab">Opc. de despacho</a></li>
                    <li><a href="#marcas" data-toggle="tab">Marcas</a></li>
                    <li><a href="#categorias" data-toggle="tab">Categorías</a></li>
                    <li><a href="#productos" data-toggle="tab">Productos</a></li>
                </ul>
                <div class="panel-body tab-content">
                    <div class="tab-pane active" id="evento">
                    	<div class="col-xs-12">
                    		<h3 class="subtitulo-tabs">Evento</h3>
                    	</div>
                    	<div class="form-group">
	                    	<div class="col-xs-12 col-sm-4">
	                    		<label><?= $this->Form->label('subdomino', 'Subdomino del evento'); ?></label>
	                    		<?= $this->Form->input('subdomino', array('placeholder' => 'Ej: cyberday, cybermonday')); ?>
	                    	</div>
	                    	<div class="col-xs-12 col-sm-4">
	                    		<label><?= $this->Form->label('nombre', 'Nombre del evento'); ?></label>
	                    		<?= $this->Form->input('nombre', array('placeholder' => 'Ej: Cyberday 2017')); ?>
	                    	</div>
	                    	<div class="col-xs-12 col-sm-4">
	                    		<label><?= $this->Form->label('sub_titulo', 'Título home'); ?></label>
	                    		<?= $this->Form->input('sub_titulo', array('placeholder' => 'Ej: Bienvenidos a Cyberday 2017')); ?>
	                    	</div>
	                    </div>
	                   	<div class="form-group">
	                    	<div class="col-xs-12 col-sm-4">
	                    		<label><?= $this->Form->label('logo', 'Logo del evento'); ?></label>
	                    		<?= $this->Form->input('logo', array('type' => 'file', 'class' => '')); ?>
	                    	</div>
	                    	<div class="col-xs-12 col-sm-4">
	                    		<label><?= $this->Form->label('fono', 'Fono de contacto'); ?></label>
	                    		<?= $this->Form->input('fono', array('class' => 'mask_phone form-control', 'placeholder' => '9 9999 9999')); ?>
	                    	</div>
	                    	<div class="col-xs-12 col-sm-4">
	                    		<label><?= $this->Form->label('email', 'Email de contacto'); ?></label>
	                    		<?= $this->Form->input('email', array('class' => 'mask_email form-control', 'placeholder' => 'contacto@evento.com')); ?>
	                    	</div>
	                    </div>
	                    <div class="form-group">
	                    	<div class="colxs-12 col-sm-12">
	                    		<div class="form-group">
	                    			<label><?= $this->Form->label('descripcion', 'Texto para el home'); ?></label>
	                    			<?= $this->Form->input('descripcion', array('placeholder' => 'Ingrese texto para agregar a la página incicio del evento')); ?>
	                    		</div>
	                    	</div>
	                    </div>
	                    <div class="col-xs-12">
                    		<h3 class="subtitulo-tabs">Fechas del evento e inactividad</h3>
                    	</div>
	                    <div class="form-group">
	                    	<div class="col-xs-12 col-sm-6">
	                    		<label><?= $this->Form->label('fecha_inicio', 'Fecha inicio del evento'); ?></label>
	                    		<?= $this->Form->input('fecha_inicio', array('type' => 'text', 'class' => 'datetimepicker form-control')); ?>
	                    	</div>
	                    	<div class="col-xs-12 col-sm-6">
	                    		<label><?= $this->Form->label('fecha_final', 'Fecha final del evento'); ?></label>
	                    		<?= $this->Form->input('fecha_final', array('type' => 'text', 'class' => 'datetimepicker form-control')); ?>
	                    	</div>
	                    </div>
	                    <div class="form-group">
	                    	<div class="col-xs-12 col-sm-12">
	                    		<label><?= $this->Form->label('imagen_inactivo', 'Imagen para la inactividad del evento'); ?></label>
	                    		<?= $this->Form->input('imagen_inactivo', array('type' => 'file', 'class' => '')); ?>
	                    	</div>
	                    </div>
	                    <div class="col-xs-12">
                    		<h3 class="subtitulo-tabs">Opciones de productos</h3>
                    	</div>
                		<div class="form-group">
	                    	<div class="col-xs-12 col-sm-6">
	                    		<label><?= $this->Form->label('mostrar_cuotas', 'Mostrar cuotas'); ?></label><br>
	                    		<label class="switch">
                                   	<?= $this->Form->input('mostrar_cuotas', array('class' => 'icheckbox')); ?>
                                    <span></span>
                                </label>
	                    		
	                    	</div>
	                    	<div class="col-xs-12 col-sm-6">
	                    		<label><?= $this->Form->label('cantidad_cuotas', 'Cantidad cuotas a mostrar'); ?></label>
	                    		<?= $this->Form->input('cantidad_cuotas', array('class' => 'form-control spinner_default')); ?>
	                    	</div>
	                    </div>
	                    <div class="form-group">
	                    	<div class="col-xs-12">
	                    		<label><?= $this->Form->label('informacion_adicional_productos', 'Información adicional'); ?></label>
	                    		<?= $this->Form->input('informacion_adicional_productos', array('placeholder' => 'Agregue información adicional')); ?>
	                    	</div>
	                    </div>
	            		<div class="col-xs-12">
                    		<h3 class="subtitulo-tabs">Opciones adicionales</h3>
                    	</div>
                    	<div class="form-group">
	                    	<div class="col-xs-12 col-sm-12">
	                    		<label><?= $this->Form->label('activo', 'Activar el evento'); ?></label><br>
	                    		<label class="switch">
                                   	<?= $this->Form->input('activo', array('class' => 'icheckbox', 'value' => 1)); ?>
                                    <span></span>
                                </label>
	                    	</div>
	                    </div>
	                   	<div class="form-group">
	                    	<div class="col-xs-12 col-sm-6">
	                    		<label><?= $this->Form->label('css_adicional', 'CSS adicional'); ?></label>
	                    		<?= $this->Form->input('css_adicional', array('placeholder' => '.class {color: #fff}')); ?>
	                    	</div>
	                    	<div class="col-xs-12 col-sm-6">
	                    		<label><?= $this->Form->label('js_adicional', 'JS adicional'); ?></label>
	                    		<?= $this->Form->input('js_adicional', array('placeholder' => 'var foo = "value"')); ?>
	                    	</div>
	                    </div>
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