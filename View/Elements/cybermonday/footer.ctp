<footer class="page-footer naranjo">
    <div class="container">
        <div class="row">
        	<div class="col s12 m4">
        		<h5 class="white-text valign-wrapper"><i class="mdi-action-info-outline"></i> Información</h5>
        		<? if (isset($todo['Pagina'])) :  ?>
                <ul>
                    <? foreach($todo['Pagina'] as $ip => $pagina) :  ?>
        			 <li><?=$this->Html->link($pagina['Pagina']['nombre'], array('controller' => 'eventos', 'action' => 'pagina', 'slug' => $pagina['Pagina']['slug']), array('class' => 'white-text sm-text')); ?></li>
                    <? endforeach; ?>
        		</ul>
                <? endif; ?>
        	</div>
        	<div class="col s12 m4">
        		<h5 class="white-text valign-wrapper"><i class="mdi-social-people-outline"></i> Servicio al cliente</h5>
        		<ul>
        			<li><a class="white-text sm-text" href="mailto:<?=$todo['Evento']['email'];?>"><?=$todo['Evento']['email'];?></a></li>
        			<li><a class="white-text sm-text" href="tel:<?=$todo['Evento']['fono'];?>"><?=$todo['Evento']['fono'];?></a></li>
        		</ul>
        	</div>
        	<div class="col s12 m4">
        		<h5 class="white-text valign-wrapper"><i class="mdi-action-store"></i> Tienda</h5>
        		<ul>
        			<li class="white-text sm-text"><b>Horario de atención:</b> Lunes a Viernes de 09:00 a 14:00 y de 15:00 a 18:30</li>
        			<li class="white-text sm-text"><b>Dirección:</b> Diagonal Oriente #1355, Ñuñoa, Santiago.</li>
        		</ul>
        	</div>
        </div>
    </div>
</footer>