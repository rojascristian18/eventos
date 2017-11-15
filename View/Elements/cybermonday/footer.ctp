<footer class="page-footer grey darken-4">
    <div class="container">
        <div class="row">
        	<div class="col s12 m4">
        		<h5 class="white-text"><i class="mdi-action-info-outline"></i> Información</h5>
        		<ul>
        			<li><?=$this->Html->link('Términos y condiciones', array('controller' => 'evento', 'action' => 'terminos_y_condiciones'), array('class' => 'white-text')); ?></li>
        		</ul>
        	</div>
        	<div class="col s12 m4">
        		<h5 class="white-text"><i class="mdi-social-people-outline"></i> Servicio al cliente</h5>
        		<ul>
        			<li><a class="white-text" href="mailto:<?=$todo['Evento']['email'];?>"><?=$todo['Evento']['email'];?></a></li>
        			<li><a class="white-text" href="tel:<?=$todo['Evento']['fono'];?>"><?=$todo['Evento']['fono'];?></a></li>
        		</ul>
        	</div>
        	<div class="col s12 m4">
        		<h5 class="white-text"><i class="mdi-action-store"></i> Tienda</h5>
        		<ul>
        			<li class="white-text"><b>Horario de atención:</b> Lunes a Viernes de 09:00</li>
        			<li class="white-text"><b>Dirección:</b> Diagonal Oriente #1355, Ñuñoa, Santiago.</li>
        		</ul>
        	</div>
        </div>
    </div>
</footer>