<?= $this->Form->create('Filtro', array('type' => 'get', 'url' => array('controller' => $this->request->params['controller'], 'action' => $this->request->params['action']), 'inputDefaults' => array('div' => false, 'label' => false))); ?>
<div id="filtro">
	<div class="container">
		<div class="row">
			<div class="input-field col s3 m3">
				<select id="filtroMarcas" multiple name="m[]">
					<option value="" disabled selected>Seleccione</option>
					<? foreach ($todo['EventosMarca'] as $ix => $marca) : ?>
						<option value="<?=$marca['EventosMarca']['id'];?>"><?=$marca['EventosMarca']['nombre'];?></option>
					<? endforeach; ?>
				</select>
	            <label><?=__('Marcas');?></label>
			</div>
			<div class="input-field col s3 m3">
				<select id="filtroPrecios" name="p">
					<option value="" disabled selected>Seleccione</option>
					<? foreach ($todo['Filtro']['rango_precios'] as $ip => $precio) : ?>
						<option value="<?=$ip;?>"><?=$precio; ?></option>
					<? endforeach; ?>
				</select>
				<label for="icon_password">Precio</label>
			</div>
			<div class="input-field col s3 m3">
				<select id="filtroDescuento" name="d">
					<option value="" disabled selected>Seleccione</option>
					<option value="DESC">De menor a mayor descuento</option>
					<option value="ASC">De mayor a menor descuento</option>
				</select>
				<label for="icon_password">Descuentos</label>
			</div>
			<div class="input-field col s3 m3">
				<div class="input-field col s12">
					<button class="btn naranjo waves-effect waves-light col s12" type="submit"><i class="fa fa-filter"></i> Filtrar</button>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->Form->end(); ?>
<script type="text/javascript">
	var filtroPrecio = '', arrMarcas = [], filtroDescuento = '';
</script>

<? if (isset($this->request->query['m']) && !empty($this->request->query['m']) ) : ?>
	<script type="text/javascript">
	    arrMarcas = [];

	    <? foreach ($this->request->query['m'] as $i => $marca) : ?>
	        arrMarcas.push(<?=$marca;?>);
	    <? endforeach; ?>
	</script>		
<? endif; ?>


<? if (isset($this->request->query['p']) && !empty($this->request->query['p']) ) : ?>
	<script type="text/javascript">
	    filtroPrecio = "<?=$this->request->query['p'];?>";
	</script>		
<? endif; ?>


<? if (isset($this->request->query['d']) && !empty($this->request->query['d']) ) : ?>
	<script type="text/javascript">
	   filtroDescuento = "<?=$this->request->query['d'];?>";
	</script>		
<? endif; ?>