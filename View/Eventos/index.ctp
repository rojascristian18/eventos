<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="error-template center-align">
                <h1 class="text-nodriza">Oops!</h1>
                <h2 class="text-nodriza">404 No encontrado</h2>
                <div class="text-nodriza error-details">
                    El evento que buscas no existe. 
                </div>
                <br>
                <br>
                <div class="error-actions">
                	<h5 class="text-nodriza">
                		¡Te invitamos a visitar nuestras tiendas online!
                	</h5>
                    <ul>
                    <? foreach ($tiendas as $i => $tienda) : ?>
                    	<li><?=$this->Html->link(
                    			$this->Html->image($tienda['Tienda']['logo']['path'], array('class' => 'responsive-img')) . ' Ir a ' . $tienda['Tienda']['nombre'],
                    			'http://' . $tienda['Tienda']['url'],
                    			array('escape' => false, 'class' => 'text-nodriza')
                    			);?></li>	
                    <? endforeach; ?>
                	</ul>
                </div>
            </div>
        </div>
    </div>
</div>