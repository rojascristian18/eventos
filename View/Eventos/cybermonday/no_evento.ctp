<div class="img-inactivo">
	<div class="container">
		<div class="row">
			<div class="col s12 m6 offset-m3">
				<div class="card">
					<div class="card-image">
						<?=$this->Html->image($todo['Evento']['imagen_inactivo']['path'], array('class' => 'responsive-img'));?>

						<span class="card-title">Este evento no está activo</span>
					</div>
					<div class="card-content">
						<p>Usted será redirigido a <?=$todo['Tienda']['nombre']; ?> en <span id="count"></span></p>
						</div>
						<div class="card-action">
						<a href="https://<?=$todo['Tienda']['url'];?>" class="text-nodriza">Ir ahora a <?=$todo['Tienda']['nombre']; ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>

<script type="text/javascript">
	
	var cont = 10;

	var intervalo = setInterval(function(){
		document.getElementById("count").innerHTML = cont;

		if (cont == 0) {
			window.location.href = "https://<?=$todo['Tienda']['url'];?>";
			clearInterval(intervalo);
		}
		cont--;
	}, 1000);
	
</script>