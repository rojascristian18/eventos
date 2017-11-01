<div id="filtro">
	<div class="container">
		<div class="row">
			<div class="input-field col s3">
				<select id="filtroMarcas" multiple>
					<option value="" disabled selected>Seleccione</option>
					<? foreach ($todo['EventosMarca'] as $ix => $marca) : ?>
						<option value="<?=$marca['EventosMarca']['id'];?>"><?=$marca['EventosMarca']['nombre'];?></option>
					<? endforeach; ?>
				</select>
	            <label><?=__('Marcas');?></label>
			</div>
			<div class="input-field col s3">
				<select id="filtroPrecios">
					<option value="" disabled selected>Seleccione</option>
					<? foreach ($todo['Filtro']['rango_precios'] as $ip => $precio) : ?>
						<option value="<?=$ip;?>"><?=$precio; ?></option>
					<? endforeach; ?>
				</select>
				<label for="icon_password">Precio</label>
			</div>
			<div class="input-field col s3">
				<select id="filtroDescuento">
					<option value="" disabled selected>Seleccione</option>
					<option value="asc">De menor a mayor descuento</option>
					<option value="asc">De mayor a menor descuento</option>
				</select>
				<label for="icon_password">Descuentos</label>
			</div>
			<div class="input-field col s3">
				<div class="input-field col s12">
					<button class="btn naranjo waves-effect waves-light col s12" type="submit" name="filtroEnviar"><i class="fa fa-filter"></i> Filtrar</button>
				</div>
			</div>
		</div>
	</div>
</div>