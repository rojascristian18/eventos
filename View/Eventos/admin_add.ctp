<?= $this->Form->create('Evento', array('class' => 'form-horizontal', 'type' => 'file', 'inputDefaults' => array('label' => false, 'div' => false, 'class' => 'form-control'))); ?>
<?= $this->Form->input('tienda_id', array('type' => 'hidden', 'value' => $this->Session->read('Tienda.id'))); ?>
<?= $this->Form->input('ElementosEliminadosMarcas', array('type' => 'hidden', 'id' => 'ElementosEliminadosMarcas')); ?>
<?= $this->Form->input('ElementosEliminadosCategorias', array('type' => 'hidden', 'id' => 'ElementosEliminadosCategorias')); ?>
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
	                    	<div class="col-xs-12 col-sm-3">
	                    		<label><?= $this->Form->label('subdomino', 'Subdomino del evento'); ?></label>
	                    		<?= $this->Form->input('subdomino', array('placeholder' => 'Ej: cyberday, cybermonday')); ?>
	                    	</div>
	                    	<div class="col-xs-12 col-sm-3">
	                    		<label><?= $this->Form->label('nombre_tema', 'Carpeta del tema'); ?></label>
	                    		<?= $this->Form->input('nombre_tema', array('placeholder' => 'Ej: cyberday, cybermonday')); ?>
	                    	</div>
	                    	<div class="col-xs-12 col-sm-3">
	                    		<label><?= $this->Form->label('nombre', 'Nombre del evento'); ?></label>
	                    		<?= $this->Form->input('nombre', array('placeholder' => 'Ej: Cyberday 2017')); ?>
	                    	</div>
	                    	<div class="col-xs-12 col-sm-3">
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
	                    		<label><?= $this->Form->label('favicon', 'Favicon del evento'); ?></label>
	                    		<?= $this->Form->input('favicon', array('type' => 'file', 'class' => '')); ?>
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
	                    	<div class="col-xs-12 col-sm-4">
	                    		<label><?= $this->Form->label('host_imagenes', 'URL host de imágenes'); ?></label>
	                    		<?= $this->Form->input('host_imagenes', array('placeholder' => 'Ingrese el host de la bdega de imágenes')); ?>
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
                    <div class="tab-pane" id="pagos">
                    	<div class="col-xs-12">
                    		<span class="label label-default label-form">Agregue un listado de medios de pagos que aceptará en el evento. Puede agregar una descripción u condición de éste.</span>
                    		<br>
                    		<br>
                    		<p>Sí la opción de mostrar cuotas está activa, usted podrá utilizar las siguientes etiquetas en la descripción o condición del medio de pago para mostrar el valor de las cuotas a pagar (sólo aplica para cuotas sin interés).</p>
                    		<ul>
                    			<li><b>{{cuota}}</b> : Muestra la cantiad de cuotas</li>
                    			<li><b>{{monto}}</b> : Muestra el monto en pesos de las cuotas</li>
                    		</ul>
                    		<br>
                    		<br>
                    	</div>
                        <div class="table-responsive">
							<table class="table js-clon-scope">
								<thead>
									<tr>
										<th style="width: 75px;"><?=__('Orden');?></th>
										<th><?=__('Nombre');?></th>
										<th><?=__('Descripción/Condición');?></th>
										<th><?=__('Activo');?></th>
										<th><?=__('Acciones');?></th>
									</tr>
								</thead>
								<tbody class="js-clon-contenedor js-clon-blank">
									<tr class="js-clon-base hidden">
										<td><?= $this->Form->input('Pago.999.orden', array('disabled' => true)); ?></td>
										<td><?= $this->Form->input('Pago.999.nombre', array('disabled' => true, 'class' => 'form-control', 'placeholder' => 'Ej: Efectivo')); ?></td>
										<td><?= $this->Form->input('Pago.999.descripcion', array('disabled' => true, 'class' => 'form-control', 'placeholder' => 'Desc del medio de pago')); ?></td>
										<td><?= $this->Form->input('Pago.999.activo', array('disabled' => true, 'checked' => true, 'class' => 'icheckbox')); ?></td>
										<td>
											<a href="#" class="btn btn-xs btn-danger js-clon-eliminar"><i class="fa fa-trash"></i> Quitar</a>
											<!--<a href="#" class="btn btn-xs btn-primary js-clon-clonar"><i class="fa fa-clone"></i> Duplicar</a>-->
										</td>
									</tr>
									<? if ( ! empty($this->request->data['Pago']) ) : ?>
									<? foreach ( $this->request->data['Pago'] as $index => $pago ) : ?>
									<tr>
										<td><?= $this->Form->input(sprintf('Pago.%d.orden', $index)); ?></td>
										<td><?= $this->Form->input(sprintf('Pago.%d.nombre', $index), array('class' => 'form-control', 'placeholder' => 'Ej: Efectivo')); ?></td>
										<td><?= $this->Form->input(sprintf('Pago.%d.descripcion', $index), array('class' => 'form-control', 'placeholder' => 'Desc del medio de pago')); ?></td>
										<td><?= $this->Form->input(sprintf('Pago.%d.activo', $index), array('class' => 'icheckbox')); ?></td>
										<td>
											<a href="#" class="btn btn-xs btn-danger js-clon-eliminar"><i class="fa fa-trash"></i> Quitar</a>
										</td>
									</tr>
									<? endforeach; ?>
									<? endif; ?>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="4">&nbsp;</td>
										<td><a href="#" class="btn btn-xs btn-success js-clon-agregar"><i class="fa fa-plus"></i> Agregar otro medio de pago</a></td>
									</tr>
								</tfoot>
							</table>
						</div>
                    </div>
                    <div class="tab-pane" id="despachos">
                        <div class="col-xs-12">
                    		<span class="label label-default label-form">Agregue un listado de despachos disponibles para el evento. Puede agregar una descripción u condición de éste.</span>
                    		<br>
                    		<br>
                    	</div>
                        <div class="table-responsive">
							<table class="table js-clon-scope">
								<thead>
									<tr>
										<th style="width: 75px;"><?=__('Orden');?></th>
										<th><?=__('Nombre');?></th>
										<th><?=__('Descripción/Condición');?></th>
										<th><?=__('Activo');?></th>
										<th><?=__('Acciones');?></th>
									</tr>
								</thead>
								<tbody class="js-clon-contenedor js-clon-blank">
									<tr class="js-clon-base hidden">
										<td><?= $this->Form->input('Despacho.999.orden', array('disabled' => true)); ?></td>
										<td><?= $this->Form->input('Despacho.999.nombre', array('disabled' => true, 'class' => 'form-control', 'placeholder' => 'Ej: Retiro en tienda')); ?></td>
										<td><?= $this->Form->input('Despacho.999.descripcion', array('disabled' => true, 'class' => 'form-control', 'placeholder' => 'Desc del despacho')); ?></td>
										<td><?= $this->Form->input('Despacho.999.activo', array('disabled' => true, 'checked' => true, 'class' => 'icheckbox')); ?></td>
										<td>
											<a href="#" class="btn btn-xs btn-danger js-clon-eliminar"><i class="fa fa-trash"></i> Quitar</a>
										</td>
									</tr>
									<? if ( ! empty($this->request->data['Despacho']) ) : ?>
									<? foreach ( $this->request->data['Despacho'] as $index => $pago ) : ?>
									<tr>
										<td><?= $this->Form->input(sprintf('Despacho.%d.orden', $index)); ?></td>
										<td><?= $this->Form->input(sprintf('Despacho.%d.nombre', $index), array('class' => 'form-control', 'placeholder' => 'Ej: Retiro en tienda')); ?></td>
										<td><?= $this->Form->input(sprintf('Despacho.%d.descripcion', $index), array('class' => 'form-control', 'placeholder' => 'Desc del despacho')); ?></td>
										<td><?= $this->Form->input(sprintf('Despacho.%d.activo', $index), array('class' => 'icheckbox')); ?></td>
										<td>
											<a href="#" class="btn btn-xs btn-danger js-clon-eliminar"><i class="fa fa-trash"></i> Quitar</a>
										</td>
									</tr>
									<? endforeach; ?>
									<? endif; ?>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="4">&nbsp;</td>
										<td><a href="#" class="btn btn-xs btn-success js-clon-agregar"><i class="fa fa-plus"></i> Agregar otro tipo de despacho</a></td>
									</tr>
								</tfoot>
							</table>
						</div>
                    </div>
                    <div class="tab-pane" id="marcas">
                        <div class="col-xs-12">
                    		<span class="label label-default label-form">Seleccione las marcas que estarán disponibles en este evento desde la Tienda</span>
                    		<br>
                    		<br>
                    	</div>
                        <div class="table-responsive">
							<table class="table js-clon-scope">
								<thead>
									<tr>
										<th style="width: 75px;"><?=__('Orden');?></th>
										<th><?=__('Marca');?></th>
										<th><?=__('Nombre Personalizado');?></th>
										<th><?=__('Logo');?></th>
										<th><?=__('Activo');?></th>
										<th><?=__('Acciones');?></th>
									</tr>
								</thead>
								<tbody class="js-clon-contenedor js-clon-blank">
									<tr class="js-clon-base hidden">
										<td><?= $this->Form->input('EventosMarca.999.orden', array('disabled' => true)); ?></td>
										<td><?= $this->Form->select('EventosMarca.999.MarcasFabricante', $marcas , array('disabled' => true, 'class' => 'form-control', 'data-live-search' => true, 'empty' => 'Seleccione marca', 'multiple' => 'multiple')); ?></td>
										<td><?= $this->Form->input('EventosMarca.999.nombre', array('disabled' => true, 'class' => 'form-control', 'placeholder' => 'Ej: Bosch, Makita, etc.')); ?></td>
										<td><?= $this->Form->input('EventosMarca.999.imagen', array('disabled' => true, 'type' => 'file', 'class' => 'fileinput btn-primary not-blank', 'data-filename-placement' => 'inside', 'title' => '<i class="fa fa-upload"></i> Logo')); ?></td>
										<td><?= $this->Form->input('EventosMarca.999.activo', array('disabled' => true, 'checked' => true, 'class' => 'icheckbox')); ?></td>
										<td>
											<a href="#" class="btn btn-xs btn-danger js-clon-eliminar"><i class="fa fa-trash"></i> Quitar</a>
										</td>
									</tr>
									<? if ( ! empty($this->request->data['EventosMarca']) ) : ?>
									<? foreach ( $this->request->data['EventosMarca'] as $index => $pago ) : ?>
									<tr>
										<td>
											<?= $this->Form->hidden(sprintf('EventosMarca.%d.id', $index), array('class' => 'id_evento_marca')); ?>
											<?= $this->Form->input(sprintf('EventosMarca.%d.orden', $index)); ?></td>
										<td><?= $this->Form->select(sprintf('EventosMarca.%d.MarcasFabricante', $index), $marcas, array('class' => 'form-control', 'data-live-search' => true, 'empty' => 'Seleccione marca', 'multiple' => 'multiple')); ?></td>
										<td><?= $this->Form->input(sprintf('EventosMarca.%d.nombre', $index), array('class' => 'form-control', 'placeholder' => 'Desc del despacho')); ?></td>
										<td>
											<? if (!empty($this->request->data['EventosMarca'][$index]['imagen'])) : ?>
												<?= $this->Html->image(sprintf('EventosMarca/%d/xs_mini_%s', $pago['id'], $pago['imagen']));?>
												<?= $this->Form->input(sprintf('EventosMarca.%d.imagen', $index), array('type' => 'file', 'class' => 'fileinput btn-primary not-blank', 'data-filename-placement' => 'inside', 'title' => '<i class="fa fa-upload"></i> Actualizar logo')); ?>
											<? else : ?>
												<?= $this->Form->input(sprintf('EventosMarca.%d.imagen', $index), array('type' => 'file', 'class' => 'fileinput btn-primary not-blank', 'data-filename-placement' => 'inside', 'title' => '<i class="fa fa-upload"></i> Logo')); ?>
											<? endif; ?>
										</td>
										<td><?= $this->Form->input(sprintf('EventosMarca.%d.activo', $index), array('class' => 'icheckbox')); ?></td>
										<td>
											<a href="#" class="btn btn-xs btn-danger js-clon-eliminar-marcas"><i class="fa fa-trash"></i> Quitar</a>
										</td>
									</tr>
									<? endforeach; ?>
									<? endif; ?>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="5">&nbsp;</td>
										<td><a href="#" class="btn btn-xs btn-success js-clon-agregar"><i class="fa fa-plus"></i> Agregar otra marca</a></td>
									</tr>
								</tfoot>
							</table>
						</div>
                    </div>
                    <div class="tab-pane" id="categorias">
                    	<div class="col-xs-12">
                    		<span class="label label-default label-form">Agregue las categorías del evento</span>
                    		<br>
                    		<br>
                    	</div>
                        <div class="table-responsive">
							<table class="table js-clon-scope">
								<thead>
									<tr>
										<th><?=__('Nombre');?></th>
										<!--<th><?=__('Cuerpo');?></th>-->
										<th><?=__('Imágen destacada');?></th>
										<th><?=__('Ícono del menú');?></th>
										<th><?=__('Texto del menú');?></th>
										<th><?=__('Activo');?></th>
										<th><?=__('Acciones');?></th>
									</tr>
								</thead>
								<tbody class="js-clon-contenedor js-clon-blank">
									<tr class="js-clon-base hidden">
										<td><?= $this->Form->input('Categoria.999.nombre', array('disabled' => true, array('placeholder' => 'Herramientas...'))); ?></td>
										<!--<td><?= $this->Form->input('Categoria.999.cuerpo', array('disabled' => true, 'class' => 'form-control')); ?></td>-->
										<td><?= $this->Form->input('Categoria.999.imagen_principal', array('disabled' => true, 'type' => 'file', 'class' => 'fileinput btn-primary not-blank', 'data-filename-placement' => 'inside', 'title' => '<i class="fa fa-upload"></i> Destacada')); ?></td>
										<td><?= $this->Form->input('Categoria.999.icono_imagen', array('disabled' => true, 'type' => 'file', 'class' => 'fileinput btn-primary not-blank', 'data-filename-placement' => 'inside', 'title' => '<i class="fa fa-upload"></i> Ícono')); ?></td>
										<td><?= $this->Form->input('Categoria.999.icono_texto', array('disabled' => true)); ?></td>
										<td><?= $this->Form->input('Categoria.999.activo', array('disabled' => true, 'checked' => true, 'class' => 'icheckbox')); ?></td>
										<td>
											<a href="#" class="btn btn-xs btn-danger js-clon-eliminar"><i class="fa fa-trash"></i> Quitar</a>
										</td>
									</tr>
									<? if ( ! empty($this->request->data['Categoria']) ) : ?>
									<? foreach ( $this->request->data['Categoria'] as $index => $categoria ) : ?>
									<tr>
										<td>
											<?= $this->Form->hidden(sprintf('Categoria.%d.id', $index), array('class' => 'id_evento_categoria')); ?>
											<?= $this->Form->input(sprintf('Categoria.%d.nombre', $index)); ?></td>
										<!--<td><?= $this->Form->input(sprintf('Categoria.%d.cuerpo', $index)); ?></td>-->
										<td>
											<? if (!empty($this->request->data['Categoria'][$index]['imagen_principal'])) : ?>
												<?= $this->Html->image(sprintf('Categoria/%d/xs_mini_%s', $categoria['id'], $categoria['imagen_principal']));?>
												<?= $this->Form->input(sprintf('Categoria.%d.imagen_principal', $index), array('type' => 'file', 'class' => 'fileinput btn-primary not-blank', 'data-filename-placement' => 'inside', 'title' => '<i class="fa fa-upload"></i> Actualizar')); ?>
											<? else : ?>
												<?= $this->Form->input(sprintf('Categoria.%d.imagen_principal', $index), array('type' => 'file', 'class' => 'fileinput btn-primary not-blank', 'data-filename-placement' => 'inside', 'title' => '<i class="fa fa-upload"></i> Destacada')); ?>
											<? endif; ?>
										</td>
										<td>
											<? if (!empty($this->request->data['Categoria'][$index]['icono_imagen'])) : ?>
												<?= $this->Html->image(sprintf('Categoria/%d/xs_mini_%s', $categoria['id'], $categoria['icono_imagen']));?>
												<?= $this->Form->input(sprintf('Categoria.%d.icono_imagen', $index), array('type' => 'file', 'class' => 'fileinput btn-primary not-blank', 'data-filename-placement' => 'inside', 'title' => '<i class="fa fa-upload"></i> Actualizar')); ?>
											<? else : ?>
												<?= $this->Form->input(sprintf('Categoria.%d.icono_imagen', $index), array('type' => 'file', 'class' => 'fileinput btn-primary not-blank', 'data-filename-placement' => 'inside', 'title' => '<i class="fa fa-upload"></i> Destacada')); ?>
											<? endif; ?>
										</td>
										<td><?= $this->Form->input(sprintf('Categoria.%d.icono_texto', $index)); ?></td>
										<td><?= $this->Form->input(sprintf('Categoria.%d.activo', $index), array('class' => 'icheckbox')); ?></td>
										<td>
											<a href="#" class="btn btn-xs btn-danger js-clon-eliminar-categoria"><i class="fa fa-trash"></i> Quitar</a>
										</td>
									</tr>
									<? endforeach; ?>
									<? endif; ?>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="5">&nbsp;</td>
										<td><a href="#" class="btn btn-xs btn-success js-clon-agregar"><i class="fa fa-plus"></i> Agregar otra categoria</a></td>
									</tr>
								</tfoot>
							</table>
						</div>
                    </div>
                    <div class="tab-pane" id="productos">
                        <div class="col-xs-12">
							<div class="form-inline form-productos">
								<div class="form-group">
									<label>Ingrese la referencia del producto&nbsp;&nbsp;&nbsp;&nbsp;</label>
								</div>
								<div class="form-group">
									<input class="form-control input-productos-buscar" placeholder="RF2010C" type="text"  style="min-width: 300px;">
								</div>
								<div class="form-group">
									<button class="btn btn-primary button-productos-buscar"><span class="fa fa-plus"></span> Agregar</button>
								</div>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-stripped" id="tablaProductos">
								<thead>
									<th>ID</th>
									<th>Referencia</th>
									<th>Nombre</th>
									<th>Precio normal</th>
									<th>Descuento</th>
									<th>Precio final</th>
									<th>Acciones</th>
								</thead>
								<tbody>
									<? if (!empty($this->request->data['EventosProducto'])) : 
										echo $this->Html->tabla_productos($this->request->data['EventosProducto']); 
									?>
									<? endif; ?>
								</tbody>
							</table>
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


<? if ( ! empty($this->request->data['EventosMarca']) ) : ?>
<? foreach ( $this->request->data['EventosMarca'] as $index => $pago ) : ?>
<script type="text/javascript">
	var selected = [];
	<? foreach ($pago['MarcasFabricante'] as $ix => $fabricante) : ?>
		selected.push(<?=$fabricante['id_manufacturer'];?>);
	<? endforeach; ?>
	$('select[name="data[EventosMarca][<?=$index;?>][MarcasFabricante][]"]').val( selected );
</script>
<? endforeach; ?>
<? endif; ?>