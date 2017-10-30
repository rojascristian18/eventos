<div class="product">
    <div class="card">
        <div class="card-image waves-effect waves-block waves-light">
            <? if (isset($producto['Producto']['descuento']) ) : ?>
                <a href="#" class="btn-floating btn-large btn-price waves-effect waves-light  orange accent-2"><?=$producto['Producto']['descuento']?></a>
            <? endif; ?>

            <a href="#"><img src="https://dummyimage.com/300x300/fff/ff5500.jpg" alt="product-img">
            </a>
        </div>
        <ul class="card-action-buttons">
            <li><a class="btn-floating waves-effect waves-light orange darken-1"><i class="mdi-action-info activator"></i></a>
            </li>
        </ul>
        <div class="card-content">

            <div class="row">
                <div class="col s12">
                    <p class="card-title grey-text text-darken-4"><a href="#" class="grey-text text-darken-4">
                    	<?=$this->Text->truncate(
						    $producto['Idioma'][0]['ProductosIdioma']['name'],
						    30,
						    array(
						        'ellipsis' => '...',
						        'exact' => false
						    )
						); ?></a>
                    </p>
                </div>
                <div class="col s12">
                    <? if (isset($producto['MarcasFabricante'])) : ?>
                    <a href=""></a><?=$this->Html->image( sprintf('/img/EventosMarca/%d/%s', $producto['MarcasFabricante']['EventosMarca']['id'], $producto['MarcasFabricante']['EventosMarca']['imagen']), array('alt' => $producto['MarcasFabricante']['EventosMarca']['nombre'], 'class' => 'responsive-img') );?>
                    </a>
                    <? endif; ?>
                </div>
                <div class="col s12">
                    <span class="price"><?= CakeNumber::currency($producto['Producto']['valor_final'], 'CLP'); ?></span>
                </div>
            </div>
        </div>
        <div class="card-reveal">
            <span class="card-title grey-text text-darken-4"><i class="mdi-navigation-close right"></i>
            	<?=$this->Text->truncate(
				    $producto['Idioma'][0]['ProductosIdioma']['description_short'],
				    60,
				    array(
				        'ellipsis' => '...',
				        'exact' => false
				    )
				); ?></span>
            <p><?=$producto['Idioma'][0]['ProductosIdioma']['name'];?></p>
        </div>
    </div>
</div>